<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Project;
use Illuminate\Http\Request;
use App\Country;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      if(Request()->has('search')){
        $project = Project::where(function ($q){
          $this->filterPrams($q);
        })->paginate(20);
        $project_count = Project::where(function ($q){
          $this->filterPrams($q);
        })->count();
      }else{
        $project = Project::paginate(20);
        $project_count = Project::count();
      }
  
        $countries = Country::all();
        return view('admin.projects.index',[
          'projects' => $project,
          'countries' => $countries,
          'copyEnable' => true,
          'project_count' => $project_count,
        ]);
    }


    public function store(Request $request)
    {
        $data = $request->validate([
          'name_ar' => 'required|max:255|unique:projects',
          'name_en' => 'required|max:255|unique:projects',
          'country_id' => 'required'
        ]); 

        addHistory('Project',0,'added',$data);   

        Project::create($data);
        return back()->withSuccess(__('site.success'));
    }


    public function update(Request $request,  $id)
    {
      $project = Project::findOrFail($id);
      $data = $request->validate([
        'name_ar' => 'required|max:255|unique:projects,name_ar,'.$project->id,
        'name_en' => 'required|max:255|unique:projects,name_en,'.$project->id,
        'country_id' => 'required',
        'active' => 'required'
      ]);

      addHistory('Project Developer',$id,'updated',$data,$project);

      $project->update($data);
      return back()->withSuccess(__('site.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy( $project)
    {
        $project = Project::findOrFail($project);
        $project->delete();
        addHistory('Project',$id,'deleted');     
        return back()->withSuccess(__('site.success'));
    }
    
    public function getProjects(Request $request)
    {
        if(!$request->country) return false;
        
        $country = Country::where('id',$request->country)->first();
       
      $rows = Project::where('country_id',$request->country)
                            ->orderBy('name_en','ASC')
                            ->get();
                            
                            
    $others = Project::where('name_en','others')
    ->first();
    
    $others->name =  app()->getLocale() == 'ar' ? $others->name_ar : $others->name_en;
    
    
   
      
      foreach($rows as $row)
      {
        $row->name = app()->getLocale() == 'ar' ? $row->name_ar : $row->name_en;
      }
      
      
       $rows->prepend($others);
    
      
      return response()->json([
        'status' => 'success',
        'rows' => $rows,
        'countryCode' => $country->code
      ]);
    }

    private function filterPrams($q){

      if(Request()->has('search')){
        $uri = Request()->fullUrl();
        return $q->where('name_en','LIKE','%'. Request('search') .'%')
        ->orWhere('name_ar','LIKE','%'. Request('search') .'%')->get();
      }
    } 
}
