<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Campaing;
use Illuminate\Http\Request;
use App\Setting;
use App\Project;

class CampaignsController extends Controller
{

    public function index()
    {
      $status = Campaing::paginate(20);
      $projects = Project::orderBy('name_en','ASC')->get();
      return view('admin.campaigns.index',[
        'status' => $status,
        'copyEnable' => true,
        'projects' => $projects
      ]);
    }

    public function store(Request $request)
    {
      $data = $request->validate([
        'name' => 'required|max:255|unique:campaigns',
        'cost' => 'required',
        'project_id' => 'required'
      ]);


      addHistory('Campaign',0,'added',$data);

      Campaing::create($data);

      return back()->withSuccess(__('site.success'));
    }

    public function update(Request $request,  $id)
    {
      $status = Campaing::findOrFail($id);
      $data = $request->validate([
        'name' => 'required|max:255|unique:campaigns,name,'.$status->id,
        'active' => 'required',
        'cost' => 'required',
        'project_id' => 'required'
      ]);

      addHistory('Campaign',$id,'updated',$data,$status);

      $status->update($data);
      return back()->withSuccess(__('site.success'));
    }


}
