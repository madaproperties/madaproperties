<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Activity;
use App\Log;
use Carbon\Carbon;
use DateTime;
use Carbon\CarbonPeriod;
use App\Contact;
use DB;
use App\Status;
use App\Campaing;
use App\Source;
use App\Country;
use App\City;
use App\Project;
use App\CampaignReportExport;
use Maatwebsite\Excel\Facades\Excel;
use App\CampainReport;
use App\ProjectData;

class ReportController extends Controller
{
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     function __construct()
     {
		$this->middleware('permission:users-report', ['only' => ['reportUsers']]);
		$this->middleware('permission:daily-report', ['only' => ['reportDaily']]);
		$this->middleware('permission:campaign-report', ['only' => ['reportCampaing']]);
		$this->middleware('permission:campaign-analytics-report', ['only' => ['reportCampaingAnalytics']]);
		$this->middleware('permission:leaders-report', ['only' => ['reportLeaders']]);
		$this->middleware('permission:advance-campaign-report', ['only' => ['reportAdvanceCampaing']]);
		$this->middleware('permission:add-advance-campaign-report', ['only' => ['addReportAdvanceCampaing','storeReportAdvanceCampaing']]);
		$this->middleware('permission:edit-advance-campaign-report', ['only' => ['showReportAdvanceCampaing']]);
		$this->middleware('permission:delete-advance-campaign-report', ['only' => ['deleteReportAdvanceCampaing']]);
     }	

	public function index(){ // campaing

	}

	public function reportCampaing(){ // campaing

		if(Request('type') AND request('type') == 'campaing'){
			if(Request()->has('exportData')){
			return Excel::download(new CampaignReportExport, 'CampaignReportExport_'.date('d-m-Y').'.xlsx');
			}  

			$campaings = Campaing::orderBy('id','desc')->paginate(10);
			$status = Status::where('active','1')->orderBy('weight','ASC')->get();

			if(userRole() == 'leader'){
				$users = User::select('id','leader')->where('leader',auth()->id())->
				OrWhere('id', auth()->id())->get();
				$users = $users->pluck('id');
			}else{
				$users = [];
			}

			$source = Source::where('active','1')->get();

			$campaings_data =Campaing::where('active','1')->get();	
			$city_data = City::get();
			$projects_options = Project::orderBy('name_en','asc')->get();
			$projects_data = Project::orderBy('created_at','desc');

			if(userRole() == 'sales admin uae') {
				$projects_data =  $projects_data->where('country_id','2');
				$projects_options = Project::where('country_id','2')->orderBy('name_en','asc')->get();
			}else if(userRole() == 'sales admin saudi'){
				$projects_data =  $projects_data->where('country_id','1');
				$projects_options = Project::where('country_id','1')->orderBy('name_en','asc')->get();
			}
			if(Request('project_id') && !empty(request('project_id'))){
				$projects_data = $projects_data->where('id',request('project_id'));
			}
			if(Request('project_country_id') && !empty(request('project_country_id'))){
				$projects_data = $projects_data->where('country_id',Request('project_country_id'));
			}
			$projects_data = $projects_data->paginate(10);

			$countries = Country::orderBy('name_en')->get();
			$collectCounties = [];
			$collectCounties = collect($collectCounties);
			foreach($countries as $index => $country){
				if(in_array($country->name_en,toCountriess()) ){
					$collectCounties->push($country);
				}
			}
			$countries = $countries->filter(function($item) {
				return !in_array($item->name_en,toCountriess());
			});
			foreach($collectCounties as $topCountry){
				$countries->prepend($topCountry);
			}			   
			return view('admin.reports.index',[
				'campaings' =>  $campaings,
				'status' =>  $status,
				'users' => $users,
				'sources_data' => $source,
				'countries_data' => $countries,
				'campaings_data'=> $campaings_data,
				'city_data'=> $city_data,
				'projects_data'=>$projects_data,
				'projects_options'=>$projects_options
			]);
		}
	}

