<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Country;
use App\PurposeType;
use Carbon\Carbon;
use App\Employee;
use App\Leave;
use App\EmployeeLeave;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EmployeeImport;
use App\Hrnotification;

class DateinfoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     function __construct() {
      $this->middleware('permission:date-info', ['only' => ['index']]);
      // $this->middleware('permission:employee-leave-create', ['only' => ['create','store']]);
      // $this->middleware('permission:employee-leave-edit', ['only' => ['show','edit']]);
      // $this->middleware('permission:employee-leave-delete', ['only' => ['destroy']]);
      // $this->middleware('permission:project-export', ['only' => ['exportProjectData']]);
    }	
 

  // index 
  public function index()
  {
    if(auth()->user()->time_zone=='Asia/Dubai')
    {
    $employees=Employee::where('location','dubai')->where('active_status',1)->get();
    $notification_count=Hrnotification::where('location','dubai')->where('status',1)->count();
  }
  else{
    $employees=Employee::where('location','saudi')->where('active_status',1)->get();
    $notification_count=Hrnotification::where('location','saudi')->where('status',1)->count();
  }

    return view('admin.dateinfo.index',compact('employees','notification_count'));
  
  }
 
  

}
