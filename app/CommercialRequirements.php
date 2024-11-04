<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommercialRequirements extends Model
{
  protected $guarded = [];

  protected $table = 'commercial_requirements';

  public function user()
  {
    return $this->belongsTo(User::class);
  }
  public function commercial()
  {
    return $this->belongsTo(Commercial::class);
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
    return $this->belongsTo(CommercialContactPerson::class,'contact_id');
  }
  
}
