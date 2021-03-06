<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deal extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $dates = ['deleted_at'];
    

    public function leader()
    {
      return $this->belongsTo(User::class,'leader_id');
    }
    public function leaderTwo()
    {
      return $this->belongsTo(User::class,'leader2_id');
    }
    public function agent()
    {
      return $this->belongsTo(User::class,'agent_id');
    }
    public function agentTwo()
    {
      return $this->belongsTo(User::class,'agent2_id');
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
      return $this->belongsTo(DealDeveloper::class,'developer_id');
    }


}
