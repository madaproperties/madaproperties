<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyNotes extends Model
{
    //use SoftDeletes;

    protected $guarded = [];
   // protected $dates = ['deleted_at'];
    protected $table = 'property_notes';
    
    public function user()
    {
      return $this->belongsTo(User::class,'user_id');
    }
}
