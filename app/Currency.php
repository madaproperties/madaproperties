<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $guarded = [];


    public function getCurrencyNameAttribute()
    {
      if(app()->getLocale() == 'ar')
      {
        return $this->currency_ar;
      }else{
        return $this->currency;
      }
    }

}
