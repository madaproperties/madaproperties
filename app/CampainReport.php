<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampainReport extends Model
{
    protected $guarded = [];
    protected $table = 'advance_campaign_data';   

    public function project()
    {
      return $this->belongsTo(Project::class);
    }
    
}
