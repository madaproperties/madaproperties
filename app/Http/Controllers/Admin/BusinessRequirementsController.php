<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\BusinessTask;
use Illuminate\Http\Request;
use App\BusinessDevelopment;
use App\BusinessRequirements;
use Carbon\Carbon;

class BusinessRequirementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
          'contact_id'  => 'nullable',
          'city_id'        => 'nullable',
          'zone_id'        => 'nullable',
          'district_id'        => 'nullable',
          'expanding_date' => 'nullable',
          'business_id'  => 'nullable',
          'target_size_from'        => 'nullable',
          'target_size_to'        => 'nullable',
          'street_info'        => 'nullable',
          'status'        => 'nullable',
          'expanding_year'        => 'nullable',
          'description'        => 'nullable',
          'requirement_id'    => 'nullable',
          'business_type'     =>'nullable',
        ]);
 
        $data['user_id'] = auth()->id(); 
        
        $requirement = BusinessRequirements::create($data);
        $action = auth()->user()->name.' '. __('site.add new') .' '. __('site.requirement');
        $this->newBusinessDevelopmentActivity($request->commercial_id,auth()->id(),$action,'Requirement',$requirement->id,null);

        BusinessDevelopment::where('id',$request->business_id)->update([
        'updated_at' => Carbon::now()
        ]);
    
        return back()->withSuccess(__('site.success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $task)
    {
        
      $requirement = BusinessRequirements::findOrFail($task);
      
      $data = $request->validate([
        'contact_id'  => 'nullable',
        'city_id'        => 'nullable',
        'zone_id'        => 'nullable',
        'district_id'        => 'nullable',
        'expanding_date' => 'nullable',
        'business_id'  => 'nullable',
        'target_size_from'        => 'nullable',
        'target_size_to'        => 'nullable',
        'street_info'        => 'nullable',
        'status'        => 'nullable',
        'expanding_year'        => 'nullable',
        'description'        => 'nullable',
        'business_type'     =>'nullable',
      ]);


      $requirement->update($data);

      $action = auth()->user()->name.' '. __('site.updated') .' '. __('site.requirement');
      $this->newBusinessDevelopmentActivity($request->business_id,auth()->id(),$action,'Requirement',$requirement->id,null);


      return back()->withSuccess(__('site.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
