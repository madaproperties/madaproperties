<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Medium;
use Illuminate\Http\Request;
use App\Setting;

class MediumsController extends Controller
{
   
    public function index()
    {
      $status = Medium::paginate(20);
      return view('admin.mediums.index',[
        'status' => $status
      ]);
    }

    public function store(Request $request)
    {
      $data = $request->validate([
        'name' => 'required|max:255|unique:mediums',
      ]);


      Medium::create($data);
      
      return back()->withSuccess(__('site.success'));
    }

    public function update(Request $request,  $status)
    {
      $status = Medium::findOrFail($status);
      $data = $request->validate([
        'name' => 'required|max:255|unique:mediums,name,'.$status->id,
        'active' => 'required'
      ]);

      $status->update($data);
      return back()->withSuccess(__('site.success'));
    }

   
}
