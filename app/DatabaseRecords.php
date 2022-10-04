<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DatabaseRecords extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $table = 'database_records';
    protected $dates = ['deleted_at'];
    
    public function country()
    {
      return $this->belongsTo(Country::class,'country_id');
    }

}
