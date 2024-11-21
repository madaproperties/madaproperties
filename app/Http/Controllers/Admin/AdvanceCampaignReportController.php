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

class AdvanceCampaignReportController extends Controller
{
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     function __construct()
     {

		$this->middleware('permission:advance-campaign-report-list', ['only' => ['index']]);
		$this->middleware('permission:advance-campaign-report-create', ['only' => ['create','store']]);
		$this->middleware('permission:advance-campaign-report-edit', ['only' => ['show','edit','update']]);
		$this->middleware('permission:advance-campaign-report-delete', ['only' => ['destroy']]);
     }	

	public function index(){ // campaing
		$data_count = CampainReport::count();
		$data = CampainReport::paginate(20);

		return view('admin.reports.index-advance-campaign-report',[
			'data_count' => $data_count,
			'data' => $data
		]);				
	}

    public function edit($id)
    {
		$campaings = Campaing::orderBy('id','desc')->paginate(10);
		$source = Source::where('active','1')->whereNotIn('name',['facebook','instagram'])->orderBy('order_by','asc')->get();
		$campaings_data =Campaing::where('active','1')->get();	
		$projects_options = Project::orderBy('name_en','asc')->get();
		$reportData = CampainReport::where('id',$id)->first();

		$from = date('Y-m-d 00:00:00', strtotime($reportData->start_from));
		$to = date('Y-m-d 23:59:59', strtotime($reportData->end_to));

		$countriesIds = Contact::where('project_id',$reportData->project_id)->whereBetween('created_at',[ $from,$to ])->distinct('campaign_country')->get()->pluck('campaign_country');
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

		$europeCountries = Country::orderBy('name_en')->whereBetween('created_at',[ $from,$to ])->whereIn('id',$countriesIds)->where('parent_id',2)->get();
		$cData = [];
		foreach ($europeCountries as $value) {
			$cData[] = $value->id;
		}
		$cData = implode("_",$cData);

		$russiaCountries = Country::orderBy('name_en')->whereBetween('created_at',[ $from,$to ])->whereIn('id',$countriesIds)->where('parent_id',3)->get();
		$rData = [];
		foreach ($russiaCountries as $value) {
			$rData[] = $value->id;
		}
		$rDataVar = implode("_",$rData);


		return view('admin.reports.edit-advance-campaign-report',[
			'campaings' =>  $campaings,
			'sources_data' => $source,
			'countries_data' => $countries,
			'projects_options' => $projects_options,
			'project_id'=>$reportData->project_id,
			'reportData'=>$reportData,
			'advance_campaign' => true,
			'europeCountries' => $cData,
			'russiaCountries' => $rData
		]);
    }
	public function show($id){
		$source = Source::where('active','1')->whereNotIn('name',['facebook','instagram'])->orderBy('order_by','asc')->get();
		$campaings_data =Campaing::where('active','1')->get();	
		$projects_options = Project::orderBy('name_en','asc')->get();
		// 07-04-2021
		// if(userRole() === 'admin' || userRole() == 'sales admin uae' || userRole() == 'sales admin saudi'){
		// 	$users = User::all();
		// }elseif(userRole() == 'leader'){
		// 	$users = User::whereRaw('JSON_CONTAINS(leader, ?)', [json_encode((string) auth()->id())])->OrWhere('id',auth()->id())->get();
		// }

		$users = User::where('active','1');
        if(userRole() == 'sales admin saudi'){
			$whereCountry = 'Asia/Riyadh';
			$users = $users->where('time_zone','like','%'.$whereCountry.'%');
		}else if(userRole() == 'sales admin uae'){
			$whereCountry = 'Asia/Dubai';
			$users = $users->where('time_zone','like','%'.$whereCountry.'%');
		}else if(userRole() == 'leader'){
			/// if he is leader get his sellars and get him with them too
			$users = $users->whereRaw('JSON_CONTAINS(leader, ?)', [json_encode((string) auth()->id())]);
		}
		$users = $users->orderBy('email')->get();



		$reportData = CampainReport::where('id',$id)
						->first();

		$project_id = $reportData->project_id;

		if(Request('project_id') && Request('last_update_from') && Request('last_update_to')){
			$project_id = Request('project_id');
			$start_from = date('Y-m-d',strtotime(Request('last_update_from')));
			$end_to = date('Y-m-d',strtotime(Request('last_update_to')));
			$start_from = Carbon::parse($start_from)->format('Y-m-d');
			$end_to = Carbon::parse($end_to)->format('Y-m-d');
			$reportData = CampainReport::where('project_id',$project_id)
							->where('start_from','<=',$start_from)
							->where('end_to','>=',$end_to)
							->orderBy('id','desc')
							->first();
			if(!$reportData){
				$reportData = [];
			}
		}

		$from = date('Y-m-d 00:00:00', strtotime($reportData->start_from));
		$to = date('Y-m-d 23:59:59', strtotime($reportData->end_to));
		
		$countriesIds = Contact::where('project_id',$project_id)->whereBetween('created_at',[ $from,$to ])->distinct('campaign_country')->get()->pluck('campaign_country');

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


		$europeCountries = Country::orderBy('name_en')->whereBetween('created_at',[ $from,$to ])->whereIn('id',$countriesIds)->where('parent_id',2)->get();
		$cData = [];
		foreach ($europeCountries as $value) {
			$cData[] = $value->id;
		}
		$cDataVar = implode("_",$cData);

		$russiaCountries = Country::orderBy('name_en')->whereBetween('created_at',[ $from,$to ])->whereIn('id',$countriesIds)->where('parent_id',3)->get();
		$rData = [];
		foreach ($russiaCountries as $value) {
			$rData[] = $value->id;
		}
		$rDataVar = implode("_",$rData);

		$country = Contact::where('project_id',$project_id)->whereBetween('created_at',[ $from,$to ])->distinct('country_id')->get()->pluck('country_id');
		$countries2 = Country::orderBy('name_en')->whereIn('id',$country)->get();
		$collectCounties = [];
		$collectCounties = collect($collectCounties);
		foreach($countries2 as $index => $country){
			if(in_array($country->name_en,toCountriess()) ){
				$collectCounties->push($country);
			}
		}
		$countries2 = $countries2->filter(function($item) {
			return !in_array($item->name_en,toCountriess());
		});
		foreach($collectCounties as $topCountry){
			$countries2->prepend($topCountry);
		}

		$status = Status::where('active','1')->get();

		return view('admin.reports.show-advance-campaign-report',[
			'sources_data' => $source,
			'countries_data' => $countries,
			'campaings_data'=> $campaings_data,
			'projects_options' => $projects_options,
			'advance_campaign_repot'=>true,
			'reportData'=>$reportData,
			'users' => $users,
			'europeCountries' => $cData,
			'cDataVar' => $cDataVar,
			'russiaCountries' => $rData,
			'rDataVar' => $rDataVar,
			'status' => $status,
			'countries' => $countries2
		]);
	}



