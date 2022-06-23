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

class ContactExport implements FromQuery, WithHeadings, ShouldAutoSize, WithMapping
{
    use Exportable;

    private $active;

    private $selectedAttruibutes = ['project_id','campaign',
    'purpose','lang','last_mile_conversion',
    'id','first_name','last_name',
    'phone','country_id','city_id',
    'status_id','created_at','updated_at',
    'user_id','created_by','purpose_type','source','email'];    

    public function __construct($active = true)
    {
      $this->active = $active;
    }

    public function query()
    {
      if(userRole() == 'admin' || userRole() == 'sales admin uae' || userRole() == 'sales admin saudi' ){ //Updated by Javed

        if(Request()->has('duplicated')){

          if(userRole() == 'sales admin uae'){ //Updated by Javed
            $contacts = Contact::select($this->selectedAttruibutes,\DB::raw('COUNT(phone) as phone'))
                    ->whereHas('project', function($q2) {
                      $q2->where('projects.country_id','2');
                    })
                    ->groupBy('phone')
                    ->havingRaw('COUNT(phone) > ?', [1])
                    ->get();
    
            $contactsPhone = $contacts->pluck('phone');
    
            $contacts =   Contact::query()->whereIn('phone',$contactsPhone->toArray())
                                          ->where('country_id','2')
                                          ->orderByRaw("phone");

          }else if(userRole() == 'sales admin saudi'){
            $contacts = Contact::select($this->selectedAttruibutes,\DB::raw('COUNT(phone) as phone'))
                    ->whereHas('project', function($q2) {
                      $q2->where('projects.country_id','1');
                    })
                    ->groupBy('phone')
                    ->havingRaw('COUNT(phone) > ?', [1])
                    ->get();
    
            $contactsPhone = $contacts->pluck('phone');
    
            $contacts =   Contact::query()->whereIn('phone',$contactsPhone->toArray())
                                          ->where('country_id','1')                        
                                          ->orderByRaw("phone");

          }else{
            $contacts = Contact::select($this->selectedAttruibutes,\DB::raw('COUNT(phone) as phone'))
                    ->groupBy('phone')
                    ->havingRaw('COUNT(phone) > ?', [1])
                    ->get();
    
            $contactsPhone = $contacts->pluck('phone');
    
            $contacts =   Contact::query()->whereIn('phone',$contactsPhone->toArray())
                                    ->orderByRaw("phone");

          }
        }else{
          
          if(userRole() == 'sales admin uae'){

            $contacts = Contact::query()->select($this->selectedAttruibutes)->where(function ($q){
              $this->filterPrams($q);
            })
            ->whereHas('project', function($q2) {
              $q2->where('projects.country_id','2');
            })
            ->orderBy('created_at','DESC');
          
          }else if(userRole() == 'sales admin saudi'){
            
            $contacts = Contact::query()->select($this->selectedAttruibutes)->where(function ($q){
              $this->filterPrams($q);
            })
            ->whereHas('project', function($q2) {
              $q2->where('projects.country_id','1');
            })
            ->orderBy('created_at','DESC');
          
          }else{
          
            $contacts = Contact::query()->select($this->selectedAttruibutes)->where(function ($q){
                  $this->filterPrams($q);
                })->orderBy('created_at','DESC');
          }
        }
  
      }elseif(userRole() == 'leader'){
        // get leader group
        $leaderId = auth()->id();
        // get leader , and sellers reltedt to that leader
        $users = User::select('id','leader')->where('leader',$leaderId)->Orwhere('id',$leaderId)->get();
        $usersIds = $users->pluck('id')->toArray();
        $contacts = Contact::query()->select($this->selectedAttruibutes)->whereIn('user_id',$usersIds)->where(function ($q){
          $this->filterPrams($q);
        })->orderBy('created_at','DESC');
  
      }else if(userRole() == 'sales admin') { // sales admin
        
        $contacts = Contact::query()->select($this->selectedAttruibutes)->where(function ($q){
          $this->filterPrams($q);
        })->where('created_by',auth()->id())
          ->where('user_id',null)
          ->orderBy('created_at','DESC');
  
      }else{
        
        $contacts = Contact::query()->select($this->selectedAttruibutes)->where(function ($q){
          $this->filterPrams($q);
        })->where('user_id',auth()->id())->orderBy('created_at','DESC');
  
      }
  
      //$contact = Contact::query();
      return $contacts;
    }

