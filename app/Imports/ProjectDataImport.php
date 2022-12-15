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
use App\ProjectData;


class ProjectDataImport implements ToCollection, WithHeadingRow,ShouldQueue,WithChunkReading 
{

    private $errors = [];
    private $validateAttribute = [
      "country_id.*"          => "required",
      "city_name.*"          => "required",
      "district_name.*"          => "required",
      "developer_id.*"          => "required",
      "unit_name.*"          => "required",
      "project_id.*"          => "required",
      "property_type.*"          => "required",
      "area_bua.*"          => "required",
      "area_plot.*"          => "required",
      "bedroom.*"          => "required",
      "price.*"          => "required",
      "completion_date.*"          => "required",
      "payment_status.*"          => "required",
      "floor_no.*" =>"required",
      "commission" => "nullable",
      "down_payment" =>"nullable",
            
      "status" =>"nullable",      
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
        $project_id = $this->getID($index,'Project','name',$contact['project_name']);
        $contact['project_id'] = $project_id;
        $developer_id = $this->getID($index,'Developer','name',$contact['developer_name']);
        $contact['developer_id'] = $developer_id;
        $contact['payment_status'] = str_replace(" ","-",$contact['payment_status']);

        unset($contact['country_name']); // remove asssigned to => replaced with user_id
        unset($contact['project_name']);
        unset($contact['developer_name']);
        $contact = ProjectData::create(array_filter($contact));
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
        }else if($model == 'Developer') {
          $ID =  ProjectDeveloper::where($search_feild,'LIKE','%'.$value)->first();
          $customMsg = __('site.developer not found: recode').'['.$index.'] ' ;
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
