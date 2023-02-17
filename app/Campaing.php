<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaing extends Model
{
    protected $guarded = [];
    protected $table = 'campaigns';   

    public function project()
    {
      return $this->belongsTo(Project::class);
    }

}
