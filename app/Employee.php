<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    // 
    // protected $table = ['employees'];
    protected $table = 'employees';
    protected $fillable = ['emp_no', 'employee_name', 'official_email','personel_email','phone','alternative_phone','reporting_manager','designation','department','country_id','date_of_join','date_of_birth','visa_status','visa_issue','visa_exp','passport_no','passport_issue','passport_exp','emirates_id','emirates_id_issue','emiratesid_exp','labour_card','labourcard_issue','insurance_issue_date','photo','doc_passport', 'doc_visa','doc_education','doc_pre_exp','doc_pre_visa','offer_letter','emirates_id','medical_certificate','resume','basic_salary','hra','total_salary','other_allowance','verified_person','verified_date','active_status','insurance_issue','eid_issue','resignation','location','insurance_card','insurance_issue','insurance_card_exp','mol_contract','increment_letter','commssion_letter','resignation_letter','warning_letter','termination_letter']; 

   public function country()
    {
      return $this->belongsTo(Country::class,'country_id');
    }  
}
