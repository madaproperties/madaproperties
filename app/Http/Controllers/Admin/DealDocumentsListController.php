<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Project;
use DB;
use App\DealDocuments;
use App\Deal;
use App\DealProject;
use Illuminate\Support\Facades\Storage;

class DealDocumentsListController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct(){
      $this->middleware('permission:deal-documents-list', ['only' => ['index','dealList','dealDocumentsList']]);
    }  
  // index 
  public function index(){
  
    $project_ids = Deal::orWhereHas('documents')->orWhereHas('down_payments')
    ->orWhereHas('mada_comission_slip')->orWhereHas('national_address')
    ->orWhereHas('signed_contract')->groupBy('project_id')->pluck('project_id');
    $data = DealProject::orderBy('project_name','ASC');
    if(!checkLeader()){
      $data = $data->where('country_id',1);
    }elseif(!checkLeaderUae()){
      $data = $data->where('country_id',2);
    }elseif(userRole()=='sales director'){
      $user_loc=User::where('id',auth()->id())->first();
      if($user_loc->time_zone=='Asia/Riyadh'){
        $data = $data->where('country_id',1);
      }else{
        $data = $data->where('country_id',2);
      }
    }
    $data = $data->whereIn('id',$project_ids)->get();
    return view('admin.deals_documents.webindex',compact('data'));

  }

  
  public function dealsList($project_id)
  {
    $deals = Deal::where(function($q){
      $q->orWhereHas('documents')->orWhereHas('down_payments')
      ->orWhereHas('mada_comission_slip')->orWhereHas('national_address')
      ->orWhereHas('signed_contract');
    })->where('project_id',$project_id)->paginate(20);
    return view('admin.deals_documents.index',compact('deals'));
  }  
  public function dealDocumentsList($id)
  {
    $deal = Deal::where('id',$id)->first();
    return view('admin.deals_documents.documents-list',compact('deal'));
  }  
}
