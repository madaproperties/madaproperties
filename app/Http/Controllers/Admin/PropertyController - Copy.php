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
    $properties = Property::orderBy('id','desc')->paginate(20);
    $property_count = Property::count();
    return view('admin.property.index',compact('properties','property_count'));
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
    }elseif(userRole() == 'admin') {
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
    return view('admin.property.create',compact('cities','countries','campaigns','sources','purposeType','sellers','features'));
  }

  /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
  public function store(Request $request) {

    $data = $request->validate([
      "title" => 'nullable',
      "unitno" => 'nullable',
      "str_no" => 'nullable',
      "sale_rent" => 'nullable',
      "street" => 'nullable',
      "measure_unit" => 'nullable',
      "buildup_area" => 'nullable',
      "plot_size" => 'nullable',
      "parking_type" => 'nullable',
      "parking_areas" => 'nullable',
      "floor" => 'required',
      "city_id" => 'required',
      "area_name" => 'required',
      "project_name" => 'required',
      "building_name" => 'required',
      "source_id" => 'required',
      //"channel_id" => 'required',
      "campaign_id" => 'required',
      "view" => 'required',
      "category_id" => 'required',
      "price_type" => 'nullable',
      "price" => 'nullable',
      "price_unit" => 'nullable',
      "bedrooms" => 'nullable',
      "bathrooms" =>'nullable',
      "cheques" => 'nullable',
      "deposit" => 'nullable',
      "furnished" => 'nullable',
      "owner_id" => 'nullable',
      "description" => 'nullable',
      "user_id" => 'required',
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
      "passport_emirates_id" => 'required',
      "title_deed" => 'required',
      "forma_noc_slform" => 'required',
      'description'   => 'nullable',
      'unverified_reason'   => 'nullable',
      'is_managed' => 'nullable',
      'is_exclusive' => 'nullable',
      'verified_date' => 'nullable',

    ]);

    if(isset($data['is_managed'])){
      $data['is_managed']=1;
    }else{
      $data['is_managed']=0;
    }

    if(isset($data['is_exclusive'])){
      $data['is_exclusive']=1;
    }else{
      $data['is_exclusive']=0;
    }

    
    $data['created_at'] = Carbon::now();
    $data['created_by'] = auth()->id();
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

    return redirect(route('admin.property.index'))->withSuccess(__('site.success'));
  }

  public function update(Request $request,  $id)
  {

    $property = Property::findOrFail($id);

    $data = $request->validate([
      "title" => 'nullable',
      "unitno" => 'nullable',
      "str_no" => 'nullable',
      "sale_rent" => 'nullable',
      "street" => 'nullable',
      "measure_unit" => 'nullable',
      "buildup_area" => 'nullable',
      "plot_size" => 'nullable',
      "parking_type" => 'nullable',
      "parking_areas" => 'nullable',
      "floor" => 'required',
      "city_id" => 'required',
      "area_name" => 'required',
      "project_name" => 'required',
      "building_name" => 'required',
      "source_id" => 'required',
      //"channel_id" => 'required',
      "campaign_id" => 'required',
      "view" => 'required',
      "category_id" => 'required',
      "price_type" => 'nullable',
      "price" => 'nullable',
      "price_unit" => 'nullable',
      "bedrooms" => 'nullable',
      "bathrooms" =>'nullable',
      "cheques" => 'nullable',
      "deposit" => 'nullable',
      "furnished" => 'nullable',
      "owner_id" => 'nullable',
      "description" => 'nullable',
      "user_id" => 'required',
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
      "passport_emirates_id" => 'required',
      "title_deed" => 'required',
      "forma_noc_slform" => 'required',
      'description'   => 'nullable',
      'unverified_reason' => 'nullable',
      'is_managed' => 'nullable',
      'is_exclusive' => 'nullable',
      'verified_date' => 'nullable',
    ]);

    if(isset($data['is_managed'])){
      $data['is_managed']=1;
    }else{
      $data['is_managed']=0;
    }

    if(isset($data['is_exclusive'])){
      $data['is_exclusive']=1;
    }else{
      $data['is_exclusive']=0;
    }

    $data['updated_at'] = Carbon::now();
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
    }elseif(userRole() == 'admin') {
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

    
    // echo "<pre>";
    // print_r($property);
    // die;
    return view('admin.property.show',compact('property','cities','countries','campaigns','sources','purposeType','sellers','features','propertyFeatures','propertyPortals'));

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

  public function deleteImage($id)
  {
    $data = PropertyImages::findOrFail($id);
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
            $file = $file->move('public/uploads/property/'.$property_id.'/images', $md5Name.'.'.$guessExtension);     
            $filename = $md5Name.'.'.$guessExtension;
            PropertyImages::create([
            'property_id' => $property_id,
            'images_link' => $filename
            ]);
            $publicPath='public/uploads/property/'.$property_id.'/images/';
          }else{
            $file = $file->move('public/uploads/temp/images', $md5Name.'.'.$guessExtension);     
            $filename = $md5Name.'.'.$guessExtension;
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
      $allowedfileExtension=['pdf','xlsx','xls','doc', 'docx','ppt', 'pptx','txt'];
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
        $features = Request('features');
        $temp = [];
        $i = 0;
        foreach ($features as $value) {
          $temp[$i]['property_id'] = $property_id;
          $temp[$i++]['feature_id'] = $value;
        }
        PropertyFeatures::where('property_id',$property_id)->delete();
        \DB::table("property_features")->insert($temp);
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
      }else{
        $portals = Request('portals');
        \Session::push('tempPortals', $portals);
      }
    }
    return response()->json(['success'=>true]);
  }

  public function propertyBayutXml(Request $request){
    $properties = Property::orderBy('last_updated','desc')->get();
    header('Content-Type: text/xml');

    $xw = xmlwriter_open_memory();
    xmlwriter_set_indent($xw, 1);
    $res = xmlwriter_set_indent_string($xw, ' ');
    
    xmlwriter_start_document($xw, '1.0', 'UTF-8');
    
    // A first element
    xmlwriter_start_element($xw, 'Listings');
    $i = 1;
    foreach ($properties as $property) {
      // Start a child element
      xmlwriter_start_element($xw, 'Listing');
        // CDATA
        xmlwriter_start_element($xw, 'Count');
        xmlwriter_write_cdata($xw, $i++);
        xmlwriter_end_element($xw); // Count
          
        // CDATA
        xmlwriter_start_element($xw, 'Unit_Type');
        xmlwriter_write_cdata($xw,$property->category_id);
        xmlwriter_end_element($xw); // Count
          
        // CDATA
        xmlwriter_start_element($xw, 'Ad_Type');
        xmlwriter_write_cdata($xw, $property->category_id);
        xmlwriter_end_element($xw); // Count

        xmlwriter_start_element($xw, 'Emirate');
        xmlwriter_write_cdata($xw, $property->passport_emirates_id);
        xmlwriter_end_element($xw); // Count

        xmlwriter_start_element($xw, 'Community');
        xmlwriter_write_cdata($xw, $property->area_name);
        xmlwriter_end_element($xw); // Count

        xmlwriter_start_element($xw, 'Property_Name');
        xmlwriter_write_cdata($xw, $property->building_name);
        xmlwriter_end_element($xw); // Count

        xmlwriter_start_element($xw, 'Property_Ref_No');
        xmlwriter_write_cdata($xw, $property->category_id);
        xmlwriter_end_element($xw); // Count

        xmlwriter_start_element($xw, 'Permit_Number');
        xmlwriter_write_cdata($xw, $property->str_no);
        xmlwriter_end_element($xw); // Count

        xmlwriter_start_element($xw, 'Price');
        xmlwriter_write_cdata($xw, $property->price);
        xmlwriter_end_element($xw); // Count

        xmlwriter_start_element($xw, 'Unit_Buildup_Area');
        xmlwriter_write_cdata($xw, $property->buildup_area);
        xmlwriter_end_element($xw); // Count

        xmlwriter_start_element($xw, 'No_of_Rooms');
        xmlwriter_write_cdata($xw, $property->rooms);
        xmlwriter_end_element($xw); // Count

        xmlwriter_start_element($xw, 'No_of_Bathrooms');
        xmlwriter_write_cdata($xw, $property->bathrooms);
        xmlwriter_end_element($xw); // Count

        xmlwriter_start_element($xw, 'Property_Title');
        xmlwriter_write_cdata($xw, $property->title);
        xmlwriter_end_element($xw); // Count

        xmlwriter_start_element($xw, 'Web_Remarks');
        xmlwriter_write_cdata($xw, $property->description);
        xmlwriter_end_element($xw); // Count

        if($property->agent){
          xmlwriter_start_element($xw, 'Listing_Agent');
          xmlwriter_write_cdata($xw, $property->agent->username);
          xmlwriter_end_element($xw); // Count
            
          xmlwriter_start_element($xw, 'Listing_Agent_Phone');
          xmlwriter_write_cdata($xw, $property->agent->mobile_no);
          xmlwriter_end_element($xw); // Count
            
          xmlwriter_start_element($xw, 'Listing_Agent_Email');
          xmlwriter_write_cdata($xw, $property->agent->email);
          xmlwriter_end_element($xw); // Count
        }

        if($property->images && count($property->images)){
          xmlwriter_start_element($xw, 'Images');
          foreach($property->images as $image){
            xmlwriter_start_element($xw, 'ImageUrl');
              xmlwriter_write_cdata($xw, asset('public/uploads/property/'.$property->id.'/images/'.$image->images_link));
            xmlwriter_end_element($xw); // ImageUrl
          }
          xmlwriter_end_element($xw); // Images
        }
          
        xmlwriter_start_element($xw, 'Listing_Date');
        xmlwriter_write_cdata($xw, $property->created_at);
        xmlwriter_end_element($xw); // Listing_Date
          
        xmlwriter_start_element($xw, 'Last_Updated');
        xmlwriter_write_cdata($xw, $property->updated_at);
        xmlwriter_end_element($xw); // Last_Updated
          
        if($property->features && count($property->features)){
          xmlwriter_start_element($xw, 'Facilities');
          foreach($property->features as $feature){
            xmlwriter_start_element($xw, 'Facility');
              xmlwriter_write_cdata($xw, $this->getFeatureName($feature->feature_id));
            xmlwriter_end_element($xw); // Facility
          }
          xmlwriter_end_element($xw); // Facilities
        }
          
        xmlwriter_start_element($xw, 'unit_measure');
        xmlwriter_write_cdata($xw, $property->measure_unit);
        xmlwriter_end_element($xw); // unit_measure
          
        xmlwriter_start_element($xw, 'Permit_Id');
        xmlwriter_write_cdata($xw, $property->str_no);
        xmlwriter_end_element($xw); // Permit_Id
          
        xmlwriter_start_element($xw, 'featured_on_companywebsite');
        xmlwriter_write_cdata($xw, $property->forma_noc_slform);
        xmlwriter_end_element($xw); // featured_on_companywebsite
          
        xmlwriter_start_element($xw, 'under_construction');
        xmlwriter_write_cdata($xw, $property->updated_at);
        xmlwriter_end_element($xw); // under_construction
          
        xmlwriter_start_element($xw, 'Off_Plan');
        if($property->project_status=='1'){ 
          xmlwriter_write_cdata($xw, "off_plan");
        }else{
          xmlwriter_write_cdata($xw, "completed");
        }
        xmlwriter_end_element($xw); // Off_Plan
          
        xmlwriter_start_element($xw, 'Cheques');
        xmlwriter_write_cdata($xw, $property->cheques);
        xmlwriter_end_element($xw); // Cheques
          
        xmlwriter_start_element($xw, 'Exclusive_Rights');
        xmlwriter_write_cdata($xw, $property->is_exclusive ? 'Yes' : 'No');
        xmlwriter_end_element($xw); // Exclusive_Rights
          
      
      
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
    $properties = Property::orderBy('last_updated','desc')->get();
    $count = Property::count();
    $last_update = Property::orderBy('last_updated','desc')->first();

    header('Content-Type: text/xml');
    $xml = '<?xml version="1.0" encoding="utf-8"?>';    
    $xml.="<list last_update='".$last_update->last_updated."' listing_count='".$count."'>";
    $i = 1;
    foreach ($properties as $property) {
      $amenities = $this->get_amenities($property->id);
      $privateamenities = $amenities['privateamenities'];
      $commercialamenities = $amenities['commercialamenities'];
      $features = $amenities['features'];

      $completion_status="completed";
      if($property->project_status=='1') { $completion_status="off_plan"; }
      
      $permit_number=$property->str_no;

      $sale_rent=$property->sale_rent;
      
      $main_category_id=$property->mcategory_id;
      $offering_type1=$offering_type2="";
      
      if($sale_rent==1) { $offering_type1="S"; }
      
      else if($sale_rent==2) { $offering_type1="R"; }
      
      if($main_category_id==1) { $offering_type2="R"; }
      
      else if($main_category_id==2) { $offering_type2="C"; }
      
      $offering_type=$offering_type2.$offering_type1;
      
      $category=$property->category_name;
      
      $get_property_type=$property->pfix;
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
      <property last_update='".$property->last_updated."'>
      <reference_number>".$property->crm_id."</reference_number>
      <permit_number>".$permit_number."</permit_number>
      <offering_type>".$offering_type."</offering_type>
      <property_type>".$get_property_type."</property_type>
      <completion_status>".$completion_status."</completion_status>
      <price_on_application>".$property->price_on_application."</price_on_application>
      <price>".$property->price."</price>
      <service_charge/>
      <cheques/>
      <city>".$city_text."</city>
      <community><![CDATA[".$community."]]></community>
      <sub_community><![CDATA[".$property->project_name."]]></sub_community>
      <property_name><![CDATA[".$property->building_name."]]></property_name>
      <title_en><![CDATA[".$property->title."]]></title_en>
      <title_ar/>
      <description_en><![CDATA[".$property->description."]]></description_en>
      <description_ar/>
      <private_amenities>".$privateamenities."</private_amenities>
      <commercial_amenities>".$commercialamenities."</commercial_amenities>
      <features>".$features."</features>
      <view><![CDATA[".$property->view."]]></view>
      <plot_size>".$property->plot_size."</plot_size>
      <size>".$property->buildup_area."</size>
      <bedroom>".$property->bedrooms."</bedroom>
      <bathroom>".$property->bathroom."</bathroom>";
      if($property->agent){
        $xml .="<agent>
          <id>".$property->agent->id."</id>
          <name>".$property->agent->name."</name>
          <email>".$property->agent->name."</email>
          <phone>".$property->agent->mobile_no."</phone>
        </agent>";
      }
      $xml .="<parking>".$property->parking_areas."</parking>
      <furnished>".$property->furnished."</furnished>
      <photo>";
      $x=0;
      $photos="";
      if($property->images && count($property->images)){
        foreach($property->images as $image){
          $xml.="<url last_updated='".$image->date."' watermark='yes'>".asset('public/uploads/property/'.$property->id.'/images/'.$image->images_link)."</url>";          
        }
      }
      $xml.="
      </photo>
      <geopoints>".$long_lat."</geopoints>
      </property>";
    }
    
    $xml.="</list>";    
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
      switch ($rs->feature_name) {
          case "Maid's room":
            if($y!=0) { $privateamenities.=",";}  
            $privateamenities.="MR";
            $y++;
            break;
          case 'Study':
            if($y!=0) { $privateamenities.=",";}      
            $privateamenities.="ST";    
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
          case 'Shared swimming pool':    
            if($y!=0) { $privateamenities.=",";}      
            $privateamenities.="SP";    
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
          case 'Jacuzzi':
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
          case 'View of sea/':
            if($y!=0) { $privateamenities.=",";}  
            $privateamenities.="VW";
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
    $xml = simplexml_load_file("public\property-finder.xml");
    echo "<h2>".$xml->attributes()->last_update."</h2><br />";
    $propertArray = [];
    $i=0;
    foreach ($xml->children() as $row) {
      $property = [];
      $property['updated_at'] = $row->attributes()->last_update;
      $property['crm_id'] = $row->reference_number;
      $property['str_no'] = $row->permit_number;
      //$property['property_type'] = $row->property_type;
      $property['price_on_application'] = $row->price_on_application;
      $property['price'] = $row->price;
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

      $property = Property::create($property);

      if($row->photo){
        $urls = (((array)$row->photo)['url']);
        if(count($urls)){
          for($i=0; $i < count($urls); $i++){
            PropertyImages::create([
              'property_id' => $property->id,
              'temp_image' => $urls[$i]
            ]);
          }          
        }
      }
      $propertArray[$i++] = $property->id;
    }
    echo "<pre>";
    print_r($propertArray);
    die;
  }


    
}
