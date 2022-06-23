<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Task;
use Illuminate\Http\Request;
use App\Contact;
use Carbon\Carbon;

class TasksController extends Controller
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
          'name'        => 'required|max:255',
          'date'        => 'required|max:255',
          'time'        => 'required|max:255',
          'description' => 'nullable',
          'contact_id'  => 'required',
          'type'        => 'required',
        ]);

        $data['user_id'] = auth()->id();
        $task = Task::create($data);
        $action = auth()->user()->name. __('site.add new') . __('site.task');
        $this->newActivity($request->contact_id,auth()->id(),$action,'Task',$task->id,$data['date']);

        Contact::where('id',$request->contact_id)->update([
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
        
      $task = Task::findOrFail($task);
      
      $data = $request->validate([
        'name'        => 'nullable|max:255',
        'date'        => 'required|max:255',
        'time'        => 'required|max:255',
        'description' => 'nullable',
        'contact_id'  => 'required',
        'type'        => 'required',
      ]);


      $task->update($data);
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
