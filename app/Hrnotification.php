<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hrnotification extends Model
{
    //
    // protected $table = ['employees'];
    protected $table = 'hr_notification';
    protected $fillable = ['notification','status','location'];   
}
