<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusinessDevelopment;
use App\BusinessActivity;
use App\BusinessTask;
use App\BusinessNote;
use App\BusinessLog;
use App\BusinessRequirements;
use App\BusinessContactPerson;
use App\Status;
use App\Country;
use App\User;
use App\PurposeType;
use App\Currency;
use App\City;
use App\Zones;
use App\Districts;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;


class BusinessdevelopementController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  function __construct()
  {
      $this->middleware('permission:busniess-development-list|busniess-development-create|busniess-development-edit|busniess-development-delete', ['only' => ['index','store']]);
      $this->middleware('permission:busniess-development-create', ['only' => ['create','store']]);
      $this->middleware('permission:busniess-development-edit', ['only' => ['edit','show','update','detail']]);
      $this->middleware('permission:busniess-development-delete', ['only' => ['destroy']]);
      //$this->middleware('permission:commercial-export', ['only' => ['exportDataContact']]);
  }   

  public function index(){ 
    
    if(Request()->has('search'))
    {
     $business_leads=BusinessDevelopment::Where('business_category','LIKE','%'. Request('search') .'%')
                                         ->orWhere('activity_type','LIKE','%'. Request('search') .'%')
                                         ->orWhere('brand_name','LIKE','%'. Request('search') .'%')
                                         ; 
    } 
    else{
     $business_leads=BusinessDevelopment::select('*'); 
    }

    if(userRole() == 'business developement leader'){
      // get leader group
      $leaderId = auth()->id();
      // get leader , and sellers reltedt to that leader
      $usersIds = User::select('id','leader')->where('active','1')
      ->whereRaw('JSON_CONTAINS(leader, ?)', [$leaderId])
      ->orWhere('id',$leaderId)
      ->pluck('id');

      $business_leads->whereIn('user_id',$usersIds);

    }elseif(userRole() == 'business developement sales') {
      $business_leads->where('user_id',auth()->id());
    }

    $business_leads->orderBy('id', 'DESC');

 $business_count= $business_leads->count();
    $business_leads= $business_leads->paginate(20); 


    $uri = Request()->fullUrl();
    session()->put('start_filter_url',$uri);
        
    $businessSellers = getBusinessSellers();
    return view('admin.business-development.index',compact('business_leads','business_count','businessSellers'));
    // return view('admin.busniess-development.index');
  }

  public function show($business)
  {
    
   $business = BusinessDevelopment::findOrFail($business);
    $countries = Country::orderBy('name_en')->get();  
    return view('admin.business-development.show',[
      'business' => $business,
      'countries' => $countries
    ]);
  }


  public function create() {
    
     $countries = Country::get();


    return view('admin.business-development.create',compact('countries'));
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
      "country"                 => "nullable",
      "brand_name"             => "nullable|max:255",
      "business_category"            => "nullable",
      "activity_type"            => "nullable",
      "location_id"            => "nullable",
      "contact_persons"            => "nullable",
    ]);

    $data['created_by'] = auth()->id(); // set user to cuurunt user\
    $data['user_id'] = auth()->id(); // set user to cuurunt user\

    addHistory('Business',0,'added',$data);
    $contact_persons='';
    if($data['contact_persons']){
      $contact_persons = $data['contact_persons'];
      unset($data['contact_persons']);
    }
    $business = BusinessDevelopment::create($data);

    if($contact_persons){
      $contactPersons = [];
      for($i=0;$i < count($contact_persons); $i++){

        $contactPersons['name']=$contact_persons[$i]['name'];
        $contactPersons['email']=$contact_persons[$i]['email'];
        $contactPersons['phone']=$contact_persons[$i]['phone'];
        $contactPersons['designation']=$contact_persons[$i]['designation'];
        $contactPersons['lead_id']=$business->id;
        BusinessContactPerson::create($contactPersons);
      }

    }
    $action = __('site.lead created');

    $this->newBusinessDevelopmentActivity($business->id,auth()->id(),$action,'Business',$business->id,null,true);

    return redirect()->route('admin.business-development-leads.index')->withSuccess(__('site.success'));
  }


  public function update(Request $request,  $id) {
 
    $business = BusinessDevelopment::findOrFail($id);
    $data = $request->validate([
      "country"                 => "nullable",
      "brand_name"             => "nullable|max:255",
      "business_category"            => "nullable",
      "activity_type"            => "nullable",
      "location_id"            => "nullable",
      "contact_persons"            => "nullable",
    ]);

    $data['updated_at'] = Carbon::now();
    if($data['contact_persons']){
      $contactPersons = [];
      BusinessContactPerson::where('lead_id',$id)->delete();
      for($i=0;$i < count($data['contact_persons']); $i++){

        $contactPersons['name']=$data['contact_persons'][$i]['name'];
        $contactPersons['email']=$data['contact_persons'][$i]['email'];
        $contactPersons['phone']=$data['contact_persons'][$i]['phone'];
        $contactPersons['designation']=$data['contact_persons'][$i]['designation'];
        $contactPersons['lead_id']=$id;
        BusinessContactPerson::create($contactPersons);
      }

      unset($data['contact_persons']);
    }
    
    addHistory('Business',$id,'updated',$data,$business);
    $business->update($data);

    return redirect()->route('admin.business-development-leads.index')->withSuccess(__('site.success'));
  }


  public function destroy ($id) {

      $business = BusinessDevelopment::findOrFail($id);
      $business->delete();
      addHistory('Business',$id,'deleted');    
      return back()->withSuccess(__('site.success'));
  }

  public function detail($id) {
    
    $business = BusinessDevelopment::findOrFail($id);

    $persons= BusinessContactPerson::where('lead_id',$id)->get();
    $status = Status::where('active','1')->orderBy('weight','ASC')->get();
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
    // End Hundel Counties Sort

    $purposetype = PurposeType::orderBy('type')->get();
    $currencies = "";

    $sellers = getSellers(); // Added by Lokesh on 15-11-2022

    $activities = BusinessActivity::where('business_id',$business->id)->orderBy('id','DESC')->get();
    $tasks = BusinessTask::where('business_id',$business->id)->orderBy('created_at','DESC')->get();
    $notes = BusinessNote::where('business_id',$business->id)->orderBy('created_at','DESC')->get();
    $logs = BusinessLog::where('business_id',$business->id)->orderBy('created_at','DESC')->get();
    $requirements = BusinessRequirements::where('business_id',$business->id)->orderBy('created_at','DESC')->get();
    

    $LastConnected = BusinessLog::where('business_id',$business->id)->orderBy('log_date','DESC')->first();

    $minutes = [
      '15',
      '30',
      '45',
    ];
    $durations = [];
    for($i =0;$i<=8;$i++) {
      foreach($minutes as $minute) {
        $time = $i . ' hours '.$minute .' minutes';
        $durations[] = str_replace('0 hours','',$time);
      }
    }
    $purpose  = auth()->user()->position_types;
    $purpose  = json_decode($purpose);

    if(count($purpose) == 1 AND $purpose[0] == 'sell'){
        $purpose[0] = 'buy';
    }
    $cities ="";
    $communities="";
    $subcommunities="";
    $zones="";
    $districts="";
    $cities = City::where('country_id',1)->get();
    $zones = Zones::get();
    $districtsEdit="";
    if($business->zone_id){
      $districtsEdit = Districts::where('zone_id',$business->zone_id)->get();
    }

    $expanding_years = [
      date("Y",strtotime("-1 year")) => date("Y",strtotime("-1 year")),
      date("Y") => date("Y"),
      date("Y",strtotime("+1 year")) => date("Y",strtotime("+1 year")),
      date("Y",strtotime("+2 year")) => date("Y",strtotime("+2 year")),
      date("Y",strtotime("+3 year")) => date("Y",strtotime("+3 year")),
      date("Y",strtotime("+4 year")) => date("Y",strtotime("+4 year")),
      date("Y",strtotime("+5 year")) => date("Y",strtotime("+5 year")),
    ];
      $fields = [
                100,
                200,
                300,
                400,
                ];
    return view('admin.business-development.detail',[
      'business' => $business,
      'countries' => $countries,
      'sellers' => $sellers,
      'activities' => $activities,
      'tasks' => $tasks,
      'notes' => $notes,
      'requirements' => $requirements,
      'purpose' => $purpose,
      'logs' => $logs,
      'status' => $status,
      'LastConnected' => $LastConnected,
      'durations' => $durations,
      'currencies' => $currencies,
      'purposetype' => $purposetype,
      'cities'=>$cities,
      'communities'=>$communities,
      'subcommunities'=>$subcommunities,
      'zones'=>$zones,
      'districts' =>$districtsEdit,
      'cities' =>$cities,
      'expanding_years' => $expanding_years,
      'persons'  =>$persons,
      'fields'  =>$fields,
    ]);
  }

  public function multiple_assign() {
 
    $data = [];
    if(!request()->ids OR !request()->id) return false;
    $user = User::where('id',request()->id)->first();
    $ids = explode(',',request()->ids);
    //$contacts = Contact::select('*')->whereIn('id',$contacts)->get();
    $businesses = BusinessDevelopment::whereIn('id',$ids)->get();
    if(!$businesses OR !$user) return false;

    foreach($businesses as $business) {
      
      //Added by Lokesh on 13-09-2022  
      $mailData = [
        'user_name' => $business->user ? $business->user->name : '',
      ];          
      //end
        
      // create new history if he not the same user !
      if($business->user_id != $user->id) {
        $action = __('site.assigned to') .' '.User::where('id',$user->id)->first()->name;
        $this->newBusinessDevelopmentActivity($business->id,auth()->id(),$action,null,null, null,true);
      }
      
      
      if($user->id != $business->user_id) {
          $action = __('site.assigned to') .' '.User::where('id',$user->id)->first()->name;
          $this->newBusinessDevelopmentActivity($business->id,auth()->id(),$action,null,null, null,true);
      }
      
      $business->update([
        'user_id' => $user->id,
        'updated_at' => Carbon::now()
      ]);
    }

    return response()->json([
      'status' => true,
    ]);
  }

  public function multiple_delete() {
    
    $ids = explode(',',request()->ids);
    BusinessDevelopment::whereIn('id',$ids)->delete();
    for($i = 0; $i < count($ids); $i++){
      addHistory('Business',$ids[$i],'deleted');    
    }
    return response()->json([
      'status' => true,
    ]);
  }

  function getDistricts(Request $request){
    $districts = Districts::where('zone_id',$request->zone_id)->orderBy('name','asc')->get();

    $data = '<option value="">'. __('site.choose').'</option>';
    foreach($districts as $district){
      $data .= '<option value="'.$district->id.'">'.$district->name.'</option>';
    }
    return $data;
  }

}
