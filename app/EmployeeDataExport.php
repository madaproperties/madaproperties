<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Http\Request;

class EmployeeDataExport implements FromQuery, WithHeadings, ShouldAutoSize, WithMapping
{
    use Exportable;

    public function query()
    {
      
        // $data = Employee::get();
      if(auth()->user()->time_zone=='Asia/Dubai')
      {

        $data = Employee::orderBy('id','desc')->where('location','dubai');
      }
      else{
       $data = Employee::orderBy('id','desc')->where('location','saudi'); 
      }

             
      return $data;
    }
    public function map($data): array
    {
       $nationality = $data->country ? $data->country->name : ''; 
     
        return [
          $data->emp_no,
          $data->employee_name,
          $data->official_email,
          $data->personel_email,
          $data->phone,
          $data->alternative_phone,
          $data->reporting_manager,
          $data->designation,
          $data->department,
          $nationality,
          $data->date_of_birth,
          $data->visa_status,
          $data->visa_issue,
          $data->visa_exp,
          $data->passport_no,
          $data->passport_issue,
          $data->passport_exp,
          $data->emirates_id,
          $data->emirates_id_issue,
          $data->emiratesid_exp,
          $data->labour_card,
          $data->labourcard_issue,
          $data->insurance_issue_date,
          $data->emirates_id_issue,
        ];
    }  
   public function headings(): array
    {
      return array_map('ucfirst',[
        __('site.emp_no'),
        __('site.employee_name'),
        __('site.official_email'),
        __('site.personel_email'),
        __('site.phone'),
        __('site.alternative_phone'),
        __('site.reporting_manager'),
        __('site.designation'),
        __('site.department'),
        __('site.nationality'),
        __('site.date_of_birth'),
        __('site.visa_status'),
        __('site.visa_issue'),
        __('site.visa_exp'),
        __('site.passport_no'),
        __('site.passport_issue'),
        __('site.passport_exp'),
        __('site.emirates_id'),
        __('site.emirates_id_issue'),
        __('site.emiratesid_exp'),
        __('site.labour_card'),
        __('site.labourcard_issue'),
        __('site.insurance_issue_date'),
        __('site.emirates_id_issue'),
      ]);
    }
  
    
}

