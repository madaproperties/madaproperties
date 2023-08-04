<?php

namespace App\Imports;

use App\Contact;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Validator;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Country;
use App\City;
use App\User;
use App\ProjectName;
use App\ProjectDeveloper;
use App\Status;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Carbon\Carbon;
use App\DatabaseRecords;
use App\Community;
use App\Zones;

use App\Districts;


class DatabaseImport implements ToCollection, WithHeadingRow,ShouldQueue,WithChunkReading 
{

    private $errors = [];
    private $validateAttribute = [
      'user_country_id'=>'required' ,
      "country_name" => "nullable",
      "name"          => "required",
      "email"          => "nullable",
      "phone"          => "required",
      "city"          => "nullable",
      "area"          => "nullable",
      "project_id"          => "nullable",
      "unit_country"    =>"nullable",
      "building_name"          => "nullable",
      "unit_name"             => "nullable",
      "price"          => "nullable",
      "bedroom"          => "nullable",
      'local_phone_no_or_reference' => 'nullable',
      'options' => 'nullable',
      'response' => 'nullable',
      'community_id' => 'nullable',
      'subcommunity_id' => 'nullable',
      'developer' => 'nullable',
      'status' => 'nullable',        
      'comment' => 'nullable',
      'user_id' => 'nullable' ,
      'zone_id'=>'nullable',
      'district_id'=>'nullable',
      'agent_email' => 'nullable' ,
      'user_country_id'=>'nullable' ,
      'zone_id'=>'nullable',
      'district_id'=>'nullable',
       ];

    public function collection(Collection $rows)
    {
      $contactsData = $rows->slice(0);
      $rowsArray = $contactsData->toArray();
      
      
      foreach($contactsData as $index => $contact) {
        $index++;
        $contact = $contact->toArray();
        // get new status 
        $country_id = $this->getID($index,'Country','name_en',$contact['country_name']);
        $contact['country_id'] = $country_id;
        $user_country_id = $this->getID($index,'Country','name_en',$contact['user_country_id']);
        $contact['user_country_id'] = $user_country_id;

        $agent_id = $this->getID($index,'Agent','email',$contact['agent_email']);
        $contact['user_id'] = $agent_id;
        // 

        if($country_id==1)
        {

          $zone_id = $this->getID($index,'Zones','zone_name',$contact['zone_id']);
          $contact['zone_id'] = $zone_id;
          $district_id = $this->getID($index,'Districts','name',$contact['district_id']);
        $contact['district_id'] = $district_id;

        // $community_id = $this->getID($index,'Community','name_en',$contact['community_id']);
        $contact['community_id'] = '';
         // $subcommunity_id = $this->getID($index,'Community','name_en',$contact['subcommunity_id']);
        $contact['subcommunity_id'] = '';

        }
        else
        {
          // $zone_id = $this->getID($index,'Zones','zone_name',$contact['zone_id']);
          $contact['zone_id'] = '';
          // $district_id = $this->getID($index,'Districts','name',$contact['district_id']);
        $contact['district_id'] = '';
        $community_id = $this->getID($index,'Community','name_en',$contact['community_id']);
        $contact['community_id'] = $community_id;
         $subcommunity_id = $this->getID($index,'Community','name_en',$contact['subcommunity_id']);
        $contact['subcommunity_id'] = $subcommunity_id;

        }
      

        $contact['project_id'] = $contact['project_name'];
        $contact['created_by']=auth()->id();
        // $contact['user_id']=auth()->id();
         if($agent_id=='')
        {
        
        $contact['user_id']=auth()->id();
        }
        else
        {
    
        $contact['user_id']=$contact['user_id'];  
        }
        // 
        $contact['status']=2;
        unset($contact['country_name']); // remove asssigned to => replaced with user_id
        unset($contact['agent_email']);
        // unset($contact['unit_country']);
        unset($contact['project_name']);
        $contact = DatabaseRecords::create(array_filter($contact));
      }
      session()->flash('success',__('site.success'));
    }

    private function getID($index,$model,$search_feild,$value,$extra_condtion_value = null)
    {
      if($value) // check if it not empty
      {
        if($model == 'Country') {
          $ID = Country::where($search_feild,'LIKE','%'.$value)->first();
          $customMsg = __('site.'.strtolower($model)).' '.__('site.not found: recourd').$value.' #['.$index.']';
        }

        else if($model == 'Project') {
          $ID = ProjectName::where($search_feild,'LIKE','%'. $value )->first();
          $customMsg = __('site.project not found: recode').$value.' #['.$index.']';
        }else if($model == 'Agent') {
          $ID =  User::where($search_feild,'LIKE','%'.$value)->first();
          $customMsg = __('site.user not found: recode').'['.$index.'] ' ;
        }

        else if($model == 'Zones') {
          $ID = Zones::where($search_feild,'LIKE','%'. $value )->first();
          $customMsg = __('site.zone not foud: recode').$value.' #['.$index.']';
        }
        else if($model == 'Districts') {
          $ID = Districts::where($search_feild,'LIKE','%'. $value )->first();
          $customMsg = __('site.district not found: recode').$value.' #['.$index.']';
        }
        else if($model == 'Community') {
          $ID = Community::where($search_feild,'LIKE','%'. $value )->first();
          $customMsg = __('site.community not foud: recode').$value.' #['.$index.']';
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
}