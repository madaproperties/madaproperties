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
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\DatabaseRecords;
use App\DatabaseRecordsExport;
use App\DatabaseNote;
use App\Status;
use App\Imports\DatabaseImport;


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
    
    
    /********* Get Contacts By The Rule ***********/
    // if(userRole() == 'admin' || userRole() == 'sales admin uae' || userRole() == 'sales admin saudi' || userRole() == 'digital marketing'  || userRole() == 'ceo' ){ //Updated by Javed

    //     if(userRole() == 'sales admin uae'){

    //       $data = DatabaseRecords::where(function ($q){
    //         $this->filterPrams($q);
    //       })->orderBy('created_at','DESC');

    //       $data_count = $data->count();

    //       $paginationNo = 20;
    //       $data = $data->paginate($paginationNo);
          
    //     }else if(userRole() == 'sales admin saudi'){
    //       $data = DatabaseRecords::where(function ($q){
    //         $this->filterPrams($q);
    //       })->orderBy('created_at','DESC');

    //       $data_count = $data->count();

    //       $paginationNo = 20;
    //       $data = $data->paginate($paginationNo);

    //     }else{

    //       $data = DatabaseRecords::where(function ($q){
    //             $this->filterPrams($q);
    //           })->orderBy('created_at','DESC');

    //       $data_count = $data->count();

    //       $paginationNo = 20;
    //       $data = $data->paginate($paginationNo);
    //     }

    // }elseif(userRole() == 'leader'){
    //   // get leader group
    //   $leaderId = auth()->id();
    //   // get leader , and sellers reltedt to that leader
    //   $users = User::select('id','leader')->where('active','1')->where('leader',$leaderId)->Orwhere('id',$leaderId)->get();
    //   $usersIds = $users->pluck('id')->toArray();
    //   $data = DatabaseRecords::whereIn('assign_to',$usersIds)->where(function ($q){
    //   $this->filterPrams($q);
    //   })->orderBy('created_at','DESC');
    //   $data_count = $data->count();
    //   $data = $data->paginate(20);

    // }else if(userRole() == 'sales admin') { // sales admin
      
    //   $data = DatabaseRecords::where(function ($q){
    //     $this->filterPrams($q);
    //   })->where('assign_to',null)
    //     ->orderBy('created_at','DESC');

    //   $data_count = $data->count();
    //   $data = $data->paginate(20);
    // }else if(userRole() == 'sales director') { 
    //   $data = DatabaseRecords::where(function ($q){
    //     $this->filterPrams($q);
    //   })->where('assign_to',null)
    //     ->orderBy('created_at','DESC');

    //   $data_count = $data->count();
    //   $data = $data->paginate(20);
    // }else{
    //   $data = DatabaseRecords::where(function ($q){
    //     $this->filterPrams($q);
    //   })->where('assign_to',auth()->id())->orderBy('created_at','DESC');

    //   $data_count = $data->count();
    //   $data = $data->paginate(20);

    // }
    // added by fazal
    if(userRole() == 'admin')
    {
     $data=DatabaseRecords::join('statuses','database_records.status','statuses.id')
                            ->select('database_records.*','statuses.name_en AS status') 
                            ->paginate(20);
     $data_count = DatabaseRecords::count();

    }
    else
    {
     $data=DatabaseRecords::where('assign_to',auth()->id())
                           ->select('database_records.*','statuses.name_en AS status') 
                           ->paginate(20);
     $data_count = DatabaseRecords::count();
    }
    $sellers = getSellers();
    return view('admin.databaserecords.index',compact('data','data_count','sellers'));
  }

  public function create() {
    $countries = $this->getCuntoryList();
    $sellers = getSellers();
    $status =  Status::get();
    return view('admin.databaserecords.create',compact('countries','sellers','status'));
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
        'comment' => 'nullable',
        'created_by' =>'nullable',
        'assign_to' => 'nullable',           
      ]);


      $data['created_at'] = Carbon::now();
      $data['created_by'] = auth()->id();
      $data['assign_to'] = auth()->id();
      $data['status'] = 2; 
      addHistory('Database Records',0,'added',$data);   

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


  public function update(Request $request,  $id)
  {

    $deal = DatabaseRecords::findOrFail($id);

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
      'comment' => 'nullable',
      'assign_to' => 'nullable'  
  ]);

    $data['updated_at'] = Carbon::now();

    addHistory('Database Records',$id,'updated',$data,$deal);
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
    addHistory('Database Records',$id,'deleted');
    return back()->withSuccess(__('site.success'));
  }

  public function show($deal)
  {
    $data = DatabaseRecords::findOrFail($deal);

    $countries = $this->getCuntoryList();
    $sellers = getSellers();
    $status =  Status::get();
    $notes = DatabaseNote::where('database_id',$data->id)->orderBy('created_at','DESC')->get();

    return view('admin.databaserecords.show',compact('data','countries','sellers','notes','status'));
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
              ->OrWhere('email','LIKE','%'. Request('search') .'%')
              ->OrWhere('phone','LIKE','%'. Request('search') .'%')
              ->get();
    }
  }  


  public function exportDatabaseRecords(){
  
    if(Request()->has('exportData')){
      return Excel::download(new DatabaseRecordsExport, 'DatabaseRecords_'.date('d-m-Y').'.xlsx');
    }  
  }

  public function multiple_assign() {
    $data = [];
    if(!request()->ids OR !request()->id) return false;
    $user = User::where('id',request()->id)->first();
    $records = explode(',',request()->ids);
    $records = DatabaseRecords::select('id','assign_to')->whereIn('id',$records)->get();
    if(!$records OR !$user) return false;

    foreach($records as $data) {
      $data->update([
        'assign_to' => $user->id,
        'updated_at' => Carbon::now()
      ]);
    }

    return response()->json([
      'status' => true,
    ]);
  }  

  function getCuntoryList(){
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

    return $countries;
  }

  public function import(Request $req) {
    $file = $req->validate([
      'file' => 'required|mimes:xlsx'
    ]);
    $file = Request()->file('file');

    $results = Excel::import(new DatabaseImport,$file);

    return back();
  }
}
