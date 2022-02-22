<?php

namespace App\Http\Controllers\Admin;

use App\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Project;
use DB;
use App\LastMileConversion;
use App\City;
use App\Country;
use App\User;
use App\Activity;
use App\Task;
use App\Note;
use App\Log;
use App\Meeting;
use App\Status;
use App\Currency;
use App\PurposeType;
use Carbon\Carbon;
use App\Campaing;
use App\Content;
use App\Source;
use App\Medium;
use App\Deal;
use Maatwebsite\Excel\Facades\Excel;
use App\DealProjectExport;
use App\Developer;
use App\DealProject;

class DealProjectController extends Controller
{

  // index 
  public function index(){
    if(userRole() != 'admin'){
      return abort(404);
    }
   
    if(Request()->has('exportData')){
      return Excel::download(new DealProjectExport, 'DealProjectsReport.xlsx');
    }  

    if(Request()->has('search')){
      $deals = DealProject::where('project_name','LIKE','%'. Request('search') .'%')->orderBy('id','desc')->paginate(20);
      $deals_count = DealProject::where('project_name','LIKE','%'. Request('search') .'%')->count();
        
    }else{
      $deals = DealProject::orderBy('id','desc')->paginate(20);
      $deals_count = DealProject::count();
    }


    return view('admin.deals.index_project',compact('deals','deals_count'));
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

    return view('admin.deals.create_project',compact('countries'));
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
        "project_name"            => "required",
      ]);


      $data['created_at'] = Carbon::now();

      $deal = DealProject::create($data);
      return redirect(route('admin.deal_project.index'))->withSuccess(__('site.success'));
  }

  public function update(Request $request,  $deal)
  {
    $deal = DealProject::findOrFail($deal);

    $data = $request->validate([
      "country_id"          => "required",
      "project_name"            => "required",
    ]);

    $data['updated_at'] = Carbon::now();

    $deal->update($data);
    return redirect(route('admin.deal_project.index'))->withSuccess(__('site.success'));
  }


  public function destroy ($id)
  {
    if(userRole() != 'admin'){
      return abort(404);
    }
    $data = DealProject::findOrFail($id);
    $data->delete();
    return back()->withSuccess(__('site.success'));
  }

  public function show($deal)
  {
    $deal = DealProject::findOrFail($deal);
    if(userRole() != 'admin'){
      return abort(404);
    }
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

    return view('admin.deals.show_project',compact('deal','countries'));

  }  

  public function getDealProjects(Request $request)
  {
    if(!$request->country) return false;
      
    $country = Country::where('id',$request->country)->first();
  
    $rows = DealProject::where('country_id',$request->country)
                          ->orderBy('project_name','ASC')
                          ->get();
                          
    foreach($rows as $row)
    {
      $row->name = $row->project_name;
    }
    return response()->json([
      'status' => 'success',
      'rows' => $rows,
      'countryCode' => $country->code
    ]);
  }

}