	public function store(Request $request){
  
		$data = $request->validate([
			"project_id"   => "required",
			"start_from"   => "required",
			"end_to"   => "required",
		]);
  
		//$start_from = str_replace("/","-",$request->input('last_update_from'));
		//$end_to = str_replace("/","-",$request->input('last_update_to'));
		$start_from = date('Y-m-d',strtotime($request->post('start_from')));
		$end_to = date('Y-m-d',strtotime($request->post('end_to')));
		//$start_from = Carbon::parse($start_from)->format('Y-m-d');
		//$end_to = Carbon::parse($end_to)->format('Y-m-d');

		$data = [
			'project_id' => $request->input('project_id'),
			'source_wise_amount' => json_encode($request->input('data')),
			'start_from' => Carbon::parse($start_from)->format('Y-m-d'),
			'end_to' => Carbon::parse($end_to)->format('Y-m-d')
		];

		$campainReport = CampainReport::where('project_id',$request->input('project_id'))
		->where('start_from',Carbon::parse($start_from)->format('Y-m-d'))
		->where('end_to',Carbon::parse($end_to)->format('Y-m-d'))
		->first();


		if($campainReport){
			$campainReport->update($data);
		}else{
			CampainReport::create($data);	
		}
		// CampainReport::updateOrCreate([
		// 	'project_id' => $request->input('project_id'),
		// 	'start_from' => Carbon::parse($start_from)->format('Y-m-d'),
		// 	'end_to' => Carbon::parse($end_to)->format('Y-m-d')
		// 	],$data);
		return redirect()->back()->with('success','Added successfully');
	}
	
