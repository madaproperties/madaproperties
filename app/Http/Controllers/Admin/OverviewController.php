<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contact;
use DB;
use Carbon\Carbon;

class OverviewController extends Controller
{
    //
    public function index()
    {


    	// get all the same source that created in the same Day !


    	return view('admin.overview',compact('sources','created_at_dats','contacts'));
    }


    private function addCountPerDayAttribute($data)
    {

    }
}
