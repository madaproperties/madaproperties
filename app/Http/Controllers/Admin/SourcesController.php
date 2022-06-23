<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Source;
use Illuminate\Http\Request;
use App\Setting;
use Spatie\Permission\Models\Role;

class SourcesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     function __construct()
     {
          // $this->middleware('permission:source-list|source-create|source-edit|source-delete', ['only' => ['index','store']]);
          // $this->middleware('permission:source-create', ['only' => ['create','store']]);
          // $this->middleware('permission:source-edit', ['only' => ['edit','update']]);
          // $this->middleware('permission:source-delete', ['only' => ['destroy']]);
     }
     
   
    public function index()
    {
      $status = Source::paginate(20);
      return view('admin.sources.index',[
        'status' => $status
      ]);
    }

    public function store(Request $request)
    {
      $data = $request->validate([
        'name' => 'required|max:255|unique:campaigns',
      ]);


      Source::create($data);
      
      return back()->withSuccess(__('site.success'));
    }

    public function update(Request $request,  $status)
    {
      $status = Source::findOrFail($status);
      $data = $request->validate([
        'name' => 'required|max:255|unique:campaigns,name,'.$status->id,
        'active' => 'required'
      ]);

      $status->update($data);
      return back()->withSuccess(__('site.success'));
    }

   
}
