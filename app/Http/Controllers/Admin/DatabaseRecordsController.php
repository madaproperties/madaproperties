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
use Maatwebsite\Excel\Facades\Excel;
use App\DatabaseRecords;
use App\DatabaseRecordsExport;

class DatabaseRecordsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     function __construct()
     {
          $this->middleware('permission:database-records-list', ['only' => ['index']]);
          $this->middleware('permission:database-records-create', ['only' => ['create','store']]);
          $this->middleware('permission:database-records-edit', ['only' => ['edit','show','update']]);
          $this->middleware('permission:database-records-delete', ['only' => ['destroy']]);
          $this->middleware('permission:database-records-export', ['only' => ['exportDatabaseRecords']]);
     }  
  // index 
  public function index(){
    if(Request()->has('search')){
      $data = DatabaseRecords::where('name','LIKE','%'. Request('search') .'%')->orderBy('created_at','desc')->paginate(20);
      $data_count  = DatabaseRecords::where('name','LIKE','%'. Request('search') .'%')->orderBy('created_at','desc')->count();
    }else{
      $data = DatabaseRecords::orderBy('created_at','desc')->paginate(20);
      $data_count  = DatabaseRecords::orderBy('created_at','desc')->count();
    }
    return view('admin.databaserecords.index',compact('data','data_count'));
  }

  public function create() {
    $countries = Country::orderBy('name_en')->get();
    $collectCounties = [];
    $collectCounties = collect($collectCounties);

    foreach($countries as $index => $country) {
        if(in_array($country->name_en,toCountriess()) ) {
            $collectCounties->push($country);
        }
    }
    $countries = $countries->filter(function($item) {
      return !in_array($item->name_en,toCountriess());
    });

    foreach($collectCounties as $topCountry) {
        $countries->prepend($topCountry);
    }

    return view('admin.databaserecords.create',compact('countries'));
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
        "country_id"            => "nullable",
        "name"          => "nullable",
        "email"          => "nullable",
        "phone"          => "nullable",
        "city"          => "nullable",
        "area"          => "nullable",
        "project_id"          => "nullable",
        "building_name"          => "nullable",
        "unit_name"             => "nullable",
        "price"          => "nullable",
        "bedroom"          => "nullable",
        'local_phone_no_or_reference' => 'nullable',
        'options' => 'nullable',
        'response' => 'nullable',
        'community' => 'nullable',
        'sub_community' => 'nullable',
        'developer' => 'nullable',
        'status' => 'nullable',        
        'comment' => 'nullable'          
      ]);


      $data['created_at'] = Carbon::now();

      $deal = DatabaseRecords::create($data);
      return redirect(route('admin.database-records.index'))->withSuccess(__('site.success'));
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

    $deal = DatabaseRecords::findOrFail($deal);

    $data = $request->validate([
      "country_id"            => "nullable",
      "name"          => "nullable",
      "email"          => "nullable",
      "phone"          => "nullable",
      "city"          => "nullable",
      "area"          => "nullable",
      "project_id"          => "nullable",
      "building_name"          => "nullable",
      "unit_name"             => "nullable",
      "price"          => "nullable",
      "bedroom"          => "nullable",
      'local_phone_no_or_reference' => 'nullable',
      'options' => 'nullable',
      'response' => 'nullable',
      'community' => 'nullable',
      'sub_community' => 'nullable',
      'developer' => 'nullable',
      'status' => 'nullable',        
      'comment' => 'nullable'        
  ]);

    $data['updated_at'] = Carbon::now();

    $deal->update($data);
    //print_r(session('start_filter_url'));
    //die;
    if(session('start_filter_url')){
      return redirect(session()->get('start_filter_url'))->withSuccess(__('site.success'));
    }
    return redirect(route('admin.database-records.index'))->withSuccess(__('site.success'));
  }


  public function destroy ($id)
  {
    $data = DatabaseRecords::findOrFail($id);
    $data->delete();
    return back()->withSuccess(__('site.success'));
  }

  public function show($deal)
  {
    $data = DatabaseRecords::findOrFail($deal);

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
    return view('admin.databaserecords.show',compact('data','countries'));

  }  

  private function filterPrams($q){
    if(request()->has('ADVANCED')){
      $uri = '';
      $feilds = request()->all();
      $allowedFeilds =[
        "country_id",
        "name",
        "email",
        "phone",
        "city",
        "area",
        "project_id",
        "building_name",
        "unit_name"   ,
        "price",
        "bedroom",
        "price",
        ];

      foreach($feilds as $feild => $value){
        if(in_array($feild,$allowedFeilds) AND !empty($value)){
            $q->where($feild,$value);
        }
      }

      //Added by Javed
      if(Request('from') && Request('to')){
        $uri = Request()->fullUrl();
        $from = date('Y-m-d 00:00:00', strtotime(Request('from')));
        $to = date('Y-m-d 23:59:59', strtotime(Request('to')));
        $q->whereBetween('created_at',[$from,$to]);
      }else{   
        if(Request('from')){
          $uri = Request()->fullUrl();
          $from = date('Y-m-d 00:00:00', strtotime(Request('from')));
          $q->where('created_at','>=', $from);
        }   
        if(Request('to')){
          $uri = Request()->fullUrl();
          $to = date('Y-m-d 23:59:59', strtotime(Request('to')));
          $q->where('created_at','<=',$to);
        }            
      }
      //End

      $uri = Request()->fullUrl();
      session()->put('start_filter_url',$uri);
      return $q->get();
    }

    if(Request()->has('search')){
      $uri = Request()->fullUrl();
      session()->put('start_filter_url',$uri);
      return $q->where('name','LIKE','%'. Request('search') .'%')
              ->get();
    }
  }  


  public function exportDatabaseRecords(){
  
    if(Request()->has('exportData')){
      return Excel::download(new DatabaseRecordsExport, 'DatabaseRecords_'.date('d-m-Y').'.xlsx');
    }  
  }
}
