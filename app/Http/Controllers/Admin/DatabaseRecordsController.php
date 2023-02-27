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
use App\Zones;
use Maatwebsite\Excel\Facades\Excel;
use App\DatabaseRecords;
use App\DatabaseRecordsExport;
use App\DatabaseNote;
use App\Status;
use App\Districts;
use App\Community;
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
    if(userRole() == 'admin' || userRole() == 'sales admin uae' || userRole() == 'sales admin saudi' || userRole() == 'digital marketing'  || userRole() == 'ceo'|| userRole() == 'sales director' ){ //Updated by Javed
         
        if(userRole() == 'sales admin uae'){

          $data = DatabaseRecords::where('country_id',2)->where(function ($q){
            $this->filterPrams($q);
          })->orderBy('created_at','DESC');


          $data_count = $data->count();

          $paginationNo = 20;
          $data = $data->paginate($paginationNo);
          
        }else if(userRole() == 'sales admin saudi'){
          $data = DatabaseRecords::where('country_id',1)->where(function ($q){
            $this->filterPrams($q);
          })->orderBy('created_at','DESC');

          $data_count = $data->count();

          $paginationNo = 20;
          $data = $data->paginate($paginationNo);

        }
       

        elseif(userRole()=='sales director')
        {
          // dd('hit');
          $user=User::where('id',auth()->id())->first();
          if($user->time_zone=='Asia/Riyadh')
          {
           $data = DatabaseRecords::where('country_id',1)
          ->orderBy('created_at','DESC');

          $data_count = $data->count();

          $paginationNo = 20;
          $data = $data->paginate($paginationNo);
          }
          else
          {
          $data = DatabaseRecords::where('country_id',2)->orderBy('created_at','DESC');

          $data_count = $data->count();

          $paginationNo = 20;
          $data = $data->paginate($paginationNo);
          }
        }

        else{

          $data = DatabaseRecords::where(function ($q){
                $this->filterPrams($q);
              })->orderBy('created_at','DESC');

          $data_count = $data->count();

          $paginationNo = 20;
          $data = $data->paginate($paginationNo);
        }

    }elseif(userRole() == 'leader'){
      // get leader group
      $leaderId = auth()->id();
      // get leader , and sellers reltedt to that leader
      $users = User::select('id','leader')->where('active','1')->where('leader',$leaderId)->Orwhere('id',$leaderId)->get();
      $usersIds = $users->pluck('id')->toArray();
      $data = DatabaseRecords::whereIn('user_id',$usersIds)->where(function ($q){
      $this->filterPrams($q);
      })->orderBy('created_at','DESC');
      $data_count = $data->count();
      $data = $data->paginate(20);

    }else if(userRole() == 'sales admin') { // sales admin
      $user_data=User::where('id',auth()->id())->first();
       $user_loc=$user_data->time_zone;
       if($user_loc=='Asia/Dubai')
       {
         $data = DatabaseRecords::where('unit_country',2)->where(function ($q){
        $this->filterPrams($q);
      })->where('user_id',null)
        ->orderBy('created_at','DESC');
       }

       else{
         $data = DatabaseRecords::where('unit_country',1)->where(function ($q){
        $this->filterPrams($q);
      })->where('user_id',null)
        ->orderBy('created_at','DESC');
       }  
      

      $data_count = $data->count();
      $data = $data->paginate(20);
    }else if(userRole() == 'sales director') { 
      $user_data=User::where('id',auth()->id())->first();
       $user_loc=$user_data->time_zone;
       if($user_loc=='Asia/Dubai')
       {
         $data = DatabaseRecords::where('unit_country',2)->where(function ($q){
        $this->filterPrams($q);
      })->where('user_id',null)
        ->orderBy('created_at','DESC');
        }
        else
        {
         $data = DatabaseRecords::where('unit_country',1)->where(function ($q){
        $this->filterPrams($q);
      })->where('user_id',null)
        ->orderBy('created_at','DESC');
        }
     

      $data_count = $data->count();
      $data = $data->paginate(20);
    }else{
      $data = DatabaseRecords::where(function ($q){
        $this->filterPrams($q);
      })->where('user_id',auth()->id())->orderBy('created_at','DESC');

      $data_count = $data->count();
      $data = $data->paginate(20);

    }
    $sellers = getSellers();
    $countries = Country::orderBy('name_en')->get(); //added by fazal -26-02
    $project_country=Country::whereIn('id',[1,2])->get();//added by fazal -26-02
    $createdBy = User::where('active','1')->select('id','email')->get();
    $status = Status::where('active','1')->orderBy('weight','ASC')->get();
    $zones=Zones::get(); //added by fazal -26-02
    $districts=Districts::get(); //added by fazal -26-02
    $communities = Community::where('parent_id',0)->orderBy('name_en','asc')->get(); //added by fazal -26-02
    $subcommunities = Community::where('parent_id','!=', 0)->orderBy('name_en','asc')->get();  //added by fazal -26-02
    return view('admin.databaserecords.index',compact('data','data_count','sellers','countries','createdBy','status','zones','districts','communities','subcommunities','project_country'));
  }

  public function create() {
    $user=User::where('id',auth()->id())->first();
    if($user->time_zone=='Asia/Riyadh' && $user->rule!= 'admin')
    {
     $dbcountries = Country::where('id',1)->get();
    }
    elseif($user->time_zone=='Asia/Dubai' && $user->rule != 'admin')
    {
     $dbcountries = Country::where('id',2)->get();
    }
    else
    {
    $dbcountries = Country::whereIn('id',[1,2])->get();  
    }
    $countries= Country::get();
    $sellers = getSellers();
    $status=Status::get();
    $zones=Zones::get();
    $communities = Community::where('city_id','84')->where('parent_id',0)->orderBy('name_en','asc')->get();      
    
    return view('admin.databaserecords.create',compact('countries','sellers','status','dbcountries','zones','communities'));
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
        "country_id"            => "required",
        "name"          => "required",
        "email"          => "nullable",
        "phone"          => "required",
        "city"          => "nullable",
        "area"          => "nullable",
        "project_id"          => "nullable",
        "unit_country"  => "nullable",
        "building_name"          => "nullable",
        "unit_name"             => "nullable",
        "price"          => "nullable",
        "bedroom"          => "nullable",
        'local_phone_no_or_reference' => 'nullable',
        'options' => 'nullable',
        'response' => 'nullable',
        'community_id' => 'nullable',
        'subcommunity_id' => 'nullable',
        'developer' => 'nullable',
        'status' => 'nullable',        
        'comment' => 'nullable',
        'user_to' => 'nullable',
        'user_country_id'=>'nullable',
        'zone_id'=>'nullable',
        'district_id'=>'nullable',           
      ]);


      $data['created_at'] = Carbon::now();
      $data['created_by'] =auth()->id();
      $data['user_id']=auth()->id();
      $data['status']=2;

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
        "unit_country"  => "nullable",
        "building_name"          => "nullable",
        "unit_name"             => "nullable",
        "price"          => "nullable",
        "bedroom"          => "nullable",
        'local_phone_no_or_reference' => 'nullable',
        'options' => 'nullable',
        'response' => 'nullable',
        'community_id' => 'nullable',
        'subcommunity_id' => 'nullable',
        'developer' => 'nullable',
        'status' => 'nullable',        
        'comment' => 'nullable',
        'user_to' => 'nullable',
        'user_country_id'=>'nullable',
        'zone_id'=>'nullable',
        'district_id'=>'nullable',           
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
     $user=User::where('id',auth()->id())->first();
    if($user->time_zone=='Asia/Riyadh' && $user->rule=='sales')
    {
     $dbcountries = Country::where('id',1)->get();
    }
    elseif($user->time_zone=='Asia/Dubai' && $user->rule=='sales')
    {
     $dbcountries = Country::where('id',2)->get();
    }
    else
    {
    $dbcountries = Country::whereIn('id',[1,2])->get();  
    }
    $countries = $this->getCuntoryList();
    $sellers = getSellers();
    $status=Status::get();
    $districts=Districts::get();
    $zones=Zones::get();
    $districts=Districts::where('zone_id',$data->zone_id)->get();
    $communities = Community::where('city_id','84')->where('parent_id',0)->orderBy('name_en','asc')->get();
    $subcommunities = Community::where('city_id','84')->where('parent_id',$data->community_id)->get();
    $notes = DatabaseNote::where('database_id',$data->id)->orderBy('created_at','DESC')->get();

    return view('admin.databaserecords.show',compact('data','status','countries','sellers','notes','dbcountries','zones','communities','subcommunities','districts'));
  }

