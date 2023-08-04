<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements JWTSubject 
{
    use Notifiable,SoftDeletes,HasRoles;

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function getNameAttribute()
    {
      return $this->email;
    }


     public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    
    public function getJWTCustomClaims()
    {
        return [];
    }
    
    public function reraUser() {
      return $this->belongsTo(User::class,'rera_user_id');
    }

    
    
}
