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
use App\Community;
use App\Zones;
use App\Districts;
use App\LeadPoolActivity;
use Mail;
use App\Mail\LeadAssigned;
use Illuminate\Support\Facades\Cache;


class LeadPoolController extends Controller
{

  private $selectedAttruibutes = ['project_id','campaign',
                                  'purpose','lang','last_mile_conversion',
                                  'id','first_name','last_name',
                                  'phone','country_id','city_id',
                                  'status_id','created_at','updated_at',
                                  'user_id','created_by','purpose_type','source','email'];

  function __construct()
  {
  } 

  public function index(){

    $userloc=User::where('id',auth()->id())->first();
    if($userloc->time_zone=='Asia/Riyadh') {
      return abort(404);
    }

    $cacheTime = '3600';
    if(userRole() == 'other'){
      return redirect()->route('admin.deal.index');      
    }

    $createdBy = User::where('active','1')->select('id','email');

  // added by fazal 18-05-23
  if(userRole()== 'sales director'){
    $user=User::where('id',auth()->id())->first();
    if($user->time_zone=='Asia/Riyadh') {
      $leaders=  User::where('rule','leader')->where('active',1)->where('time_zone','Asia/Riyadh')->select('id','email')->get();
    }else{
      $leaders=  User::where('rule','leader')->where('active',1)->where('time_zone','Asia/Dubai')->select('id','email')->get();
    }
  }else{
      $leaders=  User::where('rule','leader')->where('active',1)->select('id','email')->get();  
  }
  // end added by fazal


    if(userRole() == 'admin' || userRole() == 'sales admin uae' || userRole() == 'sales admin saudi' || userRole() == 'digital marketing'  || userRole() == 'ceo') { //Updated by Javed

      if(userRole() == 'sales admin uae'){

        if(Request()->has('my-contacts')){
            $contacts = Contact::with(['country','project','creator','user','status'])
                        ->select($this->selectedAttruibutes)->where(function ($q){
              $this->filterPrams($q);
            })
            ->orderBy('created_at','DESC');
          }else{
            $projectId = Project::where('country_id',2)->pluck('id');
            $contacts = Contact::with(['country','project','creator','user','status'])
                        ->select($this->selectedAttruibutes)->where(function ($q){
              $this->filterPrams($q);
            })
            ->whereIn('project_id',$projectId)
            ->orderBy('created_at','DESC');
          }

          $contactsCount = $contacts->count();

          $paginationNo = 20;
          $contacts = $contacts->paginate($paginationNo);
          
          $whereCountry = 'Asia/Dubai';
          $createdBy = $createdBy->where('time_zone','like','%'.$whereCountry.'%');
          
        }else if(userRole() == 'sales admin saudi'){
          if(Request()->has('my-contacts')){
            $contacts = Contact::with(['country','project','creator','user','status'])
                        ->select($this->selectedAttruibutes)->where(function ($q){
              $this->filterPrams($q);
            })
            ->orderBy('created_at','DESC');
          }else{
            $projectId = Project::where('country_id',1)->pluck('id');
            $contacts = Contact::with(['country','project','creator','user','status'])
                        ->select($this->selectedAttruibutes)->where(function ($q){
              $this->filterPrams($q);
            })
            ->whereIn('project_id',$projectId)
            ->orderBy('created_at','DESC');
          }

          $contactsCount = $contacts->count();

          $paginationNo = 20;
          $contacts = $contacts->paginate($paginationNo);

          $whereCountry = 'Asia/Riyadh';
          $createdBy = $createdBy->where('time_zone','like','%'.$whereCountry.'%');
        }else{

          $contacts = Contact::with(['country','project','creator','user','status'])
                        ->select($this->selectedAttruibutes)->where(function ($q){
                $this->filterPrams($q);
              })->orderBy('created_at','DESC');

          $contactsCount = $contacts->count();

          $paginationNo = 20;
          $contacts = $contacts->paginate($paginationNo);
        }

    }elseif(userRole() == 'leader'){
      // get leader group
      $leaderId = auth()->id();
      // get leader , and sellers reltedt to that leader
      $users = User::select('id','leader')->where('active','1')->whereIn('leader',$leaderId)->Orwhere('id',$leaderId)->get();
      $usersIds = $users->pluck('id')->toArray();
      $contacts = Contact::with(['country','project','creator','user','status'])
                        ->select($this->selectedAttruibutes)->where(function ($q){
      $this->filterPrams($q);
      })->orderBy('created_at','DESC');
      $contactsCount = $contacts->count();
      $contacts = $contacts->paginate(20);

      //Added by Javed
      $createdBy = $createdBy->whereIn('leader',$leaderId);
      //End

    }else if(userRole() == 'sales admin' || userRole() == 'assistant sales director') { // sales admin
      
    
      $contacts = Contact::with(['country','project','creator','user','status'])
                        ->select($this->selectedAttruibutes)->where(function ($q){
      $this->filterPrams($q);
      })->orderBy('created_at','DESC');
      $contactsCount = $contacts->count();
      $contacts = $contacts->paginate(20);

    }else if(userRole() == 'sales director') { // sales director
      $userloc=User::where('id',auth()->id())->first();
      if($userloc->time_zone=='Asia/Dubai') { 
        $whereCountry = 'Asia/Dubai';  
      }else{
        $whereCountry = 'Asia/Riyadh';
      }
      $createdBy = $createdBy->where('time_zone','like','%'.$whereCountry.'%');
      if(Request()->has('my-contacts')){
        $contacts = Contact::with(['country','project','creator','user','status'])
                        ->select($this->selectedAttruibutes)->where(function ($q){
          $this->filterPrams($q);
        })
        ->orderBy('created_at','DESC');
          $contactsCount = $contacts->count();
          $paginationNo = 10;
          $contacts = $contacts->paginate($paginationNo);
      }else{
         if($userloc->time_zone=='Asia/Dubai'){
          $projectId = Project::where('country_id',2)->pluck('id');
          $contacts = Contact::with(['country','project','creator','user','status'])
                        ->select($this->selectedAttruibutes)->where(function ($q){
            $this->filterPrams($q);
          })->whereIn('project_id',$projectId)
          ->orderBy('created_at','DESC');
        }else{
          $projectId = Project::where('country_id',1)->pluck('id');
          $contacts = Contact::with(['country','project','creator','user','status'])
                        ->select($this->selectedAttruibutes)->where(function ($q){
            $this->filterPrams($q);
          })->whereIn('project_id',$projectId)
          ->orderBy('created_at','DESC'); 
        }
        $contactsCount = $contacts->count();
        $paginationNo = 20;
        $contacts = $contacts->paginate($paginationNo);
      }
    }else{
      $contacts = Contact::with(['country','project','creator','user','status'])
                        ->select($this->selectedAttruibutes)->where(function ($q){
        $this->filterPrams($q);
      })->orderBy('created_at','DESC');

      $contactsCount = $contacts->count();
      $contacts = $contacts->paginate(20);
    }

    $sellers= getSellers(); // Added by Lokesh on 15-11-2022

    $status=Cache::remember('status', $cacheTime, function () {
      return Status::where('active','1')->orderBy('weight','ASC')->get();
    });


    // Start Hundel Counties Sort

    $countries=Cache::remember('countries', $cacheTime, function () {
      return Country::orderBy('name_en')->get();
    });

    $collectCounties = [];
    $collectCounties = collect($collectCounties);

    foreach($countries as $index => $country){
        if(in_array($country->name_en,toCountriess()) )
        {
            $collectCounties->push($country);
        }
    }


    $countries = $countries->filter(function($item) {
      return !in_array($item->name_en,toCountriess());
    });


    foreach($collectCounties as $topCountry){
        $countries->prepend($topCountry);
    }
    
    $campaignCountry = '';
    // End Hundel Counties Sort
    if(userRole() == 'sales admin saudi'){ //Added by Javed
      $campaignCountry = '1';
      $projects = Project::where('country_id','1')->orderBy('name_en','ASC')->get();
    }else if(userRole() == 'sales admin uae'){  //Added by Javed
      $projects = Project::where('country_id','2')->orderBy('name_en','ASC')->get();
      $campaignCountry = '2';
    }
    // 
    else if(userRole() == 'sales admin' || userRole() == 'assistant sales director' || userRole()=='sales director' || userRole()=='sales' || userRole()=='leader'){
    // dd('hit'); //Added by Javed
      $user=User::where('id',auth()->id())->first();
      if($user->time_zone=='Asia/Riyadh')
      {
        $campaignCountry = '1';
        $projects = Project::where('country_id','1')->orderBy('name_en','ASC')->get();  
      }
      else
      {
        $projects = Project::where('country_id','2')->orderBy('name_en','ASC')->get(); 
        $campaignCountry = '2';
      }
      
    }
    // 
    else{
      $projects = Project::orderBy('name_en','ASC')->get();
      if(userRole() == 'leader'){
        if(auth()->user()->time_zone == 'Asia/Riyadh'){
          $campaignCountry = '1';
          $projects = Project::where('country_id','1')->orderBy('name_en','ASC')->get();
        }else if(auth()->user()->time_zone == 'Asia/Dubai'){
          $projects = Project::where('country_id','2')->orderBy('name_en','ASC')->get();
          $campaignCountry = '2';
        }
      }
    }

    $purpose  = auth()->user()->position_types;
    $purpose  = json_decode($purpose);
    
    // added by fazal on -19-6-23
    if($campaignCountry){
      $campaigns = Campaing::where('active','1')
      ->whereHas('project',function($q) use($campaignCountry){
        $q->where('country_id',$campaignCountry);
      })->orderBy('name','ASC')->get();
    }else{
      $campaigns = Campaing::where('active','1')->orderBy('name','ASC')->get();
    }

    $miles=Cache::remember('miles', $cacheTime, function () {
      return LastMileConversion::where('active','1')
      ->orderBy('name_'. app()->getLocale())
      ->get();
    });

    $createdBy=$createdBy->orderBy('email')->get();

    $sources=Cache::remember('sources', $cacheTime, function (){
      return Source::where('active','1')->get();
    });

    $purposetype=Cache::remember('purposetype', $cacheTime, function (){
      return PurposeType::orderBy('type')->get();    
    });

    return view('admin.leadpool.index',compact('contacts','contactsCount','sellers','purposetype','sources','miles','purpose','projects','campaigns','contacts','status','contactsCount','sellers','countries','createdBy','leaders'));
  }

