<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notofication extends Model
{
    protected $guarded = [];

    public function createor()
    {
      return $this->belongsTo(User::class,'created_by');
    }

}
