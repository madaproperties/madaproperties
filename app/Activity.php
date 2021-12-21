<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $guarded = [];

    public function user()
    {
      return $this->belongsTo(User::class);
    }
    public function contact()
    {
      return $this->belongsTo(Contact::class);
    }

}
