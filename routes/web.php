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

Route::get('project-data/brochure/{project_id}','Admin\ProjectDataController@brochure')->name('project.brochure');
Route::get('property-bayut-xml','Admin\PropertyBayutXmlController@propertyBayutXml')->name('propertyBayutXml');
Route::get('property-finder-xml','Admin\PropertyFinderXmlController@propertyFinderXml')->name('propertyFinderXml');
Route::get('property-dubizzle-xml','Admin\PropertyDubizzleXmlController@propertyDubizzleXml')->name('propertyDubizzleXml');
Route::get('property-dubizzle-hourly-xml','Admin\PropertyDubizzleXmlController@propertyDubizzleHourlyXml')->name('propertyDubizzleHourlyXml');

Route::get('property-xml','Admin\PropertyXmlController@propertyXml')->name('propertyXml');
Route::get('property/brochure/{property_id}','Admin\PropertyController@brochure')->name('property.brochure');
Route::get('project-data/brochure/{project_id}','Admin\ProjectDataController@brochure')->name('project.brochure');

Route::get('read-xml','Admin\PropertyXmlController@readXml2')->name('property.readXml');
Route::get('read-bayut-xml','Admin\PropertyXmlController@readBayutXml')->name('property.readBayutXml');
Route::get('read-dubizzle-xml','Admin\PropertyXmlController@readDubizzleXml')->name('property.readDubizzleXml');
Route::get('employee','EmployeeController@index')->name('employee.index');

// unit listing :added by fazal
Route::get('new-web','Admin\ProjectDataController@newWeb')->name('projcets.newweb'); 
Route::get('projectdata/view/{id}','Admin\ProjectDataController@View')->name('projectdata.view');
Route::post('projectdata/getPupUpByAjax','Admin\ProjectDataController@getPupUpByAjax')->name('projectdata.getPupUpByAjax');
Route::get('projectdata/terms-and-conditions','Admin\ProjectDataController@termsAndConditions')->name('projectdata.termsAndConditions');
// end

Route::post('project/payment','Admin\ProjectPaymentController@payment')->name('projectPayment.payment');
Route::get('payment/checkoutPage/{id}','Admin\ProjectPaymentController@checkoutPage')->name('projectPayment.checkoutPage');
Route::get('payment/success','Admin\ProjectPaymentController@success')->name('projectPayment.success');
Route::get('payment/error','Admin\ProjectPaymentController@error')->name('projectPayment.error');
// 
Route::get('secondaryproject/brochure/{id}','Admin\SecondaryController@brochure')->name('secondaryproject.brochure');

Route::get('property-xml-dubai','Admin\PropertyXmlController@propertyXmlDubai')->name('propertyXmlDubai');
Route::get('property-xml-saudi','Admin\PropertyXmlController@propertyXmlSaudi')->name('propertyXmlSaudi');
// added by fazal 04-04-2023
Route::get('madastars','Admin\DealController@topAgentsUae')->name('deal.agents');
Route::get('topagentsaudideals','Admin\DealController@topAgentsSaudi')->name('deal.agentssaudi');
Route::get('topagentsaudideals-new','Admin\DealController@topAgentsSaudiNew')->name('deal.agentssaudinew');
//added by fazal 03-06-23
Route::get('montlydeal','Admin\DealController@monthlDeal')->name('mada.monthly.deal');
Route::get('madaslider','Admin\MadaboardController@slider')->name('mada.slider');

Route::get('resale','Admin\ProjectDataController@resale')->name('projectdata.resale'); 
Route::get('my-login/{email}','Admin\DealController@login')->name('deal.login');

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
