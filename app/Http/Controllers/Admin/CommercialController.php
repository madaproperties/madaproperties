<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Commercial;
use App\CommercialActivity;
use App\CommercialTask;
use App\CommercialNote;
use App\CommercialLog;
use App\Status;
use App\Country;
use App\PurposeType;
use App\Currency;
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
      $this->middleware('permission:commercial-edit', ['only' => ['edit','show','update']]);
      $this->middleware('permission:commercial-delete', ['only' => ['destroy']]);
      //$this->middleware('permission:commercial-export', ['only' => ['exportDataContact']]);
  }   

  public function index(){
    $commercial_leads=Commercial::orderBy('id', 'DESC'); 
    $commercial_leads= $commercial_leads->paginate(20); 
    $commercial_count= $commercial_leads->count();
    return view('admin.commercial.index',compact('commercial_leads','commercial_count'));

  }

  public function show($commercial)
  {
    $commercial = Commercial::findOrFail($commercial);
    return view('admin.commercial.show',[
      'commercial' => $commercial,
    ]);
  }


  public function create() {
    return view('admin.commercial.create');
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
      "location"            => "nullable",
      "contact_persons"            => "nullable",
    ]);

    if($data['contact_persons']){
      $data['contact_persons'] = json_encode($data['contact_persons']);
    }

    $data['created_by'] = auth()->id(); // set user to cuurunt user\

    addHistory('Commercial',0,'added',$data);


    $commercial = Commercial::create($data);
    $action = __('site.lead created');

    $this->newActivity($commercial->id,auth()->id(),$action,'Commercial',$commercial->id,null,true);

    return back()->withSuccess(__('site.success'));
  }


  public function update(Request $request,  $id) {

    $commercial = Commercial::findOrFail($id);
    $data = $request->validate([
      "country"                 => "nullable",
      "brand_name"             => "nullable|max:255",
      "activity_name"            => "nullable",
      "activity_type"            => "nullable",
      "location"            => "nullable",
      "contact_persons"            => "nullable",
    ]);

    if($data['contact_persons']){
      $data['contact_persons'] = json_encode($data['contact_persons']);
    }
    $data['updated_at'] = Carbon::now();
    
    addHistory('Commercial',$id,'updated',$data,$commercial);
    $commercial->update($data);

    return back()->withSuccess(__('site.success'));
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

    return view('admin.commercial.detail',[
      'commercial' => $commercial,
      'countries' => $countries,
      'sellers' => $sellers,
      'activities' => $activities,
      'tasks' => $tasks,
      'notes' => $notes,
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
      'districts' =>$districts,
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

    foreach($commercials as $contact) {
      
      //Added by Lokesh on 13-09-2022  
      $mailData = [
        'user_name' => $commercial->user ? $commercial->user->name : '',
      ];          
      //end
        
      // create new history if he not the same user !
      if($commercial->user_id != $user->id)
      {
        $action = __('site.assigned to') .' '.User::where('id',$user->id)->first()->name;
        $this->newActivity($commercial->id,auth()->id(),$action,null,null, null,true);
      }
      
      
      if($user->id != $commercial->user_id)
      {
          $action = __('site.assigned to') .' '.User::where('id',$user->id)->first()->name;
          $this->newActivity($commercial->id,auth()->id(),$action,null,null, null,true);

          // Change Startus to new if its not
          if(isset($commercial->status_id)){
              $data['status_id'] = newStatus()->id;

                $data['status_changed_at'] = Carbon::now();
              $action = __('site.status changed to').' '.newStatus()->name;
              $this->newActivity($commercial->id,auth()->id(),$action,null,null, null,true);
          }

      }
      
      if(isset($data['status_id'])){ //added by Javed on 07-09-2022
          $commercial->update([
            'user_id' => $user->id,
            'status_id' => $data['status_id']
            // 'updated_at' => Carbon::now()
          ]);
          // Mail::to($user->name)->send(new LeadAssigned($mailData));
          
      }
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

}
