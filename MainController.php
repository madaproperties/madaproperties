<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contact;
use App\User;
use App\Country;
use App\LastMileConversion;
use App\Project;
use App\Status;
use DB;
use Carbon\Carbon;
use App\Campaing;
use Maatwebsite\Excel\Facades\Excel;
use App\ContactExport;
use App\Source;
use App\PurposeType;

class MainController extends Controller
{

  private $selectedAttruibutes = ['project_id','campaign',
                                  'purpose','lang','last_mile_conversion',
                                  'id','first_name','last_name',
                                  'phone','country_id','city_id',
                                  'status_id','created_at','updated_at',
                                  'user_id','created_by','purpose_type','source','email'];

  private $selectedAttruibutes2 = ['id','first_name','last_name','country_id','city_id','status_id','created_at','user_id','created_by'];

  // index
  public function index(){
    if(userRole() == 'other'){
      return redirect()->route('admin.deal.index');      
    }


    if(Request()->has('exportData')){
      return Excel::download(new ContactExport, 'Report_'.date('d-m-Y').'.xlsx');
    }  
    /********* Get Contacts By The Rule ***********/
    if(userRole() == 'admin' || userRole() == 'sales admin uae' || userRole() == 'sales admin saudi' ){ //Updated by Javed

      if(Request()->has('duplicated')){

        if(userRole() == 'sales admin uae'){

          $contacts = Contact::select($this->selectedAttruibutes,\DB::raw('COUNT(phone) as phone'))
                  ->whereHas('project', function($q2) {
                    $q2->where('projects.country_id','2');
                  })
                  ->groupBy('phone')
                  ->havingRaw('COUNT(phone) > ?', [1])
                  ->get();

          $contactsPhone = $contacts->pluck('phone');

          $contacts =   Contact::whereIn('phone',$contactsPhone->toArray())
                                  ->whereHas('project', function($q2) {
                                    $q2->where('projects.country_id','2');
                                  })
                                  ->orderByRaw("phone")
                                  ->paginate(20);

          $contactsCount = count($contacts);
          
        }else if(userRole() == 'sales admin saudi'){
          $contacts = Contact::select($this->selectedAttruibutes,\DB::raw('COUNT(phone) as phone'))
                  ->whereHas('project', function($q2) {
                    $q2->where('projects.country_id','1');
                  })
                  ->groupBy('phone')
                  ->havingRaw('COUNT(phone) > ?', [1])
                  ->get();

          $contactsPhone = $contacts->pluck('phone');

          $contacts =   Contact::whereIn('phone',$contactsPhone->toArray())
                                  ->whereHas('project', function($q2) {
                                    $q2->where('projects.country_id','1');
                                  })
                                  ->orderByRaw("phone")
                                  ->paginate(20);

          $contactsCount = count($contacts);

        }else{
          $contacts = Contact::select($this->selectedAttruibutes,\DB::raw('COUNT(phone) as phone'))
                  ->groupBy('phone')
                  ->havingRaw('COUNT(phone) > ?', [1])
                  ->get();

          $contactsPhone = $contacts->pluck('phone');

          $contacts =   Contact::whereIn('phone',$contactsPhone->toArray())
                                  ->orderByRaw("phone")
                                  ->paginate(20);

          $contactsCount = count($contacts);
        }
      }else{

        if(userRole() == 'sales admin uae'){

          $contacts = Contact::select($this->selectedAttruibutes)->where(function ($q){
            $this->filterPrams($q);
          })
          ->whereHas('project', function($q2) {
            $q2->where('projects.country_id','2');
          })
          ->orderBy('created_at','DESC');

          $contactsCount = $contacts->count();

          $paginationNo = 20;
          $contacts = $contacts->paginate($paginationNo);
          
        }else if(userRole() == 'sales admin saudi'){
          $contacts = Contact::select($this->selectedAttruibutes)->where(function ($q){
            $this->filterPrams($q);
          })
          ->whereHas('project', function($q2) {
            $q2->where('projects.country_id','1');
          })
          ->orderBy('created_at','DESC');

          $contactsCount = $contacts->count();

          $paginationNo = 20;
          $contacts = $contacts->paginate($paginationNo);

        }else{

          $contacts = Contact::select($this->selectedAttruibutes)->where(function ($q){
                $this->filterPrams($q);
              })->orderBy('created_at','DESC');

          $contactsCount = $contacts->count();

          $paginationNo = 20;
          $contacts = $contacts->paginate($paginationNo);
        }
      }

    }elseif(userRole() == 'leader'){
      // get leader group
      $leaderId = auth()->id();
      // get leader , and sellers reltedt to that leader
      $users = User::select('id','leader')->where('leader',$leaderId)->Orwhere('id',$leaderId)->get();
      $usersIds = $users->pluck('id')->toArray();
      $contacts = Contact::select($this->selectedAttruibutes)->whereIn('user_id',$usersIds)->where(function ($q){
      $this->filterPrams($q);
      })->orderBy('created_at','DESC');
      $contactsCount = $contacts->count();
      $contacts = $contacts->paginate(20);

    }else if(userRole() == 'sales admin') { // sales admin
      
      $contacts = Contact::select($this->selectedAttruibutes)->where(function ($q){
        $this->filterPrams($q);
      })->where('created_by',auth()->id())
        ->where('user_id',null)
        ->orderBy('created_at','DESC');

      $contactsCount = $contacts->count();
      $contacts = $contacts->paginate(20);

    }else{
      
      $contacts = Contact::select($this->selectedAttruibutes)->where(function ($q){
        $this->filterPrams($q);
      })->where('user_id',auth()->id())->orderBy('created_at','DESC');

      $contactsCount = $contacts->count();
      $contacts = $contacts->paginate(20);

    }


    if(userRole() == 'leader'){
      $id = auth()->id();
      $sellers = User::where(function($q) use($id){
                        $q->where('leader',$id);
                        $q->OrWhere('id',$id);
                      })
                      ->where('active','1')->get();
    }elseif(userRole() == 'admin' || userRole() == 'sales admin uae' || userRole() == 'sales admin saudi' ){ //Updated by Javed

      if(userRole() == 'sales admin uae' || userRole() == 'sales admin saudi' ){
        $whereCountry = '';
        if(userRole() == 'sales admin uae'){
          $whereCountry = 'Asia/Dubai';
        }else{
          $whereCountry = 'Asia/Riyadh';
        }
        $sellers = User::where(function($q){
                        $q->where('rule','sales');
                        $q->orWhere('rule','leader');
                      })
                      ->where('active','1')
                      ->where('time_zone','like','%'.$whereCountry.'%')
                      ->get();
      }else{
        $sellers = User::where(function($q){
                        $q->where('rule','sales');
                        $q->orWhere('rule','leader');
                      })
                      ->where('active','1')->get();
      }

    }elseif(userRole() == 'sales admin'){

        $leader = auth()->user()->leader;
        if($leader){
          $sellers = User::where('leader',$leader)
                            ->where(function($q) use($leader){
                              $q->where('id','!=',auth()->id());
                              $q->Orwhere('id',$leader);
                            })
                            ->where('active','1')->get();
        }else{
            $sellers = [];
        }

    }else {
      $sellers = [];
    }

    $status = Status::where('active','1')->orderBy('weight','ASC')->get();

    // check if there the new status , if not create it
    $this->checkNewStatus();

    // Start Hundel Counties Sort

    $countries = Country::orderBy('name_en')->get();

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
    // End Hundel Counties Sort
    if(userRole() == 'sales admin saudi'){ //Added by Javed
      $projects = Project::where('country_id','1')->orderBy('name_en','ASC')->get();
    }else if(userRole() == 'sales admin uae'){  //Added by Javed
      $projects = Project::where('country_id','2')->orderBy('name_en','ASC')->get();
    }else{
      $projects = Project::orderBy('name_en','ASC')->get();
    }

    $purpose  = auth()->user()->position_types;
    $purpose  = json_decode($purpose);
    $campaigns = Campaing::where('active','1')->orderBy('name','ASC')->get();

    $miles = LastMileConversion::where('active','1')
                        ->orderBy('name_'. app()->getLocale())
                        ->get();

    //Added by Javed
    $createdBy = User::select('id','email')->get();
    //End
    $sources = Source::where('active','1')->get();

    $purposetype = PurposeType::orderBy('type')->get();    
    return view('admin.home',
    compact('purposetype','sources','miles','purpose','projects','campaigns','contacts','status','contactsCount','sellers','countries','createdBy'));
  }
  // get only the attributes that i want

