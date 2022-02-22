<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    protected $guarded = [];

    

    public function leader()
    {
      return $this->belongsTo(User::class,'leader_id');
    }
    public function agent()
    {
      return $this->belongsTo(User::class,'agent_id');
    }
    public function source()
    {
      return $this->belongsTo(Source::class,'source_id');
    }

    public function status()
    {
      return $this->belongsTo(Status::class);
    }

    public function project()
    {
      return $this->belongsTo(DealProject::class);
    }

    public function getProjectNameAttribute()
    {
      return $this->project->project_name;
    }

    public function country()
    {
      return $this->belongsTo(Country::class,'unit_country');
    }

    public function developer()
    {
      return $this->belongsTo(Developer::class,'developer_id');
    }


}
