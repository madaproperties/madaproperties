<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurposeType extends Model
{
    protected $guarded = [];


    public function getNameAttribute()
    {
      if(app()->getLocale() == 'ar')
      {
        return $this->type_ar;
      }else{
        return $this->type;
      }
    }

}
