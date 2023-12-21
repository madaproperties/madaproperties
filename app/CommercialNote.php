<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommercialNote extends Model
{
  protected $guarded = [];
  protected $table = 'commercial_notes';

  public function user()
  {
    return $this->belongsTo(User::class);
  }
  public function commercial()
  {
    return $this->belongsTo(Commercial::class);
  }
}
