<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
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
    public function connected()
    {
      return $this->belongsTo(User::class,'connected_id');
    }
}
