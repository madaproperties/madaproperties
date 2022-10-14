<?php

use Illuminate\Support\Facades\Route;


env('TIME_ZONE', 'Asia/Dubai');

// change lang
Route::get('lang/{lang}', function ($lang){
    session()->put('lang',$lang);
    return back();
})->name('lang');

Route::group(['middleware' => 'lang'], function (){
  Auth::routes();
});

Route::group(['middleware' => ['guest','lang']], function (){
  Route::view('/','admin.login')->name('home');
  Route::view('login','admin.login');
  Route::get('setpassword/{token}','HomeController@setpassword')->name('setpassword');
  Route::post('change-password','HomeController@changePassword')->name('changepassword');
  Route::post('login','HomeController@login')->name('login');
});

Route::get('property-bayut-xml','Admin\PropertyController@propertyBayutXml')->name('propertyBayutXml');
Route::get('property-finder-xml','Admin\PropertyController@propertyFinderXml')->name('propertyFinderXml');
Route::get('property-xml','Admin\PropertyController@propertyXml')->name('propertyXml');
Route::get('property/brochure/{property_id}','Admin\PropertyController@brochure')->name('property.brochure');
Route::get('project-data/brochure/{project_id}','Admin\ProjectDataController@brochure')->name('project.brochure');

Route::get('read-xml','Admin\PropertyController@readXml')->name('property.readXml');

use App\Contact;
use App\Country;
use App\City;

Route::get('work', function (){
    $rows = Contact::select('id','project_id','unit_country')->where('project_id','!=',null)->get();
    
    foreach($rows as $row){
        $getunitcounytry = App\Project::where('id',$row->project_id)->first();
       
       $row->update([
           'unit_country' => $getunitcounytry->country_id  
         ]);
         
   
    }
    echo 1;
});

Route::get('push-langs', function (){
      // reset data

    foreach(countriesCodes() as $code => $country)
    {
      if(!Country::where('name_ar',$country)->count())
      {
        Country::create([
          'name_ar' => $country,
          'name_en' => $country,
          'code' => $code,
        ]);
      }
    }


    foreach(cities() as $country => $city)
    {
      $countryDB = Country::where('name_en',$country)->first();
      foreach(cities()[$country] as $city_ar => $city_en)
      {
        if(!City::where('name_en',$city_en)->where('country_id',$countryDB->id)->count())
        {
          City::create([
            'name_ar' => $city_ar,
            'name_en' => $city_en,
            'country_id' => $countryDB->id,
          ]);
        }
      }
    }
});
