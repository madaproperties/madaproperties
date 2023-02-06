<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PurposeType;
use Illuminate\Http\Request;

class PurposeTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $rows = PurposeType::paginate(20);
      return view('admin.purposetype.index',[
        'rows' => $rows
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
          'type' => 'required|max:255',
          'type_ar' => 'required|max:255'
        ]);

        addHistory('Purpose Type',0,'added',$data);   

        PurposeType::create($data);
        return back()->withSuccess(__('site.success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PurposeType  $purposeType
     * @return \Illuminate\Http\Response
     */
    public function show(PurposeType $purposeType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PurposeType  $purposeType
     * @return \Illuminate\Http\Response
     */
    public function edit(PurposeType $purposeType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PurposeType  $purposeType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
      $purposeType = PurposeType::findOrFail($id);
      $data = $request->validate([
        'type' => 'required|max:255',
        'type_ar' => 'required|max:255'
      ]);

      addHistory('Purpose Type',$id,'updated',$data,$purposeType);

      $purposeType->update($data);
      return back()->withSuccess(__('site.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PurposeType  $purposeType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $purposeType = PurposeType::findOrFail($id);
        $purposeType->delete();
        addHistory('Purpose Type',$id,'deleted');     
        return back()->withSuccess(__('site.success'));
    }
}
