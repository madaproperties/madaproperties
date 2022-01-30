<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
  protected $table = 'developer';

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
