<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];
    
    public function getNameAttribute()
    {
      if(app()->getLocale() == 'ar')
      {
        return $this->name_ar;
      }else{
        return $this->name_en;
      }
    }

    public function contact()
    {
      return $this->hasMany(contact::class);
    }

}
