<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Commercial;
use App\CommercialActivity;
use App\CommercialTask;
use App\CommercialNote;
use App\CommercialLog;
use App\CommercialRequirements;
use App\CommercialContactPerson;
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


class CommercialController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  function __construct()
  {
      $this->middleware('permission:commercial-list|commercial-create|commercial-edit|commercial-delete', ['only' => ['index','store']]);
      $this->middleware('permission:commercial-create', ['only' => ['create','store']]);
      $this->middleware('permission:commercial-edit', ['only' => ['edit','show','update','detail']]);
      $this->middleware('permission:commercial-delete', ['only' => ['destroy']]);
      //$this->middleware('permission:commercial-export', ['only' => ['exportDataContact']]);
  }   

  public function index(){

    $commercial_leads=Commercial::select('*'); 

    if(userRole() == 'commercial leader'){
      // get leader group
      $leaderId = auth()->id();
      // get leader , and sellers reltedt to that leader
      $usersIds = User::select('id','leader')->where('active','1')
      ->where('leader',$leaderId)
      ->orWhere('id',$leaderId)
      ->pluck('id');

      $commercial_leads->whereIn('user_id',$usersIds);

    }elseif(userRole() == 'commercial sales') {
      $commercial_leads->where('user_id',auth()->id());
    }

    $commercial_leads->orderBy('id', 'DESC');

    $commercial_count= $commercial_leads->count();

    $commercial_leads= $commercial_leads->paginate(20); 


    $uri = Request()->fullUrl();
    session()->put('start_filter_url',$uri);
        
    $commercialSellers = getCommercialSellers();
    return view('admin.commercial.index',compact('commercial_leads','commercial_count','commercialSellers'));
  }

  public function show($commercial)
  {
    $commercial = Commercial::findOrFail($commercial);
    $countries = Country::orderBy('name_en')->get();	
    return view('admin.commercial.show',[
      'commercial' => $commercial,
      'countries' => $countries
    ]);
  }


  public function create() {
    $countries = Country::orderBy('name_en')->get();	
    return view('admin.commercial.create',[
      'countries' => $countries
    ]);
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
      "activity_name"            => "nullable",
      "activity_type"            => "nullable",
      "location_id"            => "nullable",
      "contact_persons"            => "nullable",
    ]);

    $data['created_by'] = auth()->id(); // set user to cuurunt user\
    $data['user_id'] = auth()->id(); // set user to cuurunt user\

    addHistory('Commercial',0,'added',$data);
    $contact_persons='';
    if($data['contact_persons']){
      $contact_persons = $data['contact_persons'];
      unset($data['contact_persons']);
    }
    $commercial = Commercial::create($data);

    if($contact_persons){
      $contactPersons = [];
      for($i=0;$i < count($contact_persons); $i++){

        $contactPersons['name']=$contact_persons[$i]['name'];
        $contactPersons['email']=$contact_persons[$i]['email'];
        $contactPersons['phone']=$contact_persons[$i]['phone'];
        $contactPersons['designation']=$contact_persons[$i]['designation'];
        $contactPersons['lead_id']=$commercial->id;
        CommercialContactPerson::create($contactPersons);
      }

    }
    $action = __('site.lead created');

    $this->newCommercialActivity($commercial->id,auth()->id(),$action,'Commercial',$commercial->id,null,true);

    return redirect()->route('admin.commercial-leads.index')->withSuccess(__('site.success'));
  }


  public function update(Request $request,  $id) {

    $commercial = Commercial::findOrFail($id);
    $data = $request->validate([
      "country"                 => "nullable",
      "brand_name"             => "nullable|max:255",
      "activity_name"            => "nullable",
      "activity_type"            => "nullable",
      "location_id"            => "nullable",
      "contact_persons"            => "nullable",
    ]);

    $data['updated_at'] = Carbon::now();
    if($data['contact_persons']){
      $contactPersons = [];
      CommercialContactPerson::where('lead_id',$id)->delete();
      for($i=0;$i < count($data['contact_persons']); $i++){

        $contactPersons['name']=$data['contact_persons'][$i]['name'];
        $contactPersons['email']=$data['contact_persons'][$i]['email'];
        $contactPersons['phone']=$data['contact_persons'][$i]['phone'];
        $contactPersons['designation']=$data['contact_persons'][$i]['designation'];
        $contactPersons['lead_id']=$id;
        CommercialContactPerson::create($contactPersons);
      }

      unset($data['contact_persons']);
    }
    
    addHistory('Commercial',$id,'updated',$data,$commercial);
    $commercial->update($data);

    return redirect()->route('admin.commercial-leads.index')->withSuccess(__('site.success'));
  }


  public function destroy ($id) {

      $commercial = Commercial::findOrFail($id);
      $commercial->delete();
      addHistory('Commercial',$id,'deleted');    
      return back()->withSuccess(__('site.success'));
  }

  public function detail($id) {
    $commercial = Commercial::findOrFail($id);

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

    $activities = CommercialActivity::where('commercial_id',$commercial->id)->orderBy('id','DESC')->get();
    $tasks = CommercialTask::where('commercial_id',$commercial->id)->orderBy('created_at','DESC')->get();
    $notes = CommercialNote::where('commercial_id',$commercial->id)->orderBy('created_at','DESC')->get();
    $logs = CommercialLog::where('commercial_id',$commercial->id)->orderBy('created_at','DESC')->get();
    $requirements = CommercialRequirements::where('commercial_id',$commercial->id)->get();

    $LastConnected = CommercialLog::where('commercial_id',$commercial->id)->orderBy('log_date','DESC')->first();

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
    if($commercial->zone_id){
      $districtsEdit = Districts::where('zone_id',$commercial->zone_id)->get();
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

    return view('admin.commercial.detail',[
      'commercial' => $commercial,
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
      'expanding_years' => $expanding_years
    ]);
  }

  public function multiple_assign() {

    $data = [];
    if(!request()->ids OR !request()->id) return false;
    $user = User::where('id',request()->id)->first();
    $ids = explode(',',request()->ids);
    //$contacts = Contact::select('*')->whereIn('id',$contacts)->get();
    $commercials = Commercial::whereIn('id',$ids)->get();
    if(!$commercials OR !$user) return false;

    foreach($commercials as $commercial) {
      
      //Added by Lokesh on 13-09-2022  
      $mailData = [
        'user_name' => $commercial->user ? $commercial->user->name : '',
      ];          
      //end
        
      // create new history if he not the same user !
      if($commercial->user_id != $user->id) {
        $action = __('site.assigned to') .' '.User::where('id',$user->id)->first()->name;
        $this->newCommercialActivity($commercial->id,auth()->id(),$action,null,null, null,true);
      }
      
      
      if($user->id != $commercial->user_id) {
          $action = __('site.assigned to') .' '.User::where('id',$user->id)->first()->name;
          $this->newCommercialActivity($commercial->id,auth()->id(),$action,null,null, null,true);
      }
      
      $commercial->update([
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
    Commercial::whereIn('id',$ids)->delete();
    for($i = 0; $i < count($ids); $i++){
      addHistory('Commercial',$ids[$i],'deleted');    
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
