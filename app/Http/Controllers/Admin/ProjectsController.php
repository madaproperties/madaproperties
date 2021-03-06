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
        $project = Project::paginate(20);
        $countries = Country::all();
        
        return view('admin.projects.index',[
          'projects' => $project,
          'countries' => $countries
        ]);
    }


    public function store(Request $request)
    {
        $data = $request->validate([
          'name_ar' => 'required|max:255|unique:projects',
          'name_en' => 'required|max:255|unique:projects',
          'country_id' => 'required'
        ]); 

        Project::create($data);
        return back()->withSuccess(__('site.success'));
    }


    public function update(Request $request,  $project)
    {
      $project = Project::findOrFail($project);
      $data = $request->validate([
        'name_ar' => 'required|max:255|unique:projects,name_ar,'.$project->id,
        'name_en' => 'required|max:255|unique:projects,name_en,'.$project->id,
        'country_id' => 'required',
        'active' => 'required'
      ]);

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
}
