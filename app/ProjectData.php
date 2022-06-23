<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectData extends Model
{
    protected $guarded = [];

    protected $table = 'projects_data';

    public function country()
    {
      return $this->belongsTo(Country::class,'country_id');
    }
    public function project()
    {
      return $this->belongsTo(ProjectName::class,'project_id');
    }
    public function developer()
    {
      return $this->belongsTo(ProjectDeveloper::class,'developer_id');
    }
}
