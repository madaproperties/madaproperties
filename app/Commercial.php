<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commercial extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $dates = ['deleted_at'];
    protected $table = 'commercial_leads';
    

    public function user()
    {
      return $this->belongsTo(User::class);
    }
    public function creator()
    {
      return $this->belongsTo(User::class,'created_by');
    }

    public function location()
    {
      return $this->belongsTo(Country::class,'location_id');
    }

    public function logs()
    {
      return $this->hasMany(CommercialLog::class,'commercial_id');
    }

    public function contact_persons()
    {
      return $this->hasMany(CommercialContactPerson::class,'lead_id');
    }

    public function requirements()
    {
      return $this->hasMany(CommercialRequirements::class,'commercial_id');
    }



}