  // i want to be the new stauts all the time
  private function checkNewStatus(){
    $status = Status::where('name_en','new')->first();
    if(empty($status))
    {
      $status = Status::create([
        'name_ar' => '????????',
        'name_en' => 'new',
        'active' => '1'
      ]);
    }
  }


  public function statics (){
      $leadsCount = Contact::count();
      $agentsCount = User::where('active','1')->count();
      $campaingsCount = Campaing::where('active','1')->count();

      return view('admin.statics',[
          'leadsCount'    => $leadsCount,
          'agentsCount'    => $agentsCount,
          'campaingsCount'    => $campaingsCount,

      ]);
  }


  private function filterPrams($q){

    if(request()->has('ADVANCED')){
      $feilds = request()->all();
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
      ];

      foreach($feilds as $feild => $value){
        if(in_array($feild,$allowedFeilds) AND !empty($value)){
          if($feild == 'project_country_id'){
            $q->whereHas('project', function($q2) use($value) {
              $q2->where('projects.country_id',$value);
            });
          }else if($feild == 'is_meeting' && $value == 1){
              $q->whereHas('logs', function($q2) use($value) {
                $q2->where('logs.type','meeting');
              });
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
      
      return $q->get();
    }

    if(Request()->has('search') AND Request()->has('my-contacts')  AND Request()->has('filter_status')){
      $uri = Request()->fullUrl();
      session()->put('start_filter_url',$uri);
      return $q->where('status_id',Request('filter_status'))
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
      return $q->where('status_id',Request('filter_status'))
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
      return $q->where('status_id', request('status'))
              ->where('campaign', request('campaign'))->get();
    }


    if(Request()->has('search') AND Request()->has('my-contacts')){
        $uri = Request()->fullUrl();
        session()->put('start_filter_url',$uri);
        return $q->where('user_id','LIKE',auth()->id())
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
      return $q->where('status_id', Request('filter_status'))->where('user_id', auth()->id());
    }

    if(Request()->has('my-contacts')){
      return $q->where('user_id', auth()->id());
    }

    if(Request()->has('filter_status')){
      $uri = Request()->fullUrl();
      session()->put('start_filter_url',$uri);
      return $q->where('status_id', Request('filter_status'));
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
                ->where('status_id',request('status'))
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

}
