<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Project;
use DB;
use App\Country;
use App\PurposeType;
use Carbon\Carbon;
use App\ProjectData;
use App\ProjectName;
use App\ProjectDeveloper;
use App\ProjectDataExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProjectDataImport;
use App\User;
use App\Payments;

class ProjectPaymentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  function __construct() {
  }	


  // index 
  public function index(){

    if(Request()->has('search') || Request()->has('ADVANCED')){
      $data = ProjectData::where(function ($q){
        $this->filterPrams($q);
      })->orderBy('id','desc');

      if(!checkLeader()){
        $data = $data->where('country_id',1);
      }elseif(!checkLeaderUae()){
        $data = $data->where('country_id',2);
      }
      $data_count = $data->count();
      $data = $data->paginate(20);
    }else{
      if(!checkLeader()){
        $data = ProjectData::where('country_id',1)->orderBy('id','desc')->paginate(20);
        $data_count = ProjectData::where('country_id',1)->count();
      }elseif(!checkLeaderUae()){
        $data = ProjectData::where('country_id',2)->orderBy('id','desc')->paginate(20);
        $data_count = ProjectData::where('country_id',2)->count();
      }else{
        $data = ProjectData::orderBy('id','desc')->paginate(20);
        $data_count = ProjectData::count();
      }
    }
    $projects = ProjectName::orderBy('name','ASC')->get();
    $developer = ProjectDeveloper::orderBy('name','ASC')->get();
    $purposetype = PurposeType::orderBy('type')->get();    

    return view('admin.projectdata.index_project',compact('data','data_count','purposetype','projects','developer'));
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
        "country_id"          => "nullable",
        "city_name"          => "required",
        "district_name"          => "required",
        "developer_id"          => "required",
        "unit_name"          => "required",
        "project_id"          => "required",
        "property_type"          => "required",
        "area_bua"          => "nullable",
        "area_plot"          => "nullable",
        "bedroom"          => "required",
        "price"          => "required",
        "completion_date"          => "nullable",
        "payment_status"          => "nullable",
        "floor_no"      =>"required",
        "commission"    =>"nullable",
        "down_payment"  => "nullable",
        "down_payment_percentage"=>"nullable",
        "floor_plan"          => "nullable",
        "status"          => "nullable",
      ]);


      $data['created_at'] = Carbon::now();

      addHistory('Project Data',0,'added',$data);   

      if($request->file('floor_plan')){
        $md5Name = md5_file($request->file('floor_plan')->getRealPath());
        $guessExtension = $request->file('floor_plan')->guessExtension();
        $file = $request->file('floor_plan')->move('public/uploads/projectData', $md5Name.'.'.$guessExtension);     
        $data['floor_plan'] = $md5Name.'.'.$guessExtension;
      }

      ProjectData::create($data);
      return redirect(route('admin.project-data.index'))->withSuccess(__('site.success'));
  }

  public function checkoutPage($unit_id){
    $unit=ProjectData::where('id',$unit_id)->whereIn('status',['Available','Resale'])->first();
    if($unit){
      session()->put('unit_id',$unit_id);

      $project_name=ProjectName::where('id',$unit->project_id)->first();
      $available=ProjectData::where('project_id',$unit->project_id)->where('status','=','Available')->count();
      $sold_out=ProjectData::where('project_id',$unit->project_id)->where('status','Sold out')->count();
      $reserved=ProjectData::where('project_id',$unit->project_id)->where('status','Reserved')->count();
      $total=ProjectData::where('project_id',$unit->project_id)->count();
      $image=ProjectData::where('project_id',$unit->project_id)->first();
      
      return view('admin.projectdata.checkout',compact('unit','unit_id','project_name','available','sold_out','reserved','total','image'));
    }else{
      return redirect()->back()->with('error','Unit is not available');
    }
  }

  public function payment(Request $request){

    if(session()->get('unit_id')){
      $unit_id = session()->get('unit_id');
      $unit_name=ProjectData::find($unit_id);
      $invoiceItems[] = [
        'ItemName'  => $unit_name->project->name_en.' - '.$unit_name->unit_name, //ISBAN, or SKU
      ];
      /* ------------------------ Configurations ---------------------------------- */
      //Test
      if(env('PAYMENT_ENV') == 'live'){
        $apiURL = env('PAYMENT_URL_LIVE');
        $apiKey = env('PAYMENT_URL_API_KEY_LIVE'); //Test token value to be placed here: https://myfatoorah.readme.io/docs/test-token
      }else{
        $apiURL = env('PAYMENT_URL_TEST');
        $apiKey = env('PAYMENT_URL_API_KEY_TEST'); //Test token value to be placed here: https://myfatoorah.readme.io/docs/test-token
      }
      /* ------------------------ Call InitiatePayment Endpoint ------------------- */
      //Fill POST fields array
      $ipPostFields = ['InvoiceAmount' => env('INVOICE_AMOUNT'), 'CurrencyIso' => env('PAYMENT_CURRENY')];
      
      //Call endpoint
      $paymentMethods = $this->initiatePayment($apiURL, $apiKey, $ipPostFields);
      
      //You can save $paymentMethods information in database to be used later
      $paymentMethodId = 2;
      /*foreach ($paymentMethods as $pm) {
          if ($pm->PaymentMethodEn == 'VISA/MASTER') {
              $paymentMethodId = $pm->PaymentMethodId;
              break;
          }
      }*/

      $amount = env('INVOICE_AMOUNT');

      if(isset($unit_name->commission) && $unit_name->commission > 0){
        $amount = $unit_name->commission;
      }
      
      //Fill POST fields array
      $postFields = [
          //Fill required data
          'paymentMethodId' => $paymentMethodId,
          'InvoiceValue'    => $amount,
          'CallBackUrl'     => route('projectPayment.success'),
          'ErrorUrl'        => route('projectPayment.error'), //or 'https://example.com/error.php'    
          //Fill optional data
          'CustomerName'       => $request->CustomerName,
          'DisplayCurrencyIso' => env('PAYMENT_CURRENY'),
          //'MobileCountryCode'  => '+965',
          'CustomerMobile'     => $request->CustomerMobile,
          'CustomerEmail'      => $request->CustomerEmail,
          //'Language'           => 'en', //or 'ar'
          //'CustomerReference'  => 'orderId',
          'CustomerCivilId'    => $request->PassportNumber,
          //'UserDefinedField'   => 'This could be string, number, or array',
          //'ExpiryDate'         => '', //The Invoice expires after 3 days by default. Use 'Y-m-d\TH:i:s' format in the 'Asia/Kuwait' time zone.
          //'SourceInfo'         => 'Pure PHP', //For example: (Laravel/Yii API Ver2.0 integration)
          //'CustomerAddress'    => $request->CustomerAddress,
          //'InvoiceItems'       => $invoiceItems,
          'unit_id'       => $unit_id,
          'project_id'    => $unit_name->project_id
      ];
      session()->put('postFields',$postFields);
      //Call endpoint
      $data = $this->executePayment($apiURL, $apiKey, $postFields);
      
      //You can save payment data in database as per your needs
      $invoiceId   = $data->InvoiceId;
      $paymentLink = $data->PaymentURL;
      
      //Redirect your customer to the payment page to complete the payment process
      //Display the payment link to your customer
      echo "please wait...<br>";
      return redirect()->away($paymentLink);
    }else{
      return redirect()->back()->with('error','Unit is not available');
    }
  }  

  public function getPupUpByAjax(Request $request){
    $unit_name=ProjectData::find($request->get('id'));
    return view('admin.projectdata.viewModal',compact('unit_name'));
  }  


  /* ------------------------ Functions --------------------------------------- */
  /*
   * Initiate Payment Endpoint Function 
   */
  function initiatePayment($apiURL, $apiKey, $postFields) {
    $json = $this->callAPI("$apiURL/v2/InitiatePayment", $apiKey, $postFields);
    return $json->Data->PaymentMethods;
  }
  
  //------------------------------------------------------------------------------
  /*
   * Execute Payment Endpoint Function 
   */
  
  function executePayment($apiURL, $apiKey, $postFields) {
    $json = $this->callAPI("$apiURL/v2/ExecutePayment", $apiKey, $postFields);
    return $json->Data;
  }
  
  //------------------------------------------------------------------------------
  /*
   * Call API Endpoint Function
   */
  
  function callAPI($endpointURL, $apiKey, $postFields = [], $requestType = 'POST') {
    $curl = curl_init($endpointURL);
    curl_setopt_array($curl, array(
        CURLOPT_CUSTOMREQUEST  => $requestType,
        CURLOPT_POSTFIELDS     => json_encode($postFields),
        CURLOPT_HTTPHEADER     => array("Authorization: Bearer $apiKey", 'Content-Type: application/json'),
        CURLOPT_RETURNTRANSFER => true,
    ));

    $response = curl_exec($curl);
    $curlErr  = curl_error($curl);

    curl_close($curl);

    if ($curlErr) {
        //Curl is not working in your server
        die("Curl Error: $curlErr");
    }

    $error = $this->handleError($response);
    if ($error) {
        die("Error: $error");
    }

    return json_decode($response);
  }
  
  //------------------------------------------------------------------------------
  /*
   * Handle Endpoint Errors Function 
   */
  function handleError($response) {
  
    $json = json_decode($response);
    if (isset($json->IsSuccess) && $json->IsSuccess == true) {
        return null;
    }

    //Check for the errors
    if (isset($json->ValidationErrors) || isset($json->FieldsErrors)) {
        $errorsObj = isset($json->ValidationErrors) ? $json->ValidationErrors : $json->FieldsErrors;
        $blogDatas = array_column($errorsObj, 'Error', 'Name');

        $error = implode(', ', array_map(function ($k, $v) {
                    return "$k: $v";
                }, array_keys($blogDatas), array_values($blogDatas)));
    } else if (isset($json->Data->ErrorMessage)) {
        $error = $json->Data->ErrorMessage;
    }

    if (empty($error)) {
        $error = (isset($json->Message)) ? $json->Message : (!empty($response) ? $response : 'API key or API URL is not correct');
    }

    return $error;
  }  

  public function success(Request $request) {
    if(session()->get('unit_id')){
      $unit_id = session()->get('unit_id');
      $unit_name=ProjectData::where('id',$unit_id)->update([
        'status' => 'Sold out'
      ]);

      $data['unit_id'] = $unit_id;
      $data['payment_response'] = json_encode($request->all());
      $data['customer_info'] = json_encode(session()->get('postFields'));
      $data['created_at'] = Carbon::now();
      Payments::create($data);

      session()->forget('unit_id');
      session()->forget('postFields');

      return redirect(route('projcets.newweb'))->with('success',__('site.success'));
    }else{
      return redirect(route('projcets.newweb'))->with('error',__('site.error'));
    }
  }
  
  public function error(Request $request) {
    session()->forget('unit_id');
    return redirect(route('projcets.newweb'))->with('error',__('site.error'));
  }
}
