<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\CommercialTask;
use Illuminate\Http\Request;
use App\Commercial;
use App\CommercialRequirements;
use Carbon\Carbon;

class CommercialRequirementsController extends Controller
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
          'commercial_id'  => 'nullable',
          'target_size'        => 'nullable',
          'street_info'        => 'nullable',
          'status'        => 'nullable',
          'expanding_year'        => 'nullable',
          'description'        => 'nullable',
        ]);

        $data['user_id'] = auth()->id();
        
        $requirement = CommercialRequirements::create($data);
        $action = auth()->user()->name.' '. __('site.add new') .' '. __('site.requirement');
        $this->newCommercialActivity($request->commercial_id,auth()->id(),$action,'Requirement',$requirement->id,null);

        Commercial::where('id',$request->commercial_id)->update([
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
        
      $requirement = CommercialRequirements::findOrFail($task);
      
      $data = $request->validate([
        'contact_id'  => 'nullable',
        'city_id'        => 'nullable',
        'zone_id'        => 'nullable',
        'district_id'        => 'nullable',
        'expanding_date' => 'nullable',
        'commercial_id'  => 'nullable',
        'target_size'        => 'nullable',
        'street_info'        => 'nullable',
        'status'        => 'nullable',
        'expanding_year'        => 'nullable',
        'description'        => 'nullable',
      ]);


      $requirement->update($data);

      $action = auth()->user()->name.' '. __('site.updated') .' '. __('site.requirement');
      $this->newCommercialActivity($request->commercial_id,auth()->id(),$action,'Requirement',$requirement->id,null);


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
