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
use App\User;
// use App\Zones;

class DatabaseRecordsExport implements FromQuery, WithHeadings, ShouldAutoSize, WithMapping
{
    use Exportable;

    public function query()
    {
      if(userRole() == 'admin' || userRole() == 'sales admin uae' || userRole() == 'sales admin saudi' || userRole() == 'digital marketing'  || userRole() == 'ceo'|| userRole() == 'sales director' || userRole() == 'leader' ){ //Updated by Javed
         
        if(userRole() == 'sales admin uae'){

          $deals = DatabaseRecords::where('country_id',2)->where(function ($q){
            $this->filterPrams($q);
          })->orderBy('created_at','DESC');
          
        }else if(userRole() == 'sales admin saudi'){
          $deals = DatabaseRecords::where('country_id',1)->where(function ($q){
            $this->filterPrams($q);
          })->orderBy('created_at','DESC');
        }elseif(userRole()=='sales director')
        {
          // dd('hit');
          $user=User::where('id',auth()->id())->first();
          if($user->time_zone=='Asia/Riyadh')
          {
            $deals = DatabaseRecords::where('country_id',1)->where(function ($q){
              $this->filterPrams($q);
            })->orderBy('created_at','DESC');
          }
          else
          {
            $deals = DatabaseRecords::where('country_id',2)->where(function ($q){
              $this->filterPrams($q);
            })->orderBy('created_at','DESC');
          }
        }
        // 
        elseif(userRole() == 'leader'){
          $leaderId = auth()->id();
          $users = User::select('id','leader')->where('active','1')->whereIn('leader',$leaderId)->Orwhere('id',$leaderId)->get();
          $usersIds = $users->pluck('id')->toArray();

          $deals = DatabaseRecords::whereIn('user_id',$usersIds)->where(function ($q){
                $this->filterPrams($q);
              })->orderBy('created_at','DESC');
        }
        else{

          $deals = DatabaseRecords::where(function ($q){
                $this->filterPrams($q);
              })->orderBy('created_at','DESC');
        }

      }elseif(userRole() == 'leader'){
        // get leader group
        $leaderId = auth()->id();
        // get leader , and sellers reltedt to that leader
        $users = User::select('id','leader')->where('active','1')->whereIn('leader',$leaderId)->Orwhere('id',$leaderId)->get();
        $usersIds = $users->pluck('id')->toArray();
        $deals = DatabaseRecords::whereIn('user_id',$usersIds)->where(function ($q){
        $this->filterPrams($q);
        })->orderBy('created_at','DESC');

      }else if(userRole() == 'sales admin' || userRole() == 'assistant sales director') { // sales admin
        $user_data=User::where('id',auth()->id())->first();
        $user_loc=$user_data->time_zone;
        if($user_loc=='Asia/Dubai')
        {
          $deals = DatabaseRecords::where('unit_country',2)->where(function ($q){
          $this->filterPrams($q);
        })->where('user_id',null)
          ->orderBy('created_at','DESC');
        }

        else{
          $deals = DatabaseRecords::where('unit_country',1)->where(function ($q){
          $this->filterPrams($q);
        })->where('user_id',null)
          ->orderBy('created_at','DESC');
        }  
      }else if(userRole() == 'sales director') { 
        $user_data=User::where('id',auth()->id())->first();
        $user_loc=$user_data->time_zone;
        if($user_loc=='Asia/Dubai')
        {
          $deals = DatabaseRecords::where('unit_country',2)->where(function ($q){
          $this->filterPrams($q);
          })->where('user_id',null)
            ->orderBy('created_at','DESC');
        }
        else
        {
            $deals = DatabaseRecords::where('unit_country',1)->where(function ($q){
            $this->filterPrams($q);
          })->where('user_id',null)
            ->orderBy('created_at','DESC');
        }
      }else{
        $deals = DatabaseRecords::where(function ($q){
          $this->filterPrams($q);
        })->where('user_id',auth()->id())->orderBy('created_at','DESC');
      }
      return $deals;
    }

