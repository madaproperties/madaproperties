<?php

namespace App\Imports;

use App\Commercial;
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
use App\CommercialActivity;
use App\CommercialContactPerson;

class CommercialLeadsImport implements ToCollection, WithHeadingRow,ShouldQueue,WithChunkReading 
{

    private $errors = [];
    private $validateAttribute = [
              "brand_name.*" => "required",
              "country.*" => "required",
              "activity_name.*" => "required",
              "activity_type.*" => "required",
            ];

    public function collection(Collection $rows)
    {
      $commercialLeads = $rows->slice(0);
      $rowsArray = $commercialLeads->toArray();
      
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
      foreach($commercialLeads as $index => $contact) {   // Get ID's
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
        
      
        // if there is assigned to will be the smae value - atherwise will be the uploder
        $lead_data['user_id'] = !empty($contact['assignedto_id']) ? $contact['assignedto_id'] : auth()->id();
        // check if he assigned to anther one i have to check if the currentauth is the leader , or the cuurun one is not a admin 
        if($lead_data['user_id'] != auth()->id() AND userRole() != 'admin') 
        {
          $checkAssigned = User::where('id',$lead_data['user_id'])
                              ->where('leader',auth()->id())->first();
          if(!$checkAssigned AND $auth_user->rule == 'leader')
          {
            $this->addErorr(__('site.you are not leader for user numer').' ['. $lead_data['user_id'].']');
          }
              
          
        }
        
        
        $lead_data['created_by'] = auth()->id(); // assigned created by for the currunt auth
        $lead_data['brand_name'] = $contact['brand_name'];
        $lead_data['activity_name'] = $contact['activity_name'];
        $lead_data['activity_type'] = $contact['activity_type'];
        $commercial = Commercial::create($lead_data);
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
          $contactPersons[$j]['lead_id']=$commercial->id;
          $j++;

        }

        if($contactPersons){
          \DB::table("commercial_contact_person")->insert($contactPersons); 
        }
        $this->newCommercialActivity($commercial->id,auth()->id(),$action,'Commercial',$commercial->id,null,true);
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

    public function newCommercialActivity($commercialID,$userID,$action,$model = null,$relatedModelID = null,$activityDate = null,$createdContact = false){
        
      $activityDate = str_replace('/','-',$activityDate);
      $activityDate = $activityDate ? Carbon::createFromFormat('d-m-Y', $activityDate)->format('d-m-Y') : $activityDate;

      $data = [
        'commercial_id' => $commercialID,
        'user_id' => $userID,
        'action' => $action,
        'related_model' => $model,
        'related_model_id' => $relatedModelID,
      ];

      if($activityDate){
        $data['date'] = $activityDate;
      }

      CommercialActivity::create($data);
    }
}
