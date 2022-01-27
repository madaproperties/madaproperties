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

    public function status()
    {
      return $this->belongsTo(Status::class);
    }

    public function project()
    {
      return $this->belongsTo(Project::class);
    }

    public function getProjectNameAttribute()
    {
      if(app()->getLocale() == 'ar')
      {
        return $this->project->name_ar;
      }else{
        return $this->project->name_en;
      }
    }

    public function country()
    {
      return $this->belongsTo(Country::class,'unit_country');
    }


}
