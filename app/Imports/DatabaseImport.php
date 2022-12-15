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


class DatabaseImport implements ToCollection, WithHeadingRow,ShouldQueue,WithChunkReading 
{

    private $errors = [];
    private $validateAttribute = [
      "country_id"            => "nullable",
      "name"          => "nullable",
      "email"          => "nullable",
      "phone"          => "nullable",
      "city"          => "nullable",
      "area"          => "nullable",
      "project_id"          => "nullable",
      "building_name"          => "nullable",
      "unit_name"             => "nullable",
      "price"          => "nullable",
      "bedroom"          => "nullable",
      'local_phone_no_or_reference' => 'nullable',
      'options' => 'nullable',
      'response' => 'nullable',
      'community' => 'nullable',
      'sub_community' => 'nullable',
      'developer' => 'nullable',
      'status' => 'nullable',        
      'comment' => 'nullable',
      'created_by'=>'nullable',
      'assign_to' => 'nullable',       
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
        $developer_id = $this->getID($index,'Agent','email',$contact['agent_email']);
        $contact['developer_id'] = $developer_id;
        $contact['project_id'] = $contact['project_name'];
        $contact['created_by']=auth()->id();
        $contact['assign_to']=auth()->id();
        $contact['status']=2;
        unset($contact['country_name']); // remove asssigned to => replaced with user_id
        unset($contact['agent_email']);
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
        }else if($model == 'Project') {
          $ID = ProjectName::where($search_feild,'LIKE','%'. $value )->first();
          $customMsg = __('site.project not found: recode').$value.' #['.$index.']';
        }else if($model == 'Agent') {
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
}