    public function map($deal): array
    {
      $country = $deal->country ? $deal->country->name : '';
      $assign_to = $deal->user ? $deal->user->name : '';
      $unit_country=Country::where('id',$deal->user_country_id)->first();
      $zone= $deal->zone ? $deal->zone->zone_name : 'N/A';
      $districts= $deal->district ? $deal->district->name : 'N/A';
      $community=$deal->community ? $deal->community->name_en : 'N/A';
      $subcommunity=$deal->subcommunity ? $deal->subcommunity->name_en : 'N/A'; 
      
      return [
          $country,
          $deal->name,
          $deal->email,
          $deal->phone,
          $deal->city,
          $deal->area,
          $deal->project_id,
          $deal->building_name,
          $deal->unit_name,
          $deal->price,
          $deal->bedroom,
          $deal->local_phone_no_or_reference,
          $deal->options,
          $deal->response,
          $community,
          $subcommunity,
          $deal->developer,
          isset($unit_country->name_en) ? $unit_country->name_en : 'N/A',
          isset($status->name_en) ? $status->name_en : 'N/A',
          // $created_by,
          // $assign_to,
          $zone,
          $districts,
          $deal->comment,
        ];
    }    

    public function headings(): array
    {
      return array_map('ucfirst',[
        __('site.country'),
        __('site.name'),
        __('site.email'),
        __('site.phone'),
        __('site.city'),
        __('site.area'),
        __('site.project_name'),
        __('site.building_name'),
        __('site.unit_name'),
        __('site.price'),
        __('site.bedroom'),
        __('site.local_phone_no_or_reference'),
        __('site.options'),
        __('site.response'),
        __('site.community'),
        __('site.sub_community'),
        __('site.developer'),
         __('site.user_country'),
        __('site.status'),
        __('site.zone'),
        __('site.district'),
        __('site.assigned to'),
        __('site.comment'),
      ]);
    }

