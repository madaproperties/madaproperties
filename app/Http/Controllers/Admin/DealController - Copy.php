<?php

namespace App\Http\Controllers\Admin;

use App\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Project;
use DB;
use App\LastMileConversion;
use App\City;
use App\Country;
use App\User;
use App\Activity;
use App\Task;
use App\Note;
use App\Log;
use App\Meeting;
use App\Status;
use App\Currency;
use App\PurposeType;
use Carbon\Carbon;
use App\Campaing;
use App\Content;
use App\Source;
use App\Medium;
use App\Deal;
use Maatwebsite\Excel\Facades\Excel;
use App\DealExport;
use App\Developer;

class DealController extends Controller
{

  // index 
  public function index(){
    if(userRole() != 'admin' && userRole() != 'other'){
      return abort(404);
    }
   
    if(Request()->has('exportData')){
      return Excel::download(new DealExport, 'DealsReport.xlsx');
    }  

    if(Request()->has('search')){
      $deals = Deal::where('unit_name','LIKE','%'. Request('search') .'%')->orderBy('deal_date','desc')->paginate(20);
      $deals_count = Deal::where('unit_name','LIKE','%'. Request('search') .'%')->count();
        
    }else{
      $deals = Deal::orderBy('deal_date','desc')->paginate(20);
      $deals_count = Deal::count();
  
    }

    $countries = Country::orderBy('name_en')->get();

    $collectCounties = [];
    $collectCounties = collect($collectCounties);

    foreach($countries as $index => $country){
        if(in_array($country->name_en,toCountriess()) ){
            $collectCounties->push($country);
        }
    }


    $countries = $countries->filter(function($item) {
      return !in_array($item->name_en,toCountriess());
    });


    foreach($collectCounties as $topCountry){
        $countries->prepend($topCountry);
    }
    $purpose  = auth()->user()->position_types;
    $purpose  = json_decode($purpose);

    if(count($purpose) == 1 AND $purpose[0] == 'sell'){
        $purpose[0] = 'buy';
    }
    $purposetype = PurposeType::orderBy('type')->get();
    $currencies = Currency::orderBy($currencyName)->get();

    $campaigns = Campaing::where('active','1')->get();
    $contents = Content::where('active','1')->get();
    $sources = Source::where('active','1')->get();
    $mediums = Medium::where('active','1')->get();

    $sellers = User::where('rule','salles')->orWhere('rule','leader')
                    ->where('active','1')->get();
  
    $leaders = User::where('rule','leader')
    ->where('active','1')->get();

    $developer = Developer::get();

    return view('admin.deals.index',compact('deals','deals_count','countries','purpose','purposetype','campaigns','contents','sources','mediums','sellers','leaders','developer'));
  }

  public function create()
  {
    if(userRole() != 'admin'){
      return abort(404);
    }

    $currencyName = app()->getLocale() == 'en' ? 'currency' : 'currency_ar';

      $projects = Project::where('name_en','others')
                          ->get();



      $miles = LastMileConversion::where('active','1')
                          ->orderBy('name_'. app()->getLocale())
                          ->get();

      $status = Status::where('active','1')->orderBy('weight','DESC')->get();

      $purpose  = auth()->user()->position_types;
      $purpose  = json_decode($purpose);


      if(count($purpose) == 1 AND $purpose[0] == 'sell')
      {
          $purpose[0] = 'buy';
      }

      // Start Hundel Counties Sort

      $countries = Country::orderBy('name_en')->get();

        $collectCounties = [];
        $collectCounties = collect($collectCounties);

      foreach($countries as $index => $country)
      {
          if(in_array($country->name_en,toCountriess()) )
          {
              $collectCounties->push($country);
          }
      }


      $countries = $countries->filter(function($item) {
        return !in_array($item->name_en,toCountriess());
      });


      foreach($collectCounties as $topCountry)
      {
          $countries->prepend($topCountry);
      }
    // End Hundel Counties Sort


      $purposetype = PurposeType::orderBy('type')->get();
      $currencies = Currency::orderBy($currencyName)->get();




      $campaigns = Campaing::where('active','1')->get();
      $contents = Content::where('active','1')->get();
      $sources = Source::where('active','1')->get();
      $mediums = Medium::where('active','1')->get();

      $sellers = User::where('rule','salles')->orWhere('rule','leader')
                      ->where('active','1')->get();
    
      $leaders = User::where('rule','leader')
      ->where('active','1')->get();

      $developer = Developer::get();


      return view('admin.deals.create',
      compact('projects','miles','countries','currencies','purpose','purposetype','campaigns','contents','sources','mediums','sellers','leaders','developer'));
  }

  /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
  public function store(Request $request)
  {
    if(userRole() != 'admin'){
      return abort(404);
    }

      $data = $request->validate([
        "unit_country"          => "required",
        "project_id"            => "required",
        "unit_name"             => "nullable",
        "developer_id"        => "nullable",
        'purpose'               => 'nullable',
        "purpose_type"          => "nullable",
        "deal_date"             => "nullable",
        "source_id"                => "nullable",
        "invoice_number"        => "nullable",
        "client_name"           => "nullable",
        "client_mobile_no"      => "nullable",
        "client_email"          => "nullable",
        "price"                 => "required",
        "commission_type"       => "nullable",
        "commission"            => "required|numeric|between:1,100",
        "commission_amount"     => "required|numeric",
        "vat"                   => "nullable",
        "vat_amount"            => "nullable",
        "vat_received"     => "required",
        "total_invoice"         => "required",
        "expected_date"         => "nullable",
        "invoice_date"          => "nullable",
        "agent_commission_percent" => "nullable",
        "agent_commission_amount"  => "nullable",
        "agent_leader_commission_percent" => "nullable",
        "agent_leader_commission_amount"  => "nullable",
        "third_party"           => "sometimes",
        "third_party_amount"    => "required_if:third_party,on",
        "third_party_name"      => "required_if:third_party,on",
        "mada_commission"       => "required|numeric",
        "agent_id"       => "nullable",
        "leader_id"       => "nullable",
        "spa"       => "nullable",
        "token"       => "nullable",
        "down_payment"       => "nullable",
        "agent_commission_received"       => "nullable",
        "agent_leader_commission_received"       => "nullable",
        "mada_commission_received"       => "nullable",
        "notes"       => "nullable",
      ]);


      $data['created_at'] = Carbon::now();

      $deal = Deal::create($data);
      return redirect(route('admin.deal.index'))->withSuccess(__('site.success'));
  }

