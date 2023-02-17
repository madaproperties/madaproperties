<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Project;
use DB;
use App\Country;
use App\Zones;
use App\PurposeType;
use Carbon\Carbon;
use App\ProjectData;
use App\ProjectName;
use App\ProjectDeveloper;
use App\ProjectDataExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProjectDataImport;
use App\User;
use App\Districts;
use App\SecondaryProject;
use App\SecondaryImages;
use App\SecondaryFloorPlan;
class SecondaryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     function __construct() {
      $this->middleware('permission:secondary-project', ['only' => ['index']]);
      $this->middleware('permission:secondary-create', ['only' => ['create','store']]);
      $this->middleware('permission:secondary-edit', ['only' => ['show','edit']]);
      $this->middleware('permission:secondary-delete', ['only' => ['destroy']]);
      // $this->middleware('permission:secondary-export', ['only' => ['exportProjectData']]);
    }	

 // index 
  public function index(Request $request){
    if(Request()->has('ADVANCED')){
      $data=SecondaryProject::orwhere('assign_to',$request->get('agent_id'))
                          ->OrWhere('zone_id',$request->get('zone_id'))
                          ->OrWhere('type',$request->get('property_type'))
                          ->OrWhere('district_id',$request->get('district_id'))
                          ->orderBy('id','desc');
    }
    else
    {
    $data=SecondaryProject::orderBy('id','desc');   
    }
   $datas=$data->paginate(20);
   $purposetypes = PurposeType::orderBy('type')->get();
   $agents=User::where('rule','sales')->where('time_zone','Asia/Riyadh')->get();
   $zones=Zones::get();
   $districts=Districts::get();
    return view('admin.secondary.index',compact('datas','purposetypes','agents','zones','districts'));
   }

  public function create()
  {
    $countries = Country::where('id',1)->first();
    $zones=Zones::get();
    $purposetypes = PurposeType::orderBy('type')->get();
    $sellers=User::where('rule','sales')->where('time_zone','Asia/Riyadh')->get();
    return view('admin.secondary.create_project',compact('countries','zones','purposetypes','sellers'));
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
        "unit_name"          => "nullable",
        "country_id"          => "required",
        "city"          => "required",
        "zone_id"          => "required",
        "district_id"          => "required",
        "project_name"          => "nullable",
        "developer_name"          => "nullable",
        "type"          => "nullable",
        "price"          => "nullable",
        "area_bua"          => "required",
        "area_plot"          => "nullable",
        "bedroom"          => "nullable",
        "bathroom"          => "nullable",
        "living_room"      =>"nullable",
        "guest_room"    =>"nullable",
        "floor_no"  => "nullable",
        "no_of_floor"=>"nullable",
        "completion_date"          => "nullable",
        "parking"          => "nullable",
        "assign_to"    =>"nullable" ,  
        "furniture"  =>"nullable",
        "facing" =>"nullable",
        "street_width"=>"nullable",
        "border_length"=>"nullable",
        "border_depth"=>"nullable",
        "description" =>"nullable",
      ]);
       $data['created_at'] = Carbon::now();
       $result=SecondaryProject::create($data);

        if($request->file('floorplan'))
       {

         $floor= $request->file('floorplan');
         foreach ($floor as $image) {
           $md5Name = md5_file($image->getRealPath());
           $guessExtension = $image->guessExtension();
           $file = $image->move('public/uploads/secondary', $md5Name.'.'.$guessExtension);
           $filename = $md5Name.'.'.$guessExtension;
           $floor_plan = new SecondaryFloorPlan;
           $floor_plan->image = $filename;
           $floor_plan->project_id = $result->id;
           $floor_plan->save();
         }
      }
       if($request->file('photos'))
       {
         foreach ($request->file('photos') as $imagefile) {
          $md5Name = md5_file($imagefile->getRealPath());
          $guessExtension = $imagefile->guessExtension();
          $file = $imagefile->move('public/uploads/secondary', $md5Name.'.'.$guessExtension);
          $filename = $md5Name.'.'.$guessExtension;
          $image = new SecondaryImages;
          $image->image_link = $filename;
          $image->project_id = $result->id;
          $image->save();
        }
       }
      return redirect(route('admin.secondary.index'))->withSuccess(__('site.success'));
  }
  public function show($id)
  {
    $data=SecondaryProject::findOrFail($id);
    $data_images=SecondaryImages::where('project_id',$id)->get();
    $data_floorplan=SecondaryFloorPlan::where('project_id',$id)->get();
    $countries = Country::where('id',1)->first();
    $zones=Zones::get();
    $districts=Districts::get();
    $purposetypes = PurposeType::orderBy('type')->get();
    $sellers=User::where('rule','sales')->where('time_zone','Asia/Riyadh')->get();
    return view('admin.secondary.show',compact('data','countries','zones','purposetypes','districts','sellers','data_images','data_floorplan'));
  }

  public function update(Request $request,  $id)
  {

    $project = SecondaryProject::findOrFail($id);
    // dd($project);
     $data = $request->validate([
        "unit_name"          => "nullable",
        "country_id"          => "required",
        "city"          => "required",
        "zone_id"          => "required",
        "district_id"          => "required",
        "project_name"          => "nullable",
        "developer_name"          => "nullable",
        "type"          => "nullable",
        "price"          => "nullable",
        "area_bua"          => "required",
        "area_plot"          => "required",
        "bedroom"          => "nullable",
        "bathroom"          => "nullable",
        "living_room"      =>"nullable",
        "guest_room"    =>"nullable",
        "floor_no"  => "nullable",
        "no_of_floor"=>"nullable",
        "completion_date"          => "nullable",
        "parking"          => "nullable",
        "furniture"  =>"nullable",
        "assign_to" =>"nullable",
        "facing" =>"nullable",
        "street_width"=>"nullable",
        "border_length"=>"nullable",
        "border_depth"=>"nullable",
        "description" =>"nullable",
      ]);
    
    $data['updated_at'] = Carbon::now();
    $project->update($data);
    // dd($request->file('floorplan'));
    if($request->file('floorplan'))
    {
      $floor= $request->file('floorplan');
    foreach ($floor as $image) {
         $md5Name = md5_file($image->getRealPath());
         $guessExtension = $image->guessExtension();
         $file = $image->move('public/uploads/secondary', $md5Name.'.'.$guessExtension);
         $filename = $md5Name.'.'.$guessExtension;
         $floor_plan = new SecondaryFloorPlan;
         $floor_plan->image = $filename;
         $floor_plan->project_id = $id;
         $floor_plan->save();
       }
      }
       if($request->file('photos'))
    {
    foreach ($request->file('photos') as $imagefile) {
         $md5Name = md5_file($imagefile->getRealPath());
         $guessExtension = $imagefile->guessExtension();
         $file = $imagefile->move('public/uploads/secondary', $md5Name.'.'.$guessExtension);
         $filename = $md5Name.'.'.$guessExtension;
         $image = new SecondaryImages;
         $image->image_link = $filename;
         $image->project_id = $id;
         $image->save();
    }
  }
    return redirect(route('admin.secondary.index'))->withSuccess(__('site.success'));
  }
  public function brochure($id)
  {
    $project=SecondaryProject::where('id',$id)->first();
    $project_images=SecondaryImages::where('project_id',$id)->get();
    $floor_plan=SecondaryFloorPlan::where('project_id',$id)->get();
    $first_image=SecondaryImages::where('project_id',$id)->first();
    return view('admin.secondary.brochure',compact('project','project_images','floor_plan','first_image'));

  }

  public function destroy ($id)
  {
    $data = SecondaryProject::findOrFail($id);
    $data->delete();
    $data_images=SecondaryImages::findOrFail($id);
    $data_images->delete();
    $data_floorplan=SecondaryFloorPlan::findOrFail($id);
    $data_floorplan->delete();
    return back()->withSuccess(__('site.success'));
  }

  function fetchDistrict(Request $request)
  {
    $zone_id=$request->get('zone_id');
       $data['districts']=Districts::where('zone_id',$zone_id)->get();
       return response()->json($data); 
  }
  function deleteImages(Request $request)
  {
    $image_id=$request->get('id');
    $result=SecondaryImages::where('id',$image_id)->delete();
    if($result)
    {
      $data['res']=6000;
      return response()->json($data);
    }
  } 
  
   function deleteFloorplan(Request $request)
  {
    $image_id=$request->get('id');
    $result=SecondaryFloorPlan::where('id',$image_id)->delete();
     if($result)
    {
      $data['res']=6000;
      return response()->json($data);
    }
  } 
}
