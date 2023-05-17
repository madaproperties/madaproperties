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
use Mail;
use App\Mail\LeadAssigned;

class ContactController extends Controller
{

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     function __construct()
     {
          $this->middleware('permission:contact-create', ['only' => ['create','store']]);
          $this->middleware('permission:contact-edit', ['only' => ['edit','show','update']]);
          $this->middleware('permission:contact-delete', ['only' => ['destroy']]);
     } 

  public function show( $contact)
  {
      $contact = Contact::findOrFail($contact);
      // some condition to check role
      // check if he leader and its belongs to hime or to one of his group , check if seller is creator
      if(userRole() == 'leader')
      {
          $contactUserLeader = $contact->user ? $contact->user->leader : false;

          if(!$contactUserLeader)
          {
              $contactUserLeader = $contact->created_by;
              $contactUserLeader = User::findOrFail($contactUserLeader);
              if($contactUserLeader->id == auth()->id())
              {
                  $contactUserLeader = auth()->id();
              }else{
                  $contactUserLeader = $contactUserLeader->leader;
              }
          }

        if($contact->user_id != auth()->id() AND $contactUserLeader != auth()->id())
        {
          return abort(404);
        }
      }elseif(userRole() == 'sales')
      {
        if($contact->user_id != auth()->id())
        {
          return abort(404);
        }
      }elseif(userRole() == 'sales admin')
      {
          if($contact->created_by != auth()->id() OR $contact->user_id)
         {
                 return abort(404);
          }
      }


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

      return view('admin.contacts.show',[
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


    public function create()
    {
        $currencyName = app()->getLocale() == 'en' ? 'currency' : 'currency_ar';

        $projects = Project::where('name_en','others')
                            ->get();



        $miles = LastMileConversion::where('active','1')
                            ->orderBy('name_'. app()->getLocale())
                            ->get();

        $status = Status::where('active','1')->orderBy('weight','DESC')->get();

        $purpose  = auth()->user()->position_types;
        $purpose  = json_decode($purpose);


        if(count($purpose) == 1 AND $purpose[0] == 'sell')
       {
           $purpose[0] = 'buy';
       }

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




        $campaigns = Campaing::where('active','1')->orderBy('name')->get();
        $contents = Content::where('active','1')->orderBy('name')->get();
        $sources = Source::where('active','1')->orderBy('name')->get();
        $mediums = Medium::where('active','1')->get();
        $sellers = getSellers();

        return view('admin.contacts.create',
        compact('projects','miles','countries','currencies','purpose','purposetype','campaigns','contents','sources','mediums','sellers'));
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
          "email"                 => "nullable|email",
          "first_name"            => "required|max:255",
          "last_name"             => "nullable|max:255",
          'user_id'               => 'nullable',
          "country_id"            => "required",
          "city_id"               => "nullable",
          "phone"                 => "required|max:20",
          "scound_phone"          => "nullable|max:20",
          "project_id"            => "nullable",
          "mile_id"               => "nullable|max:255",
          "campaign"              => "nullable|max:255",
          "source"                => "nullable|max:255",
          "medium"                => "nullable|max:255",
          "budget"                => "nullable|max:255",
          'lang'                  => "nullable|max:255",
          'lead_type'             => "nullable|max:255",
          'currency'              => "nullable|max:255",
          "purpose"               => "nullable|max:255",
          "purpose_type"          => "nullable|max:255",
          "unit_country"          => "nullable|max:255",
          "unit_city"             => "nullable|max:255",
          "last_mile_conversion"   => "nullable|max:255",
          "unit_zone"             => "nullable|max:255",
          'content' => 'nullable|max:255',
          'lead_category' => 'nullable',
          'campaign_country' => 'nullable',
          "community_id" => "nullable", 
          "subcommunities_id" => "nullable",
          "zone_id" => "nullable" ,
          "district_id"=>"nullable",
          "city"=>"nullable",

        ]);
     

        if(userRole() == 'leader')
        {
            $leader = auth()->id();
        }

        // check if lead exists in  the same team , with phone number
        $leader = userRole() == 'leader' ? auth()->id() :  auth()->user()->leader;
        $countryCode = Country::where('id',$data['country_id'])->first();
        $countryCode = $countryCode ? $countryCode->id : null;

        if($leader)
        {
            $leaderUsers = User::where('leader',$leader)
                            ->OrWhere('id', $leader)
                            ->get()->pluck('id')->toArray();

              if(userRole() == 'sales admin')
             {
                 // first start to Search in the same Level to see if sone 'sales admin' create contact before
                $contact = Contact::where('phone',$data['phone'])
                                    ->where('country_id',$countryCode)
                                    ->whereIn('created_by',$leaderUsers)
                                    ->first();
                                    // if ! countiue search
                if(!$contact) // search in teams memeber
                {
                     $contact = Contact::where('phone',$data['phone'])
                                         ->where('country_id',$countryCode)
                                         ->whereIn('user_id',$leaderUsers)
                                      ->first();
                }

             }else{
                $contact = Contact::where('phone',$data['phone'])
                                    ->where('country_id',$countryCode)
                                    ->whereIn('user_id',$leaderUsers)
                                    ->first();



             }

            if($contact)
            {
                if(newStatus()->id != $contact->status_id){
                // create activity
                $data['status_id'] = newStatus()->id;
                $data['status_changed_at'] = Carbon::now();
                $action = __('site.status changed to').' '.newStatus()->name;
                $this->newActivity($contact->id,auth()->id(),$action,null,null, null,true);
                }

                $action = __('site.tried to enter contact agian');
                $this->newActivity($contact->id,auth()->id(),$action,null,null,null,true);
                // back with messge
                $contact->update($data);
                return back()->withSuccess("lead exists before");
            }

        }



        $checkProject = Project::where('id',$request->project_id)->first();
        if($checkProject)
        {
          if($checkProject->name != 'others' OR $checkProject->name != 'أخري')
          {

            $data['unit_city'] = null;
            $data['unit_zone'] = null;
          }
        }



         $data['user_id'] = auth()->id(); // set user to cuurunt user
        if(userRole() == 'sales admin') // ignore userid if he admin sales
        {
            if($request->user_id)
            {
                $data['user_id'] = $request->user_id;
            }else{
               $data['user_id'] = null;
            }

        }

        $data['status_id'] = newStatus()->id;
         $data['created_by'] = auth()->id(); // set user to cuurunt user\
        $data['created_from'] = 'website';
        $data['status_changed_at'] = Carbon::now();

        addHistory('Contact',0,'added',$data);


        $contact = Contact::create($data);
        $action = __('site.contact created');

        $this->newActivity($contact->id,auth()->id(),$action,'Contact',$contact->id,null,true);

        if($contact->user_id)
        {
          $action = __('site.assigned to') .' '.User::where('id',$contact->user_id)->first()->name;
          $this->newActivity($contact->id,auth()->id(),$action,null,null, null,true);
        }

        return back()->withSuccess(__('site.success'));
    }

    function testData($data)
    { dd('Edit Fiest');
      $data =DB::table('sa_cities')->get();
      foreach($data as $val)
      {
        $data = '%'.$val->nameAr.'%'.' => %'.$val->nameEn . '%';
        echo str_replace('%',"'",$data) .', <br>';
      }
      dd('');
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
      $contact = Contact::findOrFail($id);



      $data = $request->validate([
        "email"                 => "nullable|email",
        "first_name"            => "nullable|max:255",
        "last_name"             => "nullable|max:255",
        "country_id"            => "nullable",
        "city_id"               => "nullable",
        "phone"                 => "nullable|max:20",
        "scound_phone"          => "nullable|max:20",
        "project_id"            => "nullable",
        "mile_id"               => "nullable|max:255",
        "campaign"              => "nullable|max:255",
        "last_mile_conversion"  => "nullable|max:255",
        'budget'                => 'nullable|max:255',
        "source"                => "nullable|max:255",
        "medium"                => "nullable|max:255",
        'lang'                  => "nullable|max:255",
        'user_id'               => "nullable",
        'lead_type'             => "nullable",
        'status_id'             => 'required',
        'currency'             => "nullable|max:255",
        "purpose"               => "nullable|max:255",
        "purpose_type"          => "nullable|max:255",
        "unit_country"          => "nullable|max:255",
        "unit_city"             => "nullable|max:255",
        "unit_zone"             => "nullable|max:255",
        'content' => 'nullable|max:255',
        'lead_category' => 'nullable',
        'campaign_country' => 'nullable',
        "community_id" => "nullable", 
        "subcommunities_id" => "nullable",
        "zone_id" => "nullable" ,
        "district_id"=>"nullable",
        "city"=>"nullable",
      ]);


     if(userRole() == 'sales' || userRole() == 'sales admin')
     {
        $data['user_id'] = auth()->id();
     }


      $checkProject = Project::where('id',$request->project_id)->first();
      if($checkProject)
      {
        if($checkProject->name != 'others' OR $checkProject->name != 'أخري')
        {
          $data['unit_city'] = null;
          $data['unit_zone'] = null;
        }
      }

      $oldStatus = $contact->status_id;

      // update contact
      if($request->status_id != $oldStatus)
      {
        $data['status_changed_at'] = Carbon::now();
        $action = __('site.status changed to').' '.Status::where('id',$request->status_id)->first()->name;
        $this->newActivity($contact->id,auth()->id(),$action,null,null, null,true);
      }


     if($request->user_id){
        // check if he change assigned-to or status
        if($request->user_id != $contact->user_id AND $request->user_id)
        {
            $action = __('site.assigned to') .' '.User::where('id',$request->user_id)->first()->name;
            $this->newActivity($contact->id,auth()->id(),$action,null,null, null,true);

            // Change Startus to new if its not
            if($contact->status_id != newStatus()->id){
                $data['status_id'] = newStatus()->id;

                 $data['status_changed_at'] = Carbon::now();
                $action = __('site.status changed to').' '.newStatus()->name;
                $this->newActivity($contact->id,auth()->id(),$action,null,null, null,true);
            }

        }

        if(userRole() == 'sales admin')
        {
            $redirectSalesAdmin = true;
        }
     }

     $data['updated_at'] = Carbon::now();

     
     addHistory('Contact',$id,'updated',$data,$contact);

      $contact->update($data);



      // check $redirectSalesAdmin
      if(isset($redirectSalesAdmin))
      {
        return redirect(route('admin.'))->withSuccess(__('site.success'));
      }

      return back()->withSuccess(__('site.success'));
    }


    public function destroy ($id)
    {

        $contact = Contact::findOrFail($id);
        $contact->delete();
        addHistory('Contact',$id,'deleted');    
        return back()->withSuccess(__('site.success'));
    }

    public function multiple_assign()
    {
        $data = [];
      if(!request()->ids OR !request()->id) return false;
      $user = User::where('id',request()->id)->first();
      $contacts = explode(',',request()->ids);
      //$contacts = Contact::select('*')->whereIn('id',$contacts)->get();
      $contacts = Contact::whereIn('id',$contacts)->get();
      if(!$contacts OR !$user) return false;

      foreach($contacts as $contact)
      {
        
        //Added by Lokesh on 13-09-2022  
        $mailData = [
          'user_name' => $contact->user ? $contact->user->name : '',
          'project_name' => $contact->project ? $contact->project->name : ''
        ];          
        //end
          
        // create new history if he not the same user !
        if($contact->user_id != $user->id)
        {
          $action = __('site.assigned to') .' '.User::where('id',$user->id)->first()->name;
          $this->newActivity($contact->id,auth()->id(),$action,null,null, null,true);
        }
        
        
        if($user->id != $contact->user_id)
        {
            $action = __('site.assigned to') .' '.User::where('id',$user->id)->first()->name;
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
            Mail::to($user->name)->send(new LeadAssigned($mailData));
            
        }
      }

      return response()->json([
        'status' => true,
      ]);
    }

    public function multiple_delete() {
      $contacts = explode(',',request()->ids);
      Contact::whereIn('id',$contacts)->delete();
      for($i = 0; $i < count($contacts); $i++){
        addHistory('Contact',$contacts[$i],'deleted');    
      }
      return response()->json([
        'status' => true,
      ]);
    }
    //added by fazal 17/05/23
    public function fetchCommunities(Request $request)
    {
     $city_id=$request->get('city_id');
     $data['communities'] = Community::where('city_id',$city_id)->where('parent_id',0)->orderBy('name_en','asc')->get();
     return response()->json($data);
    }
    public function fetchSubCommunities(Request $request)
    {
     $community_id=$request->get('community_id');
     $data['subcommunities'] = Community::where('parent_id',$community_id)->orderBy('name_en','asc')->get();
     return response()->json($data);
    }
    public function fetchZones(Request $request)
    {
      $city_id=$request->get('city_id'); 
      $data['zones'] = Zones::where('city_id',$city_id)->orderBy('zone_name','asc')->get();
      return response()->json($data);
    }
    public function fetchDistricts(Request $request)
    {
      $zone_id=$request->get('zone_id'); 
      $data['districts'] = Districts::where('zone_id',$zone_id)->orderBy('name','asc')->get();
      return response()->json($data);
    }
    // end added by fazal

}