	public function reportLeaders(){ // leaders

		if(Request('type') AND request('type') == 'leaders'){
			$leaders = User::select('id','rule','leader','email')->where('active','1')->where('rule','leader');
			if(userRole() == 'sales admin saudi'){
				$whereCountry = 'Asia/Riyadh';
				$leaders = $leaders->where('time_zone','like','%'.$whereCountry.'%');
			}else if(userRole() == 'sales admin uae'){
				$whereCountry = 'Asia/Dubai';
				$leaders = $leaders->where('time_zone','like','%'.$whereCountry.'%');
			}
			$leaders = $leaders->get();

			foreach($leaders as $lead){
				$leaderTeam = User::select('id','rule','leader')
							->where('leader',$lead->id)
							->orWhere('id',$lead->id)->get();
			

				$usersIds = $leaderTeam->pluck('id')->toArray();
					$leaderLeadsCount = Contact::
						whereIn('user_id',$usersIds)
						->whereBetween('created_at',[request('from'),request('to')])->count();
				$lead->count = $leaderLeadsCount;
			}
			return view('admin.reports.index',[
							'leaders' => $leaders
						]);
		}
	}

	public function reportCampaingAnalytics(){ // reportCampaingAnalytics

		if(Request('type') AND request('type') == 'campaing-analytics'){   
			$campaings = Campaing::where('active','1')->get();
			$status = Status::where('active','1')->orderBy('weight','ASC')->get();
			if(userRole() == 'leader'){
				$users = User::select('id','leader')->where('leader',auth()->id())->orWhere('id', auth()->id())->get();
				$users = $users->pluck('id');
			}else{
				$users = [];
			}

			foreach($campaings as $c){
				$c->leadsCount = Contact::where('campaign','LIKE','%'.$c->name.'%')->count();
				$c->cpl = !$c->leadsCount  ? 0 : $c->cost / $c->leadsCount;
				$closedStatus = Status::where('name_en','Closed')->first();
				$c->conversion = Contact::where('status_id',$closedStatus->id)->where('campaign',$c->name)->count();
				if($c->conversion > 0)
				$c->cpc  = !$c->cpl ? 0 : $c->cost / $c->conversion;
			}
			return view('admin.reports.index',[
					 'campaings' =>  $campaings,
					 'status' =>  $status,
					]);
		}
	}