  public function getCities(Request $request)
  {
      if(!$request->country) return false;

      $country = Country::where('id',$request->country)->first();

    $cities = City::where('country_id',$request->country)->get();
    foreach($cities as $city)
    {
      $city->name = app()->getLocale() == 'ar' ? $city->name_ar : $city->name_en;
    }
    return response()->json([
      'status' => 'success',
      'rows' => $cities,
      'countryCode' => $country->code
    ]);
  }


  public function update(Request $request,  $deal)
  {
    if(userRole() != 'admin'){
      return abort(404);
    }

    $deal = Deal::findOrFail($deal);

    $data = $request->validate([
      "unit_country"          => "required",
      "project_id"            => "required",
      "unit_name"             => "nullable",
      "developer_id"        => "nullable",
      'purpose'               => 'nullable',
      "purpose_type"          => "nullable",
      "deal_date"             => "nullable",
      "source_id"                => "nullable",
      "invoice_number"        => "nullable",
      "client_name"           => "nullable",
      "client_mobile_no"      => "nullable",
      "client_email"          => "nullable",
      "price"                 => "required",
      "commission_type"       => "nullable",
      "commission"            => "required|numeric|between:1,100",
      "commission_amount"     => "required|numeric",
      "vat"                   => "nullable",
      "vat_amount"            => "nullable",
      "vat_received"     => "required",
      "total_invoice"         => "required",
      "expected_date"         => "nullable",
      "invoice_date"          => "nullable",
      "agent_commission_percent" => "nullable",
      "agent_commission_amount"  => "nullable",
      "agent_leader_commission_percent" => "nullable",
      "agent_leader_commission_amount"  => "nullable",
      "third_party"           => "sometimes",
      "third_party_amount"    => "required_if:third_party,on",
      "third_party_name"      => "required_if:third_party,on",
      "mada_commission"       => "required|numeric",
      "agent_id"       => "nullable",
      "leader_id"       => "nullable",
      "spa"       => "nullable",
      "token"       => "nullable",
      "down_payment"       => "nullable",
      "agent_commission_received"       => "nullable",
      "agent_leader_commission_received"       => "nullable",
      "mada_commission_received"       => "nullable",
      "notes"       => "nullable",
  ]);

    $data['updated_at'] = Carbon::now();

    $deal->update($data);
    return redirect(route('admin.deal.index'))->withSuccess(__('site.success'));
  }


  public function destroy ($id)
  {
    if(userRole() != 'admin'){
      return abort(404);
    }
    $data = Deal::findOrFail($id);
    $data->delete();
    return back()->withSuccess(__('site.success'));
  }

  public function show($deal)
  {
    if(userRole() != 'admin' && userRole() != 'other'){
      return abort(404);
    }
    $deal = Deal::findOrFail($deal);
    if(userRole() != 'admin'){
      return abort(404);
    }


    $currencyName = app()->getLocale() == 'en' ? 'currency' : 'currency_ar';
    $projects = Project::where('name_en','others')
                          ->get();

    $miles = LastMileConversion::where('active','1')
                          ->orderBy('name_'. app()->getLocale())
                          ->get();

    // Start Hundel Counties Sort
    $countries = Country::orderBy('name_en')->get();

    $collectCounties = [];
    $collectCounties = collect($collectCounties);

    foreach($countries as $index => $country)
    {
        if(in_array($country->name_en,toCountriess()) )
        {
            $collectCounties->push($country);
        }
    }


    $countries = $countries->filter(function($item) {
      return !in_array($item->name_en,toCountriess());
    });


    foreach($collectCounties as $topCountry)
    {
        $countries->prepend($topCountry);
    }
    // End Hundel Counties Sort

    $purposetype = PurposeType::orderBy('type')->get();
    $currencies = Currency::orderBy($currencyName)->get();

    $purpose  = auth()->user()->position_types;
    $purpose  = json_decode($purpose);

    if(count($purpose) == 1 AND $purpose[0] == 'sell')
    {
        $purpose[0] = 'buy';
    }

    $sellers = User::where('rule','salles')->orWhere('rule','leader')
    ->where('active','1')->get();

    $leaders = User::where('rule','leader')
    ->where('active','1')->get();

    $developer = Developer::get();
    $sources = Source::where('active','1')->get();


    return view('admin.deals.show',
    compact('deal','projects','miles','countries','currencies','purpose','purposetype','sellers','leaders','developer','sources'));

  }  

  public function print($id)
  {
    if(userRole() != 'admin' && userRole() != 'other'){
      return abort(404);
    }
    $deal = Deal::findOrFail($id);
    return view('admin.deals.print',compact('deal'));
  }  
  public function printBill($id)
  {
    if(userRole() != 'admin' && userRole() != 'other'){
      return abort(404);
    }
    $deal = Deal::findOrFail($id);
    return view('admin.deals.print_bill',compact('deal'));
  }  
}
