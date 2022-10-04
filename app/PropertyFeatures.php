<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyFeatures extends Model
{
    //use SoftDeletes;

    protected $guarded = [];
   // protected $dates = ['deleted_at'];
    protected $table = 'property_features';
    
    public function feature()
    {
      return $this->belongsTo(Features::class,'feature_id');
    }
}
