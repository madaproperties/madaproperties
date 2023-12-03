<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommercialActivity extends Model
{
    protected $guarded = [];

    public function user()
    {
      return $this->belongsTo(User::class);
    }
    public function commercial()
    {
      return $this->belongsTo(Commercial::class);
    }

}
