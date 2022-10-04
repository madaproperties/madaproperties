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
      return $this->hasMany(PropertyImages::class,'property_id')->orderBy('id','desc');
    }

    public function features()
    {
      return $this->hasMany(PropertyFeatures::class,'property_id')->orderBy('id','desc');
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


}
