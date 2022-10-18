<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Features;
use Spatie\Permission\Models\Role;

class FeaturesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     function __construct()
     {
          $this->middleware('permission:feature-list|feature-create|feature-edit|feature-delete', ['only' => ['index','store']]);
          $this->middleware('permission:feature-create', ['only' => ['create','store']]);
          $this->middleware('permission:feature-edit', ['only' => ['show','edit']]);
          $this->middleware('permission:feature-delete', ['only' => ['destroy']]);
          $this->middleware('permission:feature-export', ['only' => ['exportDataFeatures']]);
     }
     
   

  // index 
  public function index(){
    if(Request()->has('search')){
      $data = Features::where(function ($q){
        $this->filterPrams($q);
      })->orderBy('feature_type','asc');

      $features_count = $data->count();
      $features = $data->paginate(20);
    }else{
        $features = Features::orderBy('feature_type','asc')->paginate(20);
        $features_count = Features::count();
    }

    return view('admin.features.index',compact('features','features_count'));
  }

  public function create()
  {
    return view('admin.features.create');
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
      "feature_name"   => "required",
      "feature_type" => "required"
    ]);

    $data['created_at'] = Carbon::now();

    addHistory('Features',0,'added',$data);

    $deal = Features::create($data);
    return redirect(route('admin.features.index'))->withSuccess(__('site.success'));
  }

  public function update(Request $request,  $id)
  {

    $deal = Features::findOrFail($id);

    $data = $request->validate([
      "feature_name"   => "required",
      "feature_type" => "required"
    ]);
    $data['updated_at'] = Carbon::now();
    addHistory('Features',$id,'updated',$data,$deal);

    $deal->update($data);
    return redirect(route('admin.features.index'))->withSuccess(__('site.success'));
  }


  public function destroy ($id)
  {
    $data = Features::findOrFail($id);
    $data->delete();
    addHistory('Features',$id,'deleted');    
    return back()->withSuccess(__('site.success'));
  }

  public function show($id)
  {
    $feature = Features::findOrFail($id);
    return view('admin.features.show',compact('feature'));

  }  

  private function filterPrams($q){

    if(Request()->has('search')){
      $uri = Request()->fullUrl();
      return $q->where('feature_name','LIKE','%'. Request('search') .'%')
      ->get();
    }
  }  

  public function exportDataFeatures(){
    if(Request()->has('exportData')){
      return Excel::download(new featuresExport, 'featuresReport_'.date('d-m-Y').'.xlsx');
    }  
  }
}