    public function map($contact): array
    {
        $phone = ' ';
        $phone .= $contact->country ? $contact->country->code : '';
        $phone .= str_starts_with($contact->phone,0) ? substr($contact->phone,1) : $contact->phone;

        $country = $contact->country ? $contact->country->name : '';
        $project = $contact->project ? $contact->project->name : '';
        $city = $contact->city ? $contact->city->name : '';
        $status = $contact->status ? $contact->status->name : '';
        if(userRole() != 'seller'){

          $assigned_to = $contact->user ? explode('@',$contact->user->name)[0] : '';
          $created_by = $contact->creator ? explode('@',$contact->creator->name)[0] : '';
          return [
              str_replace(" ","N/A",str_replace("="," ",$contact->fullname)),
              $phone,
              $country,
              $project,
              $status,
              timeZone($contact->created_at),
              timeZone($contact->updated_at),
              $assigned_to,
              $created_by,
              $contact->purpose_type,
              $contact->source,
              $contact->email
            ];
        }else{
          return [
            str_replace(" ","N/A",str_replace("="," ",$contact->fullname)),
            $phone,
            $country,
            $project,
            $status,
            $contact->purpose_type,
            $contact->source,
            $contact->email,
            timeZone($contact->created_at),
            timeZone($contact->updated_at)
          ];

        }
    }    

    public function headings(): array
    {
      if(userRole() != 'seller'){
        return array_map('ucfirst',[
          __('site.Name'),
          __('site.Phone'),
          __('site.country'),
          __('site.project'),
          __('site.status'),
          __('site.Created'),
          __('site.Last Updated'),
          __('site.Assigned To'),
          __('site.Created By'),
          __('site.purpose type'),
          __('site.source'),
          __('site.email'),
        ]);
      }else{
        return array_map('ucfirst',[
          __('site.Name'),
          __('site.Phone'),
          __('site.country'),
          __('site.project'),
          __('site.status'),
          __('site.purpose type'),
          __('site.source'),
          __('site.email'),
          __('site.Created'),
          __('site.Last Updated')
        ]);
      }
  }
  
