<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Project;
use DB;
use App\Country;
use App\PurposeType;
use Carbon\Carbon;
use App\ProjectName;

class ProjectNameController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     function __construct() {
      $this->middleware('permission:project-name-list', ['only' => ['index']]);
      $this->middleware('permission:project-name-create', ['only' => ['create','store']]);
      $this->middleware('permission:project-name-edit', ['only' => ['show','edit']]);
      $this->middleware('permission:project-name-delete', ['only' => ['destroy']]);
    } 


  // index 
  public function index(){

    if(Request()->has('search')){
        $data = ProjectName::where('name','LIKE','%'. Request('search') .'%')->orderBy('id','desc')->paginate(20);
        $data_count = ProjectName::where('name','LIKE','%'. Request('search') .'%')->count();
    }else{
        $data = ProjectName::orderBy('id','desc')->paginate(20);
        $data_count = ProjectName::count();
    }


    return view('admin.projectdata.index_project_name',compact('data','data_count'));
  }

  public function create()
  {
    return view('admin.projectdata.create_project_name');
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
        "name"          => "required|max:191",
        "image"         => "nullable",
        "brochure"      =>"nullable",
        "video"=> "nullable",
        "payment_plan"=>"nullable",
        "project_logo"=>"nullable",
        "iban"=>"nullable",   //added by fazal 02-04-23
        "bank_name" =>"nullable",   //added by fazal 02-04-23
        "is_active" =>"nullable", //Added by Lokesh
        "account_name" =>"nullable", //added by fazal on 06-09-24

      ]);
      $data['created_at'] = Carbon::now();

      addHistory('Project Name',0,'added',$data);   
       if($request->file('image')){
        $md5Name = md5_file($request->file('image')->getRealPath());
        $guessExtension = $request->file('image')->guessExtension();
        $file = $request->file('image')->move('public/uploads/projectData', $md5Name.'.'.$guessExtension);     
        $data['image'] = $md5Name.'.'.$guessExtension;
      }
      if($request->file('project_logo')){ // added by fazal 29-3
        $md5Name = md5_file($request->file('project_logo')->getRealPath());
        $guessExtension = $request->file('project_logo')->guessExtension();
        $file = $request->file('project_logo')->move('public/uploads/projectData', $md5Name.'.'.$guessExtension);     
        $data['project_logo'] = $md5Name.'.'.$guessExtension;
      }
      if($request->file('brochure')){
        $md5Name = md5_file($request->file('brochure')->getRealPath());
        $guessExtension = $request->file('brochure')->guessExtension();
        $file = $request->file('brochure')->move('public/uploads/projectData', $md5Name.'.'.$guessExtension);     
        $data['brochure'] = $md5Name.'.'.$guessExtension;
      }
      if($request->file('video')){
        $md5Name = md5_file($request->file('video')->getRealPath());
        $guessExtension = $request->file('video')->guessExtension();
        $file = $request->file('video')->move('public/uploads/projectData', $md5Name.'.'.$guessExtension);     
        $data['video'] = $md5Name.'.'.$guessExtension;
      }
      if($request->file('payment_plan')){
        $md5Name = md5_file($request->file('payment_plan')->getRealPath());
        $guessExtension = $request->file('payment_plan')->guessExtension();
        $file = $request->file('payment_plan')->move('public/uploads/projectData', $md5Name.'.'.$guessExtension);     
        $data['payment_plan'] = $md5Name.'.'.$guessExtension;
      }

      $deal = ProjectName::create($data);
      return redirect(route('admin.project-name.index'))->withSuccess(__('site.success'));
  }

  public function update(Request $request,  $id)
  {
    $deal = ProjectName::findOrFail($id);
    $data = $request->validate([
      "name"          => "required|max:191",
      "image"         => "nullable",
        "brochure"      =>"nullable",
        "video"=> "nullable",
        "payment_plan"=>"nullable",
        "project_logo"=>"nullable",
        "iban"=>"nullable",   //added by fazal 02-04-23
        "bank_name" =>"nullable", //added by fazal 02-04-23
        "is_active" =>"nullable", //Added by Lokesh
        "account_name" =>"nullable", //added by fazal on 06-09-24
    ]);
    $data['updated_at'] = Carbon::now();
    if($request->file('image')){
        $md5Name = md5_file($request->file('image')->getRealPath());
        $guessExtension = $request->file('image')->guessExtension();
        $file = $request->file('image')->move('public/uploads/projectData', $md5Name.'.'.$guessExtension);     
        $data['image'] = $md5Name.'.'.$guessExtension;
      }
        if($request->file('project_logo')){ // added by fazal 29-3
        $md5Name = md5_file($request->file('project_logo')->getRealPath());
        $guessExtension = $request->file('project_logo')->guessExtension();
        $file = $request->file('project_logo')->move('public/uploads/projectData', $md5Name.'.'.$guessExtension);     
        $data['project_logo'] = $md5Name.'.'.$guessExtension;
      }
      if($request->file('brochure')){
        $md5Name = md5_file($request->file('brochure')->getRealPath());
        $guessExtension = $request->file('brochure')->guessExtension();
        $file = $request->file('brochure')->move('public/uploads/projectData', $md5Name.'.'.$guessExtension);     
        $data['brochure'] = $md5Name.'.'.$guessExtension;
      }
      if($request->file('video')){
        $md5Name = md5_file($request->file('video')->getRealPath());
        $guessExtension = $request->file('video')->guessExtension();
        $file = $request->file('video')->move('public/uploads/projectData', $md5Name.'.'.$guessExtension);     
        $data['video'] = $md5Name.'.'.$guessExtension;
      }
      if($request->file('payment_plan')){
        $md5Name = md5_file($request->file('payment_plan')->getRealPath());
        $guessExtension = $request->file('payment_plan')->guessExtension();
        $file = $request->file('payment_plan')->move('public/uploads/projectData', $md5Name.'.'.$guessExtension);     
        $data['payment_plan'] = $md5Name.'.'.$guessExtension;
      }

    addHistory('Project Name',$id,'updated',$data,$deal);

    $deal->update($data);
    return redirect(route('admin.project-name.index'))->withSuccess(__('site.success'));
  }


  public function destroy ($id)
  {
    $data = ProjectName::findOrFail($id);
    $data->delete();
    addHistory('Project Name',$id,'deleted');    
    return back()->withSuccess(__('site.success'));
  }

  public function show($deal)
  {
    $deal = ProjectName::findOrFail($deal);
    return view('admin.projectdata.show_project_name',compact('deal'));

  }  

}