private function filterPrams($q){
  if(request()->has('ADVANCED')){
      $feilds = request()->all();
      $uri = Request()->fullUrl();
      session()->put('start_filter_url',$uri);
      $allowedFeilds =[
        "country_id" ,
        "user_id" ,
        "project_id" ,
        "purpose" ,
        "lang" ,
        "campaign",
        "last_mile_conversion",
        "status",
        "created_by", //Added by Javed
        "project_country_id", //Added by Javed
        "budget", //Added by Javed
        "source", //Added by Javed
        "purpose_type", //Added by Javed
        "email", //Added by Javed
        "is_meeting", //Added by Javed,
        "lead_category", //Added by Javed,
        "campaign_country", //Added by Javed,
        "zone_id",   //added by fazal-25-02
        "district_id" ,//added by faza -25-02
        "community_id",//added by faza -25-02
        "subcommunity_id",//added by faza -25-02
        "user_country_id" //added by faza -26-02
      ];
      $user_id = 0;
      foreach($feilds as $feild => $value){
        if(in_array($feild,$allowedFeilds) AND !empty($value)){
          if($feild == 'user_id'){
            $user_id = $value;
          }
          if($feild == 'email'){
            $email = $value;
          }
          if($feild == 'project_country_id'){
            $q->whereHas('project', function($q2) use($value) {
              $q2->where('projects.country_id',$value);
            });
          }

            if($feild == 'user_country_id'){
            $q->whereHas('usercountry', function($q2) use($value) {
              $q2->where('countries.id',$value);
            });
          }
          if($feild == 'zone_id'){
            $q->whereHas('zone', function($q2) use($value) {
              $q2->where('zone.id',$value);
            });
          }
           if($feild == 'district_id'){
            $q->whereHas('district', function($q2) use($value) {
              $q2->where('districts.id',$value);
            });
          }
           if($feild == 'community_id'){
            $q->whereHas('community', function($q2) use($value) {
              $q2->where('community.id',$value);
            });
          }

           if($feild == 'subcommunity_id'){
            $q->whereHas('subcommunity', function($q2) use($value) {
              $q2->where('community.id',$value);
            });
          }
          else if($feild == 'is_meeting' && $value == 1){
              $q->whereHas('logs', function($q2) use($value,$user_id) {
                $q2->where('logs.type','meeting');
                if($user_id){
                  $q2->where('logs.user_id',$user_id);
                }
                if(userRole() == 'sales'){
                  $q2->where('logs.user_id',auth()->id());
                }
                //Added by Javed
                if(Request('meeting_from') && Request('meeting_to')){
                  $from = date('Y-m-d', strtotime(Request('meeting_from')));
                  $to = date('Y-m-d', strtotime(Request('meeting_to')));
                  $q2->whereBetween('logs.log_date',[$from,$to]);
                }else{   
                  if(Request('meeting_from')){
                    $from = date('Y-m-d', strtotime(Request('meeting_from')));
                    $q2->where('logs.log_date','>=', $from);
                  }   
                  if(Request('meeting_to')){
                    $to = date('Y-m-d', strtotime(Request('meeting_to')));
                    $q2->where('logs.log_date','<=',$to);
                  }            
                }                
              });
          }else if($feild == 'campaign_country'){
            $q->whereIn($feild,explode(",",$value));
          }else{
            $q->where($feild,$value);
          }
        }
      }

      //Added by Javed
      if(Request('from') && Request('to')){
        $uri = Request()->fullUrl();
        session()->put('start_filter_url',$uri);
        $from = date('Y-m-d 00:00:00', strtotime(Request('from')));
        $to = date('Y-m-d 23:59:59', strtotime(Request('to')));
        $q->whereBetween('created_at',[$from,$to]);
      }else{   
        if(Request('from')){
          $uri = Request()->fullUrl();
          session()->put('start_filter_url',$uri);
          $from = date('Y-m-d 00:00:00', strtotime(Request('from')));
          $q->where('created_at','>=', $from);
        }   
        if(Request('to')){
          $uri = Request()->fullUrl();
          session()->put('start_filter_url',$uri);
          $to = date('Y-m-d 23:59:59', strtotime(Request('to')));
          $q->where('created_at','<=',$to);
        }            
      }
      //End

      //Added by Javed
      if(Request('last_update_from') && Request('last_update_to')){
        $uri = Request()->fullUrl();
        session()->put('start_filter_url',$uri);
        $from = date('Y-m-d 00:00:00', strtotime(Request('last_update_from')));
        $to = date('Y-m-d 23:59:59', strtotime(Request('last_update_to')));
        $q->whereBetween('updated_at',[$from,$to]);
      }else{   
        if(Request('last_update_from')){
          $uri = Request()->fullUrl();
          session()->put('start_filter_url',$uri);
          $from = date('Y-m-d 00:00:00', strtotime(Request('last_update_from')));
          $q->where('updated_at','>=', $from);
        }   
        if(Request('last_update_to')){
          $uri = Request()->fullUrl();
          session()->put('start_filter_url',$uri);
          $to = date('Y-m-d 23:59:59', strtotime(Request('last_update_to')));
          $q->where('updated_at','<=',$to);
        }            
      }
      //End


      if(Request()->has('challenge_lead') && request('challenge_lead')){
        $uri = Request()->fullUrl();
        session()->put('start_filter_url',$uri);
        return $q->whereIn('status', ['1','4','7'])
                  ->whereDate('updated_at', '<=', Carbon::now()->subMonths(1));
      }
      return $q->get();
    }

    if(Request()->has('search') AND Request()->has('my-contacts')  AND Request()->has('filter_status')){
      $uri = Request()->fullUrl();
      session()->put('start_filter_url',$uri);
      return $q->where('status',Request('filter_status'))
          ->where('user_id', auth()->id())
          ->where(function ($q){
              $q ->OrWhere('last_name','LIKE','%'. Request('search') .'%')
                ->OrWhere('first_name','LIKE','%'. Request('search') .'%')
                ->OrWhere('email','LIKE','%'. Request('search') .'%')
                ->OrWhere('phone','LIKE','%'. Request('search') .'%')
                ->OrWhere('scound_phone','LIKE','%'. Request('search') .'%')
                ->OrWhere('campaign','LIKE','%'. Request('search') .'%')
                ->OrWhere('source','LIKE','%'. Request('search') .'%')
                ->OrWhere('medium','LIKE','%'. Request('search') .'%');
          })->get();
    }

    if(Request()->has('filter_status') AND Request()->has('search')){
      $uri = Request()->fullUrl();
      session()->put('start_filter_url',$uri);
      return $q->where('status',Request('filter_status'))
        ->where(function ($q){
          $q ->OrWhere('last_name','LIKE','%'. Request('search') .'%')
            ->OrWhere('first_name','LIKE','%'. Request('search') .'%')
            ->OrWhere('email','LIKE','%'. Request('search') .'%')
            ->OrWhere('phone','LIKE','%'. Request('search') .'%')
            ->OrWhere('scound_phone','LIKE','%'. Request('search') .'%')
            ->OrWhere('campaign','LIKE','%'. Request('search') .'%')
            ->OrWhere('source','LIKE','%'. Request('search') .'%')
            ->OrWhere('medium','LIKE','%'. Request('search') .'%');
      })->get();
    }

    if(Request()->has('campaign')){
      $uri = Request()->fullUrl();
      session()->put('start_filter_url',$uri);
      if(!request('status')){
        return $q->where('campaign', request('campaign'))->get();
      }
      return $q->where('status', request('status'))
              ->where('campaign', request('campaign'))->get();
    }


    if(Request()->has('search') AND Request()->has('my-contacts')){
        $uri = Request()->fullUrl();
        session()->put('start_filter_url',$uri);
        return $q->where('user_id',auth()->id())
          ->where(function ($q){
            $q ->OrWhere('last_name','LIKE','%'. Request('search') .'%')
              ->OrWhere('first_name','LIKE','%'. Request('search') .'%')
              ->OrWhere('phone','LIKE','%'. Request('search') .'%')
              ->OrWhere('email','LIKE','%'. Request('search') .'%')
              ->OrWhere('scound_phone','LIKE','%'. Request('search') .'%')
              ->OrWhere('campaign','LIKE','%'. Request('search') .'%')
              ->OrWhere('source','LIKE','%'. Request('search') .'%')
              ->OrWhere('medium','LIKE','%'. Request('search') .'%');
        })->get();
    }


    if(Request()->has('my-contacts') AND Request()->has('filter_status')){
      $uri = Request()->fullUrl();
      session()->put('start_filter_url',$uri);
      return $q->where('status', Request('filter_status'))->where('user_id', auth()->id());
    }

    if(Request()->has('my-contacts')){
      return $q->where('user_id', auth()->id());
    }

    if(Request()->has('filter_status')){
      $uri = Request()->fullUrl();
      session()->put('start_filter_url',$uri);
      return $q->where('status', Request('filter_status'));
    }


    if(Request()->has('unassigned')){
      $uri = Request()->fullUrl();
      session()->put('start_filter_url',$uri);
      $notAssignedLevel = User::select('id','rule')
                              ->where('rule','admin')
                              ->OrWhere('rule','sales admin')->get();

      return $q->where('user_id',null)
              ->orWhereIn('user_id',$notAssignedLevel->pluck('id')->toArray())->get();
    }



    if(request()->has('status') AND request()->has('user')){
      return  $q->where('status_changed_at', '<=', Carbon::today()->subDays( 2 ))
                ->where('status',request('status'))
                ->where('user_id',request('user'));

    }


    if(request()->has('export')){
      $req = request('export');
      $campaing = Campaing::select('id','name')->where('id',$req)->first();

      if($campaing)
      {
          return $q->where('campaign',$campaing->name)->get();
      }
    }

    if(Request()->has('search')){
      $uri = Request()->fullUrl();
      session()->put('start_filter_url',$uri);
      return $q->where('first_name','LIKE','%'. Request('search') .'%')
              ->OrWhere('last_name','LIKE','%'. Request('search') .'%')
              ->OrWhere('phone','LIKE','%'. Request('search') .'%')
              ->OrWhere('email','LIKE','%'. Request('search') .'%')
              ->OrWhere('scound_phone','LIKE','%'. Request('search') .'%')
              ->OrWhere('campaign','LIKE','%'. Request('search') .'%')
              ->OrWhere('source','LIKE','%'. Request('search') .'%')
              ->OrWhere('medium','LIKE','%'. Request('search') .'%')
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
    $records = DatabaseRecords::select('id','user_id')->whereIn('id',$records)->get();
    if(!$records OR !$user) return false;

    foreach($records as $data) {
      $data->update([
        'user_id' => $user->id,
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

  // added by fazal
  public function fetchCity(Request $request)
  {
    $country_id=$request->get('id');
     if($country_id==1)
     {
      $city='Riyadh';
     }
     else{
      $city='Dubai';
     } 
      return response()->json($city);        
  }
  public function fetchDistrict(Request $request)
  {
    $zone_id=$request->get('zone_id');
       $data['districts']=Districts::where('zone_id',$zone_id)->get();
       return response()->json($data);
  }
  
  public function fetchCommunity(Request $request)
  {
    $id=$request->get('id');
    //dd($id);
       $data['subCommunity'] = Community::where('city_id','84')->where('parent_id',$id)->orderBy('name_en','asc')->get();
       return response()->json($data);
  }

}
