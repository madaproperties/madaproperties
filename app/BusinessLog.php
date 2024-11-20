<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessLog extends Model
{
    protected $guarded = [];
    protected $table = 'business_logs';

    public function user()
    {
      return $this->belongsTo(User::class);
    }
    public function busniessdevelopment()
    {
      return $this->belongsTo(BusinessDevelopment::class);
    }
    public function connected()
    {
      return $this->belongsTo(User::class,'connected_id');
    }
    public function businessrequirement()
    {
      return $this->belongsTo(BusinessRequirement::class,'requirement_id');
    }
}
