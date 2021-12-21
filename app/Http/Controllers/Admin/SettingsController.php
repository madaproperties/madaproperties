<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Setting;
use App\Status;


class SettingsController extends Controller
{	

    // index 
    public function index(){
    	// set alll needed cloulmgs
    	
    	
    	target_settings();
    	
    	$settings_columns = Setting::select('*')->get();
    		
    	return view('admin.settings.index',compact('settings_columns'));
    }

    public function store(Request $request){
    	Setting::truncate(); // delete all recourds 
    	// bulid them form scratch 
    	$rows = $request->except('_token');
    	
    	foreach($rows as $name => $value)
    	{	
			Setting::create([
				'name' => $name,
				'value' => $value,
			]);
    	}

    	return back()->withSuccess(__('site.success'));
    }




    public function getTableColumns($table)
	{
	    return Schema::getColumnListing($table);
	}

	
}
