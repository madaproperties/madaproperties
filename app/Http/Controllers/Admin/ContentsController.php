<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Content;
use Illuminate\Http\Request;
use App\Setting;

class ContentsController extends Controller
{
   
    public function index()
    {
      $status = Content::paginate(20);
      return view('admin.contents.index',[
        'status' => $status
      ]);
    }

    public function store(Request $request)
    {
      $data = $request->validate([
        'name' => 'required|max:255|unique:contents',
      ]);


      Content::create($data);
      
      return back()->withSuccess(__('site.success'));
    }

    public function update(Request $request,  $status)
    {
      $status = Content::findOrFail($status);
      $data = $request->validate([
        'name' => 'required|max:255|unique:contents,name,'.$status->id,
        'active' => 'required'
      ]);

      $status->update($data);
      return back()->withSuccess(__('site.success'));
    }

   
}
