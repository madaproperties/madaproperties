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
use App\PropertyFloorPlans;
use App\TempFloorPlansDocuments;
use Redirect;
use App\PropertyExport;




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
    if(Request()->has('exportData')){
      return Excel::download(new PropertyExport, 'PropertyReport_'.date('d-m-Y').'.xlsx');
    }  

    $propertyData = array();
    if(userRole() == 'admin' || userRole() == 'sales admin uae' || userRole() == 'sales director'){ //Updated by Javed

      if($request->get('pt') == 'dubai'){
        $users = User::select('id')
        ->where('active','1')
        ->where('time_zone','Asia/Dubai')
        ->get();
        $usersIds = $users->pluck('id')->toArray();
        $property = Property::where(function ($q){
          $this->filterPrams($q);
        })->whereIn('user_id',$usersIds);
        
        //Added by Lokesh on 27-07-2023
        $propertyData['sale_count'] = Property::where(function ($q){
          $this->filterPrams2($q,'sale_rent','1','status','1');
        })->whereIn('user_id',$usersIds)->count();

        $propertyData['rent_count'] = Property::where(function ($q){
          $this->filterPrams2($q,'sale_rent','2','status','1');
        })->whereIn('user_id',$usersIds)->count();

        $propertyData['commercial_sale_count'] = Property::where(function ($q){
          $this->filterPrams2($q,'property_type','2','sale_rent','1');
        })->whereIn('user_id',$usersIds)->count();

        $propertyData['commercial_rent_count'] = Property::where(function ($q){
          $this->filterPrams2($q,'property_type','2','sale_rent','2');
        })->whereIn('user_id',$usersIds)->count();

        $propertyData['pending_approval_count'] = Property::where(function ($q){
          $this->filterPrams2($q,'status','4');
        })->whereIn('user_id',$usersIds)->count();

        $propertyData['offline_property_count'] = Property::where(function ($q){
          $this->filterPrams2($q,'status','6');
        })->whereIn('user_id',$usersIds)->count();
        //End
        
      }elseif($request->get('pt') == 'saudi'){
        $users = User::select('id')
        ->where('active','1')
        ->where('time_zone','Asia/Riyadh')
        ->get();
        $usersIds = $users->pluck('id')->toArray();
        $property = Property::where(function ($q){
          $this->filterPrams($q);
        })->whereIn('user_id',$usersIds);
        
        
         //Added by Lokesh on 27-07-2023
        $propertyData['sale_count'] = Property::where(function ($q){
          $this->filterPrams2($q,'sale_rent','1','status','1');
        })->whereIn('user_id',$usersIds)->count();

        $propertyData['rent_count'] = Property::where(function ($q){
          $this->filterPrams2($q,'sale_rent','2','status','1');
        })->whereIn('user_id',$usersIds)->count();

        $propertyData['commercial_sale_count'] = Property::where(function ($q){
          $this->filterPrams2($q,'property_type','2','sale_rent','1');
        })->whereIn('user_id',$usersIds)->count();

        $propertyData['commercial_rent_count'] = Property::where(function ($q){
          $this->filterPrams2($q,'property_type','2','sale_rent','2');
        })->whereIn('user_id',$usersIds)->count();

        $propertyData['pending_approval_count'] = Property::where(function ($q){
          $this->filterPrams2($q,'status','4');
        })->whereIn('user_id',$usersIds)->count();

        $propertyData['offline_property_count'] = Property::where(function ($q){
          $this->filterPrams2($q,'status','6');
        })->whereIn('user_id',$usersIds)->count();
        //End
        
      }else{     
           $user_loc="Asia/Dubai";
        $property = Property::where(function ($q){
          $this->filterPrams($q);
        });
        
        //Added by Lokesh on 27-07-2023
        $propertyData['sale_count'] = Property::where(function ($q){
          $this->filterPrams2($q,'sale_rent','1','status','1');
        })->count();

        $propertyData['rent_count'] = Property::where(function ($q){
          $this->filterPrams2($q,'sale_rent','2','status','1');
        })->count();

        $propertyData['commercial_sale_count'] = Property::where(function ($q){
          $this->filterPrams2($q,'property_type','2','sale_rent','1');
        })->count();

        $propertyData['commercial_rent_count'] = Property::where(function ($q){
          $this->filterPrams2($q,'property_type','2','sale_rent','2');
        })->count();

        $propertyData['pending_approval_count'] = Property::where(function ($q){
          $this->filterPrams2($q,'status','4');
        })->count();

        $propertyData['offline_property_count'] = Property::where(function ($q){
          $this->filterPrams2($q,'status','6');
        })->count();
        //End
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
      
      
      //Added by Lokesh on 27-07-2023
        $propertyData['sale_count'] = Property::where(function ($q){
          $this->filterPrams2($q,'sale_rent','1','status','1');
        })->whereIn('user_id',$usersIds)->count();

        $propertyData['rent_count'] = Property::where(function ($q){
          $this->filterPrams2($q,'sale_rent','2','status','1');
        })->whereIn('user_id',$usersIds)->count();

        $propertyData['commercial_sale_count'] = Property::where(function ($q){
          $this->filterPrams2($q,'property_type','2','sale_rent','1');
        })->whereIn('user_id',$usersIds)->count();

        $propertyData['commercial_rent_count'] = Property::where(function ($q){
          $this->filterPrams2($q,'property_type','2','sale_rent','2');
        })->whereIn('user_id',$usersIds)->count();

        $propertyData['pending_approval_count'] = Property::where(function ($q){
          $this->filterPrams2($q,'status','4');
        })->whereIn('user_id',$usersIds)->count();

        $propertyData['offline_property_count'] = Property::where(function ($q){
          $this->filterPrams2($q,'status','6');
        })->whereIn('user_id',$usersIds)->count();
        //End


    }else if(userRole() == 'sales admin') { // sales admin     
      $subUserId[]=auth()->id();
      if(isset(auth()->user()->leader)){
        $subUserId = User::select('id')->where('active','1')->where('leader',auth()->user()->leader);
        $usersIds = $subUserId->pluck('id')->toArray();
      }
      $property = Property::where(function ($q){
        $this->filterPrams($q);
      })->whereIn('user_id',$subUserId);
      
      //Added by Lokesh on 27-07-2023
        $propertyData['sale_count'] = Property::where(function ($q){
          $this->filterPrams2($q,'sale_rent','1','status','1');
        })->whereIn('user_id',$usersIds)->count();

        $propertyData['rent_count'] = Property::where(function ($q){
          $this->filterPrams2($q,'sale_rent','2','status','1');
        })->whereIn('user_id',$usersIds)->count();

        $propertyData['commercial_sale_count'] = Property::where(function ($q){
          $this->filterPrams2($q,'property_type','2','sale_rent','1');
        })->whereIn('user_id',$usersIds)->count();

        $propertyData['commercial_rent_count'] = Property::where(function ($q){
          $this->filterPrams2($q,'property_type','2','sale_rent','2');
        })->whereIn('user_id',$usersIds)->count();

        $propertyData['pending_approval_count'] = Property::where(function ($q){
          $this->filterPrams2($q,'status','4');
        })->whereIn('user_id',$usersIds)->count();

        $propertyData['offline_property_count'] = Property::where(function ($q){
          $this->filterPrams2($q,'status','6');
        })->whereIn('user_id',$usersIds)->count();
        //End
      
      
    }else{
      $property = Property::where(function ($q){
        $this->filterPrams($q);
      })->where('user_id',auth()->id());
      
      
      //Added by Lokesh on 27-07-2023
        $propertyData['sale_count'] = Property::where(function ($q){
          $this->filterPrams2($q,'sale_rent','1','status','1');
        })->where('user_id',auth()->id())->count();

        $propertyData['rent_count'] = Property::where(function ($q){
          $this->filterPrams2($q,'sale_rent','2','status','1');
        })->where('user_id',auth()->id())->count();

        $propertyData['commercial_sale_count'] = Property::where(function ($q){
          $this->filterPrams2($q,'property_type','2','sale_rent','1');
        })->where('user_id',auth()->id())->count();

        $propertyData['commercial_rent_count'] = Property::where(function ($q){
          $this->filterPrams2($q,'property_type','2','sale_rent','2');
        })->where('user_id',auth()->id())->count();

        $propertyData['pending_approval_count'] = Property::where(function ($q){
          $this->filterPrams2($q,'status','4');
        })->where('user_id',auth()->id())->count();

        $propertyData['offline_property_count'] = Property::where(function ($q){
          $this->filterPrams2($q,'status','6');
        })->where('user_id',auth()->id())->count();
        //End
      
    }

    if(Request()->has('portals') && Request()->get('portals')){
      $property->join('property_portals','property_portals.property_id','=','properties.id')
      ->where('property_portals.portal_id',Request('portals'));
    }
    $property = $property->select('properties.*');
    
    $property_count = $property->count();
    $property = $property->groupBy('properties.id');
    $properties = $property->orderBy('created_at','desc')->paginate(20);
    $categories = Categories::get(); 
    $sellers = getSellers();
    // added by fazal -7-3-23
    $leaders= User::whereIn('rule',['sales director','leader'])->where('active',1)->select('id','email')->get(); 
    // 
    //added by fazal 19-07-23
     $community_country=84; //Dubai
    if(auth()->user()->time_zone == 'Asia/Riyadh'){
      $community_country=2; //Riyadh
    }
    $community=Community::where('city_id',$community_country)->where('parent_id',0)->get();

    $sub_community=[];
    if(request()->has('ADVANCED') && request()->get('community')){
      $sub_community=Community::where('parent_id',request()->get('community'))->get();
    }
    
    
    return view('admin.property.index',compact('properties','property_count','categories','sellers','leaders','community','sub_community','propertyData'));
  }

  public function create()
  {
    \Session::forget('tempFloorPlan');
    $cities = City::orderBy('name_en')->where('country_id',2)->where('name_en','Dubai')->get();
    $countries = Country::orderBy('name_en')->get();	
    $campaigns =Campaing::where('active','1')->orderBy('name')->get();	    
    $sources = Source::where('active','1')->orderBy('name')->get();
    $purposeType = PurposeType::orderBy('type')->get();

    $sellers = getSellers();
    $unitFeatures = Features::where('feature_type',1)->orderBy('feature_name','asc')->get();
    $devFeatures = Features::where('feature_type',2)->orderBy('feature_name','asc')->get();
    $lifeStyleFeatures = Features::where('feature_type',3)->orderBy('feature_name','asc')->get();
    $categories = Categories::orderBy('category_name','asc')->get(); 
    $community = Community::where('city_id','84')->where('parent_id',0)->orderBy('name_en','asc')->get(); 
    $zones=Zones::orderBy('zone_name','asc')->get();
    $districts=Districts::orderBy('name','asc')->get();
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
      'street_information' => 'nullable',         
      'street_information_one' => 'nullable',              
      'street_information_two' => 'nullable',              
      'street_information_three' => 'nullable',              
      'street_information_four' => 'nullable',              
      'availability' => 'nullable',              
      'is_exclusive' => 'nullable',              
      'next_available' => 'nullable',              
      'no_of_floors' => 'nullable',              
      'nearest_facilities' => 'nullable',              
      'financial_status' => 'nullable',              
      'layout_type' => 'nullable',              
      'off_line_property' => 'nullable',  
      'payment_method' =>'nullable',  //added by fazal on 16-01-23   
      'down_payment_price' =>'nullable',
    ]);

    if($data['property_type'] == '2'){
      $data['bedrooms']=null;
    }

    // if(isset($data['is_managed'])){
    //   $data['is_managed']=1;
    // }else{
    //   $data['is_managed']=0;
    // }

    if(!(userRole() == 'admin') && !(userRole() == 'sales admin uae')){
      $data['user_id']=auth()->id();
    }    

    // if(isset($data['is_exclusive'])){
    //   $data['is_exclusive']=1;
    // }else{
    //   $data['is_exclusive']=0;
    // }

    
    $data['created_at'] = Carbon::now();
    $data['created_by'] = auth()->id();
    $data['updated_at'] = Carbon::now();
    $data['last_updated'] = Carbon::now();
    
    $address='';
    if($data['building_name']){
      $address .= $data['building_name'].',';
    }


    if(!empty($data['off_line_property'])){
      $data['status']=6;
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
    Property::where('id',$property->id)->update(['crm_id'=>'MADA-'.$property->id]);

    // if(\Session::get('tempImages')){
    //   foreach(\Session::get('tempImages') as $image){
    //     PropertyImages::create([
    //       'property_id' => $property->id,
    //       'images_link' => $image
    //     ]);
    //   }
    //   session()->forget('tempImages');  
    // } 


    // if(\Session::get('tempDocuments')){
    //   foreach(\Session::get('tempDocuments') as $document){
    //     PropertyDocuments::create([
    //       'property_id' => $property->id,
    //       'document_link' => $document
    //     ]);
    //   }
    //   session()->forget('tempDocuments');  
    // } 
    if(\Session::get('tempImages')){

      // $destinationPath =  'public/uploads/property/'.$property->id.'/images';
      // if (!is_dir($destinationPath)){ 
      //   mkdir($destinationPath, 0777, true);
      // }

      foreach(\Session::get('tempImages') as $image){
        $destinationPath = 'public/uploads/temp/images/'.$image;
        if(file_exists(public_path('uploads/temp/images/'.$image))){
          PropertyImages::create([
            'property_id' => $property->id,
            'images_link' => $image
          ]);

          //copy($fromPath,$destinationPath.'/'.$image);

          Storage::disk('s3')->put('uploads/property/'.$property->id.'/images/'.$image, file_get_contents($destinationPath));
          unlink($destinationPath);
        }

      }
      session()->forget('tempImages');  
    }
    
    if(\Session::get('tempDocIds')){
      // $destinationPath =  'public/uploads/property/'.$property->id.'/documents';
      // if (!is_dir($destinationPath)){ 
      //   mkdir($destinationPath, 0777, true);
      // }
      foreach(\Session::get('tempDocIds') as $key => $value){
        if($docData = TempFloorPlansDocuments::find($value->id)){
          $destinationPath = 'public/uploads/temp/'.$docData->document_link;
          if(file_exists(public_path('uploads/temp/'.$docData->document_link))){
            PropertyDocuments::create([
              'property_id' => $property->id,
              'document_link' => $docData->document_link,
              'name' => $docData->name
            ]);
            //copy($fromPath,$destinationPath.'/'.$document);

            Storage::disk('s3')->put('uploads/property/'.$property->id.'/documents/'.$docData->document_link, file_get_contents($destinationPath));
            unlink($destinationPath);
          }
        }
      }
      session()->forget('tempDocIds');  
    } 
    
    if(\Session::get('tepmFloorIds')){
      // $destinationPath =  'public/uploads/property/'.$property->id.'/documents';
      // if (!is_dir($destinationPath)){ 
      //   mkdir($destinationPath, 0777, true);
      // }
      foreach(\Session::get('tepmFloorIds') as $key => $value){
        if($floorData = TempFloorPlansDocuments::find($value->id)){
          $destinationPath = 'public/uploads/temp/'.$floorData->document_link;
          if(file_exists(public_path('uploads/temp/'.$floorData->document_link))){
            PropertyFloorPlans::create([
              'property_id' => $property->id,
              'document_link' => $floorData->document_link,
              'name' => $floorData->name
            ]);
            //copy($fromPath,$destinationPath.'/'.$document);

            Storage::disk('s3')->put('uploads/property/'.$property->id.'/floor_plan/'.$floorData->document_link, file_get_contents($destinationPath));
            unlink($destinationPath);
          }
        }
      }
      session()->forget('tepmFloorIds');  
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
      //Mail::to($users)->send(new PropertyNotification($mailData));
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
      'availability' => 'nullable',              
      'is_exclusive' => 'nullable',              
      'next_available' => 'nullable',    
      'no_of_floors' => 'nullable',              
      'nearest_facilities' => 'nullable',              
      'financial_status' => 'nullable',              
      'layout_type' => 'nullable',     
      'off_line_property' => 'nullable', 
      'payment_method' =>'nullable',  //added by fazal on 16-01-23   
      'down_payment_price' =>'nullable',
    ]);

    if($data['property_type'] == '2'){
      $data['bedrooms']=null;
    }

    if(userRole() != 'admin' && userRole() != 'sales admin uae' && userRole() != 'sales admin saudi' && userRole() != 'sales director'){
      $data['mobile']=$property->mobile;
      $data['owner_name']=$property->owner_name;
      $data['email']=$property->email;
    }

    // if(isset($data['is_exclusive'])){
    //   $data['is_exclusive']=1;
    // }else{
    //   $data['is_exclusive']=0;
    // }

    $data['updated_at'] = Carbon::now();
    $data['last_updated'] = Carbon::now();
    if(userRole() == 'admin' || userRole() == 'sales admin uae'){
      if($property->status != 1 && $data['status'] == 1){
        $data['publishing_date'] = Carbon::now();
      }
    }

    if(!empty($data['off_line_property'])){
      $data['status']=6;
    }

    if($property->status == 6 && empty($data['off_line_property'])){
      $data['status']=4;
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
    unset($data['off_line_property']);

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
    \Session::forget('tempFloorPlan');
    if(userRole() == 'admin' || userRole() == 'sales admin uae' || userRole() == 'sales director' ){ //Updated by Javed
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
    
    $categories = Categories::orderBy('category_name','asc')->get(); 
    $community = Community::where('city_id','84')->where('parent_id',0)->orderBy('name_en','asc')->get();      
    $subCommunity = Community::where('city_id','84')->where('parent_id',$property->community)->orderBy('name_en','asc')->get();      
    $zones=Zones::orderBy('zone_name','asc')->get();
    $districts=Districts::orderBy('name','asc')->get();
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
    $property_features = PropertyFeatures::where('property_id', $id)->join('features','property_features.feature_id','features.id')->take(6)->get();
    return view('admin.property.new_brochure',compact('property','property_features'));

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
            $watermark = Image::make(public_path('/images/Watermark-01.png'));                
            $img->insert($watermark, 'center');
            $img->save($destinationPath.'/'.$filename);
            
            
            PropertyImages::create([
            'property_id' => $property_id,
            'images_link' => $filename,
            'order' =>$i
            ]);
            $i++;
            $publicPath='uploads/property/'.$property_id.'/images/';

            Storage::disk('s3')->put('uploads/property/'.$property_id.'/images/'.$filename, file_get_contents($destinationPath.'/'.$filename));

            unlink($destinationPath.'/'.$filename);

            $html .= '<div class="col-xl-4" style="float:left" id="'.str_replace(".","-",$filename).'">
            <div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">                        
              <img src="'.s3AssetUrl($publicPath.$filename).'" style="width:215px;height:147px">
          </div><a href="javascript:void(0)" class="checkbox deleteImage" data-value="'.$filename.'">Delete</a>
          <a href="'.s3AssetUrl($publicPath.$filename).'" target="_blank">View</a></div>';
  
          }else{
            //$file = $file->move('public/uploads/temp/images', $md5Name.'.'.$guessExtension);   
            
            $filename = $md5Name.'.'.$guessExtension;
            $destinationPath = 'public/uploads/temp/images';
            if (!is_dir($destinationPath)){ 
              mkdir($destinationPath, 0777, true);
            }
            //Upload Images One After the Order into folder
            $img = Image::make($file->getRealPath());
            $watermark = Image::make(public_path('/images/Watermark-01.png'));                
            $img->insert($watermark, 'center');
            $img->save($destinationPath.'/'.$filename);

            \Session::push('tempImages', $filename);
            $publicPath='public/uploads/temp/images/';

            $html .= '<div class="col-xl-4" style="float:left" id="'.str_replace(".","-",$filename).'">
            <div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">                        
              <img src="'.asset($publicPath.$filename).'" style="width:215px;height:147px">
          </div><a href="javascript:void(0)" class="checkbox deleteImage" data-value="'.$filename.'">Delete</a>
          <a href="'.asset($publicPath.$filename).'" target="_blank">View</a></div>';
  
          }

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
    $i=0;
    $property_id = Request('property_id');
    $documentsName = Request('documentsName');
    $document_id = Request('document_id');

    if($request->hasFile('documentsNew')) {
      $allowedfileExtension=['pdf','xlsx','xls','doc', 'docx','ppt', 'pptx','txt','png','jpg','jpeg'];
      $files = $request->file('documentsNew');
      $documentIds = [];
      $tempDocIds = [];
      foreach($files as $file){
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $check=in_array($extension,$allowedfileExtension);
        if($check) {

          $md5Name = md5_file($file->getRealPath());
          $guessExtension = $file->guessExtension();
          $documentsName = Request('documentsNameNew');
          if(Request('property_id')){
            $property_id = Request('property_id');
            $file = $file->move('public/uploads/property/'.$property_id.'/documents', $md5Name.'.'.$guessExtension);     
            $filename = $md5Name.'.'.$guessExtension;
            $destinationPath = 'public/uploads/property/'.$property_id.'/documents/'.$filename;
            //Storage::disk('s3')->put('uploads/property/'.$property_id.'/documents', $filename);

            Storage::disk('s3')->put('uploads/property/'.$property_id.'/documents/'.$filename, file_get_contents($destinationPath));

            unlink($destinationPath);

            PropertyDocuments::create([
              'property_id' => $property_id,
              'document_link' => $filename,
              'name' => (isset($documentsName[$i]) ? $documentsName[$i] : '')
            ]);
            $i++;
          }else{
            $file = $file->move('public/uploads/temp', $md5Name.'.'.$guessExtension);     
            $filename = $md5Name.'.'.$guessExtension;
            $destinationPath = 'public/uploads/temp/'.$filename;

            $tempDocIds[] = TempFloorPlansDocuments::create([
              'name' => (isset($documentsName[$i]) ? $documentsName[$i] : ''),
              'document_link' => $filename,
              'file_type' => '2' // document
            ]);
            $i++;
          }
        }
      }
      if($tempDocIds){
        session()->put('tempDocIds', $tempDocIds);
      }
    }

    if($request->hasFile('documents')) {
      $allowedfileExtension=['pdf','xlsx','xls','doc', 'docx','ppt', 'pptx','txt','png','jpg','jpeg'];
      $files = $request->file('documents');
      $documentIds = [];
      $i=0;
      foreach($files as $file){
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $check=in_array($extension,$allowedfileExtension);
        if($check) {

          $md5Name = md5_file($file->getRealPath());
          $guessExtension = $file->guessExtension();
          if(Request('property_id')){
            $file = $file->move('public/uploads/property/'.$property_id.'/documents', $md5Name.'.'.$guessExtension);     
            $filename = $md5Name.'.'.$guessExtension;
            $destinationPath = 'public/uploads/property/'.$property_id.'/documents/'.$filename;
            //Storage::disk('s3')->put('uploads/property/'.$property_id.'/documents', $filename);

            Storage::disk('s3')->put('uploads/property/'.$property_id.'/documents/'.$filename, file_get_contents($destinationPath));

            unlink($destinationPath);

            PropertyDocuments::where('id',$document_id[$i])->update([
              'document_link' => $filename,
            ]);
            $i++;
          }
        }
        
      }
      
    }
    $i=0;
    if($documentsName) {
      foreach($documentsName as $name){
          if(isset($document_id[$i])){
            PropertyDocuments::where('id',$document_id[$i])->update([
              'name' => (isset($documentsName[$i]) ? $documentsName[$i] : '')
            ]);
            $i++;
          }
      }
    }

    if($delete_document_id = $request->get('delete_document_id')) {
      foreach($delete_document_id as $key=>$value){
        PropertyDocuments::where('id',$value)->delete();
      }
    }

    return response()->json(['success'=>true,'images'=>'']);
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
        "property_type",
        "community",
        "sub_community",
        "price",
        "bedrooms"
      ];

      foreach($feilds as $feild => $value){
        if(in_array($feild,$allowedFeilds) AND !empty($value)){
            $q->where($feild,$value);
        }
      }

      //Added by Javed
      if(Request('updated_from') && Request('updated_to')){
        $uri = Request()->fullUrl();
        $updated_from = date('Y-m-d 00:00:00', strtotime(Request('updated_from')));
        $updated_to = date('Y-m-d 23:59:59', strtotime(Request('updated_to')));
        $q->whereBetween('last_updated',[$updated_from,$updated_to]);
      }else{   
        if(Request('updated_from')){
          $uri = Request()->fullUrl();
          $updated_from = date('Y-m-d 00:00:00', strtotime(Request('updated_from')));
          $q->where('last_updated','>=', $updated_from);
        }   
        if(Request('updated_to')){
          $uri = Request()->fullUrl();
          $updated_to = date('Y-m-d 23:59:59', strtotime(Request('updated_to')));
          $q->where('last_updated','<=',$updated_to);
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
    $key = env('GoogleApiKey');
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

  public function floorPlanStore(Request $request)
  {
    $html = '';
    $i=0;
    $property_id = Request('property_id');
    $floorPlansName = Request('floorPlansName');
    $floor_plan_id = Request('floor_plan_id');

    if($request->hasFile('floorPlansNew')) {
      $allowedfileExtension=['pdf','xlsx','xls','doc', 'docx','ppt', 'pptx','txt','png','jpg','jpeg'];
      $files = $request->file('floorPlansNew');
      $documentIds = [];
      $tepmFloorIds = [];
      foreach($files as $file){
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $check=in_array($extension,$allowedfileExtension);
        if($check) {

          $md5Name = md5_file($file->getRealPath());
          $guessExtension = $file->guessExtension();
          $floorPlansNameNew = Request('floorPlansNameNew');
          if(Request('property_id')){
            $property_id = Request('property_id');
            $file = $file->move('public/uploads/property/'.$property_id.'/floor_plan', $md5Name.'.'.$guessExtension);     
            $filename = $md5Name.'.'.$guessExtension;
            $destinationPath = 'public/uploads/property/'.$property_id.'/floor_plan/'.$filename;
            //Storage::disk('s3')->put('uploads/property/'.$property_id.'/floor_plan', $filename);

            Storage::disk('s3')->put('uploads/property/'.$property_id.'/floor_plan/'.$filename, file_get_contents($destinationPath));

            unlink($destinationPath);

            PropertyFloorPlans::create([
              'property_id' => $property_id,
              'document_link' => $filename,
              'name' => (isset($floorPlansNameNew[$i]) ? $floorPlansNameNew[$i] : '')
            ]);
            $i++;
          }else{
            $file = $file->move('public/uploads/temp', $md5Name.'.'.$guessExtension);     
            $filename = $md5Name.'.'.$guessExtension;
            $destinationPath = 'public/uploads/temp/'.$filename;

            $tepmFloorIds[] = TempFloorPlansDocuments::create([
              'name' => (isset($floorPlansNameNew[$i]) ? $floorPlansNameNew[$i] : ''),
              'document_link' => $filename,
              'file_type' => '1', // floor plan
            ]);
            $i++;
          }
        }
      }
      if($tepmFloorIds){
        session()->put('tepmFloorIds', $tepmFloorIds);
      }
  
    }


    if($request->hasFile('floorPlans')) {
      $allowedfileExtension=['pdf','xlsx','xls','doc', 'docx','ppt', 'pptx','txt','png','jpg','jpeg'];
      $files = $request->file('floorPlans');
      $documentIds = [];
      $i=0;
      foreach($files as $file){
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $check=in_array($extension,$allowedfileExtension);
        if($check) {

          $md5Name = md5_file($file->getRealPath());
          $guessExtension = $file->guessExtension();
          if(Request('property_id')){
            $file = $file->move('public/uploads/property/'.$property_id.'/floor_plan', $md5Name.'.'.$guessExtension);     
            $filename = $md5Name.'.'.$guessExtension;
            $destinationPath = 'public/uploads/property/'.$property_id.'/floor_plan/'.$filename;
            //Storage::disk('s3')->put('uploads/property/'.$property_id.'/floor_plan', $filename);

            Storage::disk('s3')->put('uploads/property/'.$property_id.'/floor_plan/'.$filename, file_get_contents($destinationPath));

            unlink($destinationPath);

            PropertyFloorPlans::where('id',$floor_plan_id[$i])->update([
              'document_link' => $filename,
            ]);
            $i++;
          }
        }
        
      }
      
    }
    $i=0;
    if($floorPlansName) {
      foreach($floorPlansName as $name){
          PropertyFloorPlans::where('id',$floor_plan_id[$i])->update([
            'name' => (isset($floorPlansName[$i]) ? $floorPlansName[$i] : '')
          ]);
          $i++;
      }
    }

    if($delete_floor_plan_id = $request->get('delete_floor_plan_id')) {
      foreach($delete_floor_plan_id as $key=>$value){
        PropertyFloorPlans::where('id',$value)->delete();
      }
    }

    return response()->json(['success'=>true,'images'=>'']);
  }

  public function floorPlanDestroy(Request $request)
  {
    if(\Session::get('tempFloorPlan')){
      $floor_plan = \Session::get('tempFloorPlan'); // Get the array
      $floorPlanName =  $request->get('floorPlanName');
      if(isset($floor_plan[$floorPlanName])){
        unset($floor_plan[$floorPlanName]); // Unset the index you want
        session()->put('tempFloorPlan', $floor_plan); // Set the array again      
        $path=public_path().'/uploads/temp/floor_plan/'.$floorPlanName;
        if (file_exists($path)) {
            unlink($path);
        }
        return $floorPlanName;         
      }
    }
    if(Request('property_id')){
      $floorPlanName =  $request->get('floorPlanName');
      $property_id =  $request->get('property_id');
      $documents = PropertyDocuments::where('document_link',$floorPlanName)->delete();
      if($documents){
        $path=public_path().'public/uploads/property/'.$property_id.'/floor_plan/'.$floorPlanName;
        if (file_exists($path)) {
            unlink($path);
        }
        return $floorPlanName;  
      }
    } 
    \Session::forget('tempFloorPlan');
  }  
  
  private function filterPrams2($q,$extraParaName='',$extraParaValue='',$extraParaName2='',$extraParaValue2=''){
    if(!empty($extraParaName) && !empty($extraParaValue)){
      $q->where($extraParaName,$extraParaValue);
      if(!empty($extraParaName2) && !empty($extraParaValue2)){
        $q->where($extraParaName2,$extraParaValue2);
      }
    }

    $allowedFeilds =[
      "user_id",
    ];
    $feilds = request()->all();
    foreach($feilds as $feild => $value){
      if(in_array($feild,$allowedFeilds) AND !empty($value)){
          $q->where($feild,$value);
      }
    }
  }

}
