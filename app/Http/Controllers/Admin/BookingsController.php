<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Project;
use DB;
use App\Country;
use App\PurposeType;
use Carbon\Carbon;
use App\ProjectName;
use App\Payments;

class BookingsController extends Controller
{

  /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
  function __construct() {
    $this->middleware('permission:booking-list', ['only' => ['index']]);
  } 


  // index 
  public function index(){

    if(Request()->has('search')){
        $data = Payments::where('payment_response','LIKE','%'. Request('search') .'%')->orWhere('customer_info','LIKE','%'. Request('search') .'%')->orderBy('id','desc')->paginate(20);
        $data_count = Payments::where('payment_response','LIKE','%'. Request('search') .'%')->orWhere('customer_info','LIKE','%'. Request('search') .'%')->count();
    }else{
        $data = Payments::orderBy('id','desc')->paginate(20);
        $data_count = Payments::count();
    }
    return view('admin.projectdata.index_bookings',compact('data','data_count'));
  }
}
