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

class DealController extends Controller
{

  // index 
  public function index(){
    if(userRole() != 'admin'){
      return abort(404);
    }
   
    if(Request()->has('exportData')){
      return Excel::download(new DealExport, 'DealsReport.xlsx');
    }  

    $deals = Deal::orderBy('id','desc')->paginate(20);
      
    return view('admin.deals.index',compact('deals'));
  }

  public function create()
  {
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

      $sellers = User::where('rule','salles')
                      ->where('active','1')->get();
    
      $leaders = User::where('rule','leader')
      ->where('active','1')->get();


      return view('admin.deals.create',
      compact('projects','miles','countries','currencies','purpose','purposetype','campaigns','contents','sources','mediums','sellers','leaders'));
  }

  /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
  public function store(Request $request)
  {

      $data = $request->validate([
        "unit_country"          => "required|max:3",
        "project_id"            => "required",
        "unit_name"             => "required",
        "developer_name"        => "required|max:50",
        'purpose'               => 'required',
        "purpose_type"          => "required",
        "deal_date"             => "required",
        "client_name"           => "required|max:50",
        "client_mobile_no"      => "required|max:50",
        "client_email"          => "required|email|max:100",
        "price"                 => "required",
        "commission_type"       => "required|max:20",
        "commission"            => "required|numeric|between:1,100",
        "commission_amount"     => "required|numeric",
        "vat"                   => "required|numeric|between:1,100",
        "vat_amount"            => "required|numeric",
        "vat_received"     => "required",
        "total_invoice"         => "required",
        "expected_date"         => "required|max:20",
        "invoice_date"          => "required|max:20",
        "agent_commission_percent" => "required|numeric|between:1,100",
        "agent_commission_amount"  => "required|numeric",
        "agent_leader_commission_percent" => "required|numeric|between:1,100",
        "agent_leader_commission_amount"  => "required|numeric",
        "third_party"           => "sometimes",
        "third_party_amount"    => "required_if:third_party,on",
        "third_party_name"      => "required_if:third_party,on",
        "mada_commission"       => "required|numeric",
        "agent_id"       => "required|numeric",
        "leader_id"       => "required|numeric",
        "spa"       => "nullable",
        "token"       => "nullable",
        "down_payment"       => "nullable",
        "agent_commission_received"       => "required",
        "agent_leader_commission_received"       => "required",
        "mada_commission_received"       => "required",
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
    $deal = Deal::findOrFail($deal);

    $data = $request->validate([
      "unit_country"          => "required|max:3",
      "project_id"            => "required",
      "unit_name"             => "required",
      "developer_name"        => "required|max:50",
      'purpose'               => 'required',
      "purpose_type"          => "required",
      "deal_date"             => "required",
      "client_name"           => "required|max:50",
      "client_mobile_no"      => "required|max:50",
      "client_email"          => "required|email|max:100",
      "price"                 => "required",
      "commission_type"       => "required|max:20",
      "commission"            => "required|numeric|between:1,100",
      "commission_amount"     => "required|numeric",
      "vat"                   => "required|numeric|between:1,100",
      "vat_amount"            => "required|numeric",
      "vat_received"     => "required",
      "total_invoice"         => "required",
      "expected_date"         => "required|max:20",
      "invoice_date"          => "required|max:20",
      "agent_commission_percent" => "required|numeric|between:1,100",
      "agent_commission_amount"  => "required|numeric",
      "agent_leader_commission_percent" => "required|numeric|between:1,100",
      "agent_leader_commission_amount"  => "required|numeric",
      "third_party"           => "sometimes",
      "third_party_amount"    => "required_if:third_party,on",
      "third_party_name"      => "required_if:third_party,on",
      "mada_commission"       => "required|numeric",
      "agent_id"       => "required|numeric",
      "leader_id"       => "required|numeric",
      "spa"       => "nullable",
      "token"       => "nullable",
      "down_payment"       => "nullable",
      "agent_commission_received"       => "required",
      "agent_leader_commission_received"       => "required",
      "mada_commission_received"       => "required",
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

    $sellers = User::where('rule','salles')
    ->where('active','1')->get();

    $leaders = User::where('rule','leader')
    ->where('active','1')->get();


    return view('admin.deals.show',
    compact('deal','projects','miles','countries','currencies','purpose','purposetype','sellers','leaders'));

  }  
}
