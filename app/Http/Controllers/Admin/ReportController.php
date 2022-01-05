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

class ReportController extends Controller
{
    //

	public function index()
	{ // campaing

	       if(userRole() == 'seller' OR userRole() == 'sales admin')
	       {
	           return abort(404);
	       }



	       if(Request('type') AND request('type') == 'campaing')
	       {
	           $campaings = Campaing::where('active','1')->get();
	           $status = Status::where('active','1')->orderBy('weight','ASC')->get();


	           if(userRole() == 'leader')
	           {
	               $users = User::select('id','leader')->where('leader',auth()->id())->
	                            OrWhere('id', auth()->id())->get();

                    $users = $users->pluck('id');
	           }else{
	               $users = [];
	           }


	           return view('admin.reports.index',[
								'campaings' =>  $campaings,
								'status' =>  $status,
								'users' => $users
							]);

	       }
	       
	       if(Request('type') AND request('type') == 'leaders')
	       {
	           // get leaders 
	           
	           $leaders = User::select('id','rule','leader','email')->where('rule','leader')->get();
	           
	           // get leader teams 
	           
	           foreach($leaders as $lead)
	           {
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

		if(Request('type') AND request('type') == 'campaing-analytics')
		{   
		    if(userRole() != 'admin')
		    {
		        return abort(404);
		    }
		    
			$campaings = Campaing::where('active','1')->get();
			$status = Status::where('active','1')->orderBy('weight','ASC')->get();

			if(userRole() == 'leader')
			{
					$users = User::select('id','leader')->where('leader',auth()->id())->
											 OrWhere('id', auth()->id())->get();
						 $users = $users->pluck('id');
			}else{
					$users = [];
			}

			foreach($campaings as $c)
			{
				$c->leadsCount = Contact::where('campaign','LIKE','%'.$c->name.'%')->count();
				$c->cpl = !$c->leadsCount  ? 0 : $c->cost / $c->leadsCount;
				$closedStatus = Status::where('name_en','Closed')->first();
				$c->conversion = Contact::where('status_id',$closedStatus->id)->where('campaign',$c->name)->count();
				$c->cpc  = !$c->cpl ? 0 : $c->cost / $c->conversion;
			}


			return view('admin.reports.index',[
					 'campaings' =>  $campaings,
					 'status' =>  $status,
					]);
		}
		// dd(Request()->all());
			/// start to search
		$canvas = false;
		$weekends = 0;

		if(request()->has('users_id') AND request()->has('from') AND request()->has('to'))
		{
			$from = str_replace('/','-', Request('from'));
			$to = str_replace('/','-', Request('to'));

			$user_id = Request('users_id');
			// get the User
			$user = User::findOrFail($user_id);
			// get logs

			$activities = Log::where('user_id',$user_id)
								->where('is_log','1')
								->whereBetween('date',[ $from,$to ])
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
				if($day == 'Friday')
				{
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
		if(userRole() === 'admin' || userRole() == 'sales admin uae' || userRole() == 'sales admin saudi')
		{
			$users = User::all();
		}elseif(userRole() == 'leader')
		{
				/// if he is leader get his sellars and get him with them too
			$users = User::where('leader',auth()->id())->OrWhere('id',auth()->id())->get();
		}

		/********************************************************************/
		/****************************** Start OVERVIEW AREA *****************/
		/******************************************************************/
    if(request()->has('type') AND request('type') == 'report')
		{
      $from = Request('from')?
                            Carbon::parse(Request('from'))
                            : Carbon::parse('-100 hours');
                            
     $to = Request('to')?
        Carbon::parse(Request('to'))
        : Carbon::parse('-1 hours');



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



		foreach($sources as $source => $data)
		{

			$sources[$source]->data = [];


			foreach($created_at_dats as $date)
			{
				$result = $data->where('created_at',$date)->count();
				$date = Carbon::parse($date)->format('d/m/Y');
				$sources[$source]->data[$date] = $result;
			}
		}


		$dates = $created_at_dats;
		$created_at_dats = [];

		foreach($dates as $get_date)
		{
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
		/********************************************************************/
		/****************************** End OVERVIEW AREA *****************/
		/******************************************************************/

		$status = Status::where('active','1')->get();

		return view('admin.reports.index',[
				'users' =>  $users,
				'report_dates' =>  $report_dates,
				'activities' => $activities ,
				'user' => $user,
				'sources' => $sources,
				'created_at_dats' => $created_at_dats,
				'contacts' => $contacts,
				'status_not_changed_after_48_hours' => $status_not_changed_after_48_hours,
				'status' => $status,
				'user_contacts' => $user_contacts,
				'canvas' => $canvas,
				'weekends' => $weekends,
			]);
	}
}
