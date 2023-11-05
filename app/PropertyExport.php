<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Http\Request;

class PropertyExport implements FromQuery, WithHeadings, ShouldAutoSize, WithMapping
{
    use Exportable;

    public function query()
    {
      if(userRole() == 'admin' || userRole() == 'sales admin uae'){ //Updated by Javed

        if(Request()->get('pt') == 'dubai'){
          $users = User::select('id')
          ->where('active','1')
          ->where('time_zone','Asia/Dubai')
          ->get();
          $usersIds = $users->pluck('id')->toArray();
          $property = Property::where(function ($q){
            $this->filterPrams($q);
          })->whereIn('user_id',$usersIds);
        }elseif(Request()->get('pt') == 'saudi'){
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
      
      return $property->groupBy('properties.id')->orderBy('created_at','desc');
    }

    public function map($data): array
    {
        $property_type = $data->sale_rent == 1 ? 'Sale' : 'Rent';

        if($property_type == 'Rent'){
             if($data->yprice)
            {
                $price = $data->yprice;
            }
           else if($data->mprice)
            {
                $price = $data->mprice;
            }
            else if($data->wprice)
            {
                $price = $data->wprice;
            }
            else if($data->dprice)
            {
                $price = $data->dprice;
            }
        //   $price = "Yearly price : ".($data->yprice ? $data->yprice : 0);
        //   $price .= " Monthly price : ".($data->mprice ? $data->mprice : 0);
        //   $price .= " Weekly price : ".($data->wprice ? $data->wprice : 0);
        //   $price .= " Day price : ".($data->dprice ? $data->dprice : 0);
        }else{
          $price = $data->price;
        }

        $agent = $data->agent ? explode('@',$data->agent->name)[0] : 'N/A';
        $notes="";
        if($data->notes){
          foreach ($data->notes as $rs) {
            $notes .= ($rs->description. ' added by '.(isset($rs->user->email) ? $rs->user->email : 'N/A'). ' at '.$rs->created_at.' ');
          }
        }
        $furnished = __('config.furnished');
        if($furnished){
          $furnished = isset($furnished[$data->furnished]) ? $furnished[$data->furnished] : "N/A";
        }
        $project_status = __('config.project_status');
        if($project_status){
          $project_status = isset($project_status[$data->project_status]) ? $project_status[$data->project_status] : "N/A";
        }
        $status = __('config.status');
        if($status){
          $status = isset($status[$data->status]) ? $status[$data->status] : "N/A";
        }
        $availability = __('config.availability');
        if($availability){
          $availability = isset($availability[$data->availability]) ? $availability[$data->availability] : "N/A";
        }
        $source="N/A";
        if($data->source){
          $source = $data->source->name;
        }

        $location="N/A";
        if($data->communityId){
          $location = $data->communityId->name_en;
          if($data->building_name){
            $location .= ' '.$data->building_name;
          }
        }
        return [
          $data->crm_id,
          $data->title,
          $location,
          $property_type,
          $data->bedrooms,
          $furnished,
          $project_status,
          $data->buildup_area,
          $source,
          $availability,
          $agent,
          $status,
          $price,
          $data->created_at,
          $notes,
        ];
    }    

    public function headings(): array
    {
      return array_map('ucfirst',[
        __('site.ref'),
        __('site.title'),
        __('site.location'),
        __('site.property_type'),
        __('site.bedroom'),
        __('site.furnished'),
        __('site.project_status'),
        __('site.bua'),
        __('site.source'),
        __('site.availability'),
        __('site.agent'),
        __('site.status'),
        __('site.price'),
        __('site.created_at'),
        __('site.notes'),
      ]);
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
        "property_type"
      ];

      foreach($feilds as $feild => $value){
        if(in_array($feild,$allowedFeilds) AND !empty($value)){
            $q->where($feild,$value);
        }
      }

      //Added by Javed
      if(Request('updated_from') && Request('updated_to')){
        $updated_from = date('Y-m-d 00:00:00', strtotime(Request('updated_from')));
        $updated_to = date('Y-m-d 23:59:59', strtotime(Request('updated_to')));
        $q->whereBetween('last_updated',[$updated_from,$updated_to]);
      }else{   
        if(Request('updated_from')){
          $updated_from = date('Y-m-d 00:00:00', strtotime(Request('updated_from')));
          $q->where('last_updated','>=', $updated_from);
        }   
        if(Request('updated_to')){
          $updated_to = date('Y-m-d 23:59:59', strtotime(Request('updated_to')));
          $q->where('last_updated','<=',$updated_to);
        }            
      }

      //Added by Javed
      if(Request('from') && Request('to')){
        $from = date('Y-m-d 00:00:00', strtotime(Request('from')));
        $to = date('Y-m-d 23:59:59', strtotime(Request('to')));
        $q->whereBetween('created_at',[$from,$to]);
      }else{   
        if(Request('from')){
          $from = date('Y-m-d 00:00:00', strtotime(Request('from')));
          $q->where('created_at','>=', $from);
        }   
        if(Request('to')){
          $to = date('Y-m-d 23:59:59', strtotime(Request('to')));
          $q->where('created_at','<=',$to);
        }            
      }
    }

    // added by fazal 09-03-23
    if(Request()->has('leader') && request('leader')){
      $leaderId=request('leader');
      $users = User::select('id','leader')->where('active','1')->where('leader',$leaderId)->Orwhere('id',$leaderId)->get();
      $usersIds = $users->pluck('id')->toArray();
      $q->whereIn('user_id',$usersIds);
    }
    // end
    
    if(Request()->has('search')){
      return $q->where('title','LIKE','%'. Request('search') .'%')
              ->orWhere('crm_id','LIKE','%'. Request('search') .'%')
              ->orWhere('str_no','LIKE','%'. Request('search') .'%');
    }

  }  

}

