<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    Protected $guarded = [];

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
