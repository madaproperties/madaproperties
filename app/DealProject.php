<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DealProject extends Model
{
    protected $guarded = [];

    public function country()
    {
      return $this->belongsTo(Country::class,'country_id');
    }
}
