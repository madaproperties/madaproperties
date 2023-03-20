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
use Illuminate\Support\Facades\Storage;
use App\Community;
use App\PropertyNotes;
use App\Zones;
use App\Districts;


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
  public function index(Request $request){


    if(userRole() == 'admin' || userRole() == 'sales admin uae'){ //Updated by Javed

      if($request->get('pt') == 'dubai'){
        $users = User::select('id')
        ->where('active','1')
        ->where('time_zone','Asia/Dubai')
        ->get();
        $usersIds = $users->pluck('id')->toArray();
        $property = Property::where(function ($q){
          $this->filterPrams($q);
        })->whereIn('user_id',$usersIds);
      }elseif($request->get('pt') == 'saudi'){
        $users = User::select('id')
        ->where('active','1')
        ->where('time_zone','Asia/Riyadh')
        ->get();
        $usersIds = $users->pluck('id')->toArray();
        $property = Property::where(function ($q){
          $this->filterPrams($q);
        })->whereIn('user_id',$usersIds);
      }else{     
        $property = Property::where(function ($q){
          $this->filterPrams($q);
        });
      }
    }elseif(userRole() == 'leader'){
      // get leader group
      $leaderId = auth()->id();
      // get leader , and sellers reltedt to that leader
      $users = User::select('id','leader')
      ->where('active','1')
      ->where('leader',$leaderId)
      ->Orwhere('id',$leaderId)
      ->get();
      $usersIds = $users->pluck('id')->toArray();
      $property = Property::where(function ($q){
        $this->filterPrams($q);
      })->whereIn('user_id',$usersIds);

    }else if(userRole() == 'sales admin') { // sales admin     
      $subUserId[]=auth()->id();
      if(isset(auth()->user()->leader)){
        $subUserId = User::select('id')->where('active','1')->where('leader',auth()->user()->leader);
        $subUserId = $subUserId->pluck('id')->toArray();
      }
      $property = Property::where(function ($q){
        $this->filterPrams($q);
      })->whereIn('user_id',$subUserId);
    }else{
      $property = Property::where(function ($q){
        $this->filterPrams($q);
      })->where('user_id',auth()->id());
    }

    if(Request()->has('portals') && Request()->get('portals')){
      $property->join('property_portals','property_portals.property_id','=','properties.id')
      ->where('property_portals.portal_id',Request('portals'));
    }
    $property = $property->select('properties.*');
    
    $property_count = $property->count();
    $property = $property->groupBy('properties.id');
    $properties = $property->orderBy('last_updated','desc')->paginate(20);
    $categories = Categories::get(); 


    $sellers = getSellers();
    // added by fazal -7-3-23
    $leaders= User::where('rule','leader')->select('id','email')->get(); 
    // 
    
    return view('admin.property.index',compact('properties','property_count','categories','sellers','leaders'));
  }

  public function create()
  {

    $cities = City::orderBy('name_en')->where('country_id',2)->where('name_en','Dubai')->get();
    $countries = Country::orderBy('name_en')->get();	
    $campaigns =Campaing::where('active','1')->orderBy('name')->get();	    
    $sources = Source::where('active','1')->orderBy('name')->get();
    $purposeType = PurposeType::orderBy('type')->get();

    $sellers = getSellers();
    $unitFeatures = Features::where('feature_type',1)->orderBy('feature_name','asc')->get();
    $devFeatures = Features::where('feature_type',2)->orderBy('feature_name','asc')->get();
    $lifeStyleFeatures = Features::where('feature_type',3)->orderBy('feature_name','asc')->get();
    $categories = Categories::get(); 
    $community = Community::where('city_id','84')->where('parent_id',0)->orderBy('name_en','asc')->get(); 
    $zones=Zones::get();
    $districts=Districts::get();
    return view('admin.property.create',compact('zones','districts','community','cities','countries','campaigns','sources','purposeType','sellers','lifeStyleFeatures','categories','devFeatures','unitFeatures'));
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
      "title_ar" => 'nullable',
      "unitno" => 'nullable',
      "str_no" => 'nullable',
      "sale_rent" => 'nullable',
      "property_type" => 'nullable',
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
      "price" => 'nullable',
      "price_on_application" => 'nullable',
      "price_unit" => 'nullable',
      "bedrooms" => 'nullable',
      "bathrooms" =>'nullable',
      "cheques" => 'nullable',
      "deposit" => 'nullable',
      "furnished" => 'nullable',
      "owner_id" => 'nullable',
      "developer" => 'nullable',
      "description" => 'nullable',
      "description_ar" => 'nullable',
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
      'unverified_reason' => 'nullable',
      'is_managed' => 'nullable',
      'is_exclusive' => 'nullable',
      'verified_date' => 'nullable',
      'geopoints' => 'nullable',
      'latitude' => 'nullable',
      'longitude' => 'nullable',
      'community' => 'nullable',
      'sub_community' => 'nullable',
      'financial_status' => 'nullable',
      'yprice' => 'nullable',      
      'mprice' => 'nullable',      
      'wprice' => 'nullable',      
      'dprice' => 'nullable',      
      'zone_id' => 'nullable',      
      'district_id' => 'nullable',      
      'facing' => 'nullable',      
      'street_width' => 'nullable',      
      'border_length' => 'nullable',      
      'border_width' => 'nullable',     
      'living_room' => 'nullable',              
      'guest_room' => 'nullable',              
      'age' => 'nullable',              
      'street_information_one' => 'nullable',              
      'street_information_two' => 'nullable',              
      'street_information_three' => 'nullable',              
      'street_information_four' => 'nullable',              
    ]);

    // if(isset($data['is_managed'])){
    //   $data['is_managed']=1;
    // }else{
    //   $data['is_managed']=0;
    // }

    if(!(userRole() == 'admin') && !(userRole() == 'sales admin uae')){
      $data['user_id']=auth()->id();
    }    

    if(isset($data['is_exclusive'])){
      $data['is_exclusive']=1;
    }else{
      $data['is_exclusive']=0;
    }

    
    $data['created_at'] = Carbon::now();
    $data['created_by'] = auth()->id();
    $data['updated_at'] = Carbon::now();
    $data['last_updated'] = Carbon::now();
    
    $address='';
    if($data['building_name']){
      $address .= $data['building_name'].',';
    }
    if(!empty($data['sub_community'])){
      $sub_community = Community::where('id',$data['sub_community'])->first();
      if($sub_community){
        $address .= $sub_community->name_en.',';
      }
    }
    if(!empty($data['community'])){
      $community = Community::where('id',$data['community'])->first();
      if($community){
        $address .= $community->name_en.',';
      }
    }
    if($data['city_id']){
      $address .= City::where('id',$data['city_id'])->first()->name_en;
    }
    if($address){
      $add = $this->getGeoCode($address);
      if(isset($add['lat']) && isset($add['lng'])){
        $data['geopoints'] = implode(',',$add);
        $data['latitude'] = $add['lat'];
        $data['longitude'] = $add['lng'];
      }
    }
    if($request->file('floorplan')){
      $md5Name = md5_file($request->file('floorplan')->getRealPath());
      $guessExtension = $request->file('floorplan')->guessExtension();
      $file = $request->file('floorplan')->move('public/uploads', $md5Name.'.'.$guessExtension);     
      $data['floorplan'] = $md5Name.'.'.$guessExtension;
    }


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
      $tempId = [];
      foreach(\Session::get('tempFeatures') as $key => $value){
        foreach($value as $rs){
          if(!in_array($rs,$tempId)){
            $temp[$i]['property_id'] = $property->id;
            $temp[$i++]['feature_id'] = $rs;
            $tempId[] = $rs;
          }
        }
      }
      \DB::table("property_features")->insert($temp); 
      session()->forget('tempFeatures');  
    } 

    if(\Session::get('tempPortals')){
      $temp = [];
      $i = 0;
      $tempId = [];
      foreach(\Session::get('tempPortals') as $key => $value){
        foreach($value as $rs){
          if(!in_array($rs,$tempId)){
            $temp[$i]['property_id'] = $property->id;
            $temp[$i++]['portal_id'] = $rs;
            $tempId[] = $rs;
          }
        }
      }
      \DB::table("property_portals")->insert($temp); 
      session()->forget('tempPortals');  
    } 
    Property::where('id',$property->id)->update(['crm_id'=>'MADA-'.$property->id]);

    if($request->get('notes')){
      PropertyNotes::create([
        'property_id' => $property->id,
        'description' => $request->get('notes'),
        'user_id' => auth()->id(),
        'ip_address' => $request->ip(),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now() 
      ]);
    }
    

    //Send notifiction to users whos role is sales admin uae
    $users = User::where('rule','sales admin uae')->where('active',1)->get()->pluck(['email'])->toArray();
    if(isset($property->agent->name)){
      $mailData = [
        'id' => $property->id,
        'agent' => $property->agent->name
      ];
      Mail::to($users)->send(new PropertyNotification($mailData));
    }

    return redirect(route('admin.property.index').'?'.http_build_query(['pt'=>request()->get('pt')]) )->withSuccess(__('site.success'));
  }

  public function update(Request $request,  $id)
  {

    $property = Property::findOrFail($id);

    $data = $request->validate([
      "title" => 'required',
      "title_ar" => 'nullable',
      "unitno" => 'nullable',
      "str_no" => 'nullable',
      "sale_rent" => 'nullable',
      "property_type" => 'nullable',
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
      "price" => 'nullable',
      "price_on_application" => 'nullable',
      "price_unit" => 'nullable',
      "bedrooms" => 'nullable',
      "bathrooms" =>'nullable',
      "cheques" => 'nullable',
      "deposit" => 'nullable',
      "furnished" => 'nullable',
      "owner_id" => 'nullable',
      "description" => 'nullable',
      "developer" => 'nullable',
      "description_ar" => 'nullable',
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
      'unverified_reason' => 'nullable',
      'is_managed' => 'nullable',
      'is_exclusive' => 'nullable',
      'verified_date' => 'nullable',
      'geopoints' => 'nullable',
      'latitude' => 'nullable',
      'longitude' => 'nullable',
      'community' => 'nullable',
      'sub_community' => 'nullable',      
      'financial_status' => 'nullable',      
      'yprice' => 'nullable',      
      'mprice' => 'nullable',      
      'wprice' => 'nullable',      
      'dprice' => 'nullable',   
      'zone_id' => 'nullable',      
      'district_id' => 'nullable',      
      'facing' => 'nullable',      
      'street_width' => 'nullable',      
      'border_length' => 'nullable',      
      'border_width' => 'nullable',              
      'living_room' => 'nullable',              
      'guest_room' => 'nullable',       
      'age' => 'nullable',              
      'street_information' => 'nullable',         
      'street_information_one' => 'nullable',              
      'street_information_two' => 'nullable',              
      'street_information_three' => 'nullable',              
      'street_information_four' => 'nullable',              
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
    if(userRole() == 'admin' || userRole() == 'sales admin uae'){
      if($property->status != 1 && $data['status'] == 1){
        $data['publishing_date'] = Carbon::now();
      }
    }


    $address='';
    if($data['building_name']){
      $address .= $data['building_name'].',';
    }
    if(!empty($data['sub_community'])){
      $sub_community = Community::where('id',$data['sub_community'])->first();
      if($sub_community){
        $address .= $sub_community->name_en.',';
      }
    }
    if(!empty($data['community'])){
      $community = Community::where('id',$data['community'])->first();
      if($community){
        $address .= $community->name_en.',';
      }
    }
    if($data['city_id']){
      $address .= City::where('id',$data['city_id'])->first()->name_en;
    }
    if($address){
      $add = $this->getGeoCode($address);
      if(isset($add['lat']) && isset($add['lng'])){
        $data['geopoints'] = implode(',',$add);
        $data['latitude'] = $add['lat'];
        $data['longitude'] = $add['lng'];
      }
    }

    if($request->file('floorplan')){
      $md5Name = md5_file($request->file('floorplan')->getRealPath());
      $guessExtension = $request->file('floorplan')->guessExtension();
      $file = $request->file('floorplan')->move('public/uploads', $md5Name.'.'.$guessExtension);     
      $data['floorplan'] = $md5Name.'.'.$guessExtension;
    }

    addHistory('Property',$id,'updated',$data,$property);
    $property->update($data);

    if($request->get('notes')){
      PropertyNotes::create([
        'property_id' => $property->id,
        'description' => $request->get('notes'),
        'user_id' => auth()->id(),
        'ip_address' => $request->ip(),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now() 
      ]);
    }
    


    return redirect(route('admin.property.index').'?'.http_build_query(['pt'=>request()->get('pt')]) )->withSuccess(__('site.success'));
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
    if(userRole() == 'admin' || userRole() == 'sales admin uae'){ //Updated by Javed
      $property = Property::findOrFail($id);
    }elseif(userRole() == 'leader'){
      $leaderId = auth()->id();
      $users = User::select('id','leader')
      ->where('active','1')
      ->where('leader',$leaderId)
      ->Orwhere('id',$leaderId)
      ->get();
      $usersIds = $users->pluck('id')->toArray();
      $property = Property::where('id',$id)->whereIn('user_id',$usersIds)->first();
    }else if(userRole() == 'sales admin') { // sales admin     
      $subUserId[]=auth()->id();
      if(isset(auth()->user()->leader)){
        $subUserId = User::select('id')->where('active','1')->where('leader',auth()->user()->leader);
        $subUserId = $subUserId->pluck('id')->toArray();
      }
      $property = Property::where('id',$id)->whereIn('user_id',$subUserId)->first();
    }else{
      $property = Property::where('id',$id)->where('user_id',auth()->id())->first();
    }    
    if(!$property){
      return back()->withError(__('Property not found. Please try again.'));
    }

    $cities = City::orderBy('name_en')->where('country_id',2)->where('name_en','Dubai')->get();
    $countries = Country::orderBy('name_en')->get();	
    $campaigns =Campaing::where('active','1')->orderBy('name')->get();	    
    $sources = Source::where('active','1')->orderBy('name')->get();
    $purposeType = PurposeType::orderBy('type')->get();

    $sellers = getSellers();
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

    $unitFeatures = Features::where('feature_type',1)->orderBy('feature_name','asc')->get();
    $devFeatures = Features::where('feature_type',2)->orderBy('feature_name','asc')->get();
    $lifeStyleFeatures = Features::where('feature_type',3)->orderBy('feature_name','asc')->get();
    
    $categories = Categories::get(); 
    $community = Community::where('city_id','84')->where('parent_id',0)->orderBy('name_en','asc')->get();      
    $subCommunity = Community::where('city_id','84')->where('parent_id',$property->community)->orderBy('name_en','asc')->get();      
    $zones=Zones::get();
    $districts=Districts::get();   
    return view('admin.property.show',compact('zones','districts','community','subCommunity','property','cities','countries','campaigns','sources','purposeType','sellers','unitFeatures','propertyFeatures','propertyPortals','categories','lifeStyleFeatures','devFeatures'));

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
      $i=0;
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
            
            //Storage::disk('s3')->put('uploads/property/'.$property_id.'/images', $filename);
            
            PropertyImages::create([
            'property_id' => $property_id,
            'images_link' => $filename,
            'order' =>$i
            ]);
            $i++;
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
            //Storage::disk('s3')->put('uploads/property/'.$property_id.'/documents', $filename);
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

  private function filterPrams($q){

    if(request()->has('ADVANCED')){
      $uri = '';
      $feilds = request()->all();
      $allowedFeilds =[
        "status" ,
        "category_id" ,
        "user_id",
        "sale_rent",
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

    // added by fazal 09-03-23
    if(Request()->has('leader') && request('leader')){
      $uri = Request()->fullUrl();
      session()->put('start_filter_url',$uri);
      $leaderId=request('leader');
      $users = User::select('id','leader')->where('active','1')->where('leader',$leaderId)->Orwhere('id',$leaderId)->get();
      $usersIds = $users->pluck('id')->toArray();
      $q->whereIn('user_id',$usersIds);
    }
    // end
    
    if(Request()->has('search')){
      $uri = Request()->fullUrl();
      session()->put('start_filter_url',$uri);
      return $q->where('title','LIKE','%'. Request('search') .'%')
              ->orWhere('crm_id','LIKE','%'. Request('search') .'%')
              ->orWhere('str_no','LIKE','%'. Request('search') .'%')
              ->get();
    }
  }
    
  function getGeoCode($address){
    $key = 'AIzaSyC-Fb4qyExl4P-2mK01YEj_TmfyXJ5ljYQ';
    // geocoding api url
    //$url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.$address.'&key='.$key;
    // send api request
    $url = 'https://maps.googleapis.com/maps/api/geocode/json?';   
    $options = array("address"=>$address,"key"=>$key,"keyword"=>$url);
    $url .= http_build_query($options,'','&');
    
    $geocode = file_get_contents("$url");

    //$geocode = file_get_contents($url);
    $json = json_decode($geocode);
    $data = array();
    if(isset($json->results[0])){
      $data['lat'] = $json->results[0]->geometry->location->lat;
      $data['lng'] = $json->results[0]->geometry->location->lng;
    }
    return $data;
  }

  function getSubCommunityUrl(Request $request){
    $subCommunity = Community::where('city_id','84')->where('parent_id',$request->community_id)->orderBy('name_en','asc')->get();

    $data = '<option value="">'. __('site.choose').'</option>';
    foreach($subCommunity as $comm){
      $data .= '<option value="'.$comm->id.'">'.$comm->name_en.'</option>';
    }
    return $data;
  }
  public function imgReorder(Request $request)
  {
    $ids = $request->get('ids');
    foreach ($ids as $position => $id) {
        $data=PropertyImages::where('id', $id)->update(['order' => $position]);
    }
  }
}
