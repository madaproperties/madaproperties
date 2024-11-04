<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommercialContactPerson extends Model
{
  protected $guarded = [];
  protected $table = 'commercial_contact_person';

  public function commercial()
  {
    return $this->belongsTo(Commercial::class);
  }
}
