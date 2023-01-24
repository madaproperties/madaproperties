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
use App\DealDeveloperExport;
use App\DealDeveloper;
use App\DealProject;

class DealDeveloperController extends Controller
{

  /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    function __construct()
    {
        $this->middleware('permission:deal-developer-list', ['only' => ['index']]);
        $this->middleware('permission:deal-developer-create', ['only' => ['create','store']]);
        $this->middleware('permission:deal-developer-edit', ['only' => ['edit','show','update']]);
        $this->middleware('permission:deal-developer-delete', ['only' => ['destroy']]);
        $this->middleware('permission:deal-developer-export', ['only' => ['exportDataDeveloper']]);
    }  

  // index 
  public function index(){

    if(Request()->has('search')){
      if(!checkLeader()){
        $deals = DealDeveloper::where('country_id',1)->where('name_en','LIKE','%'. Request('search') .'%')->orderBy('id','desc')->paginate(20);
        $deals_count = DealDeveloper::where('country_id',1)->where('name_en','LIKE','%'. Request('search') .'%')->count();
      }elseif(!checkLeaderUae()){
        $deals = DealDeveloper::where('country_id',2)->where('name_en','LIKE','%'. Request('search') .'%')->orderBy('id','desc')->paginate(20);
        $deals_count = DealDeveloper::where('country_id',2)->where('name_en','LIKE','%'. Request('search') .'%')->count();
      }else{
        $deals = DealDeveloper::where('name_en','LIKE','%'. Request('search') .'%')->orderBy('id','desc')->paginate(20);
        $deals_count = DealDeveloper::where('name_en','LIKE','%'. Request('search') .'%')->count();

      }

    }else{
      if(!checkLeader()){
        $deals = DealDeveloper::where('country_id',1)->orderBy('id','desc')->paginate(20);
        $deals_count = DealDeveloper::where('country_id',1)->count();
      }elseif(!checkLeaderUae()){
        $deals = DealDeveloper::where('country_id',2)->orderBy('id','desc')->paginate(20);
        $deals_count = DealDeveloper::where('country_id',2)->count();
      }else{
        $deals = DealDeveloper::orderBy('id','desc')->paginate(20);
        $deals_count = DealDeveloper::count();
      }
    }


    return view('admin.deals.index_developer',compact('deals','deals_count'));
  }

  public function create()
  {
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

    return view('admin.deals.create_developer',compact('countries'));
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
        "country_id"          => "required",
        "name_en"            => "required",
        "company_address"     => "required",
        "trn"     => "required",
        ]);


      $data['created_at'] = Carbon::now();

      $deal = DealDeveloper::create($data);
      return redirect(route('admin.deal-developer.index'))->withSuccess(__('site.success'));
  }

  public function update(Request $request,  $deal)
  {
    $deal = DealDeveloper::findOrFail($deal);

    $data = $request->validate([
      "country_id"          => "required",
      "name_en"            => "required",
      "company_address"     => "required",
      "trn"     => "required",
    ]);

    $data['updated_at'] = Carbon::now();

    $deal->update($data);
    return redirect(route('admin.deal-developer.index'))->withSuccess(__('site.success'));
  }


  public function destroy ($id)
  {
    $data = DealDeveloper::findOrFail($id);
    $data->delete();
    return back()->withSuccess(__('site.success'));
  }

  public function show($deal)
  {
    $deal = DealDeveloper::findOrFail($deal);
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

    return view('admin.deals.show_developer',compact('deal','countries'));

  }  

  public function getDealDevelopers(Request $request)
  {
    if(!$request->country) return false;
      
    $country = Country::where('id',$request->country)->first();
  
    $rows = DealDeveloper::where('country_id',$request->country)
                          ->orderBy('name_en','ASC')
                          ->get();
                          
    foreach($rows as $row)
    {
      $row->name = $row->name_en;
    }
    return response()->json([
      'status' => 'success',
      'rows' => $rows,
      'countryCode' => $country->code
    ]);
  }

  public function exportDataDeveloper(){
    if(Request()->has('exportData')){
      return Excel::download(new DealDeveloperExport, 'DealDevelopersReport_'.date('d-m-Y').'.xlsx');
    }  
  }

}
