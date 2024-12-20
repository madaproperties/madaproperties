<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommercialLog extends Model
{
    protected $guarded = [];
    protected $table = 'commercial_logs';

    public function user()
    {
      return $this->belongsTo(User::class);
    }
    public function commercial()
    {
      return $this->belongsTo(Commercial::class);
    }
    public function connected()
    {
      return $this->belongsTo(User::class,'connected_id');
    }
    public function requirement()
    {
      return $this->belongsTo(CommercialRequirements::class,'requirement_id');
    }
    public function contactPerson()
    {
      return $this->belongsTo(CommercialContactPerson::class,'contact_person_id');
    }
}
