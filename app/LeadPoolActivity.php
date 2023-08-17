<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeadPoolActivity extends Model
{
    protected $table = 'lead_pool_activity';
    protected $guarded = [];

    public function user()
    {
      return $this->belongsTo(User::class);
    }
    public function contact()
    {
      return $this->belongsTo(Contact::class);
    }

}
