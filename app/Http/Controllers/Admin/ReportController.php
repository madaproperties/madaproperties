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
			$leaders = User::select('id','rule','leader','email')->where('rule','leader')->get();
			foreach($leaders as $lead){
				$leaderTeam = User::select('id','rule','leader')->where('leader',$lead->id)->orWhere('id',$lead->id)->get();
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
		if(request()->has('users_id') && request()->has('from') && request()->has('to')){
			$from = str_replace('/','-', Request('from'));
			$to = str_replace('/','-', Request('to'));
			$user_id = Request('users_id');
			// get the User
			$user = User::findOrFail($user_id);
			// get logs
			$activities = Log::where('user_id',$user_id)
								->where('is_log','1')
								->whereBetween('log_date',[ $from,$to ])
								->get();
			$from = Carbon::parse(Request('from'))->format('M d Y');
			$to = Carbon::parse(Request('to'))->format('M d Y');

			// get days beetwen 2 days
			$period = CarbonPeriod::create($from, $to);
			$user_contacts = Contact::select('id','status_id',DB::raw('DATE(created_at) AS created_at'))
															->where('user_id',$user_id)->get();
			// Iterate over the period / 2021-06-29
			$report_dates = [];
			foreach ($period as $date) {
				$get_day = Carbon::parse($date)->format('m-d-Y');
				$day = Carbon::createFromFormat('d-m-Y', $get_day)->format('l');
				$date = Carbon::parse($date)->format('Y-m-d 00:00:00');
				$report_dates[] = $get_day;
				if($day == 'Friday'){
						$weekends++;
				}
			}
			// contacts taht pass 48 without any think
			$status_not_changed_after_48_hours = Contact::select('id','user_id','status_id','status_changed_at')
			->where('user_id',$user_id)
			->whereDate('status_changed_at', '<=', Carbon::today()->subDays( 2 ))
			->get();
			// end contacts
		}else {
			$report_dates = [];
			$user = [];
			$activities = [];
			$status_not_changed_after_48_hours = [];
			$canvas = true;
			$user_contacts = [];
		}

		// 07-04-2021
		$users = User::all();
		if(userRole() == 'leader'){
				/// if he is leader get his sellars and get him with them too
			$users = User::where('leader',auth()->id())->OrWhere('id',auth()->id())->get();
		}

		$status = Status::where('active','1')->get();

		return view('admin.reports.index',[
			'users' =>  $users,
			'report_dates' =>  $report_dates,
			'activities' => $activities ,
			'user' => $user,
			'status_not_changed_after_48_hours' => $status_not_changed_after_48_hours,
			'status' => $status,
			'user_contacts' => $user_contacts,
			'canvas' => $canvas,
			'weekends' => $weekends,
		]);
	}

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
			$users = User::all();
		}elseif(userRole() == 'leader')
		{
				/// if he is leader get his sellars and get him with them too
			$users = User::where('leader',auth()->id())->OrWhere('id',auth()->id())->get();
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

				return view('admin.reports.index',[
					'campaings' =>  $campaings,
					'sources_data' => $source,
					'countries_data' => $countries,
					'campaings_data'=> $campaings_data,
					'projects_options' => $projects_options,
					'advance_campaign_repot'=>true,
					'project_id'=>$project_id,
					'reportData'=>$reportData,
					'users' => $users
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
	  return back()->withSuccess(__('site.success'));
	}
  
}
