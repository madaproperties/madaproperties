<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Campaing;
use Illuminate\Http\Request;
use App\Setting;

class CampaignsController extends Controller
{

    public function index()
    {
      $status = Campaing::paginate(20);
      return view('admin.campaigns.index',[
        'status' => $status
      ]);
    }

    public function store(Request $request)
    {
      $data = $request->validate([
        'name' => 'required|max:255|unique:campaigns',
        'cost' => 'required'
      ]);


      Campaing::create($data);

      return back()->withSuccess(__('site.success'));
    }

    public function update(Request $request,  $status)
    {
      $status = Campaing::findOrFail($status);
      $data = $request->validate([
        'name' => 'required|max:255|unique:campaigns,name,'.$status->id,
        'active' => 'required',
        'cost' => 'required'
      ]);

      $status->update($data);
      return back()->withSuccess(__('site.success'));
    }


}
