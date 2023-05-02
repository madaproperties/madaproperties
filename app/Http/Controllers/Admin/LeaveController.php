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
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EmployeeImport;
use App\Hrnotification;

class LeaveController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     function __construct() { 
      $this->middleware('permission:leave-list', ['only' => ['index']]);
      $this->middleware('permission:leave-create', ['only' => ['create','store']]);
      $this->middleware('permission:leave-edit', ['only' => ['show','edit']]);
      $this->middleware('permission:leave-delete', ['only' => ['destroy']]);
      // $this->middleware('permission:project-export', ['only' => ['exportProjectData']]);
    }	


  // index 
  public function index()
  { 
    if(auth()->user()->time_zone=='Asia/Dubai')
      {
        $leaves=Leave::where('location','dubai')->orderBy('id', 'DESC'); 
        if(Request()->has('search')){
          
        $leaves = Leave::where('leave_name','LIKE','%'. Request()->get('search') .'%')
                                    ->where('location','dubai');
      }
        $notification_count=Hrnotification::where('location','dubai')->where('status',1)->count();
      }
      else
      {
       $leaves=Leave::where('location','saudi')->orderBy('id', 'DESC');
       if(Request()->has('search')){
        $leaves = Leave::where('leave_name','LIKE','%'. Request()->get('search') .'%')
                                    ->where('location','dubai');
      }
       $notification_count=Hrnotification::where('location','saudi')->where('status',1)->count(); 
      }
    $leaves=$leaves->get();
    return view('admin.leave.index',compact('leaves','notification_count'));
  }
  // create
 

  /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
  public function store(Request $request)
  {   

      $data = $request->validate([
        "leave_name"=>"required",
        "days"=>"required",

      ]);
      $data['created_at'] = Carbon::now();
      if(auth()->user()->time_zone=='Asia/Dubai')
      {
        $data['location'] = 'dubai';
      }
      else
      {
       $data['location'] = 'saudi'; 
      }
     Leave::create($data);
     return redirect(route('admin.leave.index'))->withSuccess(__('site.success'));
  }
  // update
  public function update(Request $request,  $id)
  {
    
    $leave = Leave::findOrFail($id);
    $data = $request->validate([
        "leave_name"=>"required",
        "days"=>"required",

      ]);
     $data['updated_at'] = Carbon::now(); 
     if(auth()->user()->time_zone=='Asia/Dubai')
      {
        $data['location'] = 'dubai';
      }
      else
      {
       $data['location'] = 'saudi'; 
      }
     $leave->update($data);
    return redirect(route('admin.leave.index'))->withSuccess(__('site.success'));
  }
  public function destroy ($id)
  { 
        $leave = Leave::find($id);
        $leave->delete();
       return back()->withSuccess(__('site.success'));
  }
 
  
 
  


}
