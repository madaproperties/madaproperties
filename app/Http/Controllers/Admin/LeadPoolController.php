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
    if(userRole() == 'other'){
      return redirect()->route('admin.deal.index');      
    }

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
      $users = User::select('id','leader')->where('active','1')->where('leader',$leaderId)->Orwhere('id',$leaderId)->get();
      $usersIds = $users->pluck('id')->toArray();
      $contacts = Contact::with(['country','project','creator','user','status'])
                        ->select($this->selectedAttruibutes)->where(function ($q){
      $this->filterPrams($q);
      })->orderBy('created_at','DESC');
      $contactsCount = $contacts->count();
      $contacts = $contacts->paginate(20);

      //Added by Javed
      $createdBy = $createdBy->where('leader',$leaderId);
      //End

    }else if(userRole() == 'sales admin') { // sales admin
      
    
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

    return view('admin.leadpool.index',
    compact('contacts','contactsCount','sellers'));
  }

  public function show( $contact)
  {
      $contact = Contact::where('status_id',5) //status should be follow up
      ->whereNotNull('follow_up_date')
      ->where('follow_up_date','<',Carbon::now())
      ->where('id',$contact)->first();

      if(!$contact){
        return abort(404);
      }
      // some condition to check role

      $currencyName = app()->getLocale() == 'en' ? 'currency' : 'currency_ar';
     $projects = Project::where('name_en','others')
                            ->get();

      $miles = LastMileConversion::where('active','1')
                          ->orderBy('name_'. app()->getLocale())
                          ->get();

     $status = Status::where('active','1')->orderBy('weight','ASC')->get();



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


      $sellers = getSellers(); // Added by Lokesh on 15-11-2022


      $activities = Activity::where('contact_id',$contact->id)->orderBy('id','DESC')->get();
      $tasks = Task::where('contact_id',$contact->id)->orderBy('created_at','DESC')->get();
      $notes = Note::where('contact_id',$contact->id)->orderBy('created_at','DESC')->get();
      $logs = Log::where('contact_id',$contact->id)->orderBy('created_at','DESC')->get();


      $LastConnected = Log::where('contact_id',$contact->id)->orderBy('log_date','DESC')->first();

      $minutes = [
        '15',
        '30',
        '45',
      ];
      $durations = [];
      for($i =0;$i<=8;$i++)
      {
        foreach($minutes as $minute)
        {
          $time = $i . ' hours '.$minute .' minutes';
          $durations[] = str_replace('0 hours','',$time);
        }
      }


        $purpose  = auth()->user()->position_types;
        $purpose  = json_decode($purpose);

       if(count($purpose) == 1 AND $purpose[0] == 'sell')
       {
           $purpose[0] = 'buy';
       }
       $cities =City::where('country_id',$contact->unit_country)->get();
       $communities=Community::where('city_id',$contact->city)->where('parent_id',0)->get();
       $subcommunities = Community::where('parent_id',$contact->community_id)->get();
       $zones = Zones::where('city_id',$contact->city)->get();
       $districts = Districts::where('zone_id',$contact->zone_id)->get();

      return view('admin.leadpool.show',[
        'contact' => $contact,
        'countries' => $countries,
        'projects' => $projects,
        'miles' => $miles,
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
        'campaigns' => Campaing::where('active','1')->orderBy('name')->get(),
        'contents' => Content::where('active','1')->orderBy('name')->get(),
        'sources' => Source::where('active','1')->orderBy('name')->get(),
        'mediums' => Medium::where('active','1')->get(),
        'cities'=>$cities,
        'communities'=>$communities,
        'subcommunities'=>$subcommunities,
        'zones'=>$zones,
        'districts' =>$districts,



      ]);
  }



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
    return $q->where('status_id',5) //status should be follow up
    ->whereNotNull('follow_up_date')
    ->whereDate('follow_up_date','<',Carbon::now())
    ->get();
  }    
}
