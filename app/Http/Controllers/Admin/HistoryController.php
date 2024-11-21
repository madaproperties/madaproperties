<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\History;
use App\User;
use Spatie\Permission\Models\Role;

class HistoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     function __construct()
     {
        $this->middleware('permission:history-list', ['only' => ['index']]);
     }
     
   

  // index 
  public function index(){
    $data = History::orderBy('id','desc')->paginate(20);
    $data_count = History::count();

    //Added by Javed
    $createdBy = User::where('active','1')->select('id','email');
    //End
    $showCreatedBy = true;

    /********* Get Contacts By The Rule ***********/
    if(userRole() == 'admin' || userRole() == 'ceo' ){ //Updated by Javed
        $data = History::where(function ($q){
              $this->filterPrams($q);
            })->orderBy('created_at','DESC');

        $data_count = $data->count();

        $paginationNo = 20;
        $data = $data->paginate($paginationNo);
    }elseif(userRole() == 'leader'){
      // get leader group
      $leaderId = auth()->id();
      // get leader , and sellers reltedt to that leader
      $users = User::select('id','leader')->where('active','1')
      ->whereRaw('JSON_CONTAINS(leader, ?)', [json_encode((string) $leaderId)])
      ->Orwhere('id',$leaderId)->get();
      $usersIds = $users->pluck('id')->toArray();
      $data = History::whereIn('user_id',$usersIds)->where(function ($q){
      $this->filterPrams($q);
      })->orderBy('created_at','DESC');
      $data_count = $data->count();
      $data = $data->paginate(20);

      //Added by Javed
      $createdBy = $createdBy->whereRaw('JSON_CONTAINS(leader, ?)', [json_encode((string) $leaderId)]);
      //End

    }else if(userRole() == 'sales admin' || userRole() == 'assistant sales director') { // sales admin
      
      $data = History::where(function ($q){
        $this->filterPrams($q);
      })->where('created_by',auth()->id())
        ->where('user_id',null)
        ->orderBy('created_at','DESC');

      $data_count = $data->count();
      $data = $data->paginate(20);
      $showCreatedBy = false;

    }else{
      
      $data = History::where(function ($q){
        $this->filterPrams($q);
      })->where('user_id',auth()->id())->orderBy('created_at','DESC');

      $data_count = $data->count();
      $data = $data->paginate(20);
      $showCreatedBy = false;

    }
    $createdBy = $createdBy->orderBy('email')->get();
    return view('admin.history.index',compact('data','data_count','createdBy','showCreatedBy'));
  }

  /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
  public function show($id)
  {
    $data = History::findOrFail($id);
    return view('admin.history.show',compact('data'));
  }  

  private function filterPrams($q){

    if(request()->has('ADVANCED')){
      $feilds = request()->all();
      $uri = Request()->fullUrl();
      session()->put('start_filter_url',$uri);
      $allowedFeilds =[
        "user_id" ,
        "request_type" ,
        "module_name"
      ];

      foreach($feilds as $feild => $value){
        if(in_array($feild,$allowedFeilds) AND !empty($value)){
            $q->where($feild,$value);
        }
      }

      //Added by Javed
      if(Request('from') && Request('to')){
        $uri = Request()->fullUrl();
        session()->put('start_filter_url',$uri);
        $from = date('Y-m-d 00:00:00', strtotime(Request('from')));
        $to = date('Y-m-d 23:59:59', strtotime(Request('to')));
        $q->whereBetween('created_at',[$from,$to]);
      }else{   
        if(Request('from')){
          $uri = Request()->fullUrl();
          session()->put('start_filter_url',$uri);
          $from = date('Y-m-d 00:00:00', strtotime(Request('from')));
          $q->where('created_at','>=', $from);
        }   
        if(Request('to')){
          $uri = Request()->fullUrl();
          session()->put('start_filter_url',$uri);
          $to = date('Y-m-d 23:59:59', strtotime(Request('to')));
          $q->where('created_at','<=',$to);
        }            
      }
      //End

      return $q->get();
    }

  }  
}