	public function create(){	
		$campaings = Campaing::orderBy('id','desc')->paginate(10);

		$source = Source::where('active','1')->whereNotIn('name',['facebook','instagram'])->orderBy('order_by','asc')->get();

		$campaings_data =Campaing::where('active','1')->get();	
		$projects_options = Project::orderBy('name_en','asc')->get();

		$reportData = [];
		$project_id = '';
		if(Request('project_id') && Request('last_update_from') && Request('last_update_to')){
			$project_id = Request('project_id');
			$start_from = date('Y-m-d',strtotime(Request('last_update_from')));
			$end_to = date('Y-m-d',strtotime(Request('last_update_to')));
			$start_from = Carbon::parse($start_from)->format('Y-m-d');
			$end_to = Carbon::parse($end_to)->format('Y-m-d');
			$reportData = CampainReport::where('project_id',$project_id)
							->where('start_from','<=',$start_from)
							->where('end_to','>=',$end_to)
							->orderBy('id','desc')
							->first();
			if(!$reportData){
				$reportData = [];
			}
		}

		$from = date('Y-m-d 00:00:00', strtotime(Request('last_update_from')));
		$to = date('Y-m-d 23:59:59', strtotime(Request('last_update_to')));

		if($project_id){
			$countriesIds = Contact::where('project_id',$project_id)->whereNotNull('campaign_country')->distinct('campaign_country')->get()->pluck('campaign_country');
		}else{
			$countriesIds = Contact::distinct('campaign_country')->get()->pluck('campaign_country');
		}
		

		$countries = Country::orderBy('name_en')->whereBetween('created_at',[ $from,$to ])->whereIn('id',$countriesIds)->where('parent_id',0)->get();
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

		$europeCountries = Country::orderBy('name_en')->whereBetween('created_at',[ $from,$to ])->whereIn('id',$countriesIds)->where('parent_id',2)->get();
		$cData = [];
		foreach ($europeCountries as $value) {
			$cData[] = $value->id;
		}
		$cData = implode("_",$cData);


		$russiaCountries = Country::orderBy('name_en')->whereBetween('created_at',[ $from,$to ])->whereIn('id',$countriesIds)->where('parent_id',3)->get();
		$rData = [];
		foreach ($russiaCountries as $value) {
			$rData[] = $value->id;
		}
		$rDataVar = implode("_",$rData);


		return view('admin.reports.create-advance-campaign-report',[
			'campaings' =>  $campaings,
			'sources_data' => $source,
			'countries_data' => $countries,
			'projects_options' => $projects_options,
			'project_id'=>$project_id,
			'reportData'=>$reportData,
			'advance_campaign' => true,
			'europeCountries' => $cData,
			'russiaCountries' => $rData
		]);
	}
	
	
	public function update(Request $request,  $deal){
		$deal = CampainReport::findOrFail($deal);

		$data = $request->validate([
			"project_id"   => "required",
			"start_from"   => "required",
			"end_to"   => "required",
		]);
  
		$start_from = date('Y-m-d',strtotime($request->post('start_from')));
		$end_to = date('Y-m-d',strtotime($request->post('end_to')));
		//$start_from = date('Y-m-d',strtotime($request->post('start_from')));
		//$end_to = date('Y-m-d',strtotime($request->post('end_to')));
		$data = [
			'project_id' => $request->input('project_id'),
			'source_wise_amount' => json_encode($request->input('data')),
			'start_from' => Carbon::parse($start_from)->format('Y-m-d'),
			'end_to' => Carbon::parse($end_to)->format('Y-m-d')
		];
		$data['updated_at'] = Carbon::now();
		$deal->update($data);
		return redirect(route('admin.advance-campaign-report.index'))->withSuccess(__('site.success'));
	}
  
  
	public function destroy ($id){
	  $data = CampainReport::findOrFail($id);
	  $data->delete();
	  return back()->withSuccess(__('site.success'));
	}
}
