<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SecondaryProject extends Model
{
    protected $guarded = [];

    protected $table = 'secondary_project';
    protected $fillable = [
    'unit_name','country_id','city','zone_id','district_id','project_name','developer_name','type','price','area_bua','area_plot','bedroom','bathroom','living_room','guest_room','floor_no','no_of_floor','completion_date','parking','furniture','assign_to','facing','street_width','border_length','border_depth','description',
];
 
    public function country()
    {
      return $this->belongsTo(Country::class,'country_id');
    }
    
     public function zone()
    {
      return $this->belongsTo(Zones::class,'zone_id');
    }
     public function district()
    {
      return $this->belongsTo(Districts::class,'district_id');
    }   
   
}