  function filterPrams($q){

    if(request()->has('ADVANCED')){
      $feilds = request()->all();
      $allowedFeilds =[
        "country_id" ,
        "user_id" ,
        "project_id" ,
        "purpose" ,
        "lang" ,
        "campaign",
        "last_mile_conversion",
        "status_id",
        "created_by", //Added by Javed
        "project_country_id", //Added by Javed
        "budget", //Added by Javed
        "source", //Added by Javed
        "purpose_type", //Added by Javed
        "email", //Added by Javed
      ];

      foreach($feilds as $feild => $value){
        if(in_array($feild,$allowedFeilds) AND !empty($value)){
          if($feild == 'project_country_id'){
            $q->whereHas('project', function($q2) use($value) {
              $q2->where('projects.country_id',$value);
            });
          }else{
            $q->where($feild,$value);
          }
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
      //End

      //Added by Javed
      if(Request('last_update_from') && Request('last_update_to')){
        $from = date('Y-m-d 00:00:00', strtotime(Request('last_update_from')));
        $to = date('Y-m-d 23:59:59', strtotime(Request('last_update_to')));
        $q->whereBetween('updated_at',[$from,$to]);
      }else{   
        if(Request('last_update_from')){
          $from = date('Y-m-d 00:00:00', strtotime(Request('last_update_from')));
          $q->where('updated_at','>=', $from);
        }   
        if(Request('last_update_to')){
          $to = date('Y-m-d 23:59:59', strtotime(Request('last_update_to')));
          $q->where('updated_at','<=',$to);
        }            
      }
      //End
        
      return $q;
    }

    if(Request()->has('search') AND Request()->has('my-contacts')  AND Request()->has('filter_status')){
      return $q->where('status_id',Request('filter_status'))
          ->where('user_id', auth()->id())
          ->where(function ($q){
              $q ->OrWhere('last_name','LIKE','%'. Request('search') .'%')
                ->OrWhere('first_name','LIKE','%'. Request('search') .'%')
                ->OrWhere('phone','LIKE','%'. Request('search') .'%')
                ->OrWhere('email','LIKE','%'. Request('search') .'%')
                ->OrWhere('scound_phone','LIKE','%'. Request('search') .'%')
                ->OrWhere('campaign','LIKE','%'. Request('search') .'%')
                ->OrWhere('source','LIKE','%'. Request('search') .'%')
                ->OrWhere('medium','LIKE','%'. Request('search') .'%');
          });
    }

    if(Request()->has('filter_status') AND Request()->has('search')){
      return $q->where('status_id',Request('filter_status'))
        ->where(function ($q){
          $q ->OrWhere('last_name','LIKE','%'. Request('search') .'%')
            ->OrWhere('first_name','LIKE','%'. Request('search') .'%')
            ->OrWhere('phone','LIKE','%'. Request('search') .'%')
            ->OrWhere('email','LIKE','%'. Request('search') .'%')
            ->OrWhere('scound_phone','LIKE','%'. Request('search') .'%')
            ->OrWhere('campaign','LIKE','%'. Request('search') .'%')
            ->OrWhere('source','LIKE','%'. Request('search') .'%')
            ->OrWhere('medium','LIKE','%'. Request('search') .'%');
      });
    }

    if(Request()->has('campaign')){
      if(!request('status')){
        return $q->where('campaign', request('campaign'));
      }
      return $q->where('status_id', request('status'))
              ->where('campaign', request('campaign'));
    }


    if(Request()->has('search') AND Request()->has('my-contacts')){
        return $q->where('user_id','LIKE',auth()->id())
          ->where(function ($q){
            $q ->OrWhere('last_name','LIKE','%'. Request('search') .'%')
              ->OrWhere('first_name','LIKE','%'. Request('search') .'%')
              ->OrWhere('phone','LIKE','%'. Request('search') .'%')
              ->OrWhere('email','LIKE','%'. Request('search') .'%')
              ->OrWhere('scound_phone','LIKE','%'. Request('search') .'%')
              ->OrWhere('campaign','LIKE','%'. Request('search') .'%')
              ->OrWhere('source','LIKE','%'. Request('search') .'%')
              ->OrWhere('medium','LIKE','%'. Request('search') .'%');
        });
    }


    if(Request()->has('my-contacts') AND Request()->has('filter_status')){
      return $q->where('status_id', Request('filter_status'))->where('user_id', auth()->id());
    }

    if(Request()->has('my-contacts')){
      return $q->where('user_id', auth()->id());
    }

    if(Request()->has('filter_status')){
      return $q->where('status_id', Request('filter_status'));
    }


    if(Request()->has('unassigned')){
      $notAssignedLevel = User::select('id','rule')
                              ->where('rule','admin')
                              ->OrWhere('rule','sales admin')->get();

      return $q->where('user_id',null)
              ->orWhereIn('user_id',$notAssignedLevel->pluck('id')->toArray());
    }



    if(request()->has('status') AND request()->has('user')){
      return  $q->where('status_changed_at', '<=', Carbon::today()->subDays( 2 ))
                ->where('status_id',request('status'))
                ->where('user_id',request('user'));

    }


    if(request()->has('export')){
      $req = request('export');
      $campaing = Campaing::select('id','name')->where('id',$req)->first();

      if($campaing)
      {
          return $q->where('campaign',$campaing->name);
      }
    }

    if(Request()->has('search')){
      return $q->where('first_name','LIKE','%'. Request('search') .'%')
              ->OrWhere('last_name','LIKE','%'. Request('search') .'%')
              ->OrWhere('phone','LIKE','%'. Request('search') .'%')
              ->OrWhere('email','LIKE','%'. Request('search') .'%')
              ->OrWhere('scound_phone','LIKE','%'. Request('search') .'%')
              ->OrWhere('campaign','LIKE','%'. Request('search') .'%')
              ->OrWhere('source','LIKE','%'. Request('search') .'%')
              ->OrWhere('medium','LIKE','%'. Request('search') .'%');
    }
  }

}

