<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessRequirements extends Model
{
  protected $guarded = [];

  protected $table = 'business_requirements';

  public function user()
  {
    return $this->belongsTo(User::class);
  }
  public function busniessdevelopment()
  {
    return $this->belongsTo(BusinessDevelopment::class);
  }
  public function city()
  {
    return $this->belongsTo(City::class);
  }
  public function zone()
  {
    return $this->belongsTo(Zones::class);
  }
  public function district()
  {
    return $this->belongsTo(Districts::class);
  }
  public function contact_person()
  {
    return $this->belongsTo(BusinessContactPerson::class,'contact_id');
  }
  
}
