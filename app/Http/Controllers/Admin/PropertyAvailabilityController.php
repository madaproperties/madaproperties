<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Property;
use Spatie\Permission\Models\Role;
use Redirect;
use App\Categories;
use App\User;
use App\Community;


class PropertyAvailabilityController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     function __construct()
     {
        $this->middleware('permission:property-availability-list', ['only' => ['index']]);
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
      ->whereRaw('JSON_CONTAINS(leader, ?)', [json_encode((string) $leaderId)])
      ->Orwhere('id',$leaderId)
      ->get();
      $usersIds = $users->pluck('id')->toArray();
      $property = Property::where(function ($q){
        $this->filterPrams($q);
      })->whereIn('user_id',$usersIds);

    }else if(userRole() == 'sales admin' || userRole() == 'assistant sales director' || userRole() == 'sales' || userRole() == 'assistant sales director') { // sales admin     
      $subUserId[]=auth()->id();
      if(isset(auth()->user()->leader)){
        $subUserId = User::select('id')->where('active','1')
        ->whereRaw('JSON_CONTAINS(leader, ?)', [json_encode((string) auth()->user()->leader)]);
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
    $properties = $property->orderBy('created_at','desc')->paginate(20);
    $categories = Categories::get(); 

    $community_country=84; //Dubai
    if(auth()->user()->time_zone == 'Asia/Riyadh'){
      $community_country=2; //Riyadh
    }
    $community=Community::where('city_id',$community_country)->where('parent_id',0)->get();

    $sub_community=[];
    if(request()->has('ADVANCED') && request()->get('community')){
      $sub_community=Community::where('parent_id',request()->get('community'))->get();
    }
    $sellers = getSellers();
    // added by fazal -7-3-23
    $leaders= User::whereIn('rule',['sales director','leader'])->where('active',1)->select('id','email')->get(); 
    // 
    
    return view('admin.property.property_availability',compact('properties','property_count','categories','sellers','leaders','community','sub_community'));
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
      $users = User::select('id','leader')->where('active','1')->whereRaw('JSON_CONTAINS(leader, ?)', [json_encode((string) $leaderId)])->Orwhere('id',$leaderId)->get();
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

}
