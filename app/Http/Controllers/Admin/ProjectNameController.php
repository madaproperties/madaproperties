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
      ]);
      $data['created_at'] = Carbon::now();
      $deal = ProjectName::create($data);
      return redirect(route('admin.project-name.index'))->withSuccess(__('site.success'));
  }

  public function update(Request $request,  $deal)
  {
    $deal = ProjectName::findOrFail($deal);
    $data = $request->validate([
      "name"          => "required|max:191",
    ]);
    $data['updated_at'] = Carbon::now();
    $deal->update($data);
    return redirect(route('admin.project-name.index'))->withSuccess(__('site.success'));
  }


  public function destroy ($id)
  {
    $data = ProjectName::findOrFail($id);
    $data->delete();
    return back()->withSuccess(__('site.success'));
  }

  public function show($deal)
  {
    $deal = ProjectName::findOrFail($deal);
    return view('admin.projectdata.show_project_name',compact('deal'));

  }  

}
