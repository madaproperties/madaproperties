<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Project;
use DB;
use App\Country;
use App\PurposeType;
use Carbon\Carbon;
use App\ProjectData;
use App\ProjectName;
use App\ProjectDeveloper;
use App\ProjectDataExport;
use Maatwebsite\Excel\Facades\Excel;

class ProjectDataController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     function __construct() {
      $this->middleware('permission:project-list', ['only' => ['index']]);
      $this->middleware('permission:project-create', ['only' => ['create','store']]);
      $this->middleware('permission:project-edit', ['only' => ['show','edit']]);
      $this->middleware('permission:project-delete', ['only' => ['destroy']]);
      $this->middleware('permission:project-export', ['only' => ['exportProjectData']]);
    }	


  // index 
  public function index(){

    if(Request()->has('search') || Request()->has('ADVANCED')){
      $data = ProjectData::where(function ($q){
        $this->filterPrams($q);
      })->orderBy('id','desc');

      if(!checkLeader()){
        $data = $data->where('unit_country',1);
      }elseif(!checkLeaderUae()){
        $data = $data->where('unit_country',2);
      }
      $data_count = $data->count();
      $data = $data->paginate(20);
    }else{
      if(!checkLeader()){
        $data = ProjectData::where('country_id',1)->orderBy('id','desc')->paginate(20);
        $data_count = ProjectData::where('country_id',1)->count();
      }elseif(!checkLeaderUae()){
        $data = ProjectData::where('country_id',2)->orderBy('id','desc')->paginate(20);
        $data_count = ProjectData::where('country_id',2)->count();
      }else{
        $data = ProjectData::orderBy('id','desc')->paginate(20);
        $data_count = ProjectData::count();
      }
    }
    $projects = ProjectName::orderBy('name','ASC')->get();
    $developer = ProjectDeveloper::orderBy('name','ASC')->get();
    $purposetype = PurposeType::orderBy('type')->get();    

    return view('admin.projectdata.index_project',compact('data','data_count','purposetype','projects','developer'));
  }

  public function create()
  {
    $countries = Country::orderBy('name_en')->get();

    $collectCounties = [];
    $collectCounties = collect($collectCounties);

    foreach($countries as $index => $country)
    {
        if(in_array($country->name_en,toCountriess()) )
        {
            $collectCounties->push($country);
        }
    }


    $countries = $countries->filter(function($item) {
      return !in_array($item->name_en,toCountriess());
    });


    foreach($collectCounties as $topCountry)
    {
        $countries->prepend($topCountry);
    }
    // End Hundel Counties Sort
    $purposetype = PurposeType::orderBy('type')->get();    

    $projects = ProjectName::orderBy('name','ASC')->get();
    $developer = ProjectDeveloper::orderBy('name','ASC')->get();
 
    return view('admin.projectdata.create_project',compact('countries','purposetype','projects','developer'));
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
        "country_id"          => "required",
        "city_name"          => "required",
        "district_name"          => "required",
        "developer_id"          => "required",
        "unit_name"          => "required",
        "project_id"          => "required",
        "property_type"          => "required",
        "area_bua"          => "required",
        "area_plot"          => "required",
        "bedroom"          => "required",
        "price"          => "required",
        "completion_date"          => "required",
        "payment_status"          => "required",
        "govt_docs"          => "required",
      ]);


      $data['created_at'] = Carbon::now();

      $deal = ProjectData::create($data);
      return redirect(route('admin.project-data.index'))->withSuccess(__('site.success'));
  }

  public function update(Request $request,  $deal)
  {
    $deal = ProjectData::findOrFail($deal);

    $data = $request->validate([
      "country_id"          => "required",
      "city_name"          => "required",
      "district_name"          => "required",
      "developer_id"          => "required",
      "unit_name"          => "required",
      "project_id"          => "required",
      "property_type"          => "required",
      "area_bua"          => "required",
      "area_plot"          => "required",
      "bedroom"          => "required",
      "price"          => "required",
      "completion_date"          => "required",
      "payment_status"          => "required",
      "govt_docs"          => "required",
    ]);

    $data['updated_at'] = Carbon::now();

    $deal->update($data);
    return redirect(route('admin.project-data.index'))->withSuccess(__('site.success'));
  }


  public function destroy ($id)
  {
    $data = ProjectData::findOrFail($id);
    $data->delete();
    return back()->withSuccess(__('site.success'));
  }

  public function show($deal)
  {
    $deal = ProjectData::findOrFail($deal);
    // Start Hundel Counties Sort
    $countries = Country::orderBy('name_en')->get();

    $collectCounties = [];
    $collectCounties = collect($collectCounties);

    foreach($countries as $index => $country)
    {
        if(in_array($country->name_en,toCountriess()) )
        {
            $collectCounties->push($country);
        }
    }


    $countries = $countries->filter(function($item) {
      return !in_array($item->name_en,toCountriess());
    });


    foreach($collectCounties as $topCountry)
    {
        $countries->prepend($topCountry);
    }
    $purposetype = PurposeType::orderBy('type')->get();    

    $projects = ProjectName::orderBy('name','ASC')->get();
    $developer = ProjectDeveloper::orderBy('name','ASC')->get();

    return view('admin.projectdata.show_project',compact('deal','countries','purposetype','projects','developer'));

  } 
  
  private function filterPrams($q){

    if(request()->has('ADVANCED')){
      $uri = '';
      $feilds = request()->all();
      $allowedFeilds =[
        "project_id" ,
        "property_type" ,
        "bedroom" ,
        "developer_id" ,
        "payment_status" ,
      ];

      foreach($feilds as $feild => $value){
        if(in_array($feild,$allowedFeilds) AND !empty($value)){
            $q->where($feild,$value);
        }
      }
    }
  }  

  public function exportProjectData(){
    if(Request()->has('exportData')){
      return Excel::download(new ProjectDataExport, 'ProjectDataExport_'.date('d-m-Y').'.xlsx');
    }  
  }

}