  // public function show( $contact)
  // {
  //     $contact = Contact::where('status_id',5) //status should be follow up
  //     ->whereNotNull('follow_up_date')
  //     ->where('follow_up_date','<',Carbon::now())
  //     ->where('id',$contact)->first();

  //     if(!$contact){
  //       return abort(404);
  //     }
  //     // some condition to check role

  //     $currencyName = app()->getLocale() == 'en' ? 'currency' : 'currency_ar';
  //    $projects = Project::where('name_en','others')
  //                           ->get();

  //     $miles = LastMileConversion::where('active','1')
  //                         ->orderBy('name_'. app()->getLocale())
  //                         ->get();

  //    $status = Status::where('active','1')->orderBy('weight','ASC')->get();



  //    // Start Hundel Counties Sort

  //       $countries = Country::orderBy('name_en')->get();

  //        $collectCounties = [];
  //        $collectCounties = collect($collectCounties);

  //       foreach($countries as $index => $country)
  //       {
  //           if(in_array($country->name_en,toCountriess()) )
  //           {
  //              $collectCounties->push($country);
  //           }
  //       }


  //       $countries = $countries->filter(function($item) {
  //         return !in_array($item->name_en,toCountriess());
  //      });


  //      foreach($collectCounties as $topCountry)
  //      {
  //          $countries->prepend($topCountry);
  //      }
  //    // End Hundel Counties Sort

