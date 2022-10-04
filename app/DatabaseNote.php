<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatabaseNote extends Model
{
  protected $guarded = [];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
  public function database()
  {
    return $this->belongsTo(DatabaseRecords::class);
  }
}
