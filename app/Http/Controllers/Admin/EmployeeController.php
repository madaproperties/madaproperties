<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Country;
use App\PurposeType;
use Carbon\Carbon;
use App\Employee;
use App\User;
use App\EmployeeDataExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EmployeeImport;
use App\Hrnotification;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     function __construct() {
      $this->middleware('permission:employee-list', ['only' => ['index']]);
      $this->middleware('permission:employee-create', ['only' => ['create','store']]);
      $this->middleware('permission:employee-edit', ['only' => ['show','edit']]);
      $this->middleware('permission:employee-delete', ['only' => ['destroy']]);
      // $this->middleware('permission:employee-export', ['only' => ['exportProjectData']]);
    } 

 
  // index 

   
  public function index()
  {

    $user=User::where('id',auth()->id())->first();
    if($user->time_zone=='Asia/Dubai')
    {
     $employees=Employee::where('location','dubai')->orderBy('employee_name', 'DESC'); 

     if(Request()->has('search')){
        $employees = Employee::where('employee_name','LIKE','%'. Request()->get('search') .'%')
                                    ->where('location','dubai');
      }
      $notification_count=Hrnotification::where('location','dubai')->where('status',1)->count(); 
    }
    else
    {
     $employees=Employee::where('location','saudi')->orderBy('id', 'DESC'); 
     $notification_count=Hrnotification::where('location','saudi')->where('status',1)->count(); 

     if(Request()->has('search')){
        $employees = Employee::where('employee_name','LIKE','%'. Request()->get('search') .'%')
                                    ->where('location','dubai');
      } 
    }
      $employees= $employees->paginate(20); 
      $employees_count= $employees->count();
      return view('admin.employee.index',compact('employees','notification_count','employees_count'));
  }
  // create
  public function create()
  {
   $data['countries']=Country::get();
   if($user->time_zone=='Asia/Dubai')
    {
   $data['notification_count']=Hrnotification::where('status',1)->where('location','dubai')->count();
   }
   else
   {
   $data['notification_count']=Hrnotification::where('status',1)->where('location','saudi')->count();
   }
   return view('admin.employee.create')->with($data);
 
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
        "emp_no"          => "required",
        "employee_name"          => "required",
        "official_email"          => "required",
        "personel_email"          => "nullable",
        "phone"          => "required",
        "alternative_phone"          => "nullable",
        "reporting_manager"          => "nullable",
        "designation"          => "nullable",
        "department"          => "required",
        "country_id"          => "required",
        "date_of_join"          => "nullable",
        "location" =>        "nullable",
        "date_of_birth"          => "required",
        "visa_status"          => "required",
        "visa_issue"=>"required",
        "visa_exp"      =>"required",
        "passport_no"    =>"required",
        "passport_exp"  => "required",
        "passport_issue"=>"nullable",
        "emirates_id"          => "nullable",
        "emirates_id_exp"          => "nullable",
        "labour_card"=>"nullable",
        "labourcard_issue"=>"nullable",
        "insurance_card"=>"nullable",
        "insurance_issue"=>"nullable",
        "insurance_card_exp"=>"nullable",
        "emirates_id_issue"=>"nullable",
        "resignation"=>"nullable",
        "photo"=>"nullable",
        "doc_passport"          => "required",
        "doc_visa"          => "required",
        "doc_education"          => "required",
        "doc_pre_exp"          => "nullable",
        "doc_pre_visa"          => "nullable",
        "offer_letter"          => "required",
        "doc_emirates_id"          => "nullable",
        "medical_certificate"          => "nullable",
        "mol_contract"=>"nullable",
        "increment_letter"=>"nullable",
        "commssion_letter"=>"nullable",
        "resignation_letter"=>"nullable",
        "warning_letter"=>"nullable",
        "termination_letter"=>"nullable",
        "resume"          => "nullable",
        "basic_salary"          => "nullable",
        "hra"          => "nullable",
        "total_salary" =>"nullable",
        "doc_insurance_card"=>"nullable",
        "doc_labour_card"=>"nullable",
        "other_allowance"          => "nullable",
        "verified_person"          => "nullable",
        "verified_date"      =>"nullable",
      ]);
      $data['created_at'] = Carbon::now();
      $data['active_status']= 1;
      if($request->file('photo')){
      $md5Name = md5_file($request->file('photo')->getRealPath());
        $guessExtension = $request->file('photo')->guessExtension();
        $file = Storage::disk('s3')->putFile('uploads/employee', $request->file('photo'));
        $path="https://mada-properties-staging.s3.eu-west-1.amazonaws.com/".$file;     
        $data['photo'] = $path;
    }
      if($request->file('doc_passport')){
      $md5Name = md5_file($request->file('doc_passport')->getRealPath());
        $guessExtension = $request->file('doc_passport')->guessExtension();
        $file = Storage::disk('s3')->putFile('uploads/employee', $request->file('doc_passport'));
        $path="https://mada-properties-staging.s3.eu-west-1.amazonaws.com/".$file;     
        $data['doc_passport'] = $path;
    }
    if($request->file('doc_visa')){
      $md5Name = md5_file($request->file('doc_visa')->getRealPath());
        $guessExtension = $request->file('doc_visa')->guessExtension();
        $file = Storage::disk('s3')->putFile('uploads/employee', $request->file('doc_visa'));
        $path="https://mada-properties-staging.s3.eu-west-1.amazonaws.com/".$file;     
        $data['doc_visa'] = $path;
    }
    if($request->file('doc_education')){
      $md5Name = md5_file($request->file('doc_education')->getRealPath());
        $guessExtension = $request->file('doc_education')->guessExtension();
        $file = Storage::disk('s3')->putFile('uploads/employee', $request->file('doc_education'));
        $path="https://mada-properties-staging.s3.eu-west-1.amazonaws.com/".$file;     
        $data['doc_education'] = $path;
    }
    if($request->file('doc_pre_exp')){
        $md5Name = md5_file($request->file('doc_pre_exp')->getRealPath());
        $guessExtension = $request->file('doc_pre_exp')->guessExtension();
        $file = Storage::disk('s3')->putFile('uploads/employee', $request->file('doc_pre_exp'));
        $path="https://mada-properties-staging.s3.eu-west-1.amazonaws.com/".$file;     
        $data['doc_pre_exp'] = $path;
    }
    if($request->file('doc_pre_visa')){
     $md5Name = md5_file($request->file('doc_pre_visa')->getRealPath());
        $guessExtension = $request->file('doc_pre_visa')->guessExtension();
        $file = Storage::disk('s3')->putFile('uploads/employee', $request->file('doc_pre_visa'));
        $path="https://mada-properties-staging.s3.eu-west-1.amazonaws.com/".$file;     
        $data['doc_pre_visa'] = $path;
    }
    if($request->file('offer_letter')){
      $md5Name = md5_file($request->file('offer_letter')->getRealPath());
      $guessExtension = $request->file('offer_letter')->guessExtension();
      $file = $request->file('offer_letter')->move('public/uploads/employee', $md5Name.'.'.$guessExtension);     
      $data['offer_letter'] = $md5Name.'.'.$guessExtension;
    }
    if($request->file('doc_emirates_id')){
      $md5Name = md5_file($request->file('doc_emirates_id')->getRealPath());
      $guessExtension = $request->file('doc_emirates_id')->guessExtension();
      $file = $request->file('doc_emirates_id')->move('public/uploads/employee', $md5Name.'.'.$guessExtension);     
      $data['doc_emirates_id'] = $path;
    }
    if($request->file('medical_certificate')){
      $md5Name = md5_file($request->file('medical_certificate')->getRealPath());
      $guessExtension = $request->file('medical_certificate')->guessExtension();
      $file = $request->file('medical_certificate')->move('public/uploads/employee', $md5Name.'.'.$guessExtension);     
      $data['medical_certificate'] = $path;
    }
    if($request->file('doc_insurance_card')){
      $md5Name = md5_file($request->file('doc_insurance_card')->getRealPath());
      $guessExtension = $request->file('doc_insurance_card')->guessExtension();
      $file = $request->file('doc_insurance_card')->move('public/uploads/employee', $md5Name.'.'.$guessExtension);     
      $data['doc_insurance_card'] = $path;
    }
    if($request->file('doc_labour_card')){
       $md5Name = md5_file($request->file('doc_labour_card')->getRealPath());
      $guessExtension = $request->file('doc_labour_card')->guessExtension();
      $file = $request->file('doc_labour_card')->move('public/uploads/employee', $md5Name.'.'.$guessExtension);     
      $data['doc_labour_card'] = $path;
    }
    if($request->file('mol_contract')){
      $md5Name = md5_file($request->file('mol_contract')->getRealPath());
      $guessExtension = $request->file('mol_contract')->guessExtension();
      $file = $request->file('mol_contract')->move('public/uploads/employee', $md5Name.'.'.$guessExtension);     
      $data['mol_contract'] = $path;
    }
    if($request->file('increment_letter')){
      $md5Name = md5_file($request->file('increment_letter')->getRealPath());
      $guessExtension = $request->file('increment_letter')->guessExtension();
      $file = $request->file('increment_letter')->move('public/uploads/employee', $md5Name.'.'.$guessExtension);     
      $data['increment_letter'] = $path;
    }
   if($request->file('commission_letter')){
      $md5Name = md5_file($request->file('commission_letter')->getRealPath());
      $guessExtension = $request->file('commission_letter')->guessExtension();
      $file = $request->file('commission_letter')->move('public/uploads/employee', $md5Name.'.'.$guessExtension);     
      $data['commission_letter'] = $path;
    }
    if($request->file('resignation_letter')){
      $md5Name = md5_file($request->file('resignation_letter')->getRealPath());
      $guessExtension = $request->file('resignation_letter')->guessExtension();
      $file = $request->file('resignation_letter')->move('public/uploads/employee', $md5Name.'.'.$guessExtension); 
      $data['resignation_letter'] = $path;
    }
    if($request->file('warning_letter')){
      $md5Name = md5_file($request->file('warning_letter')->getRealPath());
      $guessExtension = $request->file('warning_letter')->guessExtension();
      $file = $request->file('warning_letter')->move('public/uploads/employee', $md5Name.'.'.$guessExtension); 
      $data['warning_letter'] = $path;
    }
    if($request->file('termination_letter')){
      $md5Name = md5_file($request->file('termination_letter')->getRealPath());
      $guessExtension = $request->file('termination_letter')->guessExtension();
      $file = $request->file('termination_letter')->move('public/uploads/employee', $md5Name.'.'.$guessExtension); 
      $data['termination_letter'] = $path;
    }
     Employee::create($data);
     return redirect(route('admin.employee.index'))->withSuccess(__('site.success'));
  }
  // update
  public function update(Request $request,  $id)
  {
    $employee = Employee::findOrFail($id);

   $data = $request->validate([
        "emp_no"          => "required",
        "employee_name"          => "required",
        "official_email"          => "required",
        "personel_email"          => "nullable",
        "phone"          => "required",
        "alternative_phone"          => "nullable",
        "reporting_manager"          => "nullable",
        "designation"          => "nullable",
        "department"          => "required",
        "country_id"          => "required",
        "date_of_join"          => "nullable",
        "location" =>        "nullable",
        "date_of_birth"          => "required",
        "visa_status"          => "required",
        "visa_issue"=>"required",
        "visa_exp"      =>"required",
        "passport_no"    =>"required",
        "passport_exp"  => "required",
        "passport_issue"=>"nullable",
        "emirates_id"          => "nullable",
        "emirates_id_exp"          => "nullable",
        "labour_card"=>"nullable",
        "labourcard_issue"=>"nullable",
        "insurance_card"=>"nullable",
        "insurance_issue"=>"nullable",
        "insurance_card_exp"=>"nullable",
        "emirates_id_issue"=>"nullable",
        "resignation"=>"nullable",
        "photo"=>"nullable",
        "doc_passport"          => "nullable",
        "doc_visa"          => "nullable",
        "doc_education"          => "nullable",
        "doc_pre_exp"          => "nullable",
        "doc_pre_visa"          => "nullable",
        "offer_letter"          => "nullable",
        "doc_emirates_id"          => "nullable",
        "medical_certificate"          => "nullable",
        "mol_contract"=>"nullable",
        "increment_letter"=>"nullable",
        "commssion_letter"=>"nullable",
        "resignation_letter"=>"nullable",
        "warning_letter"=>"nullable",
        "termination_letter"=>"nullable",
        "resume"          => "nullable",
        "basic_salary"          => "nullable",
        "hra"          => "nullable",
        "total_salary" =>"nullable",
        "doc_insurance_card"=>"nullable",
        "doc_labour_card"=>"nullable",
        "other_allowance"          => "nullable",
        "verified_person"          => "nullable",
        "verified_date"      =>"nullable",
      ]);
      $data['updated_at'] = Carbon::now();
      $data['active_status']= 1;
      if($request->file('photo')){
      $md5Name = md5_file($request->file('photo')->getRealPath());
        $guessExtension = $request->file('photo')->guessExtension();
        $file = Storage::disk('s3')->putFile('uploads/employee', $request->file('photo'));
        $path="https://mada-properties-staging.s3.eu-west-1.amazonaws.com/".$file;     
        $data['photo'] = $path;
    }
      if($request->file('doc_passport')){
      $md5Name = md5_file($request->file('doc_passport')->getRealPath());
        $guessExtension = $request->file('doc_passport')->guessExtension();
        $file = Storage::disk('s3')->putFile('uploads/employee', $request->file('doc_passport'));
        $path="https://mada-properties-staging.s3.eu-west-1.amazonaws.com/".$file;     
        $data['doc_passport'] = $path;
    }
    if($request->file('doc_visa')){
      $md5Name = md5_file($request->file('doc_visa')->getRealPath());
        $guessExtension = $request->file('doc_visa')->guessExtension();
        $file = Storage::disk('s3')->putFile('uploads/employee', $request->file('doc_visa'));
        $path="https://mada-properties-staging.s3.eu-west-1.amazonaws.com/".$file;     
        $data['doc_visa'] = $path;
    }
    if($request->file('doc_education')){
      $md5Name = md5_file($request->file('doc_education')->getRealPath());
        $guessExtension = $request->file('doc_education')->guessExtension();
        $file = Storage::disk('s3')->putFile('uploads/employee', $request->file('doc_education'));
        $path="https://mada-properties-staging.s3.eu-west-1.amazonaws.com/".$file;     
        $data['doc_education'] = $path;
    }
    if($request->file('doc_pre_exp')){
        $md5Name = md5_file($request->file('doc_pre_exp')->getRealPath());
        $guessExtension = $request->file('doc_pre_exp')->guessExtension();
        $file = Storage::disk('s3')->putFile('uploads/employee', $request->file('doc_pre_exp'));
        $path="https://mada-properties-staging.s3.eu-west-1.amazonaws.com/".$file;     
        $data['doc_pre_exp'] = $path;
    }
    if($request->file('doc_pre_visa')){
     $md5Name = md5_file($request->file('doc_pre_visa')->getRealPath());
        $guessExtension = $request->file('doc_pre_visa')->guessExtension();
        $file = Storage::disk('s3')->putFile('uploads/employee', $request->file('doc_pre_visa'));
        $path="https://mada-properties-staging.s3.eu-west-1.amazonaws.com/".$file;     
        $data['doc_pre_visa'] = $path;
    }
    if($request->file('offer_letter')){
      $md5Name = md5_file($request->file('offer_letter')->getRealPath());
      $guessExtension = $request->file('offer_letter')->guessExtension();
      $file = $request->file('offer_letter')->move('public/uploads/employee', $md5Name.'.'.$guessExtension);     
      $data['offer_letter'] = $md5Name.'.'.$guessExtension;
    }
    if($request->file('doc_emirates_id')){
      $md5Name = md5_file($request->file('doc_emirates_id')->getRealPath());
      $guessExtension = $request->file('doc_emirates_id')->guessExtension();
      $file = $request->file('doc_emirates_id')->move('public/uploads/employee', $md5Name.'.'.$guessExtension);     
      $data['doc_emirates_id'] = $path;
    }
    if($request->file('medical_certificate')){
      $md5Name = md5_file($request->file('medical_certificate')->getRealPath());
      $guessExtension = $request->file('medical_certificate')->guessExtension();
      $file = $request->file('medical_certificate')->move('public/uploads/employee', $md5Name.'.'.$guessExtension);     
      $data['medical_certificate'] = $path;
    }
    if($request->file('doc_insurance_card')){
      $md5Name = md5_file($request->file('doc_insurance_card')->getRealPath());
      $guessExtension = $request->file('doc_insurance_card')->guessExtension();
      $file = $request->file('doc_insurance_card')->move('public/uploads/employee', $md5Name.'.'.$guessExtension);     
      $data['doc_insurance_card'] = $path;
    }
    if($request->file('doc_labour_card')){
       $md5Name = md5_file($request->file('doc_labour_card')->getRealPath());
      $guessExtension = $request->file('doc_labour_card')->guessExtension();
      $file = $request->file('doc_labour_card')->move('public/uploads/employee', $md5Name.'.'.$guessExtension);     
      $data['doc_labour_card'] = $path;
    }
    if($request->file('mol_contract')){
      $md5Name = md5_file($request->file('mol_contract')->getRealPath());
      $guessExtension = $request->file('mol_contract')->guessExtension();
      $file = $request->file('mol_contract')->move('public/uploads/employee', $md5Name.'.'.$guessExtension);     
      $data['mol_contract'] = $path;
    }
    if($request->file('increment_letter')){
      $md5Name = md5_file($request->file('increment_letter')->getRealPath());
      $guessExtension = $request->file('increment_letter')->guessExtension();
      $file = $request->file('increment_letter')->move('public/uploads/employee', $md5Name.'.'.$guessExtension);     
      $data['increment_letter'] = $path;
    }
   if($request->file('commission_letter')){
      $md5Name = md5_file($request->file('commission_letter')->getRealPath());
      $guessExtension = $request->file('commission_letter')->guessExtension();
      $file = $request->file('commission_letter')->move('public/uploads/employee', $md5Name.'.'.$guessExtension);     
      $data['commission_letter'] = $path;
    }
    if($request->file('resignation_letter')){
      $md5Name = md5_file($request->file('resignation_letter')->getRealPath());
      $guessExtension = $request->file('resignation_letter')->guessExtension();
      $file = $request->file('resignation_letter')->move('public/uploads/employee', $md5Name.'.'.$guessExtension); 
      $data['resignation_letter'] = $path;
    }
    if($request->file('warning_letter')){
      $md5Name = md5_file($request->file('warning_letter')->getRealPath());
      $guessExtension = $request->file('warning_letter')->guessExtension();
      $file = $request->file('warning_letter')->move('public/uploads/employee', $md5Name.'.'.$guessExtension); 
      $data['warning_letter'] = $path;
    }
    if($request->file('termination_letter')){
      $md5Name = md5_file($request->file('termination_letter')->getRealPath());
      $guessExtension = $request->file('termination_letter')->guessExtension();
      $file = $request->file('termination_letter')->move('public/uploads/employee', $md5Name.'.'.$guessExtension); 
      $data['termination_letter'] = $path;
    }
    $employee->update($data);
    return redirect(route('admin.employee.index'))->withSuccess(__('site.success'));
  }
  public function destroy ($id)
  { 
    $employee = Employee::find($id);
    $employee->active_status=0;
    $employee->save();
    return back()->withSuccess(__('site.success'));
  }
 
  public function show($id)
  {
    $employee = Employee::findOrFail($id);
     if(auth()->user()->time_zone=='Asia/Dubai')
      {
        $notification_count=Hrnotification::where('location','dubai')->where('status',1)->count();
      }
      else{
       $notification_count=Hrnotification::where('location','saudi')->where('status',1)->count(); 
      }

    $countries=Country::get();
    return view('admin.employee.show',compact('employee','notification_count','countries'));
  } 
 public function import(Request $req)
    {
      $file = $req->validate([
        'file' => 'required|mimes:xlsx'
      ]);
      $file = Request()->file('file');
      $results = Excel::import(new EmployeeImport,$file);
      return back();
    } 
 public function exportEmployeeData(){
    if(Request()->has('exportData')){
      return Excel::download(new EmployeeDataExport, 'EmployeeDataExport'.date('d-m-Y').'.xlsx');
    }  
 }
 public function employeeDetails($id)
  {
    $employee=Employee::findOrFail($id);
    $toDate = Carbon::parse($employee->passport_issue);
    $fromDate = Carbon::parse($employee->passport_exp);
    $days = $toDate->diffInDays($fromDate);
    
   if(auth()->user()->time_zone=='Asia/Dubai')
    {
   $notification_count=Hrnotification::where('status',1)->where('location','dubai')->count();
   }
   else
   {
   $notification_count=Hrnotification::where('status',1)->where('location','saudi')->count();
   }
  return view('admin.employee.employeedetails',compact('employee','days','notification_count'));
  }
  public function Notification()
  {
    if(auth()->user()->time_zone=='Asia/Dubai')
    {

    $notifications=Hrnotification::where('location','dubai')->orderBy('id','desc')->paginate(20);
    $notification_count=Hrnotification::where('location','dubai')->where('status',1)->count();
     }
  else{
       $notifications=Hrnotification::where('location','saudi')->orderBy('id','desc')->paginate(20);
       $notification_count=Hrnotification::where('location','saudi')->where('status',1)->count(); 
      }
    return view('admin.employee.notification',compact('notifications','notification_count'));
  
  }
  public function changeStatus(Request $request)
  {
    $result=Hrnotification::where('id',$request->get('id'))->first();
    if($result)
    {
    $result->status=0;
    $result->save();
    return response()->json($result);

    }
  }
  // public function chart()
  // {
  //    $data = DB::table('employees')
  //      ->select(
  //       DB::raw('status as status'),
  //       DB::raw('count(*) as number'))
  //      ->groupBy('status')
  //      ->get();
  //    $array[] = ['status', 'Number'];
  //    foreach($data as $key => $value)
  //    {
  //     $array[++$key] = [$value->status, $value->number];
  //    }
  //    return view('admin.employee.chart')->with('status', json_encode($array));
  // }
}