	public function reportUsers(){ // reportUsers
		
		$canvas = false;
		$weekends = 0;
		$report_dates = [];
		$user = [];
		$activities = [];
		$status_not_changed_after_48_hours = [];
		$canvas = true;
		$user_contacts = [];	
		$status_not_changed_after_1_week = [];	
		$allUsersReport = false;
		$userReport = [];
		$two_week_report = [];

		if(userRole()!='sales director' && request('users_id') && request()->has('from') && request()->has('to')){
		  $from = date('Y-m-d 00:00:00', strtotime(Request('from')));
			$to = date('Y-m-d 23:59:59', strtotime(Request('to')));

			$user_id = Request('users_id');
			// get the User
			$user = User::findOrFail($user_id);
			// get logs
			$activities = Log::where('user_id',$user_id)
								//->where('is_log','1')
								->whereBetween('log_date',[ $from,$to ])
								->get();
			$status_not_changed_after_1_week = Contact::select('id','user_id','status_id','status_changed_at')
			->where('user_id',$user_id)
			->whereDate('updated_at', '<=', Carbon::today()->subDays( 14 ))
			->get();

			$two_week_report = Contact::select('id','user_id','status_id','status_changed_at')
			->where('user_id',$user_id)
			->whereDate('updated_at', '>=', Carbon::today()->subDays( 14 ))
			->get();
			$leader=0;

		}else if(userRole() == 'sales' && request()->has('from') && request()->has('to')){
			$from = date('Y-m-d 00:00:00', strtotime(Request('from')));
			$to = date('Y-m-d 23:59:59', strtotime(Request('to')));
      
			$user_id = auth()->id();
			// get the User
			$user = User::findOrFail($user_id);
			// get logs
			$activities = Log::where('user_id',$user_id)
								//->where('is_log','1')
								->whereBetween('log_date',[ $from,$to ])
								->get();

			$status_not_changed_after_1_week = Contact::select('id','user_id','status_id','status_changed_at')
			->where('user_id',$user_id)
			->whereDate('updated_at', '<=', Carbon::today()->subDays( 14 ))
			->get();

			$two_week_report = Contact::select('id','user_id','status_id','status_changed_at')
			->where('user_id',$user_id)
			->whereDate('updated_at', '>=', Carbon::today()->subDays( 14 ))
			->get();
			
		}else{
			if(userRole() != 'sales'){
				
				$allUsersReport = true;
				$userReport = User::where('active','1')
				->whereIn('rule',['sales','sales admin','leader','sales director']);
				if(userRole() == 'sales admin saudi'){
					$whereCountry = 'Asia/Riyadh';
					$userReport = $userReport->where('time_zone','like','%'.$whereCountry.'%');
				}else if(userRole() == 'sales admin uae'){
					$whereCountry = 'Asia/Dubai';
					$userReport = $userReport->where('time_zone','like','%'.$whereCountry.'%');
				}else if(userRole()=='sales director') { // added by fazal
					$userdetail=User::where('id',auth()->id())->first();
				   if($userdetail->time_zone=='Asia/Riyadh')
				   {
				   	$whereCountry = 'Asia/Riyadh';
					$userReport = $userReport->where('time_zone','like','%'.$whereCountry.'%');	
				   }	
				   else
				   {
				   	$whereCountry = 'Asia/Dubai';
					$userReport = $userReport->where('time_zone','like','%'.$whereCountry.'%');
				   }
				}
				//added by fazal end
			    else if(userRole() == 'leader'){
					/// if he is leader get his sellars and get him with them too
					$userReport = User::where('active','1')->where('leader',auth()->id());
				}
		// 
				if(request('users_id') > 0){
					$userReport = $userReport->where('id',request('users_id'));
				}
				$userReport = $userReport->whereNotIn('email',['lead-admin-uae@madaproperties.com','lead-admin-ksa@madaproperties.com'])
				->orderBy('email')->paginate(10);
				$leader=0;

			}
			
        // 
		}

		// 07-04-2021
		if(userRole()=='sales director')
		{

			$userdetail=User::where('id',auth()->id())->first();
				   if($userdetail->time_zone=='Asia/Riyadh'){
		       $users = User::where('active','1')->whereIn('rule',['sales','sales admin','leader','sales admin sadui']);
		       	$whereCountry = 'Asia/Riyadh';
			     $users = $users->where('time_zone','like','%'.$whereCountry.'%');
			     	
			     	   	
				   }
				   else
				   {
				   	$users = User::where('active','1')->whereIn('rule',['sales','sales admin','leader','sales admin uae']);
				   		$whereCountry = 'Asia/Dubai';
			        $users = $users->where('time_zone','like','%'.$whereCountry.'%');
			       
				   }
		
		}
		else{
			$users = User::where('active','1')->whereIn('rule',['sales','sales admin','leader']);
		}
		
        if(userRole() == 'sales admin saudi'){
			$whereCountry = 'Asia/Riyadh';
			$users = $users->where('time_zone','like','%'.$whereCountry.'%');
		}else if(userRole() == 'sales admin uae'){
			$whereCountry = 'Asia/Dubai';
			$users = $users->where('time_zone','like','%'.$whereCountry.'%');
		}
		else if(userRole() == 'leader'){
			/// if he is leader get his sellars and get him with them too
			$users = User::where('active','1')->where('leader',auth()->id());
		}

		
    $users = $users->whereNotIn('email',['lead-admin-uae@madaproperties.com','lead-admin-ksa@madaproperties.com'])
		->orderBy('email')->get();
		 

		$status = Status::where('active','1')->get();
        $countries=Country::get();
        if(userRole()=='sales director')
        {   
        	$userdetail=User::where('id',auth()->id())->first();
		     if($userdetail->time_zone=='Asia/Riyadh'){
        	 $leaders=User::where('active','1')->whereIn('rule',['leader'])->where('time_zone','Asia/Riyadh')->get();
        	 $projects=Project::where('country_id',1)->get();
             
        	}
        	else
        	{
        	$leaders=User::where('active','1')->whereIn('rule',['leader'])->where('time_zone','Asia/Dubai')->get();	
        	$projects=Project::where('country_id',2)->get();
        	}
        }
        elseif(userRole()=='sales admin saudi'){
             $leaders=User::where('active','1')->whereIn('rule',['leader'])->where('time_zone','Asia/Riyadh')->get();
        	 $projects=Project::where('country_id',1)->get();
        }
        elseif(userRole()=='sales admin uae'){
         $leaders=User::where('active','1')->whereIn('rule',['leader'])->where('time_zone','Asia/Dubai')->get();
        	 $projects=Project::where('country_id',2)->get();
        }
        else
        {
        	$leaders=User::where('rule',['leader'])->get();
        	$projects=$projects=Project::where('country_id',2)->get();
		}

		return view('admin.reports.index',[
			'users' =>  $users,
			'report_dates' =>  $report_dates,
			'activities' => $activities ,
			'user' => $user,
			'status_not_changed_after_1_week' => $status_not_changed_after_1_week,
			'status' => $status,
			'user_contacts' => $user_contacts,
			'canvas' => $canvas,
			'weekends' => $weekends,
			'last14days' => Carbon::today()->subDays( 14 ),
			'userReport' => $userReport,
			'allUsersReport' => $allUsersReport, 
			'two_week_report' => $two_week_report,
			'countries' =>$countries,
			'leader'=>$leader,
			'leaders'=>$leaders,
			'projects'=>$projects,
		]);
	}
	// added by fazal
     public function fetchProject(Request $request)
     { 

       $country_id=$request->get('country_id');
       $data['project']=Project::where('country_id',$country_id)->get();

       if($country_id==1)
       {
       	
       	$data['leaders']=User::where('rule','=','leader')->where('time_zone','Asia/Riyadh')->select('id','email')->get();
       	$data['director']=User::where('rule','=','sales director')->where('time_zone','Asia/Riyadh')->select('id','email')->get();
       }
       elseif($country_id==2)
       {

       	$data['leaders']=User::where('rule','leader')->where('time_zone','Asia/Dubai')->select('id','email')->get();
        $data['director']=User::where('rule','=','sales director')->where('time_zone','Asia/Dubai')->select('id','email')->get();
       }
       else
       {
       	$data['leaders']='';
        $data['director']='';
       }
       return response()->json($data);
    }
     public function fetchAgent(Request $request)
     {
      $data['agents']=User::where('leader',$request->get('leader_id'))->select('id','email')->get();
      return response()->json($data);      
     }
	
