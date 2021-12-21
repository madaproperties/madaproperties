<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $guarded = [];

    

    public function user()
    {
      return $this->belongsTo(User::class);
    }
    public function creator()
    {
      return $this->belongsTo(User::class,'created_by');
    }

    public function status()
    {
      return $this->belongsTo(Status::class);
    }

    public function project()
    {
      return $this->belongsTo(Project::class);
    }

    public function getProjectNameAttribute()
    {
      if(app()->getLocale() == 'ar')
      {
        return $this->project->name_ar;
      }else{
        return $this->project->name_en;
      }
    }

    public function getFullNameAttribute()
    {
      return $this->first_name.' '.$this->last_name;
    }

    public function country()
    {
      return $this->belongsTo(Country::class);
    }
    public function city()
    {
      return $this->belongsTo(City::class);
    }

    public function unitCountry()
    {
      return $this->belongsTo(Country::class,'unit_country');
    }

    public function unitCity()
    {
      return $this->belongsTo(City::class,'unit_city');
    }

    public function mileCoversion()
    {
      return $this->belongsTo(LastMileConversion::class,'last_mile_conversion');
    }

    public function Currency()
    {
      return $this->belongsTo(Currency::class,'currency');
    }


}
