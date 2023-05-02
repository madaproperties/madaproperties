<?php

namespace App\Imports;

use App\Employee;
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


class EmployeeImport implements ToCollection, WithHeadingRow,ShouldQueue,WithChunkReading 
{
 
    private $errors = [];
    private $validateAttribute = [
        "emp_no.*"          => "nullable|max:255",
        "employee_name.*"          => "nullable|max:255",
        "official_email.*"          => "nullable|email|max:255",
        "personel_email.*"          => "nullable|email|max:255",
        "phone.*"          => "nullable|max:255",
        "alternative_phone.*"          => "nullable|max:225",
        "reporting_manager.*"          => "nullable|max:225",
        "designation.*"          => "nullable|max:225",
        "department.*"          => "nullable|max:225",
        "nationality.*"          => "nullable|max:225",
        "date_of_join.*" => "nullable",
        "date_of_birth.*"          => "nullable",
        "visa_status.*"          => "nullable|max:225",
        "visa_issue.*"=>"nullable",
        "visa_exp.*"      =>"nullable",
        "passport_no.*"    =>"nullable|max:225",
        "passport_exp.*"  => "nullable",
        "passport_issue.*"=>"nullable",
        "emirates_id.*"          => "nullable|max:225",
        "emirates_id_exp.*"          => "nullable",
        "labour_card.*"=>"nullable|max:225",
        "labourcard_issue.*"=>"nullable",
        "insurance_issue_date.*"=>"nullable",
        "emirates_id_issue.*"=>"nullable",
        "resignation.*"=>"nullable",
        "location.*"=>"nullable",
];

    public function collection(Collection $rows)
    {
      $contactsData = $rows->slice(0);
      $rowsArray = $contactsData->toArray();
      
      
      foreach($contactsData as $index => $contact) {
        $index++;
        $contact = $contact->toArray();
        // get new status 
        $country_id = $this->getID($index,'Country','name_en',$contact['nationality']);
        $contact['country_id'] = $country_id;
       
        // $contact['user_id']=auth()->id();
        $contact['active_status']=1;
      
        $contact = Employee::create(array_filter($contact));
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