    private function filterPrams($q){
      if(request()->has('ADVANCED')){
          $feilds = request()->all();
          $uri = Request()->fullUrl();
          session()->put('start_filter_url',$uri);
          $allowedFeilds =[
            "country_id" ,
            "user_id" ,
            "project_id" ,
            "purpose" ,
            "lang" ,
            "campaign",
            "last_mile_conversion",
            "status",
            "created_by", //Added by Javed
            "project_country_id", //Added by Javed
            "budget", //Added by Javed
            "source", //Added by Javed
            "purpose_type", //Added by Javed
            "email", //Added by Javed
            "is_meeting", //Added by Javed,
            "lead_category", //Added by Javed,
            "campaign_country", //Added by Javed,
            "zone_id",   //added by fazal-25-02
            "district_id" ,//added by faza -25-02
            "community_id",//added by faza -25-02
            "subcommunity_id",//added by faza -25-02
            "user_country_id" //added by faza -26-02
          ];
          $user_id = 0;
          foreach($feilds as $feild => $value){
            if(in_array($feild,$allowedFeilds) AND !empty($value)){
              if($feild == 'user_id'){
                $user_id = $value;
              }
              if($feild == 'email'){
                $email = $value;
              }
              if($feild == 'project_country_id'){
                $q->whereHas('project', function($q2) use($value) {
                  $q2->where('projects.country_id',$value);
                });
              }
    
                if($feild == 'user_country_id'){
                $q->whereHas('usercountry', function($q2) use($value) {
                  $q2->where('countries.id',$value);
                });
              }
              if($feild == 'zone_id'){
                $q->whereHas('zone', function($q2) use($value) {
                  $q2->where('zone.id',$value);
                });
              }
               if($feild == 'district_id'){
                $q->whereHas('district', function($q2) use($value) {
                  $q2->where('districts.id',$value);
                });
              }
               if($feild == 'community_id'){
                $q->whereHas('community', function($q2) use($value) {
                  $q2->where('community.id',$value);
                });
              }
    
               if($feild == 'subcommunity_id'){
                $q->whereHas('subcommunity', function($q2) use($value) {
                  $q2->where('community.id',$value);
                });
              }
              else if($feild == 'is_meeting' && $value == 1){
                  $q->whereHas('logs', function($q2) use($value,$user_id) {
                    $q2->where('logs.type','meeting');
                    if($user_id){
                      $q2->where('logs.user_id',$user_id);
                    }
                    if(userRole() == 'sales'){
                      $q2->where('logs.user_id',auth()->id());
                    }
                    //Added by Javed
                    if(Request('meeting_from') && Request('meeting_to')){
                      $from = date('Y-m-d', strtotime(Request('meeting_from')));
                      $to = date('Y-m-d', strtotime(Request('meeting_to')));
                      $q2->whereBetween('logs.log_date',[$from,$to]);
                    }else{   
                      if(Request('meeting_from')){
                        $from = date('Y-m-d', strtotime(Request('meeting_from')));
                        $q2->where('logs.log_date','>=', $from);
                      }   
                      if(Request('meeting_to')){
                        $to = date('Y-m-d', strtotime(Request('meeting_to')));
                        $q2->where('logs.log_date','<=',$to);
                      }            
                    }                
                  });
              }else if($feild == 'campaign_country'){
                $q->whereIn($feild,explode(",",$value));
              }else{
                $q->where($feild,$value);
              }
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
    
          //Added by Javed
          if(Request('last_update_from') && Request('last_update_to')){
            $uri = Request()->fullUrl();
            session()->put('start_filter_url',$uri);
            $from = date('Y-m-d 00:00:00', strtotime(Request('last_update_from')));
            $to = date('Y-m-d 23:59:59', strtotime(Request('last_update_to')));
            $q->whereBetween('updated_at',[$from,$to]);
          }else{   
            if(Request('last_update_from')){
              $uri = Request()->fullUrl();
              session()->put('start_filter_url',$uri);
              $from = date('Y-m-d 00:00:00', strtotime(Request('last_update_from')));
              $q->where('updated_at','>=', $from);
            }   
            if(Request('last_update_to')){
              $uri = Request()->fullUrl();
              session()->put('start_filter_url',$uri);
              $to = date('Y-m-d 23:59:59', strtotime(Request('last_update_to')));
              $q->where('updated_at','<=',$to);
            }            
          }
          //End
    
    
          if(Request()->has('challenge_lead') && request('challenge_lead')){
            $uri = Request()->fullUrl();
            session()->put('start_filter_url',$uri);
            return $q->whereIn('status', ['1','4','7'])
                      ->whereDate('updated_at', '<=', Carbon::now()->subMonths(1));
          }
          return $q->get();
        }
    
        if(Request()->has('search') AND Request()->has('my-contacts')  AND Request()->has('filter_status')){
          $uri = Request()->fullUrl();
          session()->put('start_filter_url',$uri);
          return $q->where('status',Request('filter_status'))
              ->where('user_id', auth()->id())
              ->where(function ($q){
                  $q ->OrWhere('last_name','LIKE','%'. Request('search') .'%')
                    ->OrWhere('first_name','LIKE','%'. Request('search') .'%')
                    ->OrWhere('email','LIKE','%'. Request('search') .'%')
                    ->OrWhere('phone','LIKE','%'. Request('search') .'%')
                    ->OrWhere('scound_phone','LIKE','%'. Request('search') .'%')
                    ->OrWhere('campaign','LIKE','%'. Request('search') .'%')
                    ->OrWhere('source','LIKE','%'. Request('search') .'%')
                    ->OrWhere('medium','LIKE','%'. Request('search') .'%');
              })->get();
        }
    
        if(Request()->has('filter_status') AND Request()->has('search')){
          $uri = Request()->fullUrl();
          session()->put('start_filter_url',$uri);
          return $q->where('status',Request('filter_status'))
            ->where(function ($q){
              $q ->OrWhere('last_name','LIKE','%'. Request('search') .'%')
                ->OrWhere('first_name','LIKE','%'. Request('search') .'%')
                ->OrWhere('email','LIKE','%'. Request('search') .'%')
                ->OrWhere('phone','LIKE','%'. Request('search') .'%')
                ->OrWhere('scound_phone','LIKE','%'. Request('search') .'%')
                ->OrWhere('campaign','LIKE','%'. Request('search') .'%')
                ->OrWhere('source','LIKE','%'. Request('search') .'%')
                ->OrWhere('medium','LIKE','%'. Request('search') .'%');
          })->get();
        }
    
        if(Request()->has('campaign')){
          $uri = Request()->fullUrl();
          session()->put('start_filter_url',$uri);
          if(!request('status')){
            return $q->where('campaign', request('campaign'))->get();
          }
          return $q->where('status', request('status'))
                  ->where('campaign', request('campaign'))->get();
        }
    
    
        if(Request()->has('search') AND Request()->has('my-contacts')){
            $uri = Request()->fullUrl();
            session()->put('start_filter_url',$uri);
            return $q->where('user_id',auth()->id())
              ->where(function ($q){
                $q ->OrWhere('last_name','LIKE','%'. Request('search') .'%')
                  ->OrWhere('first_name','LIKE','%'. Request('search') .'%')
                  ->OrWhere('phone','LIKE','%'. Request('search') .'%')
                  ->OrWhere('email','LIKE','%'. Request('search') .'%')
                  ->OrWhere('scound_phone','LIKE','%'. Request('search') .'%')
                  ->OrWhere('campaign','LIKE','%'. Request('search') .'%')
                  ->OrWhere('source','LIKE','%'. Request('search') .'%')
                  ->OrWhere('medium','LIKE','%'. Request('search') .'%');
            })->get();
        }
    
    
        if(Request()->has('my-contacts') AND Request()->has('filter_status')){
          $uri = Request()->fullUrl();
          session()->put('start_filter_url',$uri);
          return $q->where('status', Request('filter_status'))->where('user_id', auth()->id());
        }
    
        if(Request()->has('my-contacts')){
          return $q->where('user_id', auth()->id());
        }
    
        if(Request()->has('filter_status')){
          $uri = Request()->fullUrl();
          session()->put('start_filter_url',$uri);
          return $q->where('status', Request('filter_status'));
        }
    
    
        if(Request()->has('unassigned')){
          $uri = Request()->fullUrl();
          session()->put('start_filter_url',$uri);
          $notAssignedLevel = User::select('id','rule')
                                  ->where('rule','admin')
                                  ->OrWhere('rule','sales admin')->get();
    
          return $q->where('user_id',null)
                  ->orWhereIn('user_id',$notAssignedLevel->pluck('id')->toArray())->get();
        }
    
    
    
        if(request()->has('status') AND request()->has('user')){
          return  $q->where('status_changed_at', '<=', Carbon::today()->subDays( 2 ))
                    ->where('status',request('status'))
                    ->where('user_id',request('user'));
    
        }
    
    
        if(request()->has('export')){
          $req = request('export');
          $campaing = Campaing::select('id','name')->where('id',$req)->first();
    
          if($campaing)
          {
              return $q->where('campaign',$campaing->name)->get();
          }
        }
    
        if(Request()->has('search')){
          $uri = Request()->fullUrl();
          session()->put('start_filter_url',$uri);
          return $q->where('name','LIKE','%'. Request('search') .'%')
                  ->OrWhere('email','LIKE','%'. Request('search') .'%')
                  ->OrWhere('phone','LIKE','%'. Request('search') .'%')
                  ->get();
        }
      }
    }    

