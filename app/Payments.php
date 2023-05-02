<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payments extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $table = 'payments';
    protected $dates = ['deleted_at'];

    public function unit()
    {
      return $this->belongsTo(ProjectData::class,'unit_id');
    }
}
