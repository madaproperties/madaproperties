<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    protected $guarded = [];

    

    public function user()
    {
      return $this->belongsTo(User::class);
    }
    public function creator()
    {
      return $this->belongsTo(User::class,'created_by');
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



}
