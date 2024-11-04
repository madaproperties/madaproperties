<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessActivity extends Model
{
    protected $guarded = [];
    protected $table = 'business_activities';

    public function user()
    {
      return $this->belongsTo(User::class);
    }
    public function busniessdevelopment()
    {
      return $this->belongsTo(BusinessDevelopment::class);
    }

}
