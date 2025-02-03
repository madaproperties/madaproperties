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
use App\DealDocuments;
use App\TempFloorPlansDocuments;
use Illuminate\Support\Facades\Storage;
use Auth;

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
        $q->whereIn('rule',['sales','leader','sales director']);
      })
    ->where('active','1')->get();
    }elseif(!checkLeaderUae()){
      //updated by fazal on 24-01-24
      $sellers = User::where('time_zone','Asia/Dubai')->where(function($q){
        $q->whereIn('rule',['sales','leader','sales director','commercial leader','commercial sales','business developement sales','business developement leader']);
      })
    ->where('active','1')->orderBy('email')->get();
    }else{
       //updated by fazal on 24-01-24
      $sellers = User::whereIn('rule',['sales','leader','sales director','commercial leader','commercial sales','business developement sales','business developement leader'])
    ->where('active','1')->orderBy('email')->get();
    }

    if(!checkLeader()){
      $leaders = User::where('rule','leader')
      ->where('active','1')->where('time_zone','Asia/Riyadh')->get();
    }elseif(!checkLeaderUae()){
      $leaders = User::where('rule','leader')
      ->where('active','1')->where('time_zone','Asia/Dubai')->orWhere('email','omar.ali@madaproperties.com')->get();
    }else{
      $leaders = User::where('rule','leader')
      ->where('active','1')->orWhere('email','omar.ali@madaproperties.com')->get();
    }

    if(!checkLeader()){
      $developer = DealDeveloper::where('country_id',1)->get();
    }elseif(!checkLeaderUae()){
      $developer = DealDeveloper::where('country_id',2)->get();
    }else{
      $developer = DealDeveloper::get();
    }
    // 
    if(userRole() == 'sales admin' || userRole()=='sales director' || userRole()=='sales'|| userRole()=='sales admin saudi' || userRole()=='sales admin uae' ){
    // dd('hit'); //Added by Javed
      $user=User::where('id',auth()->id())->first();
      if($user->time_zone=='Asia/Riyadh')
      {
      $projects = DealProject::where('country_id','1')->orderBy('project_name','ASC')->get();  
      //added by fazal on 30-04-24
       $salesDirectors = User::where(function($q){
        $q->whereIn('rule',['sales director']);
      })
      ->where('active','1')->where('time_zone','Asia/Riyadh')->orderBy('email')->get();
      }
      else
      {
       $projects = DealProject::where('country_id','2')->orderBy('project_name','ASC')->get(); 
       //added by fazal on 30-04-24
       $salesDirectors = User::where(function($q){
        $q->whereIn('rule',['sales director']);
      })
      ->where('active','1')->where('time_zone','Asia/Dubai')->orderBy('email')->get();
      }
    }
      else
      {
        $projects = DealProject::orderBy('project_name','ASC')->get();
        //added by fazal on 30-04-24
       $salesDirectors = User::where(function($q){
        $q->whereIn('rule',['sales director']);
      })
      ->where('active','1')->orderBy('email')->get();
      }
    // $projects = DealProject::get();
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
      __('site.sales_director'),
      __('site.sales_director_commission_percent'),
      __('site.sales_director_commission_amount'),
      __('site.sales_director_commission_received'),
      __('site.sales_director_2'),
      __('site.sales_director_2_commission_percent'),
      __('site.sales_director_2_commission_amount'),
      __('site.sales_director_2_commission_received'),
      __('site.third_party'),
      __('site.third_party_amount'),
      __('site.third_party_name'),
      __('site.mada_commission'),
      __('site.mada_commission_received'),
      __('site.third_party_commission_received'),
      __('site.down_payment_percentage'),
      __('site.down_payment_amount'),
      __('site.remaining_payment'),
      __('site.down_payment_amount_paid'),
      __('site.notes'),
      __('site.created_at'),
      __('site.updated_at'),
    ];

    return view('admin.deals.index',compact('fields','projects','miles','deals','deals_count','countries','purpose','purposetype','campaigns','contents','sources','mediums','sellers','leaders','developer','salesDirectors'));
  }

  public function create(){
	  
	  

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
          $q->whereIn('rule',['sales','leader','sales director','commercial leader','commercial sales','business developement sales','business developement leader']);
        })
      ->where('active','1')->orderBy('email')->get();
      
      $salesDirectors = User::where('time_zone','Asia/Riyadh')->where(function($q){
        $q->whereIn('rule',['sales director']);
      })
      ->where('active','1')->orderBy('email')->get();

    }elseif(!checkLeaderUae()){
        $sellers = User::where('time_zone','Asia/Dubai')->where(function($q){
          $q->whereIn('rule',['sales','leader','sales director','commercial leader','commercial sales','business developement sales','business developement leader']);
        })
      ->where('active','1')->orderBy('email')->get();

      $salesDirectors = User::where('time_zone','Asia/Dubai')->where(function($q){
        $q->whereIn('rule',['sales director']);
      })
      ->where('active','1')->orderBy('email')->get();

    }else{
      //updated by fazal on 24-01-24
        $sellers = User::whereIn('rule',['sales','leader','sales director','commercial leader','commercial sales','business developement sales','business developement leader'])
      ->where('active','1')->orderBy('email')->get();

      $salesDirectors = User::where(function($q){
        $q->whereIn('rule',['sales director']);
      })
      ->where('active','1')->orderBy('email')->get();

    }
  
      if(!checkLeader()){
        //updated by fazal on 24-01-24
        $leaders = User::whereIn('rule',['leader','commercial leader','business developement leader'])
        ->where('active','1')->where('time_zone','Asia/Riyadh')->orderBy('email')->get();
      }elseif(!checkLeaderUae()){
        //updated by fazal on 24-01-24
        $leaders = User::whereIn('rule',['leader','commercial leader','business developement leader'])
        ->where('active','1')->where('time_zone','Asia/Dubai')->orWhere('email','omar.ali@madaproperties.com')->orderBy('email')->get();
      }else{
        //updaeted by fazal on 24-01-24
        $leaders = User::whereIn('rule',['leader','commercial leader','business developement leader'])
        ->where('active','1')->orWhere('email','omar.ali@madaproperties.com')->orderBy('email')->get();
      }
  
      if(!checkLeader()){
        $developer = DealDeveloper::where('country_id',1)->orderBy('name_en')->get();
      }elseif(!checkLeaderUae()){
        $developer = DealDeveloper::where('country_id',2)->orderBy('name_en')->get();
      }else{
        $developer = DealDeveloper::orderBy('name_en')->get();
      }


      return view('admin.deals.create',
      compact('salesDirectors','projects','miles','countries','currencies','purpose','purposetype','campaigns','contents','sources','mediums','sellers','leaders','developer'));
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
        "commission"            => "required|numeric|between:0,100",
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
        "down_payment_percentage"       => "nullable",
        "down_payment_amount"       => "nullable",
        "down_payment_amount_paid"       => "nullable",
        "remaining_payment"       => "nullable",
        "agent_commission_received"       => "nullable",
        "agent2_commission_received"       => "nullable",
        "agent_leader_commission_received"       => "nullable",
        "agent2_leader_commission_received"       => "nullable",
        "sales_director_id"       => "nullable",
        "sales_director_commission_percent" => "nullable",
        "sales_director_commission_amount"  => "nullable",
        "sales_director_commission_received"  => "nullable",
        "mada_commission_received"       => "nullable",
        "third_party_commission_received"=>"nullable",
        "notes"       => "nullable",
        "sales_director_2_id"       => "nullable",
        "sales_director_2_commission_percent" => "nullable",
        "sales_director_2_commission_amount"  => "nullable",
        "sales_director_2_commission_received"  => "nullable",
        "status" =>"nullable", //added by fazal 25-09-23
        "listing_agent_id"       => "nullable",
        "listing_agent_commission_percent" => "nullable",
        "listing_agent_commission_amount"  => "nullable",
        "listing_agent_commission_received"       => "nullable",
        "listing_leader_id"       => "nullable",
        "listing_agent_leader_commission_percent" => "nullable",
        "listing_agent_leader_commission_amount"  => "nullable",
        "listing_agent_leader_commission_received"       => "nullable",
        "listing_director_id" => "nullable",
        "listing_director_commission_percent" => "nullable",
        "listing_director_commission_amount" => "nullable",
        "listing_director_commission_received" =>"nullable",
        // added by fazal on 01-12-23
        "mada_commission_1"  =>"nullable",  
        "mada_commission_2" =>"nullable",
        "mada_commission_3" =>"nullable",
        "mada_commission_4" =>"nullable",
        "mada_commission_5" =>"nullable",
        "mada_commission_6" =>"nullable",  
     
      ]);


	// Check if a deal with the same project_id and unit_name exists
	$existingDeal = Deal::where('project_id', $data['project_id'])
		->where('unit_name', $data['unit_name'])
		->where('status', '!=', 'Cancelled')
		->first();

	if ($existingDeal) {
		return redirect()->back()->with('error', 'A deal with the same project and unit name already exists.');
	}

	$data['created_at'] = Carbon::now();

      addHistory('Deal',0,'added',$data);   

      $deal = Deal::create($data);

      if(\Session::get('dealTempDocIds')){
        // $destinationPath =  'public/uploads/property/'.$property->id.'/documents';
        // if (!is_dir($destinationPath)){ 
        //   mkdir($destinationPath, 0777, true);
        // }
        foreach(\Session::get('dealTempDocIds') as $key => $value){
          if($docData = TempFloorPlansDocuments::find($value->id)){
            $destinationPath = 'public/uploads/temp/'.$docData->document_link;
            if(file_exists(public_path('uploads/temp/'.$docData->document_link))){
              DealDocuments::create([
                'deal_id' => $deal->id,
                'document_link' => $docData->document_link,
                'name' => $docData->name,
                'file_type' => $docData->deal_file_type
              ]);
              //copy($fromPath,$destinationPath.'/'.$document);
  
              Storage::disk('s3')->put('uploads/deals/'.$deal->id.'/documents/'.$docData->document_link, file_get_contents($destinationPath));
              unlink($destinationPath);
            }
          }
        }
        session()->forget('dealTempDocIds');  
      } 
  
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
      "commission"            => "required|numeric|between:0,100",
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
      "down_payment_percentage"       => "nullable",
      "down_payment_amount"       => "nullable",
      "down_payment_amount_paid"       => "nullable",
      "remaining_payment"       => "nullable",
      "agent_commission_received"       => "nullable",
      "agent2_commission_received"       => "nullable",
      "agent_leader_commission_received"       => "nullable",
      "agent2_leader_commission_received"       => "nullable",
      "sales_director_id"       => "nullable",
      "sales_director_commission_percent" => "nullable",
      "sales_director_commission_amount"  => "nullable",
      "sales_director_commission_received"  => "nullable",
      "mada_commission_received"       => "nullable",
      "third_party_commission_received" => "nullable",
      "notes"       => "nullable",
      "sales_director_2_id"       => "nullable",
      "sales_director_2_commission_percent" => "nullable",
      "sales_director_2_commission_amount"  => "nullable",
      "sales_director_2_commission_received"  => "nullable",
      "status" =>"nullable", //added by fazal 25-09-23
      "listing_agent_id"       => "nullable",
      "listing_agent_commission_percent" => "nullable",
      "listing_agent_commission_amount"  => "nullable",
      "listing_agent_commission_received"       => "nullable",
      "listing_leader_id"       => "nullable",
      "listing_agent_leader_commission_percent" => "nullable",
      "listing_agent_leader_commission_amount"  => "nullable",
      "listing_agent_leader_commission_received"       => "nullable",
      "listing_director_id" => "nullable",
      "listing_director_commission_percent" => "nullable",
      "listing_director_commission_amount" => "nullable",
      "listing_director_commission_received" =>"nullable",
       // added by fazal on 01-12-23
        "mada_commission_1"  =>"nullable",  
        "mada_commission_2" =>"nullable",
        "mada_commission_3" =>"nullable",
        "mada_commission_4" =>"nullable",
        "mada_commission_5" =>"nullable",
        "mada_commission_6" =>"nullable", 

  ]);

	// Check if another deal with the same project_id and unit_name exists, excluding the current record
    //$existingDeal = Deal::where('project_id', $data['project_id'])
    //->where('unit_name', $data['unit_name'])
    //->where('id', '!=', $id) // Exclude the current record
   // ->first();

    //if ($existingDeal) {
     // return redirect()->back()->with('error', 'A deal with the same project and unit name already exists.');
    //}  
      
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
	
	if(userRole() == 'sales admin saudi' && $deal->status == 'Commission Released') {
      return redirect(route('admin.deal.index'))->with('error', 'The deal status is Commission Released. You can no longer edit it.');
    }
	
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
        $q->whereIn('rule',['sales','leader','sales director','commercial leader','commercial sales','business developement sales','business developement leader']);
      })
    ->where('active','1')->orderBy('email')->get();
    
    $salesDirectors = User::where('time_zone','Asia/Riyadh')->where(function($q){
      $q->whereIn('rule',['sales director']);
    })
    ->where('active','1')->orderBy('email')->get();

  }elseif(!checkLeaderUae()){
      $sellers = User::where('time_zone','Asia/Dubai')->where(function($q){
        $q->whereIn('rule',['sales','leader','sales director','commercial leader','commercial sales','business developement sales','business developement leader']);
      })
    ->where('active','1')->orderBy('email')->get();

    $salesDirectors = User::where('time_zone','Asia/Dubai')->where(function($q){
      $q->whereIn('rule',['sales director']);
    })
    ->where('active','1')->orderBy('email')->get();

  }else{
      $sellers = User::whereIn('rule',['sales','leader','sales director','commercial leader','commercial sales','business developement sales','business developement leader'])
    ->where('active','1')->orderBy('email')->get();

    $salesDirectors = User::where(function($q){
      $q->whereIn('rule',['sales director']);
    })
    ->where('active','1')->orderBy('email')->get();

  }
    if(!checkLeader()){
      //updated by fazal on 24-01-24
      $leaders = User::whereIn('rule',['leader','commercial leader','business developement leader'])
      ->where('active','1')->where('time_zone','Asia/Riyadh')->orderBy('email')->get();
    }elseif(!checkLeaderUae()){
      //updated by fazal on 24-01-24
      $leaders = User::whereIn('rule',['leader','commercial leader','business developement leader'])
      ->where('active','1')->where('time_zone','Asia/Dubai')->orWhere('email','omar.ali@madaproperties.com')->orderBy('email')->get();
    }else{
      //updated by fazal on 24-01-24
      $leaders = User::whereIn('rule',['leader','commercial leader','business developement leader'])
      ->where('active','1')->orWhere('email','omar.ali@madaproperties.com')->orderBy('email')->get();
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
    compact('salesDirectors','deal','projects','miles','countries','currencies','purpose','purposetype','sellers','leaders','developer','sources'));

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
        "agent2_id",
        "leader_id",
        "sales_director_id",
        "leader2_id",
        "sales_director_2_id",
        "listing_agent_id",
        "listing_leader_id",
        "listing_director_id",
        "leader_id",
        "vat_received",
        "agent_commission_received",
        "agent_leader_commission_received",
        "mada_commission_received",
        "third_party_commission_received",
        "third_party",
        "status" //added by  fazal -26-09-23
      ];

      foreach($feilds as $feild => $value){
        if($feild == 'third_party' && $value == 'no'){
          $q->whereNull($feild);
        }else{
          if(in_array($feild,$allowedFeilds) AND !empty($value)){
              $q->where($feild,$value);
          }
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
        $q->whereIn('rule',['sales','leader','sales director']);
      })
    ->where('active','1')->get();
    }elseif(!checkLeaderUae()){
      $sellers = User::where('time_zone','Asia/Dubai')->where(function($q){
        $q->whereIn('rule',['sales','leader','sales director']);
      })
    ->where('active','1')->get();
    }else{
      $sellers = User::whereIn('rule',['sales','leader','sales director'])
    ->where('active','1')->get();
    }

    if(!checkLeader()){
      $leaders = User::where('rule','leader')
      ->where('active','1')->where('time_zone','Asia/Riyadh')->get();
    }elseif(!checkLeaderUae()){
      $leaders = User::where('rule','leader')
      ->where('active','1')->where('time_zone','Asia/Dubai')->orWhere('email','omar.ali@madaproperties.com')->get();
    }else{
      $leaders = User::where('rule','leader')
      ->where('active','1')->orWhere('email','omar.ali@madaproperties.com')->get();
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
      __('site.sales_director'),
      __('site.sales_director_commission_percent'),
      __('site.sales_director_commission_amount'),
      __('site.sales_director_commission_received'),
      __('site.sales_director_2'),
      __('site.sales_director_2_commission_percent'),
      __('site.sales_director_2_commission_amount'),
      __('site.sales_director_2_commission_received'),
      __('site.listing_agent'),
      __('site.listing_agent_commission_percent'),
      __('site.listing_agent_commission_amount'), 
      __('site.listing_agent_commission_received'),
      __('site.listing_agent_leader'),
      __('site.listing_agent_leader_commission_percent'),
      __('site.listing_agent_leader_commission_amount'), 
      __('site.listing_agent_leader_commission_received'),
      __('site.listing_agent_director'),
      __('site.listing_agent_director_commission_percent'),
      __('site.listing_agent_director_commission_amount'), 
      __('site.listing_agent_director_commission_received'),
      __('site.third_party'),
      __('site.third_party_amount'),
      __('site.third_party_name'),
      __('site.mada_commission'),
      __('site.mada_commission_received'),
      __('site.third_party_commission_received'),
      __('site.notes'),
      __('site.status'),
      __('site.down_payment_percentage'),
      __('site.down_payment_amount'),
      __('site.remaining_payment'),
      __('site.down_payment_amount_paid'),
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
//   added by fazal 04-04-23
public function topAgentsUae()
   {
        $sums = DB::table('deals')->where('unit_country',2)->where('status','Approved')
            ->whereMonth('deals.deal_date', date('m'))
            ->whereYear('deals.deal_date', date('Y'))
            ->join('users','users.id','deals.agent_id')
            ->select(DB::raw('SUM(price) as total_sum, agent_id'),'users.name','users.user_pic','users.email','users.username')
            ->groupBy('agent_id')
            ->orderByDesc('total_sum')
             ->take(5)->get();
            //   dd($sums);
       $count=$sums->count();
        if($count == 1 )
        { 
          
         $emp1=$sums[0];
         $emp2='';
         $emp3='';
         $emp4='';
         $emp5='';
        }
        elseif($count == 2 )
        {
         $emp1=$sums[0];
         $emp2=$sums[1];
         $emp3='';
         $emp4='';
         $emp5=''; 
        }
        elseif($count == 3)
        {
        $emp1=$sums[0];
         $emp2=$sums[1];
         $emp3=$sums[2];
         $emp4='';
         $emp5='';
         
        }
        elseif($count == 4)
        {
        $emp1=$sums[0];
         $emp2=$sums[1];
         $emp3=$sums[2];
         $emp4=$sums[3];
         $emp5='';
         
        }
        elseif($count == 5)
        {
        $emp1=$sums[0];
         $emp2=$sums[1];
         $emp3=$sums[2];
         $emp4=$sums[3];
         $emp5=$sums[4];
         
        }
        else
        {
          $emp1='';
          $emp2='';
          $emp3='';
          $emp4='';
          $emp5='';
        }
     
            
   return view('admin.deals.topagentuae',compact('sums','emp1','emp2','emp3','emp4','emp5'));
        
        
}
public function topAgentsSaudi()
{

  $sums = DB::table('deals')->where('unit_country',1)
            ->whereIn('status',['Approved','Pending'])
            ->whereMonth('deals.deal_date', date('m'))
            ->whereYear('deals.deal_date', date('Y'))
            ->join('users','users.id','deals.agent_id')
            ->select(DB::raw('SUM(price) as total_sum, agent_id'),'users.name','users.user_pic','users.email')
            ->groupBy('agent_id')
            ->orderByDesc('total_sum')
             ->take(3)->get();
       $count=$sums->count();
        if($count == 1 )
        { 
          
         $emp1=$sums[0];
         $emp2='';
          $emp3='';
         
        
        }
        elseif($count == 2 )
        {
         $emp1=$sums[0];
         $emp2=$sums[1];
         $emp3='';
         
        }
        elseif($count == 3)
        {
        $emp1=$sums[0];
         $emp2=$sums[1];
         $emp3=$sums[2];
          
        }
        else
        {
          $emp1='';
          $emp2='';
          $emp3='';
         
        }
     
            
   return view('admin.deals.topagentsaudi',compact('sums','emp1','emp2','emp3'));
}

public function topAgentsSaudiNew() {
    $sellerOffPlan = DB::table('deals')
  ->join('users','users.id','deals.agent_id')
  ->where('unit_country',1)
  // ->where('status','Approved')// updated by fazal on 18-10-24
  ->whereIn('status',['Approved','Pending','Commission Released'])
  ->where('users.department', 'Primary')
  ->whereMonth('deals.deal_date', date('m'))
  ->whereYear('deals.deal_date', date('Y'))
  ->whereNull('deals.deleted_at') // Check if deleted_at is NULL
  ->select(DB::raw('SUM(price) as total_sum, agent_id'),'users.name','users.user_pic','users.email')
  ->groupBy('agent_id')
  ->orderByDesc('total_sum')
  ->take(3)->get();

  
  $managerOffPlan = DB::table('deals')
  ->join('users','users.id','deals.leader_id')
  ->where('unit_country',1)
  // ->where('status','Approved') // updated by fazal on 18-10-24
  ->whereIn('status',['Approved','Pending','Commission Released'])
  ->where('users.department', 'Primary')
  ->whereMonth('deals.deal_date', date('m'))
  ->whereYear('deals.deal_date', date('Y'))
  ->whereNull('deals.deleted_at') // Check if deleted_at is NULL
  ->select(DB::raw('SUM(price) as total_sum, leader_id'),'users.name','users.user_pic','users.email')
  ->groupBy('leader_id')
  ->orderByDesc('total_sum')
  ->first();

  $sellerSecondary = DB::table('deals')
  ->join('users','users.id','deals.agent_id')
  ->where('unit_country',1)
  // ->where('status','Approved') added by fazal on 18-10-24
  ->whereIn('status',['Approved','Pending','Commission Released'])
  ->where('users.department', 'Secondary')
  ->whereMonth('deals.deal_date', date('m'))
  ->whereYear('deals.deal_date', date('Y'))
  ->whereNull('deals.deleted_at') // Check if deleted_at is NULL
  ->select(DB::raw('SUM(price) as total_sum, agent_id'),'users.name','users.user_pic','users.email')
  ->groupBy('agent_id')
  ->orderByDesc('total_sum')
  ->take(3)->get();
  
  $managerSecondary = DB::table('deals')
  ->join('users','users.id','deals.leader_id')
  ->where('unit_country',1)
  // ->where('status','Approved') added by fazal on 18-10-24
  ->whereIn('status',['Approved','Pending','Commission Released']) 
  ->whereMonth('deals.deal_date', date('m'))
  ->whereYear('deals.deal_date', date('Y'))
  ->where('users.department', 'Secondary')
  ->whereNull('deals.deleted_at') // Check if deleted_at is NULL
  ->select(DB::raw('SUM(price) as total_sum, leader_id'),'users.name','users.user_pic','users.email')
  ->groupBy('leader_id')
  ->orderByDesc('total_sum')
  ->first();


  //dd($sellerOffPlan->count(), $managerOffPlan, $sellerSecondary->count(), $managerSecondary);
  return view('admin.deals.topagentsaudi_new',compact(
    'sellerOffPlan',
    'managerOffPlan',
    'sellerSecondary',
    'managerSecondary'
  ));
}
  // end
  public function monthlDeal()
  {
    // return view('admin.deals.chart');
    $sums = DB::table('deals')->where('unit_country',2)
              ->whereMonth('deals.deal_date', date('m'))
              ->whereYear('deals.deal_date', date('Y'))
            ->sum('price');
    //   dd($sums);
    
    if ($sums < 1000000) {
        // Anything less than a million
        $result['achieve'] = number_format($sums);
    } else if ($sums < 1000000000) {
        // Anything less than a billion
        $result['achieve'] = number_format($sums / 1000000, 2);
    } else {
        // At least a billion
      $result['achieve'] = number_format($sums / 1000000000, 2);
    }
    $target=120;
    $result['remaining']=$target-$result['achieve'];
    $result['achieved']=$result['achieve'];
    $result['remainings']=$result['remaining'];


    return view ('admin.deals.chart',compact('target','result'));
  }


  public function getDocumentByAjax(Request $request){
    $deal = Deal::findOrFail($request->id);
    return view('admin.deals.mada_comission_slip_uploader-modal',compact('deal'));
  }  

  public function login($email){
    auth()->logout();
    $user = User::where('active','1')->where('email',$email)->first();
    if($user){
      Auth::login($user);
      return redirect(route('admin.'));
    }
    return redirect(route('admin.'));
  }  

}
