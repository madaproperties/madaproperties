<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Project;
use DB;
use App\Country;
use App\PurposeType;
use Carbon\Carbon;
use App\ProjectDeveloper;

class ProjectDeveloperController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     function __construct() {
      $this->middleware('permission:project-developer-list', ['only' => ['index']]);
      $this->middleware('permission:project-developer-create', ['only' => ['create','store']]);
      $this->middleware('permission:project-developer-edit', ['only' => ['show','edit']]);
      $this->middleware('permission:project-developer-delete', ['only' => ['destroy']]);
    }	


  // index 
  // index 
  public function index(){

    if(Request()->has('search')){
        $data = ProjectDeveloper::where('name','LIKE','%'. Request('search') .'%')->orderBy('id','desc')->paginate(20);
        $data_count = ProjectDeveloper::where('name','LIKE','%'. Request('search') .'%')->count();
    }else{
        $data = ProjectDeveloper::orderBy('id','desc')->paginate(20);
        $data_count = ProjectDeveloper::count();
    }


    return view('admin.projectdata.index_project_developer',compact('data','data_count'));
  }

  public function create()
  {
    return view('admin.projectdata.create_project_developer');
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
        "iban"          => "required|max:191",
        "bank_name"          => "required|max:250",
        "developer_logo"     =>"nullable",
      ]);
      $data['created_at'] = Carbon::now();
      if($request->file('developer_logo')){
           $file = Storage::disk('s3')->putFile('uploads/developer_logo', $request->file('developer_logo'));
           $path="https://mada-properties-staging.s3.eu-west-1.amazonaws.com/".$file;     
           $data['developer_logo'] = $path;
      }

      addHistory('Project Developer',0,'added',$data);   

      $deal = ProjectDeveloper::create($data);
      return redirect(route('admin.project-developer.index'))->withSuccess(__('site.success'));
  }

  public function update(Request $request,  $id)
  {
    $deal = ProjectDeveloper::findOrFail($id);
    $data = $request->validate([
      "name"          => "required|max:191",
      "iban"          => "required|max:191",
      "bank_name"          => "required|max:250",
      "developer_logo"     =>"nullable",
  ]);
    $data['updated_at'] = Carbon::now();
     if($request->file('developer_logo')){
        $md5Name = md5_file($request->file('developer_logo')->getRealPath());
        $guessExtension = $request->file('developer_logo')->guessExtension();
        $file = $request->file('developer_logo')->move('public/uploads/projectData', $md5Name.'.'.$guessExtension);     
        $data['developer_logo'] = $md5Name.'.'.$guessExtension;
      }


    addHistory('Project Developer',$id,'updated',$data,$deal);

    $deal->update($data);
    return redirect(route('admin.project-developer.index'))->withSuccess(__('site.success'));
  }


  public function destroy ($id)
  {
    $data = ProjectDeveloper::findOrFail($id);
    $data->delete();
    addHistory('Project Developer',$id,'deleted');    
    return back()->withSuccess(__('site.success'));
  }

  public function show($deal)
  {
    $deal = ProjectDeveloper::findOrFail($deal);
    return view('admin.projectdata.show_project_developer',compact('deal'));

  }  

}
