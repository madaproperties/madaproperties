<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $dates = ['deleted_at'];
    protected $table = 'properties';
    
    public function documents()
    {
      return $this->hasMany(PropertyDocuments::class,'property_id')->orderBy('id','desc');
    }

    public function images()
    {
      return $this->hasMany(PropertyImages::class,'property_id')->orderBy('order','asc');
    }

    public function features()
    {
      return $this->hasMany(PropertyFeatures::class,'property_id')->orderBy('id','desc');
    }
    

    public function devFeatures()
    {
      return $this->hasMany(PropertyFeatures::class,'property_id')
      ->join('features','features.id','=','property_features.feature_id')
      ->where('features.feature_type',2)->orderBy('property_features.id','desc');
    }
    

    public function unitFeatures()
    {
      return $this->hasMany(PropertyFeatures::class,'property_id')
      ->join('features','features.id','=','property_features.feature_id')
      ->where('features.feature_type',1)->orderBy('property_features.id','desc');
    }
    

    public function lifeStyleFeatures()
    {
      return $this->hasMany(PropertyFeatures::class,'property_id')
      ->join('features','features.id','=','property_features.feature_id')
      ->where('features.feature_type',3)->orderBy('property_features.id','desc');
    }
    

    public function agent()
    {
      return $this->belongsTo(User::class,'user_id');
    }
    public function portals()
    {
      return $this->hasMany(PropertyPortals::class,'property_id')->orderBy('id','desc');
    }

    public function city()
    {
      return $this->belongsTo(City::class,'city_id');
    }

    public function category()
    {
      return $this->belongsTo(Categories::class,'category_id');
    }
    public function notes()
    {
      return $this->hasMany(PropertyNotes::class,'property_id')->orderBy('id','desc');
    }

    public function communityId()
    {
      return $this->belongsTo(Community::class,'community');
    }

    public function subCommunity()
    {
      return $this->belongsTo(Community::class,'sub_community');
    }
    public function zone()
    {
      return $this->belongsTo(Zones::class,'zone_id');
    }

    public function district()
    {
      return $this->belongsTo(Districts::class,'district_id');
    }
    public function createdBy()
    {
      return $this->belongsTo(User::class,'created_by');
    }

}
