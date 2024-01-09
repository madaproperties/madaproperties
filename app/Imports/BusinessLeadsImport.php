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
              "activity_name.*" => "required",
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
        $contact['location_id'] = $country_id;
        $agent_id = $this->getID($index,'Agent','email',$contact['user_id']);
        $contact['user_id'] = $agent_id;
        
        // if there is assigned to will be the smae value - atherwise will be the uploder
        $contact['user_id'] = !empty($contact['user_id']) ? $contact['user_id'] : auth()->id();
 
        $contact['created_by'] = auth()->id(); // assigned created by for the currunt auth

        unset($contact['country']);
        $j=0;
        for($i=1;$i<100;$i++){
          if(!isset($contact['contact_person_name'.$i]) || !isset($contact['contact_person_email'.$i]) 
          || !isset($contact['contact_person_phone'.$i]) || !isset($contact['contact_person_designation'.$i])){
            break;
          }
          $contact_persons[$j]['name'] = $contact['contact_person_name'.$i];
          $contact_persons[$j]['email'] = $contact['contact_person_email'.$i];
          $contact_persons[$j]['phone'] = $contact['contact_person_phone'.$i];
          $contact_persons[$j]['designation'] = $contact['contact_person_designation'.$i];

          $j++;

          unset($contact['contact_person_name'.$i]);
          unset($contact['contact_person_email'.$i]);
          unset($contact['contact_person_phone'.$i]);
          unset($contact['contact_person_designation'.$i]);
        }
      }
    
      if(!$this->errors)
      {
        foreach($businessLeads as $contact) {
          $contact = $contact->toArray();
          $business = BusinessDevelopment::create($contact);
          $action = __('site.lead created');
          $contactPersons = [];
          if($contact_persons){
            $i=0;
            for($j=0;$j<count($contact_persons);$j++){
              $contactPersons[$i]['name']=$contact_persons[$j]['name'];
              $contactPersons[$i]['email']=$contact_persons[$j]['email'];
              $contactPersons[$i]['phone']=$contact_persons[$j]['phone'];
              $contactPersons[$i]['designation']=$contact_persons[$j]['designation'];
              $contactPersons[$i]['lead_id']=$business->id;
              $i++;
            }
            \DB::table("business_contact_person")->insert($contactPersons); 
          }
          $this->newBusinessDevelopmentActivity($business->id,auth()->id(),$action,'Business',$business->id,null,true);
        }
        session()->flash('success',__('site.success'));
      }else{
        return redirect(route('admin.'))->withErrors($this->errors);
      }
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
        if($model == 'Agent') {
          $ID =  User::where($search_feild,'LIKE','%'.$value)->first();
          $customMsg = __('site.user not found: recode').'['.$index.'] ' ;
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
