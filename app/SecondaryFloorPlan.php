<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class SecondaryFloorPlan extends Model
{
    //use SoftDeletes;

    protected $guarded = [];
   // protected $dates = ['deleted_at'];
    protected $table = 'secondary_floor_plan';
    protected $fillable = ['image','project_id'];
    
   
}
