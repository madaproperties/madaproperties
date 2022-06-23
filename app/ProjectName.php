<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectName extends Model
{
    protected $guarded = [];

    protected $table = 'projects_name';

    public function country()
    {
      return $this->belongsTo(Country::class,'country_id');
    }
}