     //added by fazal end 

	public function reportDaily(){ // reportUsers
		$canvas = true;
		$weekends = 0;

		if(request()->has('type') AND request('type') == 'report'){
			$from = Request('from') ? Carbon::parse(Request('from')) : Carbon::parse('-100 hours');
			$to = Request('to') ? Carbon::parse(Request('to')) : Carbon::parse('-1 hours');

			$contacts = Contact::select('id','created_from',DB::raw('DATE(created_at) AS created_at'))
							->whereBetween('created_at',[$from,$to])
							->orderBy('id','ASC')
							->groupBy('created_at')
							->get();

			$created_at_dats = $contacts->pluck('created_at');

			$sources = [
				__('site.api') => $contacts->where('created_from','api'),
				__('site.manual') => $contacts->where('created_from','website'),
				__('site.uolode file') => $contacts->where('created_from','import file')
			];

			foreach($sources as $source => $data){
				$sources[$source]->data = [];
				foreach($created_at_dats as $date){
					$result = $data->where('created_at',$date)->count();
					$date = Carbon::parse($date)->format('d/m/Y');
					$sources[$source]->data[$date] = $result;
				}
			}
			$dates = $created_at_dats;
			$created_at_dats = [];
			foreach($dates as $get_date) {
				$convered_date = Carbon::parse($get_date)->format('d/m/Y');
				$created_at_dats[$convered_date] = $convered_date;
			}

			$created_at_dats = collect(array_values($created_at_dats));
			$created_at_dats2 = Contact::select(DB::raw('DATE(created_at) AS created_at'))->pluck('created_at');
		}else{
			$created_at_dats = [];
			$sources = [];
			$report_dates = [];
			$contacts = [];
		}

		// 07-04-2021
		if(userRole() === 'admin' || userRole() == 'sales admin uae' || userRole() == 'sales admin saudi')
		{
			$users = User::where('active','1')->get();
		}elseif(userRole() == 'leader')
		{
				/// if he is leader get his sellars and get him with them too
			$users = User::where('leader',auth()->id())->OrWhere('id',auth()->id())->where('active','1')->get();
		}elseif(userRole() == 'sales director'){
			$userloc=User::where('id',auth()->id())->first();
			if($userloc->time_zone=='Asia/Dubai'){
				$users = User::where('time_zone','Asia/Dubai')
				->where('active','1')
				->where(function($q){
					$q->where('rule','sales')
					->orWhere('rule','leader')
					->orWhere('rule','sales director');
				})->get();
			}else{
				$users = User::where('time_zone','Asia/Riyadh')
				->where('active','1')
				->where(function($q){
					$q->where('rule','sales')
					->orWhere('rule','leader')
					->orWhere('rule','sales director');
				})->get();
			}
		}
		elseif(userRole() == 'sales director')
		{

		}

		$status = Status::where('active','1')->get();
		return view('admin.reports.index',[
			'users' =>  $users,
			'sources' => $sources,
			'created_at_dats' => $created_at_dats,
			'contacts' => $contacts,
			'status' => $status,
			'canvas' => $canvas,
			'weekends' => $weekends,
		]);
	}