  //     $purposetype = PurposeType::orderBy('type')->get();
  //     $currencies = Currency::orderBy($currencyName)->get();


  //     $sellers = getSellers(); // Added by Lokesh on 15-11-2022


  //     $activities = Activity::where('contact_id',$contact->id)->orderBy('id','DESC')->get();
  //     $tasks = Task::where('contact_id',$contact->id)->orderBy('created_at','DESC')->get();
  //     $notes = Note::where('contact_id',$contact->id)->orderBy('created_at','DESC')->get();
  //     $logs = Log::where('contact_id',$contact->id)->orderBy('created_at','DESC')->get();


  //     $LastConnected = Log::where('contact_id',$contact->id)->orderBy('log_date','DESC')->first();

  //     $minutes = [
  //       '15',
  //       '30',
  //       '45',
  //     ];
  //     $durations = [];
  //     for($i =0;$i<=8;$i++)
  //     {
  //       foreach($minutes as $minute)
  //       {
  //         $time = $i . ' hours '.$minute .' minutes';
  //         $durations[] = str_replace('0 hours','',$time);
  //       }
  //     }


  //       $purpose  = auth()->user()->position_types;
  //       $purpose  = json_decode($purpose);

  //      if(count($purpose) == 1 AND $purpose[0] == 'sell')
  //      {
  //          $purpose[0] = 'buy';
  //      }
  //      $cities =City::where('country_id',$contact->unit_country)->get();
  //      $communities=Community::where('city_id',$contact->city)->where('parent_id',0)->get();
  //      $subcommunities = Community::where('parent_id',$contact->community_id)->get();
  //      $zones = Zones::where('city_id',$contact->city)->get();
  //      $districts = Districts::where('zone_id',$contact->zone_id)->get();

