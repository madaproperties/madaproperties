<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\LastMileConversion;
use Illuminate\Http\Request;

class LastMileConversionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $miles = LastMileConversion::paginate(20);
        return view('admin.miles.index',[
          'miles' => $miles
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
        'name_ar' => 'required|max:255|unique:last_mile_conversions',
        'name_en' => 'required|max:255|unique:last_mile_conversions',
      ]);

      addHistory('Last Mile Conversion',0,'added',$data);   

      LastMileConversion::create($data);
      return back()->withSuccess(__('site.success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LastMileConversion  $lastMileConversion
     * @return \Illuminate\Http\Response
     */
    public function show(LastMileConversion $lastMileConversion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LastMileConversion  $lastMileConversion
     * @return \Illuminate\Http\Response
     */
    public function edit(LastMileConversion $lastMileConversion)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LastMileConversion  $lastMileConversion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
      $mile = LastMileConversion::findOrFail($id);
      $data = $request->validate([
        'name_ar' => 'required|max:255|unique:last_mile_conversions,name_ar,'.$mile->id,
        'name_en' => 'required|max:255|unique:last_mile_conversions,name_en,'.$mile->id,
        'active' => 'required'
      ]);


      addHistory('Last Mile Conversion',$id,'updated',$data,$mile);

      $mile->update($data);
      return back()->withSuccess(__('site.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LastMileConversion  $lastMileConversion
     * @return \Illuminate\Http\Response
     */
    public function destroy( $mile)
    {
      $mile = Project::findOrFail($mile);
      $mile->delete();
      addHistory('Project',$id,'deleted');           
      return back()->withSuccess(__('site.success'));
    }
}
