<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Status;
use Illuminate\Http\Request;
use App\Setting;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $status = Status::paginate(20);
      return view('admin.status.index',[
        'status' => $status
      ]);
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
        'name_ar' => 'required|max:255|unique:projects',
        'name_en' => 'required|max:255|unique:projects',
        'weight' => 'nullable'
      ]);


      Setting::create([
        'name' => str_replace(' ', '', $data['name_en']),
        'value' => '1'
      ]);
      
      Status::create($data);
      return back()->withSuccess(__('site.success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function show(Status $status)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function edit(Status $status)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $status)
    {
      $status = Status::findOrFail($status);
      $data = $request->validate([
        'name_ar' => 'required|max:255|unique:projects,name_ar,'.$status->id,
        'name_en' => 'required|max:255|unique:projects,name_en,'.$status->id,
        'active' => 'required',
        'weight' => 'nullable'
      ]);
    

      $status->update($data);
      return back()->withSuccess(__('site.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function destroy(Status $status)
    {
        //
    }
}