  //     return view('admin.leadpool.show',[
  //       'contact' => $contact,
  //       'countries' => $countries,
  //       'projects' => $projects,
  //       'miles' => $miles,
  //       'sellers' => $sellers,
  //       'activities' => $activities,
  //       'tasks' => $tasks,
  //       'notes' => $notes,
  //       'purpose' => $purpose,
  //       'logs' => $logs,
  //       'status' => $status,
  //       'LastConnected' => $LastConnected,
  //       'durations' => $durations,
  //       'currencies' => $currencies,
  //       'purposetype' => $purposetype,
  //       'campaigns' => Campaing::where('active','1')->orderBy('name')->get(),
  //       'contents' => Content::where('active','1')->orderBy('name')->get(),
  //       'sources' => Source::where('active','1')->orderBy('name')->get(),
  //       'mediums' => Medium::where('active','1')->get(),
  //       'cities'=>$cities,
  //       'communities'=>$communities,
  //       'subcommunities'=>$subcommunities,
  //       'zones'=>$zones,
  //       'districts' =>$districts,



  //     ]);
  // }



  public function multiple_assign() {

    $data = [];
    if(!request()->ids) {
      return response()->json([
        'status' => false,
        'message' => 'Whoops Something went wrong!!',
      ]);
    }
    $user = User::where('id',auth()->id())->first();
    $contacts = explode(',',request()->ids);
    $tempContactsCount = count($contacts);
    $contacts = Contact::whereIn('id',$contacts)
                ->where('status_id',5) //status should be follow up
                ->whereNotNull('follow_up_date')
                ->where('follow_up_date','<',Carbon::now())
                ->get();
                
    if(!$contacts OR !$user) {
      return response()->json([
        'status' => false,
        'message' => 'Whoops Something went wrong!!',
      ]);
    }

    $userTodayLeadCount = LeadPoolActivity::whereDate('created_at',Carbon::now())->where('user_id',$user->id)->count();
    if($userTodayLeadCount >= 5 || ($tempContactsCount+$userTodayLeadCount) > 5){
      return response()->json([
        'status' => false,
        'message' => "You can not assign more than 5 leads in one day.",
      ]);
    }
    foreach($contacts as $contact){

      // create new history if he not the same user !
      if($contact->user_id != $user->id) {
        $action = __('site.assigned to') .' '.$user->name;
        $this->newActivity($contact->id,auth()->id(),$action,null,null, null,true);
      }
      
      
      if($user->id != $contact->user_id){
          $action = __('site.assigned to') .' '.$user->name;
          $this->newActivity($contact->id,auth()->id(),$action,null,null, null,true);
          // Change Startus to new if its not
          if(isset($contact->status_id)){
              $data['status_id'] = newStatus()->id;
              $data['status_changed_at'] = Carbon::now();
              $action = __('site.status changed to').' '.newStatus()->name;
              $this->newActivity($contact->id,auth()->id(),$action,null,null, null,true);
          }
      }
      
      if(isset($data['status_id'])){ //added by Javed on 07-09-2022
          $contact->update([
            'user_id' => $user->id,
            'status_id' => $data['status_id']
            // 'updated_at' => Carbon::now()
          ]);
      }

      LeadPoolActivity::create([
        'contact_id'=>$contact->id,
        'user_id'=>$user->id,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ]);

    }

    session()->flash('success',__('site.success'));
    return response()->json([
      'status' => true,
    ]);
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
        "status_id",
        "created_by", //Added by Javed
        "project_country_id", //Added by Javed
        "budget", //Added by Javed
        "source", //Added by Javed
        "purpose_type", //Added by Javed
        "email", //Added by Javed
        "is_meeting", //Added by Javed,
        "lead_category", //Added by Javed,
        "campaign_country", //Added by Javed,
      ];
      $user_id = 0;
      foreach($feilds as $feild => $value){
        if(in_array($feild,$allowedFeilds) AND !empty($value)){
          if($feild == 'user_id'){
            $user_id = $value;
          }
          if($feild == 'project_country_id'){
            // $q->whereHas('project', function($q2) use($value) {
            //   $q2->where('projects.country_id',$value);
            // });
            $projectId = Project::where('country_id',$value)->pluck('id');
            $q->whereIn('project_id',$projectId);

          }else if($feild == 'is_meeting' && $value == 1){

              $logsIds = \App\Log::where('logs.type','meeting');
              if($user_id){
                $logsIds->where('logs.user_id',$user_id);
              }
              if(userRole() == 'sales'){
                $logsIds->where('logs.user_id',auth()->id());
              }
              //Added by Javed
              if(Request('meeting_from') && Request('meeting_to')){
                $from = date('Y-m-d', strtotime(Request('meeting_from')));
                $to = date('Y-m-d', strtotime(Request('meeting_to')));
                $logsIds->whereBetween('logs.log_date',[$from,$to]);
              }else{   
                if(Request('meeting_from')){
                  $from = date('Y-m-d', strtotime(Request('meeting_from')));
                  $logsIds->where('logs.log_date','>=', $from);
                }   
                if(Request('meeting_to')){
                  $to = date('Y-m-d', strtotime(Request('meeting_to')));
                  $logsIds->where('logs.log_date','<=',$to);
                }            
              } 
              $contact_ids=$logsIds->pluck('contact_id');
              $q->whereIn('id',$contact_ids);

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
      // added by fazal 09-03-23
      if(Request()->has('leader') && request('leader')){
        $uri = Request()->fullUrl();
        session()->put('start_filter_url',$uri);
        $leaderId=request('leader');
        $users = User::select('id','leader')->where('active','1')->whereIn('leader',$leaderId)->Orwhere('id',$leaderId)->get();
        $usersIds = $users->pluck('id')->toArray();
        $q->whereIn('user_id',$usersIds);
      }
      // end
     if(Request()->has('challenge_lead') && request('challenge_lead')){
        $uri = Request()->fullUrl();
        session()->put('start_filter_url',$uri);
        $q->whereIn('status_id', ['1','4','7'])
                  ->whereDate('updated_at', '<=', Carbon::now()->subMonths(1));
      }
    }



    $q->where('status_id',5) //status should be follow up
    ->whereNotNull('follow_up_date')
    ->whereDate('follow_up_date','<',Carbon::now());

    $userloc=User::where('id',auth()->id())->first();
    if($userloc->time_zone=='Asia/Riyadh') {
      $q->whereDay('follow_up_day','!=','Thursday');
    }else{
      $q->whereDay('follow_up_day','!=','SaturDay');
    }

    $q->whereDay('created_by','!=',auth()->id());
    
    
    return $q->get();
  }    
}
