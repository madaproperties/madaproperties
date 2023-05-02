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

class EmployeeLeaveController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     function __construct() {
      $this->middleware('permission:employee-leave-list', ['only' => ['index']]);
      $this->middleware('permission:employee-leave-create', ['only' => ['create','store']]);
      $this->middleware('permission:employee-leave-edit', ['only' => ['show','edit']]);
      $this->middleware('permission:employee-leave-delete', ['only' => ['destroy']]);
      
    }	


  // index 
  public function index()
  {
    if(auth()->user()->time_zone=='Asia/Dubai')
    {
    $leaves_names=Leave::where('location','dubai')->get(); 
    $employees=Employee::where('location','dubai')->where('active_status',1);
    $leaves=EmployeeLeave::where('location','dubai')->orderBy('id','desc')->paginate(20);
    $notification_count=Hrnotification::where('location','dubai')->where('status',1)->count();
    }
    else{
     $leaves_names=Leave::where('location','saudi')->get(); 
    $employees=Employee::where('location','saudi')->where('active_status',1);
    $leaves=EmployeeLeave::where('location','saudi')->orderBy('id','desc')->paginate(20);
    $notification_count=Hrnotification::where('location','saudi')->where('status',1)->count();
    }
    $employees=$employees->get();
                                  
    return view('admin.employee_leave.index',compact('leaves','employees','leaves_names','notification_count'));
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
        "employee_id"=>"required",
        "leave_id"=>"required",
        "start_date"=>"required",
        "end_date"=>"nullable",
        "description"=>"nullable",
        "days"=>"nullable",
      ]);
      $data['created_at'] = Carbon::now();
      $data['status'] =1;
      if(auth()->user()->time_zone=='Asia/Dubai')
      {
        $data['location'] ='dubai';
      }
      else
      {
      $data['location'] ='saudi';
      }
      EmployeeLeave::create($data);
      return back()->withSuccess(__('site.success'));
  }
  // update
  public function update(Request $request,  $id)
  {
    $leave=EmployeeLeave::findOrFail($id);
     $data = $request->validate([
        "employee_id"=>"required",
        "leave_id"=>"required",
        "start_date"=>"required",
        "end_date"=>"nullable",
        "description"=>"nullable",
        "days"=>"nullable",
        'status'=>"nullable",
      ]);
      if(auth()->user()->time_zone=='Asia/Dubai')
      {
        $data['location'] ='dubai';
      }
      else
      {
      $data['location'] ='saudi';
      }
    $leave->update($data);
   return back()->withSuccess(__('site.success'));
  }
  public function destroy (Request $request)
  { 
    $id=$request->get('id');
    $employee = Employee::find($id);
    $employee->active_status=0;
    $employee->save();
    $statusCode=6000;
    $message="deleted sucessfully...";
    return response()->json(['statusCode' => $statusCode, 'message' => $message]);
  }
 
  public function show($id)
  {
     if(auth()->user()->time_zone=='Asia/Dubai')
     {
     $data['leaves']=Leave::where('location','dubai')->get(); 
     $data['employees']=Employee::where('location','dubai')->where('active_status',1)->get();
     }
     else
     {
     $data['leaves']=Leave::where('location','saudi')->get(); 
     $data['employees']=Employee::where('location','saudi')->where('active_status',1)->get();
     }
    
    $data['employee_leaves'] = EmployeeLeave::where('employee_leave.id',$id)->first();
    return view('admin.employee_leave.show')->with($data);

  } 
}
