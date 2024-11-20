<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessContactPerson extends Model
{
  protected $guarded = [];
  protected $table = 'business_contact_person';

  public function busniessdevelopment()
  {
    return $this->belongsTo(BusinessDevelopment::class);
  }
}
