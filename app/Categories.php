<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Categories extends Model
{
    //use SoftDeletes;

    protected $guarded = [];
   // protected $dates = ['deleted_at'];
    protected $table = 'categories';
    public function getNameAttribute()
    {
      if(app()->getLocale() == 'ar')
      {
        return $this->category_name_ar;
      }else{
        return $this->category_name;
      }
    }
    
}
