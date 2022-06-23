<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DealDeveloper extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $table = 'developer';
    protected $dates = ['deleted_at'];
    
    public function country()
    {
      return $this->belongsTo(Country::class,'country_id');
    }

    public function getNameAttribute()
    {
      if(app()->getLocale() == 'ar')
      {
        return $this->name_ar;
      }else{
        return $this->name_en;
      }
    }
  
}
