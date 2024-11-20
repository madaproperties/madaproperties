<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessDevelopment extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $dates = ['deleted_at'];
    protected $table = 'business_developments_leads';
    

    public function user()
    {
      return $this->belongsTo(User::class);
    }
    public function creator()
    {
      return $this->belongsTo(User::class,'created_by');
    }

    public function logs()
    {
      return $this->hasMany(BusinessLog::class,'commercial_id');
    }

    public function contact_persons()
    {
      return $this->hasMany(BusinessContactPerson::class,'lead_id');
    }



}