	public function reportAdvanceCampaing(){ // campaing
		$data_count = CampainReport::count();
		$data = CampainReport::paginate(20);

		return view('admin.reports.index-advance-campaign-report',[
			'data_count' => $data_count,
			'data' => $data
		]);				
	}

	public function showReportAdvanceCampaing(){ // campaing

		if(Request('type') AND request('type') == 'campaing'){

			$campaings = Campaing::orderBy('id','desc')->paginate(10);

			$source = Source::where('active','1')->orderBy('order_by','asc')->get();

			$campaings_data =Campaing::where('active','1')->get();	
			$projects_options = Project::orderBy('name_en','asc')->get();

			

			// 07-04-2021
			if(userRole() === 'admin' || userRole() == 'sales admin uae' || userRole() == 'sales admin saudi')
			{
				$users = User::all();
			}elseif(userRole() == 'leader')
			{
					/// if he is leader get his sellars and get him with them too
				$users = User::where('leader',auth()->id())->OrWhere('id',auth()->id())->get();
			}

			$reportData = [];
			$project_id = '';
			if(Request('project_id') && Request('last_update_from') && Request('last_update_to')){
				$project_id = Request('project_id');
				$start_from = Carbon::parse(Request('last_update_from'))->format('Y-m-d');
				$end_to = Carbon::parse(Request('last_update_to'))->format('Y-m-d');

				$reportData = CampainReport::where('project_id',$project_id)
								->where('start_from','<=',$start_from)
								->where('end_to','>=',$end_to)
								->orderBy('id','desc')
								->first();
				if(isset($reportData->source_wise_amount)){
					$reportData = (array) json_decode($reportData->source_wise_amount,true);
				}

				$countriesIds = Contact::where('project_id',$project_id)->distinct('country_id')->get()->pluck('country_id');

				$countries = Country::orderBy('name_en')->whereIn('id',$countriesIds)->where('parent_id',0)->get();
				$collectCounties = [];
				$collectCounties = collect($collectCounties);
				foreach($countries as $index => $country){
					if(in_array($country->name_en,toCountriess()) ){
						$collectCounties->push($country);
					}
				}
				$countries = $countries->filter(function($item) {
					return !in_array($item->name_en,toCountriess());
				});
				foreach($collectCounties as $topCountry){
					$countries->prepend($topCountry);
				}
				$status = Status::where('active','1')->get();

				return view('admin.reports.index',[
					'campaings' =>  $campaings,
					'sources_data' => $source,
					'countries_data' => $countries,
					'campaings_data'=> $campaings_data,
					'projects_options' => $projects_options,
					'advance_campaign_repot'=>true,
					'project_id'=>$project_id,
					'reportData'=>$reportData,
					'users' => $users,
					'status' => $status
				]);
			}
		}
	}



