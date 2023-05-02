<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyFloorPlans extends Model
{
    //use SoftDeletes;

    protected $guarded = [];
    //protected $dates = ['deleted_at'];
    protected $table = 'property_floor_plans';
    
    

}
