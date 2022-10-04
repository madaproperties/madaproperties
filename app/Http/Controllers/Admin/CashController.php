<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Cash;
use App\CashExport;
use Spatie\Permission\Models\Role;

class CashController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     function __construct()
     {
          $this->middleware('permission:cash-list|cash-create|cash-edit|cash-delete', ['only' => ['index','store']]);
          $this->middleware('permission:cash-create', ['only' => ['create','store']]);
          $this->middleware('permission:cash-edit', ['only' => ['show','edit']]);
          $this->middleware('permission:cash-delete', ['only' => ['destroy']]);
          $this->middleware('permission:cash-export', ['only' => ['exportDataCash']]);
     }
     
   

  // index 
  public function index(){
    if(Request()->has('search')){
      $data = Cash::where(function ($q){
        $this->filterPrams($q);
      })->orderBy('id','desc');

      $cash_count = $data->count();
      $cash = $data->paginate(20);
    }else{
        $cash = Cash::orderBy('id','desc')->paginate(20);
        $cash_count = Cash::count();
    }

    return view('admin.cash.index',compact('cash','cash_count'));
  }

  public function create()
  {
    return view('admin.cash.create');
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
      "cheque_date"   => "nullable",
      "cheque_number" => "nullable",
      "paid"          => "nullable",
      "amount"        => "nullable",
      'description'   => 'nullable'
    ]);

    if($request->file('document')){
      $md5Name = md5_file($request->file('document')->getRealPath());
      $guessExtension = $request->file('document')->guessExtension();
      $file = $request->file('document')->move('public/uploads', $md5Name.'.'.$guessExtension);     
      $data['documents'] = $md5Name.'.'.$guessExtension;

    }
    $data['created_at'] = Carbon::now();

    addHistory('Cheque',0,'added',$data);

    $deal = Cash::create($data);
    return redirect(route('admin.cash.index'))->withSuccess(__('site.success'));
  }

  public function update(Request $request,  $id)
  {

    $deal = Cash::findOrFail($id);

    $data = $request->validate([
      "cheque_date"   => "nullable",
      "cheque_number" => "nullable",
      "paid"          => "nullable",
      "amount"        => "nullable",
      'description'   => 'nullable'
    ]);
    if($request->file('document')){
      $md5Name = md5_file($request->file('document')->getRealPath());
      $guessExtension = $request->file('document')->guessExtension();
      $file = $request->file('document')->move('public/uploads', $md5Name.'.'.$guessExtension);     
      $data['documents'] = $md5Name.'.'.$guessExtension;
    }
    $data['updated_at'] = Carbon::now();
    addHistory('Cheque',$id,'updated',$data,$deal);

    $deal->update($data);
    return redirect(route('admin.cash.index'))->withSuccess(__('site.success'));
  }


  public function destroy ($id)
  {
    $data = Cash::findOrFail($id);
    $data->delete();
    addHistory('Cheque',$id,'deleted');    
    return back()->withSuccess(__('site.success'));
  }

  public function show($id)
  {
    $cash = Cash::findOrFail($id);
    return view('admin.cash.show',compact('cash'));

  }  

  private function filterPrams($q){

    if(Request()->has('search')){
      $uri = Request()->fullUrl();
      return $q->where('cheque_date','LIKE','%'. Request('search') .'%')
      ->orWhere('amount','LIKE','%'. Request('search') .'%')
      ->orWhere('cheque_number','LIKE','%'. Request('search') .'%')
      ->orWhere('description','LIKE','%'. Request('search') .'%')
      ->get();
    }
  }  

  public function exportDataCash(){
    if(Request()->has('exportData')){
      return Excel::download(new CashExport, 'CashReport_'.date('d-m-Y').'.xlsx');
    }  
  }
}
