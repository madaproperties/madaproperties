<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeLeave extends Model
{
    //
    // protected $table = ['employees'];
    protected $table = 'employee_leave';
    protected $fillable = ['id','employee_id','leave_id','description','start_date','end_date','days','status','location'];  

    public function employee()
    {
      return $this->belongsTo(Employee::class,'employee_id');
    }
    public function leave()
    {
      return $this->belongsTo(Leave::class,'leave_id');
    } 
} 

 