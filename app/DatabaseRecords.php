<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DatabaseRecords extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $table = 'database_records';
    protected $dates = ['deleted_at'];
    
    public function country()
    {
      return $this->belongsTo(Country::class,'country_id');
    }
    public function usercountry()
    {
      return $this->belongsTo(Country::class,'user_country_id');
    }
    public function user()
    {
      return $this->belongsTo(User::class,'user_id');
    }
    public function statusName()
    {
      return $this->belongsTo(Status::class,'status');
    }
    public function creator()
    {
      return $this->belongsTo(User::class,'created_by');
    }
     public function unitCountry()
    {
      return $this->belongsTo(Country::class,'unit_country');
    }
   public function zone()
    {
      return $this->belongsTo(Zones::class,'zone_id');
    }
   public function district()
    {
      return $this->belongsTo(Districts::class,'district_id');
    }
    public function community()
    {
      return $this->belongsTo(Community::class,'community_id');
    }
    public function subcommunity()
    {
      return $this->belongsTo(Community::class,'subcommunity_id');
    }
}
