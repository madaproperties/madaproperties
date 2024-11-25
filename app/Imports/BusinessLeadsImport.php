<?php

namespace App\Imports;

use App\BusinessDevelopment;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Validator;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Country;
use App\City;
use App\User;
use App\Project;
use App\LastMileConversion;
use App\Status;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Carbon\Carbon;
use App\BusinessDevelopementActivity;
use App\BusinessContactPerson;

class BusinessLeadsImport implements ToCollection, WithHeadingRow,ShouldQueue,WithChunkReading 
{

    private $errors = [];
    private $validateAttribute = [
              "brand_name.*" => "required",
              "country.*" => "required",
              "business_category.*" => "required",
              "activity_type.*" => "required",
              "user_id.*" => "nullable",
            ];

    public function collection(Collection $rows)
    {
      $businessLeads = $rows->slice(0);
      $rowsArray = $businessLeads->toArray();
      
      $reqiuredFeilds = [];
      
      // get required feilds to validate them 
      foreach($this->validateAttribute as $key => $val) {
          $key = str_replace('.*','',$key);
          $find = str_contains($val,'required');
          if($find) {
              $key = str_replace('.*','',$key);
              $reqiuredFeilds[] = $key;
          }
      }
      

      foreach($rowsArray as $index => $rows) {
          $index++;
          $rows = array_keys($rows);
          
          foreach($reqiuredFeilds as $feild) {
              if(! in_array($feild,$rows)) {
                  $this->addErorr("#[".$index."] field ". $feild . ' required');
              }
          }
      }

      Validator::make($rowsArray, $this->validateAttribute)->validate();
      $errors = [];
      
      foreach($this->validateAttribute as  $val => $key) {
          $trimRules[] = str_replace('.*','',$val);
      }
     
      if($this->errors) {
          return redirect(route('admin.'))->withErrors($this->errors);
      }

      $contact_persons = [];
      $lead_data = []; 
      foreach($businessLeads as $index => $contact) {   // Get ID's
        $index++;
        // check if lead exsist before in the same team 
        if(userRole() == 'leader') {
            $leader = auth()->id();    
        }
    
        $leader = userRole() == 'leader' ? auth()->id() :  auth()->user()->leader;

        $countryCode = Country::where('id',$contact['country'])->first();
        $countryCode = $countryCode ? $countryCode->id : null;
          
          
      
          // end check if lead exsist before 
        
        $country_id = $this->getID($index,'Country','name_en',$contact['country']);
        $lead_data['location_id'] = $country_id;
        $agent_id = $this->getID($index,'Agent','email',$contact['user_id']);
        $contact['user_id'] = $agent_id;
         $auth_user =User::where('id',auth()->id())->first();
        // if there is assigned to will be the smae value - atherwise will be the uploder
        $lead_data['user_id'] = !empty($contact['user_id']) ? $contact['user_id'] : auth()->id();
        // check if he assigned to anther one i have to check if the currentauth is the leader , or the cuurun one is not a admin 
        if($lead_data['user_id'] != auth()->id() AND userRole() != 'admin') 
        {
          $checkAssigned = User::where('id',$lead_data['user_id'])
                              ->whereRaw('JSON_CONTAINS(leader, ?)', [auth()->id()])
                              ->first();
          if(!$checkAssigned AND $auth_user->rule == 'leader')
          {
            $this->addErorr(__('site.you are not leader for user numer').' ['. $lead_data['user_id'].']');
          }
              
          
        }
        
        
        $lead_data['created_by'] = auth()->id(); // assigned created by for the currunt auth
        $lead_data['brand_name'] = $contact['brand_name'];
        $lead_data['business_category'] = $contact['business_category'];
        $lead_data['activity_type'] = $contact['activity_type'];
        $business = BusinessDevelopment::create($lead_data);
        $action = __('site.lead created');
        $contactPersons = [];
        $j=0;
        for($i=1;$i<100;$i++){
          if(!isset($contact['contact_person_name'.$i]) || !isset($contact['contact_person_email'.$i]) 
          || !isset($contact['contact_person_phone'.$i]) || !isset($contact['contact_person_designation'.$i])){
            break;
          }
          $contactPersons[$j]['name'] = $contact['contact_person_name'.$i];
          $contactPersons[$j]['email'] = $contact['contact_person_email'.$i];
          $contactPersons[$j]['phone'] = $contact['contact_person_phone'.$i];
          $contactPersons[$j]['designation'] = $contact['contact_person_designation'.$i];
          $contactPersons[$j]['lead_id']=$business->id;
          $j++;

        }

        if($contactPersons){
          \DB::table("business_contact_person")->insert($contactPersons); 
        }
        $this->newBusinessDevelopmentActivity($business->id,auth()->id(),$action,'Commercial',$business->id,null,true);
      }
   
      session()->flash('success',__('site.success'));
    }


    private function getID($index,$model,$search_feild,$value,$extra_condtion_value = null)
    {
      if($value) // check if it not empty
      {
        if($model == 'Country' OR $model == 'unit_country') // get the result form model
        {
          $ID = Country::where($search_feild,'LIKE','%'.$value)->first();
          $customMsg = __('site.'.strtolower($model)).' '.__('site.not found: recourd').$value.' #['.$index.']';
        }
        if($model == 'City' OR $model == 'unit_city')
        {
          $ID = City::where($search_feild,'LIKE','%'.$value)
                      ->where('country_id',$extra_condtion_value)
                      ->first();
          $customMsg = __('site.'.strtolower($model)).' '.__('site.not found or not related to the country: recourd').$value.' #['.$index.']';
        }

        if($model == 'Project')
        {
          $ID = Project::where($search_feild,'LIKE','%'. $value )->first();
          $customMsg = __('site.project not found: recode').$value.' #['.$index.']';
        }

        if($model == 'last_mile_conversion')
        {
          $ID =  LastMileConversion::where($search_feild,'LIKE','%'.$value)->first();
          $customMsg = __('site.LastMile not found: recode').'['.$index.'] ' ;
        }
          if($model == 'Agent') {
          $ID =  User::where($search_feild,'LIKE','%'.$value)->first();
          $customMsg = __('site.user not found: recode').'['.$index.'] ' ;
        }

        // check if therer is result found or make an errors messge
        if(!$ID){
          $this->errors[] = $customMsg;
        }else{
          return $ID = $ID->id;
        }
      }
    }

    private function addErorr($error)
    {
      $this->errors[] = $error;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function newBusinessDevelopmentActivity($businessID,$userID,$action,$model = null,$relatedModelID = null,$activityDate = null,$createdContact = false){
        
      $activityDate = str_replace('/','-',$activityDate);
      $activityDate = $activityDate ? Carbon::createFromFormat('d-m-Y', $activityDate)->format('d-m-Y') : $activityDate;

      $data = [
        'business_id' => $businessID,
        'user_id' => $userID,
        'action' => $action,
        'related_model' => $model,
        'related_model_id' => $relatedModelID,
      ];

      if($activityDate){
        $data['date'] = $activityDate;
      }

      BusinessDevelopementActivity::create($data);
    }
}