	public function storeReportAdvanceCampaing(Request $request){ // campaing

		if($_POST){
			$start_from = str_replace("/","-",$request->input('last_update_from'));
			$end_to = str_replace("/","-",$request->input('last_update_to'));
			$data = [
				'source_wise_amount' => json_encode($request->input('data')),
				'start_from' => Carbon::parse($start_from)->format('Y-m-d'),
				'end_to' => Carbon::parse($end_to)->format('Y-m-d')
			];
			CampainReport::updateOrCreate([
				'project_id' => $request->input('project_id'),
				'start_from' => Carbon::parse($start_from)->format('Y-m-d'),
				'end_to' => Carbon::parse($end_to)->format('Y-m-d')
				],$data);
			return redirect()->back()->with('success','Added successfully');
		}
	}
	
	public function addReportAdvanceCampaing(){ // campaing

		$campaings = Campaing::orderBy('id','desc')->paginate(10);

		$source = Source::where('active','1')->orderBy('order_by','asc')->get();

		$campaings_data =Campaing::where('active','1')->get();	
		$projects_options = Project::orderBy('name_en','asc')->get();

		$countriesIds = Contact::distinct('country_id')->get()->pluck('country_id');

		$countries = Country::orderBy('name_en')->whereIn('id',$countriesIds)->where('parent_id',0)->get();
		$collectCounties = [];
		$collectCounties = collect($collectCounties);
		foreach($countries as $index => $country){
			if(in_array($country->name_en,toCountriess()) ){
				$collectCounties->push($country);
			}
		}
		$countries = $countries->filter(function($item) {
			return !in_array($item->name_en,toCountriess());
		});
		foreach($collectCounties as $topCountry){
			$countries->prepend($topCountry);
		}
		$reportData = [];
		$project_id = '';
		if(Request('project_id') && Request('last_update_from') && Request('last_update_to')){
			$project_id = Request('project_id');
			$start_from = Carbon::parse(Request('last_update_from'))->format('Y-m-d');
			$end_to = Carbon::parse(Request('last_update_to'))->format('Y-m-d');
			$reportData = CampainReport::where('project_id',$project_id)
							->where('start_from','<=',$start_from)
							->where('end_to','>=',$end_to)
							->orderBy('id','desc')
							->first();
			if(isset($reportData->source_wise_amount)){
				$reportData = (array) json_decode($reportData->source_wise_amount,true);
			}
		}
		return view('admin.reports.index',[
			'campaings' =>  $campaings,
			'sources_data' => $source,
			'countries_data' => $countries,
			'campaings_data'=> $campaings_data,
			'projects_options' => $projects_options,
			'advance_campaign'=>true,
			'project_id'=>$project_id,
			'reportData'=>$reportData
		]);
	}
	
	public function destroy ($id)
	{
	  $data = CampainReport::findOrFail($id);
	  $data->delete();
	  addHistory('Campain Report',$id,'deleted');
	  return back()->withSuccess(__('site.success'));
	}
  
}
