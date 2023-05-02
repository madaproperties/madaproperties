<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    //
    // protected $table = ['employees'];
    protected $table = 'table_leave';
    protected $fillable = ['leave_name','days','location'];   
}
