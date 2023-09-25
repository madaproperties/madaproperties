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
use App\UserStatusExport;
use Maatwebsite\Excel\Facades\Excel;
use App\CampainReport;
use App\ProjectData;
use App\UserLogsExport;
use App\UserWeekExport;
use App\UserWeekStatusExport;

class ReportExportController extends Controller
{
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	function __construct(){
	
	}	

	public function index(Request $request){
		if(Request('userStatusReport') == '1'){
			return Excel::download(new UserStatusExport, 'UserStatusReport_'.date('d-m-Y').'.xlsx');
		}elseif(Request('userStatusReport') == '2'){
			return Excel::download(new UserLogsExport, 'UserLogsReport_'.date('d-m-Y').'.xlsx');
		}elseif(Request('userStatusReport') == '3'){
			return Excel::download(new UserWeekExport, 'UserWeekReport_'.date('d-m-Y').'.xlsx');
		}elseif(Request('userStatusReport') == '4'){
			return Excel::download(new UserWeekStatusExport, 'UserStatusNotChangedReport_'.date('d-m-Y').'.xlsx');
		}
	}

}
