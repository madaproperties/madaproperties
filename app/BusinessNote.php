<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessNote extends Model
{
  protected $guarded = [];
  protected $table = 'business_notes';

  public function user()
  {
    return $this->belongsTo(User::class);
  }
  public function businessdevelopment()
  {
    return $this->belongsTo(BusinessDevelopment::class);
  }
}
