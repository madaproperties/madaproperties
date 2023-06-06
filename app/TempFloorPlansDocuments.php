<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class TempFloorPlansDocuments extends Model
{
    //use SoftDeletes;

    protected $guarded = [];
    //protected $dates = ['deleted_at'];
    protected $table = 'temp_floor_plans_document';
    
    

}
