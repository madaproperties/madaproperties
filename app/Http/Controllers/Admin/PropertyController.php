<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Property;
use Spatie\Permission\Models\Role;
use App\City;
use App\Campaing;
use App\Source;
use App\Country;
use App\PurposeType;
use App\User;
use App\PropertyDocuments;
use App\PropertyImages;
use App\Features;
use App\PropertyFeatures;
use App\PropertyPortals;
use App\Categories;
use Image;
use Mail;
use App\Mail\PropertyNotification;

class PropertyController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     function __construct()
     {
        $this->middleware('permission:property-list', ['only' => ['index']]);
        $this->middleware('permission:property-create', ['only' => ['create','store']]);
        $this->middleware('permission:property-edit', ['only' => ['show','edit']]);
        $this->middleware('permission:property-delete', ['only' => ['destroy']]);
     }
     
   

  // index 
  public function index(){


    if(userRole() == 'admin' || userRole() == 'sales admin uae'){ //Updated by Javed
      $property = Property::where(function ($q){
        $this->filterPrams($q);
      })->orderBy('last_updated','desc');
    }else{
      $property = Property::where(function ($q){
        $this->filterPrams($q);
      })->where('created_by',auth()->id())->orderBy('last_updated','desc');
    }
    $properties = $property->paginate(20);
    $property_count = $property->count();
    $categories = Categories::get(); 

    $sellers = [];
    if(userRole() == 'leader'){
      $id = auth()->id();
      $sellers = User::where('active','1')->where('leader',$id)
                      ->OrWhere('id',$id)
                      ->orderBy('email')->get();
    }elseif(userRole() == 'admin' || userRole() == 'sales admin uae') {
      $sellers = User::where('active','1')->where('rule','sales')
                      ->orWhere('rule','leader')
                      ->orderBy('email')->get();
    }elseif(userRole() == 'sales admin'){
      $leader = auth()->user()->leader;
      if($leader) {
         $sellers = User::where('active','1')->where('leader',$leader)
                           ->where('id','!=',auth()->id())
                          ->Orwhere('id',$leader)
                          ->orderBy('email')->get();
      }
    }    

    return view('admin.property.index',compact('properties','property_count','categories','sellers'));
  }

  public function create()
  {

    $cities = City::orderBy('name_en')->where('country_id',2)->get();
    $countries = Country::orderBy('name_en')->get();	
    $campaigns =Campaing::where('active','1')->orderBy('name')->get();	    
    $sources = Source::where('active','1')->orderBy('name')->get();
    $purposeType = PurposeType::orderBy('type')->get();

    $sellers = [];
    if(userRole() == 'leader'){
      $id = auth()->id();
      $sellers = User::where('active','1')->where('leader',$id)
                      ->OrWhere('id',$id)
                      ->orderBy('email')->get();
    }elseif(userRole() == 'admin' || userRole() == 'sales admin uae') {
      $sellers = User::where('active','1')->where('rule','sales')
                      ->orWhere('rule','leader')
                      ->orderBy('email')->get();
    }elseif(userRole() == 'sales admin'){
      $leader = auth()->user()->leader;
      if($leader) {
         $sellers = User::where('active','1')->where('leader',$leader)
                           ->where('id','!=',auth()->id())
                          ->Orwhere('id',$leader)
                          ->orderBy('email')->get();
      }
    }
    $unitFeatures = Features::where('feature_type',1)->get();
    $devFeatures = Features::where('feature_type',2)->get();
    $lifeStyleFeatures = Features::where('feature_type',3)->get();
    $categories = Categories::get(); 
    return view('admin.property.create',compact('cities','countries','campaigns','sources','purposeType','sellers','lifeStyleFeatures','categories','devFeatures','unitFeatures'));
  }

  /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
  public function store(Request $request) {

    $data = $request->validate([
      "title" => 'required',
      "unitno" => 'nullable',
      "str_no" => 'nullable',
      "sale_rent" => 'nullable',
      "street" => 'nullable',
      "measure_unit" => 'nullable',
      "buildup_area" => 'nullable',
      "plot_size" => 'nullable',
      "parking_type" => 'nullable',
      "parking_areas" => 'nullable',
      "floor" => 'nullable',
      "city_id" => 'nullable',
      "area_name" => 'nullable',
      "project_name" => 'nullable',
      "building_name" => 'nullable',
      "source_id" => 'nullable',
      //"channel_id" => 'required',
      "campaign_id" => 'nullable',
      //"view" => 'nullable',
      "category_id" => 'required',
      "price_type" => 'nullable',
      "price" => 'required',
      "price_on_application" => 'nullable',
      "price_unit" => 'nullable',
      "bedrooms" => 'nullable',
      "bathrooms" =>'nullable',
      "cheques" => 'nullable',
      "deposit" => 'nullable',
      "furnished" => 'nullable',
      "owner_id" => 'nullable',
      "description" => 'nullable',
      "user_id" => 'nullable',
      "tuser_id" => 'nullable',
      "created_by" => 'nullable',
      "match_leads" => 'nullable',
      "status" => 'nullable',
      "stage" => 'nullable',
      // "unit_features" => 'nullable',
      // "dev_feature" => 'nullable',
      // "lifestyle" => 'nullable',
      // "notes" => 'nullable',
      "is_featured" => 'nullable',
      "fitted" => 'nullable',
      "tenanted" => 'nullable',
      "rent_price" => 'nullable',
      "project_status" => 'nullable',
      "dname" => 'nullable',
      "rented_till" => 'nullable',
      "next_available" => 'nullable',
      "maint_fee" => 'nullable',
      "dewa" => 'nullable',
      "postal_code" => 'nullable',
      //"reminder" => 'nullable',
      "virtual_360" => 'nullable',
      "floorplan" => 'nullable',
      "video" => 'nullable',
      "contact_no" => 'nullable',
      "mobile" => 'nullable',
      "owner_name" => 'nullable',
      "email" => 'nullable',
      "verified" => 'nullable',
      "treason" => 'nullable',
      "tdate" => 'nullable',
      "passport_emirates_id" => 'nullable',
      "title_deed" => 'nullable',
      "forma_noc_slform" => 'nullable',
      'description'   => 'nullable',
      'unverified_reason' => 'nullable',
      'is_managed' => 'nullable',
      'is_exclusive' => 'nullable',
      'verified_date' => 'nullable',

    ]);

    // if(isset($data['is_managed'])){
    //   $data['is_managed']=1;
    // }else{
    //   $data['is_managed']=0;
    // }

    if(isset($data['is_exclusive'])){
      $data['is_exclusive']=1;
    }else{
      $data['is_exclusive']=0;
    }

    
    $data['created_at'] = Carbon::now();
    $data['created_by'] = auth()->id();
    $data['user_id'] = auth()->id();
    addHistory('Property',0,'added',$data);

    $property = Property::create($data);

    if(\Session::get('tempImages')){
      foreach(\Session::get('tempImages') as $image){
        PropertyImages::create([
          'property_id' => $property->id,
          'images_link' => $image
        ]);
      }
      session()->forget('tempImages');  
    } 


    if(\Session::get('tempDocuments')){
      foreach(\Session::get('tempDocuments') as $document){
        PropertyDocuments::create([
          'property_id' => $property->id,
          'document_link' => $document
        ]);
      }
      session()->forget('tempDocuments');  
    } 
    if(\Session::get('tempFeatures')){
      $temp = [];
      $i = 0;
      foreach(\Session::get('tempFeatures') as $key => $value){
        foreach($value as $rs){
          $temp[$i]['property_id'] = $property->id;
          $temp[$i++]['feature_id'] = $rs;
        }
      }
      \DB::table("property_features")->insert($temp); 
      session()->forget('tempFeatures');  
    } 

    if(\Session::get('tempPortals')){
      $temp = [];
      $i = 0;
      foreach(\Session::get('tempPortals') as $key => $value){
        foreach($value as $rs){
          $temp[$i]['property_id'] = $property->id;
          $temp[$i++]['portal_id'] = $rs;
        }
      }
      \DB::table("property_portals")->insert($temp); 
      session()->forget('tempPortals');  
    } 
    Property::where('id',$property->id)->update(['crm_id'=>'MADA-'.$property->id]);

    //Send notifiction to users whos role is sales admin uae
    $users = User::where('rule','sales admin uae')->where('active',1)->get()->pluck(['email'])->toArray();
    $mailData = [
      'id' => $property->id,
      'agent' => $property->agent->name
    ];
    Mail::to($users)->send(new PropertyNotification($mailData));

    return redirect(route('admin.property.index'))->withSuccess(__('site.success'));
  }

  public function update(Request $request,  $id)
  {

    $property = Property::findOrFail($id);

    $data = $request->validate([
      "title" => 'required',
      "unitno" => 'nullable',
      "str_no" => 'nullable',
      "sale_rent" => 'nullable',
      "street" => 'nullable',
      "measure_unit" => 'nullable',
      "buildup_area" => 'nullable',
      "plot_size" => 'nullable',
      "parking_type" => 'nullable',
      "parking_areas" => 'nullable',
      "floor" => 'nullable',
      "city_id" => 'nullable',
      "area_name" => 'nullable',
      "project_name" => 'nullable',
      "building_name" => 'nullable',
      "source_id" => 'nullable',
      //"channel_id" => 'required',
      "campaign_id" => 'nullable',
      //"view" => 'nullable',
      "category_id" => 'required',
      "price_type" => 'nullable',
      "price" => 'required',
      "price_on_application" => 'nullable',
      "price_unit" => 'nullable',
      "bedrooms" => 'nullable',
      "bathrooms" =>'nullable',
      "cheques" => 'nullable',
      "deposit" => 'nullable',
      "furnished" => 'nullable',
      "owner_id" => 'nullable',
      "description" => 'nullable',
      "user_id" => 'nullable',
      "tuser_id" => 'nullable',
      "created_by" => 'nullable',
      "match_leads" => 'nullable',
      "status" => 'nullable',
      "stage" => 'nullable',
      // "unit_features" => 'nullable',
      // "dev_feature" => 'nullable',
      // "lifestyle" => 'nullable',
      // "notes" => 'nullable',
      "is_featured" => 'nullable',
      "fitted" => 'nullable',
      "tenanted" => 'nullable',
      "rent_price" => 'nullable',
      "project_status" => 'nullable',
      "dname" => 'nullable',
      "rented_till" => 'nullable',
      "next_available" => 'nullable',
      "maint_fee" => 'nullable',
      "dewa" => 'nullable',
      "postal_code" => 'nullable',
      //"reminder" => 'nullable',
      "virtual_360" => 'nullable',
      "floorplan" => 'nullable',
      "video" => 'nullable',
      "contact_no" => 'nullable',
      "mobile" => 'nullable',
      "owner_name" => 'nullable',
      "email" => 'nullable',
      "verified" => 'nullable',
      "treason" => 'nullable',
      "tdate" => 'nullable',
      "passport_emirates_id" => 'nullable',
      "title_deed" => 'nullable',
      "forma_noc_slform" => 'nullable',
      'description'   => 'nullable',
      'unverified_reason' => 'nullable',
      'is_managed' => 'nullable',
      'is_exclusive' => 'nullable',
      'verified_date' => 'nullable',
    ]);

    // if(isset($data['is_managed'])){
    //   $data['is_managed']=1;
    // }else{
    //   $data['is_managed']=0;
    // }

    if(isset($data['is_exclusive'])){
      $data['is_exclusive']=1;
    }else{
      $data['is_exclusive']=0;
    }

    $data['updated_at'] = Carbon::now();
    $data['last_updated'] = Carbon::now();
    if($property->status != 1 && $data['status'] == 1){
      $data['publishing_date'] = Carbon::now();
    }
    addHistory('Property',$id,'updated',$data,$property);
    $property->update($data);

    return redirect(route('admin.property.index'))->withSuccess(__('site.success'));
  }


  public function destroy ($id)
  {
    $data = Property::findOrFail($id);
    $data->delete();
    addHistory('Property',$id,'deleted');    
    return back()->withSuccess(__('site.success'));
  }

  public function show($id)
  {
    $property = Property::findOrFail($id);

    $cities = City::orderBy('name_en')->where('country_id',2)->get();
    $countries = Country::orderBy('name_en')->get();	
    $campaigns =Campaing::where('active','1')->orderBy('name')->get();	    
    $sources = Source::where('active','1')->orderBy('name')->get();
    $purposeType = PurposeType::orderBy('type')->get();

    $sellers = [];
    if(userRole() == 'leader'){
      $id = auth()->id();
      $sellers = User::where('active','1')->where('leader',$id)
                      ->OrWhere('id',$id)
                      ->orderBy('email')->get();
    }elseif(userRole() == 'admin' || userRole() == 'sales admin uae') {
      $sellers = User::where('active','1')->where('rule','sales')
                      ->orWhere('rule','leader')
                      ->orderBy('email')->get();
    }elseif(userRole() == 'sales admin'){
      $leader = auth()->user()->leader;
      if($leader) {
         $sellers = User::where('active','1')->where('leader',$leader)
                           ->where('id','!=',auth()->id())
                          ->Orwhere('id',$leader)
                          ->orderBy('email')->get();
      }
    }    
    $features = Features::get();
    $propertyFeatures = [];
    $propertyPortals = [];
    if($property->features){
      foreach ($property->features as $value) {
        $propertyFeatures[] = $value->feature_id;
      }
    }

    if($property->portals){
      foreach ($property->portals as $value) {
        $propertyPortals[] = $value->portal_id;
      }
    }

    $unitFeatures = Features::where('feature_type',1)->get();
    $devFeatures = Features::where('feature_type',2)->get();
    $lifeStyleFeatures = Features::where('feature_type',3)->get();
    
    $categories = Categories::get(); 
    return view('admin.property.show',compact('property','cities','countries','campaigns','sources','purposeType','sellers','unitFeatures','propertyFeatures','propertyPortals','categories','lifeStyleFeatures','devFeatures'));

  }  

  public function exportDataCash(){
    if(Request()->has('exportData')){
      return Excel::download(new CashExport, 'CashReport_'.date('d-m-Y').'.xlsx');
    }  
  }

  public function deleteImage($id)
  {
    $data = PropertyImages::findOrFail($id);
    Property::where('id',$data->property_id)->update(['updated_at'=>Carbon::now(),'last_updated'=>Carbon::now()]);
    $data->delete();
    addHistory('PropertyImage',$id,'deleted');    
    return back()->withSuccess(__('site.success'));
  }

  public function deleteDocument($id)
  {
    $data = PropertyDocuments::findOrFail($id);
    $data->delete();
    addHistory('PropertyDocument',$id,'deleted');    
    return back()->withSuccess(__('site.success'));
  }

  public function brochure($id)
  {
    $property = Property::findOrFail($id);

    //dd($property->images[0]->images_link);
    return view('admin.property.brochure',compact('property'));

  }

  public function imageStore(Request $request)
  {
    $html = '';
    if($request->hasFile('photos')) {
      $allowedfileExtension=['gif','jpg','jpeg','png'];
      $files = $request->file('photos');
      foreach($files as $file){
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $check=in_array($extension,$allowedfileExtension);
        if($check) {

          $md5Name = md5_file($file->getRealPath());
          $guessExtension = $file->guessExtension();

         
              

          if(Request('property_id')){
            $property_id = Request('property_id');
            //$file = $file->move('public/uploads/property/'.$property_id.'/images', $md5Name.'.'.$guessExtension);     
            $filename = $md5Name.'.'.$guessExtension;
            $destinationPath = 'public/uploads/property/'.$property_id.'/images';
            if (!is_dir($destinationPath)){ 
              mkdir($destinationPath, 0777, true);
            }

            //Upload Images One After the Order into folder
            $img = Image::make($file->getRealPath());
            $watermark = Image::make(public_path('/images/Mada-Watermark.png'));                
            $img->insert($watermark, 'center');
            $img->save($destinationPath.'/'.$filename);
            
            PropertyImages::create([
            'property_id' => $property_id,
            'images_link' => $filename
            ]);
            $publicPath='public/uploads/property/'.$property_id.'/images/';
          }else{
            //$file = $file->move('public/uploads/temp/images', $md5Name.'.'.$guessExtension);   

            $filename = $md5Name.'.'.$guessExtension;
            $destinationPath = 'public/uploads/temp/images';
            if (!is_dir($destinationPath)){ 
              mkdir($destinationPath, 0777, true);
            }
            //Upload Images One After the Order into folder
            $img = Image::make($file->getRealPath());
            $watermark = Image::make(public_path('/images/Mada-Watermark.png'));                
            $img->insert($watermark, 'center');
            $img->save($destinationPath.'/'.$filename);

            \Session::push('tempImages', $filename);
            $publicPath='public/uploads/temp/images/';
          }
          $html .= '<div class="col-xl-4" style="float:left" id="'.str_replace(".","-",$filename).'">
          <div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">                        
            <img src="'.asset($publicPath.$filename).'" style="width:215px;height:147px">
        </div><a href="javascript:void(0)" class="checkbox deleteImage" data-value="'.$filename.'">Delete</a>
        <a href="'.asset($publicPath.$filename).'" target="_blank">View</a></div>';

        }
      }    
      
    }
    return response()->json(['success'=>true,'images'=>$html]);
  }

  public function imageDestroy(Request $request)
  {
    if(\Session::get('tempImages')){
      $images = \Session::get('tempImages'); // Get the array
      $imageName =  $request->get('imageName');
      if(isset($images[$imageName])){
        unset($images[$imageName]); // Unset the index you want
        session()->put('tempImages', $images); // Set the array again      
        $path=public_path().'/uploads/temp/images/'.$imageName;
        if (file_exists($path)) {
            unlink($path);
        }
        return $imageName;         
      }
    }
    if(Request('property_id')){
      $imageName =  $request->get('imageName');
      $property_id =  $request->get('property_id');
      $images = PropertyImages::where('images_link',$imageName)->delete();
      if($images){

        Property::where('id',Request('property_id'))->update(['updated_at'=>Carbon::now(),'last_updated'=>Carbon::now()]);

        $path=public_path().'public/uploads/property/'.$property_id.'/images/'.$imageName;
        if (file_exists($path)) {
            unlink($path);
        }
        return $imageName;  
      }
    }  
    \Session::forget('tempImages');      
  }  


  public function documentStore(Request $request)
  {
    $html = '';
    if($request->hasFile('documents')) {
      $allowedfileExtension=['pdf','xlsx','xls','doc', 'docx','ppt', 'pptx','txt','png','jpg','jpeg'];
      $files = $request->file('documents');
      foreach($files as $file){
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $check=in_array($extension,$allowedfileExtension);
        if($check) {

          $md5Name = md5_file($file->getRealPath());
          $guessExtension = $file->guessExtension();
          if(Request('property_id')){
            $property_id = Request('property_id');
            $file = $file->move('public/uploads/property/'.$property_id.'/documents', $md5Name.'.'.$guessExtension);     
            $filename = $md5Name.'.'.$guessExtension;
            PropertyDocuments::create([
            'property_id' => $property_id,
            'document_link' => $filename
            ]);
            $publicPath='public/uploads/property/'.$property_id.'/documents/';
          }else{
            $file = $file->move('public/uploads/temp/documents', $md5Name.'.'.$guessExtension);     
            $filename = $md5Name.'.'.$guessExtension;
            \Session::push('tempDocuments', $filename);
            $publicPath='public/uploads/temp/documents/';
          }
          $html .= '<div class="col-xl-4" id="'.str_replace(".","-",$filename).'">
          <div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">                        
            <p>'.$filename.'<a href="javascript:void(0)" class="checkbox deleteDocument" data-value="'.$filename.'">Delete</a>
            <a href="'.asset($publicPath.$filename).'" target="_blank">View</a></div></p>
        </div>';

        }
      }    
      
    }
    return response()->json(['success'=>true,'images'=>$html]);
  }
  public function documentDestroy(Request $request)
  {
    if(\Session::get('tempDocuments')){
      $documents = \Session::get('tempDocuments'); // Get the array
      $documentName =  $request->get('documentName');
      if(isset($documents[$documentName])){
        unset($documents[$documentName]); // Unset the index you want
        session()->put('tempDocuments', $documents); // Set the array again      
        $path=public_path().'/uploads/temp/documents/'.$documentName;
        if (file_exists($path)) {
            unlink($path);
        }
        return $documentName;         
      }
    }
    if(Request('property_id')){
      $documentName =  $request->get('documentName');
      $property_id =  $request->get('property_id');
      $documents = PropertyDocuments::where('document_link',$documentName)->delete();
      if($documents){
        $path=public_path().'public/uploads/property/'.$property_id.'/documents/'.$documentName;
        Storage::disk('s3')->put('images', $request->image);
        if (file_exists($path)) {
            unlink($path);
        }
        return $documentName;  
      }
    } 
    \Session::forget('tempDocuments');
  }  



  public function getPropertyImages(Request $request)
  {
    $html = '';
    if(Request('property_id')){
      $property_id = Request('property_id');
      $images = PropertyImages::where('property_id',$property_id)->get();
      if($images){
        foreach($images as $image){
          $html .= '<div class="col-sm-3">
                        <img src="'.$image.'"   style="width:150px;">
                    <div>';
        }
      }
    }else{
      $images = \Session::get('tempImages');
      if($images){
        foreach($images as $image){
          $html .= '<div class="col-sm-3">
                        <img src="'.asset('public/uploads/temp/'.$image).'" style="width:150px;">
                    <div>';
        }
      }      
    }
    return response()->json(['success'=>true,'images'=>$html]);
  }  

  public function saveFeatures(Request $request)
  {
    $html = '';
    if($request->has('features')) {
      if(Request('property_id')){
        $property_id = Request('property_id');
        $feature_type = Request('feature_type');
        $features = Request('features');
        $temp = [];
        $i = 0;
        $featureIds = [];
        foreach ($features as $value) {
          $temp[$i]['property_id'] = $property_id;
          $temp[$i++]['feature_id'] = $value;
          $featureIds[] = $value;
        }
        PropertyFeatures::where('property_id',$property_id)->whereIn('feature_id',$featureIds)->delete();
        \DB::table("property_features")->insert($temp);
        
        Property::where('id',$property_id)->update(['updated_at'=>Carbon::now(),'last_updated'=>Carbon::now()]);
      }else{
        $features = Request('features');
        \Session::push('tempFeatures', $features);
      }
    }
    return response()->json(['success'=>true]);
  }

  public function savePortals(Request $request)
  {
    $html = '';
    if($request->has('portals')) {
      if(Request('property_id')){
        $property_id = Request('property_id');
        $portals = Request('portals');
        $temp = [];
        $i = 0;
        foreach ($portals as $value) {
          $temp[$i]['property_id'] = $property_id;
          $temp[$i++]['portal_id'] = $value;
        }
        PropertyPortals::where('property_id',$property_id)->delete();
        \DB::table("property_portals")->insert($temp);

        Property::where('id',$property_id)->update(['updated_at'=>Carbon::now(),'last_updated'=>Carbon::now()]);
      }else{
        $portals = Request('portals');
        \Session::push('tempPortals', $portals);
      }
    }
    return response()->json(['success'=>true]);
  }

  public function propertyBayutXml(Request $request){
    $properties = Property::join('property_portals','property_portals.property_id','=','properties.id')
    ->where('property_portals.portal_id',2)
    ->where('status',1)
    ->get();
    
    header('Content-Type: text/xml');

    $xw = xmlwriter_open_memory();
    xmlwriter_set_indent($xw, 1);
    $res = xmlwriter_set_indent_string($xw, ' ');
    
    xmlwriter_start_document($xw, '1.0', 'UTF-8');
    
    // A first element
    xmlwriter_start_element($xw, 'Properties');
    $i = 1;

    $defaultAgent = User::where('email','omar.ali@madaproperties.com')->first();
    foreach ($properties as $property) {
      // Start a child element
      xmlwriter_start_element($xw, 'Property');
          
        // CDATA
        xmlwriter_start_element($xw, 'Property_Ref_No');
        xmlwriter_write_cdata($xw,$property->crm_id);
        xmlwriter_end_element($xw); // Count

        $sale_rent = '';
        if($property->sale_rent == '1'){
          $sale_rent = 'Buy';
        }else if($property->sale_rent == '2'){
          $sale_rent = 'Rent';
        }
        xmlwriter_start_element($xw, 'Property_purpose');
        xmlwriter_write_cdata($xw, $sale_rent);
        xmlwriter_end_element($xw); // Count
        
        if($property->category){
          xmlwriter_start_element($xw, 'Property_Type');
          xmlwriter_write_cdata($xw, $property->category->category_name);
          xmlwriter_end_element($xw); // Count
        }
        
        $status=''; 
        if($property->status == '1'){
          $status = 'live';
        }else if($property->status == '5'){
          $status = 'archive';
        }
        xmlwriter_start_element($xw, 'Property_Status');
        xmlwriter_write_cdata($xw, $status);
        xmlwriter_end_element($xw); // Count


        if($property->city){
          xmlwriter_start_element($xw, 'City');
          xmlwriter_write_cdata($xw, $property->city->name_en);
          xmlwriter_end_element($xw); // Count
        }

        if($property->area_name){
          xmlwriter_start_element($xw, 'Locality');
          xmlwriter_write_cdata($xw, $property->area_name);
          xmlwriter_end_element($xw); // Count
        }

        if($property->project_name){
          xmlwriter_start_element($xw, 'Sub_Locality');
          xmlwriter_write_cdata($xw, $property->project_name);
          xmlwriter_end_element($xw); // Count
        }

        if($property->building_name){
          xmlwriter_start_element($xw, 'Tower_Name');
          xmlwriter_write_cdata($xw, $property->building_name);
          xmlwriter_end_element($xw); // Count
        }

        xmlwriter_start_element($xw, 'Property_Size');
        xmlwriter_write_cdata($xw, $property->buildup_area);
        xmlwriter_end_element($xw); // Count

        $measure_unit = '';
        if($property->measure_unit == '1'){
          $measure_unit=strtoupper(__('config.measure_unit.'.$property->measure_unit));
        }else if($property->measure_unit == '2'){
          $measure_unit=strtoupper(__('config.measure_unit.'.$property->measure_unit));
        }
        xmlwriter_start_element($xw, 'Property_Size_Unit');
        xmlwriter_write_cdata($xw, $measure_unit);
        xmlwriter_end_element($xw); // Count

        xmlwriter_start_element($xw, 'Bedrooms');
        xmlwriter_write_cdata($xw, !empty($property->bedrooms) ? __('config.bedrooms.'.$property->bedrooms) : 0);
        xmlwriter_end_element($xw); // Count

        xmlwriter_start_element($xw, 'Bathroom');
        xmlwriter_write_cdata($xw, !empty($property->bathrooms) ? $property->bathrooms : -1);
        xmlwriter_end_element($xw); // Count

        xmlwriter_start_element($xw, 'Price');
        $price = $property->price;
        if($property->yprice){
          $price = $property->yprice;
        }
        xmlwriter_write_cdata($xw, $price);
        xmlwriter_end_element($xw); // Count

        if($property->agent && $property->agent->is_rera_active){
          xmlwriter_start_element($xw, 'Listing_Agent');
          xmlwriter_write_cdata($xw, $property->agent->username);
          xmlwriter_end_element($xw); // Count
            
          xmlwriter_start_element($xw, 'Listing_Agent_Phone');
          xmlwriter_write_cdata($xw, $property->agent->mobile_no);
          xmlwriter_end_element($xw); // Count
            
          xmlwriter_start_element($xw, 'Listing_Agent_Email');
          xmlwriter_write_cdata($xw, $property->agent->email);
          xmlwriter_end_element($xw); // Count
        }else{
          if($defaultAgent){
            xmlwriter_start_element($xw, 'Listing_Agent');
            xmlwriter_write_cdata($xw, $defaultAgent->username);
            xmlwriter_end_element($xw); // Count
              
            xmlwriter_start_element($xw, 'Listing_Agent_Phone');
            xmlwriter_write_cdata($xw, $defaultAgent->mobile_no);
            xmlwriter_end_element($xw); // Count
              
            xmlwriter_start_element($xw, 'Listing_Agent_Email');
            xmlwriter_write_cdata($xw, $defaultAgent->email);
            xmlwriter_end_element($xw); // Count
          }
        }  

        

        if($property->features && count($property->features)){
          xmlwriter_start_element($xw, 'Facilities');
          foreach($property->features as $feature){
            xmlwriter_start_element($xw, 'Facility');
              xmlwriter_write_cdata($xw, $this->getFeatureName($feature->feature_id));
            xmlwriter_end_element($xw); // Facility
          }
          xmlwriter_end_element($xw); // Facilities
        }


        if($property->images && count($property->images)){
          xmlwriter_start_element($xw, 'Images');
          foreach($property->images as $image){
            xmlwriter_start_element($xw, 'ImageUrl');
              xmlwriter_write_cdata($xw, asset('public/uploads/property/'.$property->id.'/images/'.$image->images_link));
              //xmlwriter_write_cdata($xw, $image->temp_image);
            xmlwriter_end_element($xw); // ImageUrl
          }
          xmlwriter_end_element($xw); // Images
        }
                  
        if($property->floorplan){
          xmlwriter_start_element($xw, 'Floor_Plans');
          xmlwriter_write_cdata($xw, $property->floorplan);
          xmlwriter_end_element($xw); // Count
        }

        xmlwriter_start_element($xw, 'Last_Updated');
        xmlwriter_write_cdata($xw, $property->last_updated);
        xmlwriter_end_element($xw); // Count

        // CDATA
        xmlwriter_start_element($xw, 'Permit_Number');
        xmlwriter_write_cdata($xw, $property->str_no);
        xmlwriter_end_element($xw); // Count


        if($property->video){
          xmlwriter_start_element($xw, 'Videos');
          xmlwriter_write_cdata($xw, $property->video);
          xmlwriter_end_element($xw); // Video
        }

        if($property->is_exclusive){
          xmlwriter_start_element($xw, 'Off_plan');
          xmlwriter_write_cdata($xw, $property->is_exclusive == '1' ? 'Yes' : 'No');
          xmlwriter_end_element($xw); // Count
        }

        xmlwriter_start_element($xw, 'Rent_Frequency');
        xmlwriter_write_cdata($xw, 'yearly');
        xmlwriter_end_element($xw); // Count

        xmlwriter_start_element($xw, 'Property_Title');
        xmlwriter_write_cdata($xw, $property->title);
        xmlwriter_end_element($xw); // Count

        xmlwriter_start_element($xw, 'Property_Description');
        xmlwriter_write_cdata($xw, $property->description);
        xmlwriter_end_element($xw); // Count


        // xmlwriter_start_element($xw, 'No_of_Rooms');
        // xmlwriter_write_cdata($xw, $property->rooms);
        // xmlwriter_end_element($xw); // Count

        // xmlwriter_start_element($xw, 'No_of_Bathrooms');
        // xmlwriter_write_cdata($xw, $property->bathrooms);
        // xmlwriter_end_element($xw); // Count

        // xmlwriter_start_element($xw, 'Property_Title');
        // xmlwriter_write_cdata($xw, $property->title);
        // xmlwriter_end_element($xw); // Count

        // xmlwriter_start_element($xw, 'Web_Remarks');
        // xmlwriter_write_cdata($xw, $property->description);
        // xmlwriter_end_element($xw); // Count

        

        
        // xmlwriter_start_element($xw, 'Listing_Date');
        // xmlwriter_write_cdata($xw, $property->created_at);
        // xmlwriter_end_element($xw); // Listing_Date
          
        // xmlwriter_start_element($xw, 'Last_Updated');
        // xmlwriter_write_cdata($xw, $property->updated_at);
        // xmlwriter_end_element($xw); // Last_Updated
          
        
          
        // xmlwriter_start_element($xw, 'unit_measure');
        // xmlwriter_write_cdata($xw, $property->measure_unit);
        // xmlwriter_end_element($xw); // unit_measure
          
        // xmlwriter_start_element($xw, 'Permit_Id');
        // xmlwriter_write_cdata($xw, $property->str_no);
        // xmlwriter_end_element($xw); // Permit_Id
          
        // xmlwriter_start_element($xw, 'featured_on_companywebsite');
        // xmlwriter_write_cdata($xw, $property->forma_noc_slform);
        // xmlwriter_end_element($xw); // featured_on_companywebsite
          
        // xmlwriter_start_element($xw, 'under_construction');
        // xmlwriter_write_cdata($xw, $property->updated_at);
        // xmlwriter_end_element($xw); // under_construction
          
        // xmlwriter_start_element($xw, 'Off_Plan');
        // if($property->project_status=='1'){ 
        //   xmlwriter_write_cdata($xw, "off_plan");
        // }else{
        //   xmlwriter_write_cdata($xw, "completed");
        // }
        // xmlwriter_end_element($xw); // Off_Plan
          
        // xmlwriter_start_element($xw, 'Cheques');
        // xmlwriter_write_cdata($xw, $property->cheques);
        // xmlwriter_end_element($xw); // Cheques
          
        // xmlwriter_start_element($xw, 'Exclusive_Rights');
        // xmlwriter_write_cdata($xw, $property->is_exclusive ? 'Yes' : 'No');
        // xmlwriter_end_element($xw); // Exclusive_Rights
          
      
      
      xmlwriter_end_element($xw); // Listing
    }
    xmlwriter_end_element($xw); // Listings   

    xmlwriter_end_document($xw);
      
    echo xmlwriter_output_memory($xw);

    die;
  }

  function getFeatureName($id){
    return Features::find($id)->feature_name;
  }


  function propertyFinderXml(){
    $properties = Property::join('property_portals','property_portals.property_id','=','properties.id')
    ->where('property_portals.portal_id',1)
    ->where('status',1)->get();
    $count = Property::join('property_portals','property_portals.property_id','=','properties.id')
    ->where('property_portals.portal_id',1)
    ->where('status',1)->count();
    $last_update = Property::join('property_portals','property_portals.property_id','=','properties.id')
    ->where('property_portals.portal_id',1)
    ->where('status',1)->orderBy('last_updated','desc')->first();

    header('Content-Type: text/xml');
    $xml = '<?xml version="1.0" encoding="utf-8"?>';    
    $xml.="<list last_update='".$last_update->last_updated."' listing_count='".$count."'>";
    $i = 1;

    $defaultAgent = User::where('email','omar.ali@madaproperties.com')->first();

    foreach ($properties as $property) {
      $amenities = $this->get_amenities($property->id);
      $privateamenities = $amenities['privateamenities'];
      $commercialamenities = $amenities['commercialamenities'];
      $features = $amenities['features'];

      $completion_status="completed";
      if($property->project_status=='1') { $completion_status="off_plan"; }
      
      $permit_number=$property->str_no;

      $sale_rent=$property->sale_rent;
      
      $main_category_id=isset($property->category->main_category_id) ? $property->category->main_category_id : 0;
      $offering_type1=$offering_type2="";
      
      if($sale_rent==1) { $offering_type1="S"; }
      
      else if($sale_rent==2) { $offering_type1="R"; }
      
      if($main_category_id==1) { $offering_type2="R"; }
      
      else if($main_category_id==2) { $offering_type2="C"; }
      
      $offering_type=$offering_type2.$offering_type1;
      
      //$category=$property->category->category_name;
      
      $get_property_type=isset($property->category->pfix) ? $property->category->pfix : "";
      $price=$property->price;
      $dte=date('d');
      if($dte % 2 == 0){ 
        $price=$price-1;      
      }

      $price=str_replace(".00","",$price);
      $city_text = $property->city->name_en;
      $community=$property->area_name;
      $project_name=$property->project_name;
      $building_name=$property->bname;
      
      if($project_name=='Not Specified') { $project_name=""; }
      if($building_name=='Not Specified') { $building_name=""; }
      $longitute=$property->longitute;      
      $latitude=$property->latitude;
      
      $long_lat="";
      if($longitute!="" && $latitude!="") {
        $long_lat=$longitute.",".$latitude;
      }
      


      $xml.="
      <property last_update='".$property->last_updated."'>";
      if($property->crm_id){
        $xml.="<reference_number>".$property->crm_id."</reference_number>";
      }

      if($permit_number){
        $xml.="<permit_number>".$permit_number."</permit_number>";
      }

      if($offering_type){
        $xml.="<offering_type>".$offering_type."</offering_type>";
      }

      if($get_property_type){
        $xml.="<property_type>".$get_property_type."</property_type>";
      }
      $xml.="<price_on_application>".($property->price_on_application == 1 ? 'Yes' : 'No' )."</price_on_application>";
      
    $xml.="<price>";
      if($property->yprice){
        $xml.="<yearly>".$property->yprice."</yearly>";
      }
      if($property->mprice){
        $xml.="<monthly>".$property->mprice."</monthly>";
      }
      if($property->price && $property->mprice ==0 && $property->yprice == 0){
        $xml.=$property->price;
      }
      $xml.="</price>";



      $xml.="<city><![CDATA[".$city_text."]]></city>
      <community><![CDATA[".$community."]]></community>
      <sub_community><![CDATA[".$property->project_name."]]></sub_community>
      <property_name><![CDATA[".$property->building_name."]]></property_name>
      <title_en><![CDATA[".$property->title."]]></title_en>
      <description_en><![CDATA[".$property->description."]]></description_en>";
      if($privateamenities){
        $xml.="<private_amenities>".$privateamenities."</private_amenities>";
      }
      if($commercialamenities){
        $xml.="<commercial_amenities>".$commercialamenities."</commercial_amenities>";
      }
      $xml.="<features>".$features."</features>
      <plot_size>".$property->plot_size."</plot_size>
      <size>".$property->buildup_area."</size>
      <bedroom>".__('config.bedrooms.'.$property->bedrooms)."</bedroom>
      <bathroom>".$property->bathrooms."</bathroom>";
      if($property->agent && $property->agent->is_rera_active){
        $xml .="<agent>
          <id>".$property->agent->id."</id>
          <name><![CDATA[".$property->agent->name."]]></name>
          <email>".$property->agent->name."</email>
          <phone>".$property->agent->mobile_no."</phone>
        </agent>";
      }else{
        if($defaultAgent){
          $xml .="<agent>
            <id>".$defaultAgent->id."</id>
            <name><![CDATA[".$defaultAgent->username."]]></name>
            <email>".$defaultAgent->name."</email>
            <phone>".$defaultAgent->mobile_no."</phone>
          </agent>";
        }
      }
      $xml .="<parking>".$property->parking_areas."</parking>
      <furnished>".($property->furnished == 1 ? 'Yes' : 'No')."</furnished>";

      if($property->virtual_360){
        $xml .="<view360>".($property->virtual_360)."</view360>";
      }
      $xml .="<photo>";
      $x=0;
      $photos="";
      if($property->images && count($property->images)){
        foreach($property->images as $image){
          //$xml.="<url last_updated='".$image->date."' watermark='yes'>".asset('public/uploads/property/'.$property->id.'/images/'.$image->images_link)."</url>";          
          $xml.="<url last_updated='".$image->date."' watermark='yes'>".asset('public/uploads/property/'.$property->id.'/images/'.$image->images_link)."</url>";          
        }
      }
      $xml.="</photo>";
      if($property->geopoints){
        $xml.="<geopoints>".$property->geopoints."</geopoints>";
      }
      $xml.="</property>";
    }
    
    $xml.="</list>";    
    echo $xml;  
    die;
  }  
  
  function propertyDubizzleXml(){
    $properties = Property::join('property_portals','property_portals.property_id','=','properties.id')
    ->where('property_portals.portal_id',3)
    ->where('status',1)
    ->get();
    
    header('Content-Type: text/xml');
    $xml = '<?xml version="1.0" encoding="utf-8"?>';    
    $xml.="<dubizzlepropertyfeed>";
    $i = 1;
    $defaultAgent = User::where('email','omar.ali@madaproperties.com')->first();
    foreach ($properties as $property) {
      $amenities = $this->get_amenities($property->id);
      $privateamenities = $amenities['privateamenities'];
      $commercialamenities = $amenities['commercialamenities'];
      $features = $amenities['features'];

      $completion_status="completed";
      if($property->project_status=='1') { $completion_status="off_plan"; }
      
      $permit_number=$property->str_no;

      $sale_rent=$property->sale_rent;
      
      $main_category_id=isset($property->category->main_category_id) ? $property->category->main_category_id : 0;
      $offering_type1=$offering_type2="";
      
      if($sale_rent==1) { $offering_type1="SP"; }
      
      else if($sale_rent==2) { $offering_type1="RP"; }
      
      $offering_type=$offering_type2.$offering_type1;
      
      //$category=$property->category->category_name;
      
      $get_property_type=isset($property->category->pfix) ? $property->category->pfix : "";
      $price=$property->price;
      $dte=date('d');
      if($dte % 2 == 0){ 
        $price=$price-1;      
      }

      $price=str_replace(".00","",$price);
      //$city_text = $property->city->name_en;
      $community=$property->area_name;
      $project_name=$property->project_name;
      $building_name=$property->bname;
      
      if($project_name=='Not Specified') { $project_name=""; }
      if($building_name=='Not Specified') { $building_name=""; }
      $longitute=$property->longitute;      
      $latitude=$property->latitude;
      
      $long_lat="";
      if($longitute!="" && $latitude!="") {
        $long_lat=$longitute.",".$latitude;
      }
      


      $xml.="
      <property>";
      if($property->stage){
        $xml.="<status>vacant</status>";
      }

      if($offering_type){
        $xml.="<type>".$offering_type."</type>";
      }

      if($get_property_type){
        $xml.="<subtype>".$get_property_type."</subtype>";
      }else{
        $xml.="<subtype>AP</subtype>";
      }

      if($get_property_type == 'CO'){
        $xml.="<commercialtype>".$get_property_type."</commercialtype>";
      }      

      if($property->crm_id){
        $xml.="<refno>".$property->crm_id."</refno>";
      }

      if($permit_number){
        $xml.="<permit_number>".$permit_number."</permit_number>";
      }

      
      
    $xml.="<price>";
      if($property->yprice){
        $xml.="<yearly>".$property->yprice."</yearly>";
      }
      if($property->mprice){
        $xml.="<monthly>".$property->mprice."</monthly>";
      }
      if($property->price && $property->mprice ==0 && $property->yprice == 0){
        $xml.=$property->price;
      }
      $xml.="</price>";



      $xml.="<city><![CDATA[2]]></city>";
      if($property->project_name){
        $xml.="<locationtext><![CDATA[".$property->project_name."]]></locationtext>";
      }else{
        $xml.="<locationtext><![CDATA[Dubai]]></locationtext>";
      }
      $xml.="<building><![CDATA[".$property->building_name."]]></building>
      <title><![CDATA[".$property->title."]]></title>
      <description><![CDATA[".$property->description."]]></description>";
      if($privateamenities){
        $xml.="<privateamenities>".$privateamenities."</privateamenities>";
      }
      if($commercialamenities){
        $xml.="<commercialamenities>".$commercialamenities."</commercialamenities>";
      }
      
      $measure_unit = '';
      if($property->measure_unit == '1'){
        $measure_unit=strtoupper(__('config.measure_unit.'.$property->measure_unit));
      }else if($property->measure_unit == '2'){
        $measure_unit=strtoupper(__('config.measure_unit.'.$property->measure_unit));
      }

      $xml.="<size>".$property->buildup_area."</size>
      <sizeunits>".$measure_unit."</sizeunits>
      <bedrooms>".__('config.bedrooms.'.$property->bedrooms)."</bedrooms>
      <bathrooms>".$property->bathrooms."</bathrooms>";
      if($property->agent && $property->agent->is_rera_active){
        $xml .="<contactemail>".$property->agent->name."</contactemail>
          <contactnumber>".$property->agent->mobile_no."</contactnumber>";
      }else{
        if($defaultAgent){
          $xml .="<contactemail>".$defaultAgent->name."</contactemail>
          <contactnumber>".$defaultAgent->mobile_no."</contactnumber>";
        }
      }
      $xml .="<lastupdated>".($property->last_updated)."</lastupdated>";
      
      if($property->developer){
        $xml .="<developer>".($property->developer)."</developer>";
      }
      if($property->virtual_360){
        $xml .="<view360>".($property->virtual_360)."</view360>";
      }
      if($property->video){
        $xml .="<video_url>".($property->video)."</video_url>";
      }
      if($property->images && count($property->images)){
        $xml .="<photos>";
        $x=0;
        $photo=[];
        foreach($property->images as $image){
          //$xml.="<url last_updated='".$image->date."' watermark='yes'>".asset('public/uploads/property/'.$property->id.'/images/'.$image->images_link)."</url>";          
          $photo[]= asset('public/uploads/property/'.$property->id.'/images/'.$image->images_link);          
        }
        $xml.= implode("|",$photo);
        $xml.="</photos>";
      }

      $xml .="<furnished>".($property->furnished == 1 ? '1' : '0')."</furnished>";

      if($property->geopoints){
        $xml.="<geopoints>".$property->geopoints."</geopoints>";
      }
      $xml.="</property>";
    }
    
    $xml.="</dubizzlepropertyfeed>";    
    echo $xml;  
    die;
  }

  
  function propertyDubizzleHourlyXml(){
    $properties = Property::join('property_portals','property_portals.property_id','=','properties.id')
    ->where('property_portals.portal_id',3)
    ->where('status',1)
    ->where('last_updated','>', Carbon::now()->subDay())
    ->limit(10)
    ->get();
    
    header('Content-Type: text/xml');
    $xml = '<?xml version="1.0" encoding="utf-8"?>';    
    $xml.="<dubizzlepropertyfeed>";
    $i = 1;
    $defaultAgent = User::where('email','omar.ali@madaproperties.com')->first();
    foreach ($properties as $property) {
      $amenities = $this->get_amenities($property->id);
      $privateamenities = $amenities['privateamenities'];
      $commercialamenities = $amenities['commercialamenities'];
      $features = $amenities['features'];

      $completion_status="completed";
      if($property->project_status=='1') { $completion_status="off_plan"; }
      
      $permit_number=$property->str_no;

      $sale_rent=$property->sale_rent;
      
      $main_category_id=isset($property->category->main_category_id) ? $property->category->main_category_id : 0;
      $offering_type1=$offering_type2="";
      
      if($sale_rent==1) { $offering_type1="SP"; }
      
      else if($sale_rent==2) { $offering_type1="RP"; }
      
      $offering_type=$offering_type2.$offering_type1;
      
      //$category=$property->category->category_name;
      
      $get_property_type=isset($property->category->pfix) ? $property->category->pfix : "";
      $price=$property->price;
      $dte=date('d');
      if($dte % 2 == 0){ 
        $price=$price-1;      
      }

      $price=str_replace(".00","",$price);
      $community=$property->area_name;
      $project_name=$property->project_name;
      $building_name=$property->bname;
      
      if($project_name=='Not Specified') { $project_name=""; }
      if($building_name=='Not Specified') { $building_name=""; }
      $longitute=$property->longitute;      
      $latitude=$property->latitude;
      
      $long_lat="";
      if($longitute!="" && $latitude!="") {
        $long_lat=$longitute.",".$latitude;
      }
      


      $xml.="
      <property>";
      if($property->stage){
        $xml.="<status>vacant</status>";
      }

      if($offering_type){
        $xml.="<type>".$offering_type."</type>";
      }

      if($get_property_type){
        $xml.="<subtype>".$get_property_type."</subtype>";
      }else{
        $xml.="<subtype>AP</subtype>";
      }

      if($get_property_type == 'CO'){
        $xml.="<commercialtype>".$get_property_type."</commercialtype>";
      }      

      if($property->crm_id){
        $xml.="<refno>".$property->crm_id."</refno>";
      }

      if($permit_number){
        $xml.="<permit_number>".$permit_number."</permit_number>";
      }

      
      
    $xml.="<price>";
      if($property->yprice){
        $xml.="<yearly>".$property->yprice."</yearly>";
      }
      if($property->mprice){
        $xml.="<monthly>".$property->mprice."</monthly>";
      }
      if($property->price && $property->mprice ==0 && $property->yprice == 0){
        $xml.=$property->price;
      }
      $xml.="</price>";


      $xml.="<city><![CDATA[2]]></city>";

      if($property->project_name){
        $xml.="<locationtext><![CDATA[".$property->project_name."]]></locationtext>";
      }else{
        $xml.="<locationtext><![CDATA[Dubai]]></locationtext>";
      }
      
      $xml.="<building><![CDATA[".$property->building_name."]]></building>
      <title><![CDATA[".$property->title."]]></title>
      <description><![CDATA[".$property->description."]]></description>";
      if($privateamenities){
        $xml.="<privateamenities>".$privateamenities."</privateamenities>";
      }
      if($commercialamenities){
        $xml.="<commercialamenities>".$commercialamenities."</commercialamenities>";
      }
      
      $measure_unit = '';
      if($property->measure_unit == '1'){
        $measure_unit=strtoupper(__('config.measure_unit.'.$property->measure_unit));
      }else if($property->measure_unit == '2'){
        $measure_unit=strtoupper(__('config.measure_unit.'.$property->measure_unit));
      }

      $xml.="<size>".$property->buildup_area."</size>
      <sizeunits>".$measure_unit."</sizeunits>
      <bedrooms>".__('config.bedrooms.'.$property->bedrooms)."</bedrooms>
      <bathrooms>".$property->bathrooms."</bathrooms>";
      if($property->agent && $property->agent->is_rera_active){
        $xml .="<contactemail>".$property->agent->name."</contactemail>
          <contactnumber>".$property->agent->mobile_no."</contactnumber>";
      }else{
        if($defaultAgent){
          $xml .="<contactemail>".$defaultAgent->name."</contactemail>
          <contactnumber>".$defaultAgent->mobile_no."</contactnumber>";
        }
      }
      $xml .="<lastupdated>".($property->last_updated)."</lastupdated>";
      if($property->developer){
        $xml .="<developer>".($property->developer)."</developer>";
      }
      if($property->virtual_360){
        $xml .="<view360>".($property->virtual_360)."</view360>";
      }
      if($property->video){
        $xml .="<video_url>".($property->video)."</video_url>";
      }
      if($property->images && count($property->images)){
        $xml .="<photos>";
        $x=0;
        $photo=[];
        foreach($property->images as $image){
          //$xml.="<url last_updated='".$image->date."' watermark='yes'>".asset('public/uploads/property/'.$property->id.'/images/'.$image->images_link)."</url>";          
          $photo[]= asset('public/uploads/property/'.$property->id.'/images/'.$image->images_link);          
        }
        $xml.= implode("|",$photo);
        $xml.="</photos>";
      }

      $xml .="<furnished>".($property->furnished == 1 ? '1' : '0')."</furnished>";

      if($property->geopoints){
        $xml.="<geopoints>".$property->geopoints."</geopoints>";
      }
      $xml.="</property>";
    }
    
    $xml.="</dubizzlepropertyfeed>";    
    echo $xml;  
    die;
  }
  function get_amenities($property_id){
    $propertyFeature = PropertyFeatures::where('property_id',$property_id)->get();
    $y=0;
    $z=0;
    $privateamenities="";
    $commercialamenities="";
    $features="";
    foreach ($propertyFeature as $rs) {
      $features.= $rs->feature->feature_name.',';
      switch ($rs->feature->feature_name) {
          case "Maid's room":
            if($y!=0) { $privateamenities.=",";}  
            $privateamenities.="MR";
            $y++;
            break;
            case "Covered Parking":
            if($y!=0) { $privateamenities.=",";}  
            $privateamenities.="CP";
            $y++;
            break;
            case "Maid Service":
            if($y!=0) { $privateamenities.=",";}  
            $privateamenities.="MS";
            $y++;
            break;
           case "Concierge Service":
            if($y!=0) { $privateamenities.=",";}  
            $privateamenities.="CS";
            $y++;
            break;
           case "Lobby in Building":
            if($y!=0) { $privateamenities.=",";}  
            $privateamenities.="LB";
            $y++;
            break;
            case "Children's Play Area":
            if($y!=0) { $privateamenities.=",";}  
            $privateamenities.="PR";
            $y++;
            break;
            case "Barbecue Area":
            if($y!=0) { $privateamenities.=",";}  
            $privateamenities.="BR";
            $y++;
            break;
            case "Walk-in Closet":
            if($y!=0) { $privateamenities.=",";}  
            $privateamenities.="WC";
            $y++;
            break;
          case "Study":
            if($y!=0) { $privateamenities.=",";}      
            $privateamenities.="ST";    
            $y++;    
            break; 
            case "Children's Pool":
            if($y!=0) { $privateamenities.=",";}      
            $privateamenities.="CO";    
            $y++;    
            break; 
          case 'Central air conditioning':
            if($y!=0) { $privateamenities.=",";}      
            $privateamenities.="AC";    
            $y++;    
            break;     
          case 'Balcony':
            if($y!=0) { $privateamenities.=",";}      
            $privateamenities.="BA";    
            $y++;    
            break;
          case 'More than one Balcony':    
            if($y!=0) { $privateamenities.=",";}      
            $privateamenities.="BA";    
            $y++;    
            break;
          case 'Private garden':
            if($y!=0) { $privateamenities.=",";}      
            $privateamenities.="PG";    
            $y++;    
            break;
          case 'Landscaped garden':
            if($y!=0) { $privateamenities.=",";}      
            $privateamenities.="PG";    
            $y++;    
            break;
          case 'Private swimming pool':    
            if($y!=0) { $privateamenities.=",";}      
            $privateamenities.="PP";    
            $y++;    
            break;
          case 'Gymnasium':
            if($y!=0) { $privateamenities.=",";}  
            if($z!=0) { $commercialamenities.=",";}  
            $privateamenities.="PY";
            $commercialamenities.="SY";
            $z++;
            $y++;
            break;
          case 'Gym & health club facilities':
            if($y!=0) { $privateamenities.=",";}  
            $privateamenities.="PY";
            $y++;
            break;
          case 'Private Jacuzzi':
            if($y!=0) { $privateamenities.=",";}      
            $privateamenities.="PJ";    
            $y++;
            break;
          case 'Shared swimming pool':
            if($y!=0) { $privateamenities.=",";}  
            $privateamenities.="SP";
            $y++;
            break;
          case '24 hr security desk':
            if($y!=0) { $privateamenities.=",";}  
            $privateamenities.="SE";
            $y++;
            break;
          case 'Covered parking':
            if($y!=0) { $privateamenities.=",";} 
            if($z!=0) { $commercialamenities.=",";} 
            $privateamenities.="CP";
            $commercialamenities.="CP";
            $z++;
            $y++;
            break;	
          case 'Built in wardrobes':
            if($y!=0) { $privateamenities.=",";}  
            $privateamenities.="BW";
            $y++;
            break;
          case 'Fully fitted kitchen':
            if($y!=0) { $privateamenities.=",";}  
            $privateamenities.="BK";
            $y++;
            break;
          case 'View of Landmark':
            if($y!=0) { $privateamenities.=",";}  
            $privateamenities.="BL";
            $y++;
            break;
          case 'View of sea/':
            if($y!=0) { $privateamenities.=",";}  
            $privateamenities.="VW";
            $y++;
            break;
            case 'Vastu-compliant/':
            if($y!=0) { $privateamenities.=",";}  
            $privateamenities.="VC";
            $y++;
            break;
          case 'Pets allowed':
            if($y!=0) { $privateamenities.=",";}  
            $privateamenities.="PA";
            $y++;
            break;		
          case 'Conference room':
            if($z!=0) { $commercialamenities.=",";}  
            $commercialamenities.="CR";
            $z++;
            break;	
              case 'Available Networked':
            if($z!=0) { $commercialamenities.=",";}  
            $commercialamenities.="AN";
            $z++;
            break;
            case 'Dining in building':
            if($z!=0) { $commercialamenities.=",";}  
            $commercialamenities.="DN";
            $z++;
            break;
          case 'Fully furnished':
            if($z!=0) { $commercialamenities.=",";}  
            $commercialamenities.="AF";
            $z++;
            break;		
          case 'Partly furnished':
            if($z!=0) { $commercialamenities.=",";}  
            $commercialamenities.="AF";
            $z++;
            break;		
          case 'Shared gymnasium':
            if($z!=0) { $commercialamenities.=",";}  
            $commercialamenities.="SG";
            $z++;
            break;		
          case 'Shared spa':
            if($z!=0) { $commercialamenities.=",";}  
            $commercialamenities.="SS";
            $z++;
            break;		
          case 'Dining in Building':    
            if($z!=0) { $commercialamenities.=",";}      
            $commercialamenities.="DB";    
            $z++;   
            break;		
          case 'Retail in Building':
            if($z!=0) { $commercialamenities.=",";}      
            $commercialamenities.="RB";    
            $z++;    
            break;		
          default:
          $privateamenities.="";
    
      }
    }
    $return['commercialamenities']=$commercialamenities;
    $return['privateamenities']=$privateamenities;
    $return['features']=$features;
    return $return;
  }
    

  public function readXml(){
    // Loading the XML file
    $xml = simplexml_load_file(url("public/property-finder-xml-04102022.xml")); //Staging 
    //$xml = simplexml_load_file("public\property-finder.xml"); //Local

    echo "<h2>".$xml->attributes()->last_update."</h2><br />";
    $propertArray = [];
    $i=0;
    foreach ($xml->children() as $row) {
      $property = [];
      $property['updated_at'] = $row->attributes()->updated_at;
      $property['crm_id'] = $row->reference_number;
      $property['str_no'] = $row->permit_number;
      $offering_type = strpos($row->offering_type, '-', strpos($row->offering_type, '-') + 1);
      if($offering_type == 'S'){
        $property['sale_rent'] = '1';
      }else{
        $property['sale_rent'] = '2';
      }
      if(isset(Categories::where('pfix',$row->property_type)->first()->id)){
        $property['category_id'] = Categories::where('pfix',$row->property_type)->first()->id;
      }
      $property['price_on_application'] = $row->price_on_application;
      $property['price'] = $row->price;
      $property['yprice'] = $row->price->yearly;
      $property['mprice'] = $row->price->monthly;
      $property['city_id'] = City::where('name_en',$row->city)->first()->id;
      $property['area_name'] = $row->community;
      $property['project_name'] = $row->sub_community;
      $property['building_name'] = $row->property_name;
      //$property['location_id'] = $row->location_id;
      $property['title'] = $row->title_en;
      $property['description'] = $row->description_en;
      $property['buildup_area'] = $row->size;
      $property['bedrooms'] = $row->bedroom;
      $property['bathrooms'] = $row->bathroom;
      $property['user_id'] = $row->agent->id;
      $property['parking_areas'] = $row->parking;
      $property['furnished'] = $row->furnished;
      $property['geopoints'] = $row->geopoints;
      $property['virtual_360'] = $row->view360;

      $property = Property::create($property);

      if($row->photo){
        $urls = (((array)$row->photo)['url']);
        if(count($urls)){
          for($i=0; $i < count($urls); $i++){
            $fileName = $urls[$i];
            $nameArray = explode('/',$fileName);
            $destinationPath = 'public/uploads/property/'.$property->id.'/images';
            if (!is_dir($destinationPath)){ 
              mkdir($destinationPath, 0777, true);
            }
            copy($fileName,$destinationPath.'/'.end($nameArray));
        
            PropertyImages::create([
              'property_id' => $property->id,
              'images_link' => end($nameArray),
              'temp_image' => $urls[$i]
            ]);
          }          
        }
      }
      $temp = [];
      for($j=0; $j < 10; $j++) {
        $temp[$i]['property_id'] = $property->id;
        $temp[$i++]['feature_id'] = Features::inRandomOrder()->first()->id;
      }
      \DB::table("property_features")->insert($temp);
     
      \DB::table("property_portals")->insert(['property_id'=>$property->id,'portal_id'=>1]);  

    }
    echo "<pre>";
    print_r($propertArray);
    die;
  }

  public function readBayutXml(){
    // Loading the XML file
    $xml = simplexml_load_file(url("public/bayut-xml-04102022.xml")); //Staging 
    //$xml = simplexml_load_file("public\property-finder.xml"); //Local

    $propertArray = [];
    $i=0;
    foreach ($xml->children() as $row) {
      $property = [];
      $property['updated_at'] = $row->Last_Updated;
      $property['crm_id'] = $row->Property_Ref_No;
      $property['str_no'] = $row->Permit_Id;
      if($row->Ad_Type == 'Rent'){
        $property['sale_rent'] = '2';
      }else{
        $property['sale_rent'] = '1';
      }
      if(isset(Categories::where('category_name',$row->Unit_Type)->first()->id)){
        $property['category_id'] = Categories::where('category_name',$row->Unit_Type)->first()->id;
      }
      $property['price'] = $row->Price;
      if($row->Frequency == 'yearly'){
        $property['yprice'] = $row->Price;
        $property['price'] = 0;
      }else if($row->Frequency == 'monthly'){
        $property['mprice'] = $row->Price;
        $property['yprice'] = 0;
        $property['price'] = 0;
      }
      $property['city_id'] = City::where('name_en',$row->Emirate)->first()->id;
      $property['area_name'] = $row->Community;
      $property['project_name'] = $row->Property_Name;
      //$property['location_id'] = $row->location_id;
      $property['title'] = $row->Property_Title;
      $property['description'] = $row->Web_Remarks;
      $property['measure_unit'] = $row->unit_measure;
      $property['bedrooms'] = $row->No_of_Rooms;
      $property['bathrooms'] = $row->No_of_Bathrooms;
      $property['user_id'] = 43;
      $property['cheques'] = $row->Cheques;
      $property['latitude'] = $row->Geopoints->Latitude;
      $property['longitude'] = $row->Geopoints->Longitude;
      $property['is_exclusive'] = $row->Off_Plan == 'YES' ? 1 : 0;

      $property = Property::create($property);

      if($row->Images){
        $urls = (((array)$row->Images)['ImageUrl']);
        if(count($urls)){
          for($i=0; $i < count($urls); $i++){
            $fileName = $urls[$i];
            $nameArray = explode('/',$fileName);
            $firstNameArray = explode('?',$fileName);
            $destinationPath = 'public/uploads/property/'.$property->id.'/images';
            if (!is_dir($destinationPath)){ 
              mkdir($destinationPath, 0777, true);
            }
            if(isset($firstNameArray[0]) && !empty($firstNameArray[0])){
              $nameArray = explode('/',$firstNameArray[0]);
              copy($firstNameArray[0],$destinationPath.'/'.end($nameArray));
            }else{
              copy($fileName,$destinationPath.'/'.end($nameArray));
            }
            PropertyImages::create([
              'property_id' => $property->id,
              'images_link' => end($nameArray),
              'temp_image' => $urls[$i]
            ]);
          }          
        }
      }
      if($row->Facilities){
        if(isset((((array)$row->Facilities)['Facility']))){
          $facilities = (((array)$row->Facilities)['Facility']);
          if(count($facilities)){
            for($i=0; $i < count($facilities); $i++){
              $feature = Features::where('feature_name',$facilities[$i])->first();
              if($feature){
                $data = ['property_id'=>$property->id,'feature_id'=>$feature->id];
                PropertyFeatures::create($data);
              }
            }
          }
        }
      }
     
      \DB::table("property_portals")->insert(['property_id'=>$property->id,'portal_id'=>2]);  

    }
    echo "<pre>";
    print_r($propertArray);
    die;
  }  

  public function readDubizzleXml(){
    // Loading the XML file
    $xml = simplexml_load_file(url("public/full-dubizzle-xml-06102022.xml")); //Staging 
    //$xml = simplexml_load_file("public\property-finder.xml"); //Local

    $propertArray = [];
    $i=0;
    foreach ($xml->children() as $row) {
      $property = [];
      $property['updated_at'] = $row->lastupdated;
      $property['crm_id'] = $row->refno;
      $property['str_no'] = $row->permit_number;
      if($row->type == 'SP'){
        $property['sale_rent'] = '1';
      }else{
        $property['sale_rent'] = '2';
      }
      if(isset(Categories::where('pfix',$row->subtype)->first()->id)){
        $property['category_id'] = Categories::where('pfix',$row->subtype)->first()->id;
      }
      $property['price'] = $row->price;
      if($row->Frequency == 'yearly'){
        $property['yprice'] = $row->price;
        $property['price'] = 0;
      }else if($row->Frequency == 'monthly'){
        $property['mprice'] = $row->price;
        $property['yprice'] = 0;
        $property['price'] = 0;
      }
      $property['price'] = $row->price;
      $property['city_id'] = $row->city;
      $property['area_name'] = $row->community;
      $property['project_name'] = $row->sub_community;
      $property['building_name'] = $row->building;
      //$property['location_id'] = $row->location_id;
      $property['title'] = $row->title;
      $property['description'] = $row->description;
      $property['buildup_area'] = $row->size;
      $property['measure_unit'] = $row->sizeunits;
      $property['bedrooms'] = $row->bedrooms;
      $property['bathrooms'] = $row->bathrooms;
      $property['user_id'] = 43;
      $property['geopoints'] = $row->geopoints;
      $property['developer'] = $row->developer;
      $property['virtual_360'] = $row->view360;
      $property['video'] = $row->video_url;

      $property = Property::create($property);

      if($row->photos){
        $urls = explode("|",$row->photos);
        if(count($urls)){
          for($i=0; $i < count($urls); $i++){
            $fileName = $urls[$i];
            $nameArray = explode('/',$fileName);
            $firstNameArray = explode('?',$fileName);
            $destinationPath = 'public/uploads/property/'.$property->id.'/images';
            if (!is_dir($destinationPath)){ 
              mkdir($destinationPath, 0777, true);
            }
            if(isset($firstNameArray[0]) && !empty($firstNameArray[0])){
              $nameArray = explode('/',$firstNameArray[0]);
              copy($firstNameArray[0],$destinationPath.'/'.end($nameArray));
            }else{
              copy($fileName,$destinationPath.'/'.end($nameArray));
            }
            PropertyImages::create([
              'property_id' => $property->id,
              'images_link' => end($nameArray),
              'temp_image' => $urls[$i]
            ]);
          }          
        }

        $temp = [];
        for($j=0; $j < 10; $j++) {
          $temp[$i]['property_id'] = $property->id;
          $temp[$i++]['feature_id'] = Features::inRandomOrder()->first()->id;
        }
        \DB::table("property_features")->insert($temp);
      }
     
      \DB::table("property_portals")->insert(['property_id'=>$property->id,'portal_id'=>3]);  

    }
    echo "<pre>";
    print_r($propertArray);
    die;
  }  

  private function filterPrams($q){

    if(request()->has('ADVANCED')){
      $uri = '';
      $feilds = request()->all();
      $allowedFeilds =[
        "status" ,
        "category_id" ,
        "user_id"
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
        $q->whereBetween('last_updated',[$from,$to]);
      }else{   
        if(Request('from')){
          $uri = Request()->fullUrl();
          $from = date('Y-m-d 00:00:00', strtotime(Request('from')));
          $q->where('last_updated','>=', $from);
        }   
        if(Request('to')){
          $uri = Request()->fullUrl();
          $to = date('Y-m-d 23:59:59', strtotime(Request('to')));
          $q->where('last_updated','<=',$to);
        }            
      }
      session()->put('start_filter_url',$uri);
      //End
    }

    if(Request()->has('search')){
      $uri = Request()->fullUrl();
      session()->put('start_filter_url',$uri);
      return $q->where('title','LIKE','%'. Request('search') .'%')
              ->get();
    }
  }
    
  function propertyXml(){
    $properties = Property::where('status',1)->get();
    $count = Property::where('status',1)->count();
    $last_update = Property::where('status',1)->orderBy('last_updated','desc')->first();

    header('Content-Type: text/xml');
    $xml = '<?xml version="1.0" encoding="utf-8"?>';    
    $xml.="<list last_update='".$last_update->last_updated."' listing_count='".$count."'>";
    $i = 1;
    $defaultAgent = User::where('email','omar.ali@madaproperties.com')->first();
    foreach ($properties as $property) {
      $amenities = $this->get_amenities($property->id);
      $privateamenities = $amenities['privateamenities'];
      $commercialamenities = $amenities['commercialamenities'];
      $features = $amenities['features'];

      $completion_status="completed";
      if($property->project_status=='1') { $completion_status="off_plan"; }
      
      $permit_number=$property->str_no;

      $sale_rent=$property->sale_rent;
      
      $main_category_id=isset($property->category->main_category_id) ? $property->category->main_category_id : 0;
      $offering_type1=$offering_type2="";
      
      if($sale_rent==1){ 
        $offering_type1="Sale"; 
      }else if($sale_rent==2){ 
        $offering_type1="Rent"; 
      }
      $offering_type=$offering_type2.$offering_type1;
      
      //$category=$property->category->category_name;
      
      $get_property_type=isset($property->category->category_name) ? $property->category->category_name : "";
      $price=$property->price;
      $dte=date('d');
      if($dte % 2 == 0){ 
        $price=$price-1;      
      }

      $price=str_replace(".00","",$price);
      $city_text = isset($property->city->name_en) ? $property->city->name_en : "Dubai";
      $community=$property->area_name;
      $project_name=$property->project_name;
      $building_name=$property->bname;
      
      if($project_name=='Not Specified') { $project_name=""; }
      if($building_name=='Not Specified') { $building_name=""; }
      $longitute=$property->longitute;      
      $latitude=$property->latitude;
      
      $long_lat="";
      if($longitute!="" && $latitude!="") {
        $long_lat=$longitute.",".$latitude;
      }
      


      $xml.="
      <property last_update='".$property->last_updated."'>";
      $xml.="<title><![CDATA[".$property->title."]]></title>
      <description><![CDATA[".$property->description."]]></description>";

      if($property->crm_id){
        $xml.="<reference_number>".$property->crm_id."</reference_number>";
      }
      if($permit_number){
        $xml.="<permit_number>".$permit_number."</permit_number>";
      }
      if($get_property_type){
        $xml.="<type>".$get_property_type."</type>";
      }

      if($offering_type){
        $xml.="<property_type>".$offering_type."</property_type>";
      }

      $xml.="<features>".$features."</features>
      <plot_size>".$property->plot_size."</plot_size>
      <size>".$property->buildup_area."</size>
      <bedroom>".__('config.bedrooms.'.$property->bedrooms)."</bedroom>
      <bathroom>".$property->bathrooms."</bathroom>";

      $xml.="<city><![CDATA[".$city_text."]]></city>
      <community><![CDATA[".$community."]]></community>
      <sub_community><![CDATA[".$property->project_name."]]></sub_community>
      <property_name><![CDATA[".$property->building_name."]]></property_name>";

      $xml.="<price_on_application>".($property->price_on_application == 1 ? 'Yes' : 'No' )."</price_on_application>";
      
      $xml.="<price>";
      if($property->yprice){
        $xml.="<yearly>".$property->yprice."</yearly>";
      }
      if($property->mprice){
        $xml.="<monthly>".$property->mprice."</monthly>";
      }
      if($property->price && $property->mprice ==0 && $property->yprice == 0){
        $xml.=$property->price;
      }
      $xml.="</price>";



      if($privateamenities){
        $xml.="<private_amenities>".$privateamenities."</private_amenities>";
      }
      if($commercialamenities){
        $xml.="<commercial_amenities>".$commercialamenities."</commercial_amenities>";
      }
      if($property->agent && $property->agent->is_rera_active){
        $xml .="<agent>
          <id>".$property->agent->id."</id>
          <name><![CDATA[".$property->agent->name."]]></name>
          <email>".$property->agent->name."</email>
          <phone>".$property->agent->mobile_no."</phone>
        </agent>";
      }else{
        if($defaultAgent){
          $xml .="<agent>
            <id>".$defaultAgent->id."</id>
            <name><![CDATA[".$defaultAgent->username."]]></name>
            <email>".$defaultAgent->name."</email>
            <phone>".$defaultAgent->mobile_no."</phone>
          </agent>";
        }
      }
      $xml .="<parking>".$property->parking_areas."</parking>
      <furnished>".($property->furnished == 1 ? 'Yes' : 'No')."</furnished>";

      if($property->virtual_360){
        $xml .="<view360>".($property->virtual_360)."</view360>";
      }
      $xml .="<photo>";
      $x=0;
      $photos="";
      if($property->images && count($property->images)){
        foreach($property->images as $image){
          //$xml.="<url last_updated='".$image->date."' watermark='yes'>".asset('public/uploads/property/'.$property->id.'/images/'.$image->images_link)."</url>";          
          $xml.="<url last_updated='".$image->date."' watermark='yes'>".asset('public/uploads/property/'.$property->id.'/images/'.$image->images_link)."</url>";          
        }
      }
      $xml.="</photo>";
      if($property->geopoints){
        $xml.="<geopoints>".$property->geopoints."</geopoints>";
      }
      $xml.="</property>";
    }
    
    $xml.="</list>";    
    echo $xml;  
    die;
  }  
}
