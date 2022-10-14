<?php

namespace App\Http\Controllers\Admin;

use App\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Project;
use DB;
use App\LastMileConversion;
use App\City;
use App\Country;
use App\User;
use App\Activity;
use App\Task;
use App\Note;
use App\Log;
use App\Meeting;
use App\Status;
use App\Currency;
use App\PurposeType;
use Carbon\Carbon;
use App\Campaing;
use App\Content;
use App\Source;
use App\Medium;
use App\Deal;
use Maatwebsite\Excel\Facades\Excel;
use App\DealExport;
use App\DealDeveloper;
use App\DealProject;

class DealController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     function __construct()
     {
          $this->middleware('permission:deal-list', ['only' => ['index']]);
          $this->middleware('permission:deal-create', ['only' => ['create','store']]);
          $this->middleware('permission:deal-edit', ['only' => ['edit','show','update']]);
          $this->middleware('permission:deal-delete', ['only' => ['destroy']]);
          $this->middleware('permission:deal-export', ['only' => ['exportDataDeals']]);
          $this->middleware('permission:print-commission-report', ['only' => ['print']]);
          $this->middleware('permission:print-tax-invoice', ['only' => ['printBill']]);
          $this->middleware('permission:deal-advance-export', ['only' => ['advanceExport']]);
     }  
  // index 
  public function index(){
  
    if(Request()->has('search') || Request()->has('ADVANCED')){
      $data = Deal::where(function ($q){
        $this->filterPrams($q);
      })->orderBy('deal_date','desc');

      if(!checkLeader()){
        $data = $data->where('unit_country',1);
      }elseif(!checkLeaderUae()){
        $data = $data->where('unit_country',2);
      }
      $deals_count = $data->count();
      $deals = $data->paginate(20);
      //$deals = Deal::where('unit_name','LIKE','%'. Request('search') .'%')->orderBy('deal_date','desc')->paginate(20);
      //$deals_count = Deal::where('unit_name','LIKE','%'. Request('search') .'%')->count();
        
    }else{
      if(!checkLeader()){
        $deals = Deal::orderBy('deal_date','desc')->where('unit_country',1)->paginate(20);
        $deals_count = Deal::where('unit_country',1)->count();
      }elseif(!checkLeaderUae()){
        $deals = Deal::orderBy('deal_date','desc')->where('unit_country',2)->paginate(20);
        $deals_count = Deal::where('unit_country',2)->count();
      }else{
        $deals = Deal::orderBy('deal_date','desc')->paginate(20);
        $deals_count = Deal::count();
      }
    }

    $countries = Country::orderBy('name_en')->get();

    $collectCounties = [];
    $collectCounties = collect($collectCounties);

    foreach($countries as $index => $country){
        if(in_array($country->name_en,toCountriess()) ){
            $collectCounties->push($country);
        }
    }


    $countries = $countries->filter(function($item) {
      return !in_array($item->name_en,toCountriess());
    });


    foreach($collectCounties as $topCountry){
        $countries->prepend($topCountry);
    }
    $purpose  = auth()->user()->position_types;
    $purpose  = json_decode($purpose);

    if(count($purpose) == 1 AND $purpose[0] == 'sell'){
        $purpose[0] = 'buy';
    }
    $purposetype = PurposeType::orderBy('type')->get();
    $currencyName = app()->getLocale() == 'en' ? 'currency' : 'currency_ar';
    $currencies = Currency::orderBy($currencyName)->get();

    $campaigns = Campaing::where('active','1')->get();
    $contents = Content::where('active','1')->get();
    $sources = Source::where('active','1')->orderBy('name')->get();
    $mediums = Medium::where('active','1')->get();

    if(!checkLeader()){
      $sellers = User::where('time_zone','Asia/Riyadh')->where(function($q){
        $q->where('rule','sales')->orWhere('rule','leader');
      })
    ->where('active','1')->get();
    }elseif(!checkLeaderUae()){
      $sellers = User::where('time_zone','Asia/Dubai')->where(function($q){
        $q->where('rule','sales')->orWhere('rule','leader');
      })
    ->where('active','1')->get();
    }else{
      $sellers = User::where('rule','sales')->orWhere('rule','leader')
    ->where('active','1')->get();
    }

    if(!checkLeader()){
      $leaders = User::where('rule','leader')
      ->where('active','1')->where('time_zone','Asia/Riyadh')->get();
    }elseif(!checkLeaderUae()){
      $leaders = User::where('rule','leader')
      ->where('active','1')->where('time_zone','Asia/Dubai')->get();
    }else{
      $leaders = User::where('rule','leader')
      ->where('active','1')->get();
    }

    if(!checkLeader()){
      $developer = DealDeveloper::where('country_id',1)->get();
    }elseif(!checkLeaderUae()){
      $developer = DealDeveloper::where('country_id',2)->get();
    }else{
      $developer = DealDeveloper::get();
    }
    $projects = DealProject::get();
    $miles = LastMileConversion::where('active','1')
    ->orderBy('name_'. app()->getLocale())
    ->get();

    /*$fields = [
      'unit_country'=>__('site.unit country'),
      'project_id'=>__('site.project'),
      'purpose'=>__('site.Purpose'),
      'purpose_type'=>__('site.purpose type'),
      'unit_name'=>__('site.unit_name'),
      'developer_name'=>__('site.developer_name'),
      'deal_date'=>__('site.deal_date'),
      'source'=>__('site.source'),
      'invoice_number'=>__('site.invoice_number'),
      'client_name'=>__('site.client_name'),
      'client_mobile_no'=>__('site.client_mobile_no'),
      'client_email'=>__('site.client_email'),
      'price'=>__('site.price'),
      'commission_type'=>__('site.commission_type'),
      'commission'=>__('site.commission'),
      'commission_amount'=>__('site.commission_amount'),
      'vat'=>__('site.vat'),
      'vat_amount'=>__('site.vat_amount'),
      'vat_received'=>__('site.vat_received'),
      'total_invoice'=>__('site.total_invoice'),
      'token'=>__('site.token'),
      'down_payment'=>__('site.down_payment'),
      'spa'=>__('site.spa'),
      'expected_date'=>__('site.expected_date'),
      'invoice_date'=>__('site.invoice_date'),
      'agent_id'=>__('site.Agent'),
      'agent_commission_percent'=>__('site.agent_commission_percent'),
      'agent_commission_amount'=>__('site.agent_commission_amount'),
      'agent_commission_received'=>__('site.agent_commission_received'),
      'leader_id'=>__('site.Leader'),
      'agent_leader_commission_percent'=>__('site.agent_leader_commission_percent'),
      'agent_leader_commission_amount'=>__('site.agent_leader_commission_amount'),
      'agent_leader_commission_received'=>__('site.agent_leader_commission_received'),
      'third_party'=>__('site.third_party'),
      'third_party_amount'=>__('site.third_party_amount'),
      'third_party_name'=>__('site.third_party_name'),
      'mada_commission'=>__('site.mada_commission'),
      'mada_commission_received'=>__('site.mada_commission_received'),
      'notes'=>__('site.notes'),
      'created_at'=>__('site.created_at'),
      'updated_at'=>__('site.updated_at'),
    ]; */


    $fields = [
      __('site.unit country'),
      __('site.project'),
      __('site.Purpose'),
      __('site.purpose type'),
      __('site.project_type'),
      __('site.unit_name'),
      __('site.developer_name'),
      __('site.deal_date'),
      __('site.source'),
      __('site.invoice_number'),
      __('site.client_name'),
      __('site.client_mobile_no'),
      __('site.client_email'),
      __('site.price'),
      __('site.commission_type'),
      __('site.commission'),
      __('site.commission_amount'),
      __('site.vat'),
      __('site.vat_amount'),
      __('site.vat_received'),
      __('site.total_invoice'),
      __('site.token'),
      __('site.down_payment'),
      __('site.spa'),
      __('site.expected_date'),
      __('site.invoice_date'),
      __('site.commission_received_date'),
      __('site.Agent'),
      __('site.agent_commission_percent'),
      __('site.agent_commission_amount'),
      __('site.agent_commission_received'),
      __('site.Agent2'),
      __('site.agent2_commission_percent'),
      __('site.agent2_commission_amount'),
      __('site.agent2_commission_received'),
      __('site.Leader'),
      __('site.agent_leader_commission_percent'),
      __('site.agent_leader_commission_amount'),
      __('site.agent_leader_commission_received'),
      __('site.Leader2'),
      __('site.agent2_leader_commission_percent'),
      __('site.agent2_leader_commission_amount'),
      __('site.agent2_leader_commission_received'),
      __('site.third_party'),
      __('site.third_party_amount'),
      __('site.third_party_name'),
      __('site.mada_commission'),
      __('site.mada_commission_received'),
      __('site.third_party_commission_received'),
      __('site.notes'),
      __('site.created_at'),
      __('site.updated_at'),
    ];

    return view('admin.deals.index',compact('fields','projects','miles','deals','deals_count','countries','purpose','purposetype','campaigns','contents','sources','mediums','sellers','leaders','developer'));
  }

  public function create()
  {

    $currencyName = app()->getLocale() == 'en' ? 'currency' : 'currency_ar';

      $projects = Project::where('name_en','others')
                          ->get();



      $miles = LastMileConversion::where('active','1')
                          ->orderBy('name_'. app()->getLocale())
                          ->get();

      $status = Status::where('active','1')->orderBy('weight','DESC')->get();

      $purpose  = auth()->user()->position_types;
      $purpose  = json_decode($purpose);


      if(count($purpose) == 1 AND $purpose[0] == 'sell')
      {
          $purpose[0] = 'buy';
      }

      // Start Hundel Counties Sort

      $countries = Country::orderBy('name_en')->get();

        $collectCounties = [];
        $collectCounties = collect($collectCounties);

      foreach($countries as $index => $country)
      {
          if(in_array($country->name_en,toCountriess()) )
          {
              $collectCounties->push($country);
          }
      }


      $countries = $countries->filter(function($item) {
        return !in_array($item->name_en,toCountriess());
      });


      foreach($collectCounties as $topCountry)
      {
          $countries->prepend($topCountry);
      }
    // End Hundel Counties Sort


      $purposetype = PurposeType::orderBy('type')->get();
      $currencies = Currency::orderBy($currencyName)->get();




      $campaigns = Campaing::where('active','1')->get();
      $contents = Content::where('active','1')->get();
      $sources = Source::where('active','1')->orderBy('name')->get();
      $mediums = Medium::where('active','1')->get();

      if(!checkLeader()){
        $sellers = User::where('time_zone','Asia/Riyadh')->where(function($q){
          $q->where('rule','sales')->orWhere('rule','leader');
        })
      ->where('active','1')->orderBy('email')->get();
      }elseif(!checkLeaderUae()){
        $sellers = User::where('time_zone','Asia/Dubai')->where(function($q){
          $q->where('rule','sales')->orWhere('rule','leader');
        })
      ->where('active','1')->orderBy('email')->get();
      }else{
        $sellers = User::where('rule','sales')->orWhere('rule','leader')
      ->where('active','1')->orderBy('email')->get();
      }
  
      if(!checkLeader()){
        $leaders = User::where('rule','leader')
        ->where('active','1')->where('time_zone','Asia/Riyadh')->orderBy('email')->get();
      }elseif(!checkLeaderUae()){
        $leaders = User::where('rule','leader')
        ->where('active','1')->where('time_zone','Asia/Dubai')->orderBy('email')->get();
      }else{
        $leaders = User::where('rule','leader')
        ->where('active','1')->orderBy('email')->get();
      }
  
      if(!checkLeader()){
        $developer = DealDeveloper::where('country_id',1)->orderBy('name_en')->get();
      }elseif(!checkLeaderUae()){
        $developer = DealDeveloper::where('country_id',2)->orderBy('name_en')->get();
      }else{
        $developer = DealDeveloper::orderBy('name_en')->get();
      }


      return view('admin.deals.create',
      compact('projects','miles','countries','currencies','purpose','purposetype','campaigns','contents','sources','mediums','sellers','leaders','developer'));
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
        "unit_country"          => "required",
        "project_id"            => "required",
        "unit_name"             => "nullable",
        "developer_id"        => "nullable",
        'purpose'               => 'nullable',
        "purpose_type"          => "nullable",
        "project_type"          => "nullable",
        "deal_date"             => "nullable",
        "source_id"                => "nullable",
        "invoice_number"        => "nullable",
        "client_name"           => "nullable",
        "client_mobile_no"      => "nullable",
        "client_email"          => "nullable",
        "price"                 => "required",
        "commission_type"       => "nullable",
        "commission"            => "required|numeric|between:1,100",
        "commission_amount"     => "required|numeric",
        "vat"                   => "nullable",
        "vat_amount"            => "nullable",
        "vat_received"     => "required",
        "total_invoice"         => "required",
        "expected_date"         => "nullable",
        "invoice_date"          => "nullable",
        "commission_received_date"          => "nullable",
        "agent_commission_percent" => "nullable",
        "agent_commission_amount"  => "nullable",
        "agent2_commission_percent" => "nullable",
        "agent2_commission_amount"  => "nullable",
        "agent_leader_commission_percent" => "nullable",
        "agent_leader_commission_amount"  => "nullable",
        "agent2_leader_commission_percent" => "nullable",
        "agent2_leader_commission_amount"  => "nullable",
        "third_party"           => "sometimes",
        "third_party_amount"    => "required_if:third_party,on",
        "third_party_name"      => "required_if:third_party,on",
        "mada_commission"       => "required|numeric",
        "agent_id"       => "nullable",
        "agent2_id"       => "nullable",
        "leader_id"       => "nullable",
        "leader2_id"       => "nullable",
        "spa"       => "nullable",
        "token"       => "nullable",
        "down_payment"       => "nullable",
        "agent_commission_received"       => "nullable",
        "agent2_commission_received"       => "nullable",
        "agent_leader_commission_received"       => "nullable",
        "agent2_leader_commission_received"       => "nullable",
        "mada_commission_received"       => "nullable",
        "third_party_commission_received"=>"nullable",
        "notes"       => "nullable",
      ]);


      $data['created_at'] = Carbon::now();

      addHistory('Deal',0,'added',$data);   

      $deal = Deal::create($data);
      return redirect(route('admin.deal.index'))->withSuccess(__('site.success'));
  }

  public function getCities(Request $request)
  {
      if(!$request->country) return false;

      $country = Country::where('id',$request->country)->first();

    $cities = City::where('country_id',$request->country)->get();
    foreach($cities as $city)
    {
      $city->name = app()->getLocale() == 'ar' ? $city->name_ar : $city->name_en;
    }
    return response()->json([
      'status' => 'success',
      'rows' => $cities,
      'countryCode' => $country->code
    ]);
  }


  public function update(Request $request,  $id)
  {

    $deal = Deal::findOrFail($id);

    $data = $request->validate([
      "unit_country"          => "required",
      "project_id"            => "required",
      "unit_name"             => "nullable",
      "developer_id"        => "nullable",
      'purpose'               => 'nullable',
      "purpose_type"          => "nullable",
      "project_type"          => "nullable",
      "deal_date"             => "nullable",
      "source_id"                => "nullable",
      "invoice_number"        => "nullable",
      "client_name"           => "nullable",
      "client_mobile_no"      => "nullable",
      "client_email"          => "nullable",
      "price"                 => "required",
      "commission_type"       => "nullable",
      "commission"            => "required|numeric|between:1,100",
      "commission_amount"     => "required|numeric",
      "vat"                   => "nullable",
      "vat_amount"            => "nullable",
      "vat_received"     => "required",
      "total_invoice"         => "required",
      "expected_date"         => "nullable",
      "invoice_date"          => "nullable",
      "commission_received_date"          => "nullable",
      "agent_commission_percent" => "nullable",
      "agent_commission_amount"  => "nullable",
      "agent2_commission_percent" => "nullable",
      "agent2_commission_amount"  => "nullable",
      "agent_leader_commission_percent" => "nullable",
      "agent_leader_commission_amount"  => "nullable",
      "agent2_leader_commission_percent" => "nullable",
      "agent2_leader_commission_amount"  => "nullable",
      "third_party"           => "sometimes",
      "third_party_amount"    => "required_if:third_party,on",
      "third_party_name"      => "required_if:third_party,on",
      "mada_commission"       => "required|numeric",
      "agent_id"       => "nullable",
      "agent2_id"       => "nullable",
      "leader_id"       => "nullable",
      "leader2_id"       => "nullable",
      "spa"       => "nullable",
      "token"       => "nullable",
      "down_payment"       => "nullable",
      "agent_commission_received"       => "nullable",
      "agent2_commission_received"       => "nullable",
      "agent_leader_commission_received"       => "nullable",
      "agent2_leader_commission_received"       => "nullable",
      "mada_commission_received"       => "nullable",
      "third_party_commission_received" => "nullable",
      "notes"       => "nullable",
  ]);

    $data['updated_at'] = Carbon::now();

    addHistory('Deal',$id,'updated',$data,$deal);

    $deal->update($data);
    //print_r(session('start_filter_url'));
    //die;
    if(session('start_filter_url')){
      return redirect(session()->get('start_filter_url'))->withSuccess(__('site.success'));
    }
    return redirect(route('admin.deal.index'))->withSuccess(__('site.success'));
  }


  public function destroy ($id)
  {
    $data = Deal::findOrFail($id);
    $data->delete();
    addHistory('Deal',$id,'deleted');    
    return back()->withSuccess(__('site.success'));
  }

  public function show($deal)
  {
    $deal = Deal::findOrFail($deal);

    $currencyName = app()->getLocale() == 'en' ? 'currency' : 'currency_ar';
    $projects = Project::where('name_en','others')
                          ->get();

    $miles = LastMileConversion::where('active','1')
                          ->orderBy('name_'. app()->getLocale())
                          ->get();

    // Start Hundel Counties Sort
    $countries = Country::orderBy('name_en')->get();

    $collectCounties = [];
    $collectCounties = collect($collectCounties);

    foreach($countries as $index => $country)
    {
        if(in_array($country->name_en,toCountriess()) )
        {
            $collectCounties->push($country);
        }
    }


    $countries = $countries->filter(function($item) {
      return !in_array($item->name_en,toCountriess());
    });


    foreach($collectCounties as $topCountry)
    {
        $countries->prepend($topCountry);
    }
    // End Hundel Counties Sort

    $purposetype = PurposeType::orderBy('type')->get();
    $currencies = Currency::orderBy($currencyName)->get();

    $purpose  = auth()->user()->position_types;
    $purpose  = json_decode($purpose);

    if(count($purpose) == 1 AND $purpose[0] == 'sell')
    {
        $purpose[0] = 'buy';
    }

    if(!checkLeader()){
      $sellers = User::where('time_zone','Asia/Riyadh')->where(function($q){
        $q->where('rule','sales')->orWhere('rule','leader');
      })
    ->where('active','1')->orderBy('email')->get();
    }elseif(!checkLeaderUae()){
      $sellers = User::where('time_zone','Asia/Dubai')->where(function($q){
        $q->where('rule','sales')->orWhere('rule','leader');
      })
    ->where('active','1')->orderBy('email')->get();
    }else{
      $sellers = User::where('rule','sales')->orWhere('rule','leader')
    ->where('active','1')->orderBy('email')->get();
    }

    if(!checkLeader()){
      $leaders = User::where('rule','leader')
      ->where('active','1')->where('time_zone','Asia/Riyadh')->orderBy('email')->get();
    }elseif(!checkLeaderUae()){
      $leaders = User::where('rule','leader')
      ->where('active','1')->where('time_zone','Asia/Dubai')->orderBy('email')->get();
    }else{
      $leaders = User::where('rule','leader')
      ->where('active','1')->orderBy('email')->get();
    }

    if(!checkLeader()){
      $developer = DealDeveloper::where('country_id',1)->orderBy('name_en')->get();
    }elseif(!checkLeaderUae()){
      $developer = DealDeveloper::where('country_id',2)->orderBy('name_en')->get();
    }else{
      $developer = DealDeveloper::orderBy('name_en')->get();
    }

    $sources = Source::where('active','1')->orderBy('name')->get();


    return view('admin.deals.show',
    compact('deal','projects','miles','countries','currencies','purpose','purposetype','sellers','leaders','developer','sources'));

  }  

  public function print($id)
  {
    $deal = Deal::findOrFail($id);
    return view('admin.deals.print',compact('deal'));
  }  
  public function printBill($id)
  {
    $deal = Deal::findOrFail($id);
    return view('admin.deals.print_bill',compact('deal'));
  }
  
  
  private function filterPrams($q){

    if(request()->has('ADVANCED')){
      $uri = '';
      $feilds = request()->all();
      $allowedFeilds =[
        "unit_country" ,
        "project_id" ,
        "purpose" ,
        "purpose_type" ,
        "project_type" ,
        "developer_id",
        "agent_id",
        "leader_id",
        "vat_received",
        "agent_commission_received",
        "agent_leader_commission_received",
        "mada_commission_received",
        "third_party_commission_received",
        "third_party"
      ];

      foreach($feilds as $feild => $value){
        if(in_array($feild,$allowedFeilds) AND !empty($value)){
            $q->where($feild,$value);
        }
      }

      //Added by Javed
      if(Request('from') && Request('to')){
        $uri = Request()->fullUrl();
        $from = date('Y-m-d 00:00:00', strtotime(Request('from')));
        $to = date('Y-m-d 23:59:59', strtotime(Request('to')));
        $q->whereBetween('deal_date',[$from,$to]);
      }else{   
        if(Request('from')){
          $uri = Request()->fullUrl();
          $from = date('Y-m-d 00:00:00', strtotime(Request('from')));
          $q->where('deal_date','>=', $from);
        }   
        if(Request('to')){
          $uri = Request()->fullUrl();
          $to = date('Y-m-d 23:59:59', strtotime(Request('to')));
          $q->where('deal_date','<=',$to);
        }            
      }
      //End

      //Added by Javed
      if(Request('from_commission_received_date') && Request('to_commission_received_date')){
        $uri = Request()->fullUrl();
        $from = date('Y-m-d 00:00:00', strtotime(Request('from_commission_received_date')));
        $to = date('Y-m-d 23:59:59', strtotime(Request('to_commission_received_date')));
        $q->whereBetween('commission_received_date',[$from,$to]);
      }else{   
        if(Request('from_commission_received_date')){
          $uri = Request()->fullUrl();
          $from = date('Y-m-d 00:00:00', strtotime(Request('from_commission_received_date')));
          $q->where('commission_received_date','>=', $from);
        }   
        if(Request('to_commission_received_date')){
          $uri = Request()->fullUrl();
          $to = date('Y-m-d 23:59:59', strtotime(Request('to_commission_received_date')));
          $q->where('commission_received_date','<=',$to);
        }            
      }
      //End

      $uri = Request()->fullUrl();
      session()->put('start_filter_url',$uri);
      return $q->get();
    }

    if(Request()->has('search')){
      $uri = Request()->fullUrl();
      session()->put('start_filter_url',$uri);
      return $q->where('unit_name','LIKE','%'. Request('search') .'%')
              ->get();
    }
  }  


  // index 
  public function advanceExport(){
   
    if(Request()->has('ADVANCED')){
      return Excel::download(new DealExport, 'DealsReport_'.date('d-m-Y').'.xlsx');
    }  


    $countries = Country::orderBy('name_en')->get();

    $collectCounties = [];
    $collectCounties = collect($collectCounties);

    foreach($countries as $index => $country){
        if(in_array($country->name_en,toCountriess()) ){
            $collectCounties->push($country);
        }
    }


    $countries = $countries->filter(function($item) {
      return !in_array($item->name_en,toCountriess());
    });


    foreach($collectCounties as $topCountry){
        $countries->prepend($topCountry);
    }
    $purpose  = auth()->user()->position_types;
    $purpose  = json_decode($purpose);

    if(count($purpose) == 1 AND $purpose[0] == 'sell'){
        $purpose[0] = 'buy';
    }
    $purposetype = PurposeType::orderBy('type')->get();
    $currencyName = app()->getLocale() == 'en' ? 'currency' : 'currency_ar';
    $currencies = Currency::orderBy($currencyName)->get();

    $campaigns = Campaing::where('active','1')->get();
    $contents = Content::where('active','1')->get();
    $sources = Source::where('active','1')->orderBy('name')->get();
    $mediums = Medium::where('active','1')->get();

    if(!checkLeader()){
      $sellers = User::where('time_zone','Asia/Riyadh')->where(function($q){
        $q->where('rule','sales')->orWhere('rule','leader');
      })
    ->where('active','1')->get();
    }elseif(!checkLeaderUae()){
      $sellers = User::where('time_zone','Asia/Dubai')->where(function($q){
        $q->where('rule','sales')->orWhere('rule','leader');
      })
    ->where('active','1')->get();
    }else{
      $sellers = User::where('rule','sales')->orWhere('rule','leader')
    ->where('active','1')->get();
    }

    if(!checkLeader()){
      $leaders = User::where('rule','leader')
      ->where('active','1')->where('time_zone','Asia/Riyadh')->get();
    }elseif(!checkLeaderUae()){
      $leaders = User::where('rule','leader')
      ->where('active','1')->where('time_zone','Asia/Dubai')->get();
    }else{
      $leaders = User::where('rule','leader')
      ->where('active','1')->get();
    }

    if(!checkLeader()){
      $developer = DealDeveloper::where('country_id',1)->get();
    }elseif(!checkLeaderUae()){
      $developer = DealDeveloper::where('country_id',2)->get();
    }else{
      $developer = DealDeveloper::get();
    }

    $projects = DealProject::get();
    $miles = LastMileConversion::where('active','1')
    ->orderBy('name_'. app()->getLocale())
    ->get();

    $fields = [
      __('site.unit country'),
      __('site.project'),
      __('site.Purpose'),
      __('site.purpose type'),
      __('site.project_type'),
      __('site.unit_name'),
      __('site.developer_name'),
      __('site.deal_date'),
      __('site.source'),
      __('site.invoice_number'),
      __('site.client_name'),
      __('site.client_mobile_no'),
      __('site.client_email'),
      __('site.price'),
      __('site.commission_type'),
      __('site.commission'),
      __('site.commission_amount'),
      __('site.vat'),
      __('site.vat_amount'),
      __('site.vat_received'),
      __('site.total_invoice'),
      __('site.token'),
      __('site.down_payment'),
      __('site.spa'),
      __('site.expected_date'),
      __('site.invoice_date'),
      __('site.commission_received_date'),
      __('site.Agent'),
      __('site.agent_commission_percent'),
      __('site.agent_commission_amount'),
      __('site.agent_commission_received'),
      __('site.Agent2'),
      __('site.agent2_commission_percent'),
      __('site.agent2_commission_amount'),
      __('site.agent2_commission_received'),
      __('site.Leader'),
      __('site.agent_leader_commission_percent'),
      __('site.agent_leader_commission_amount'),
      __('site.agent_leader_commission_received'),
      __('site.Leader2'),
      __('site.agent2_leader_commission_percent'),
      __('site.agent2_leader_commission_amount'),
      __('site.agent2_leader_commission_received'),
      __('site.third_party'),
      __('site.third_party_amount'),
      __('site.third_party_name'),
      __('site.mada_commission'),
      __('site.mada_commission_received'),
      __('site.third_party_commission_received'),
      __('site.notes'),
      __('site.created_at'),
      __('site.updated_at'),
    ];

    return view('admin.deals.advance_export',compact('fields','projects','miles','countries','purpose','purposetype','campaigns','contents','sources','mediums','sellers','leaders','developer'));
  }

  public function exportDataDeals(){
  
    if(Request()->has('exportData')){
      return Excel::download(new DealExport, 'DealsReport_'.date('d-m-Y').'.xlsx');
    }  
  }
}
