<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
  protected $guarded = [];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
  public function connected()
  {
    return $this->belongsTo(User::class,'connected_id');
  }
  public function contact()
  {
    return $this->belongsTo(Contact::class);
  }
}
