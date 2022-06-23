<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectDeveloper extends Model
{
    protected $guarded = [];

    protected $table = 'projects_developer';

    public function country()
    {
      return $this->belongsTo(Country::class,'country_id');
    }
}
