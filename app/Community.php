<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Community extends Model
{
    protected $guarded = [];
    protected $dates = ['deleted_at'];
    protected $table = 'community';

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
