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
use App\Contact;

class UserStatusExport implements FromQuery, WithHeadings, ShouldAutoSize, WithMapping
{
    use Exportable;

    public function query()
    {		
        $userReport = User::where('active','1');
        if(userRole() != 'sales'){
            $allUsersReport = true;
            $userReport->whereIn('rule',['sales','sales admin','leader','sales director']);
            if(userRole() == 'sales admin saudi'){
                $whereCountry = 'Asia/Riyadh';
                $userReport = $userReport->where('time_zone','like','%'.$whereCountry.'%');
            }else if(userRole() == 'sales admin uae'){
                $whereCountry = 'Asia/Dubai';
                $userReport = $userReport->where('time_zone','like','%'.$whereCountry.'%');
            }else if(userRole()=='sales director') { 
                $userdetail=User::where('id',auth()->id())->first();
                if($userdetail->time_zone=='Asia/Riyadh'){
                    $whereCountry = 'Asia/Riyadh';
                    $userReport = $userReport->where('time_zone','like','%'.$whereCountry.'%');	
                }else{
                    $whereCountry = 'Asia/Dubai';
                    $userReport = $userReport->where('time_zone','like','%'.$whereCountry.'%');
                }
            }else if(userRole() == 'leader'){
                $userReport = User::where('active','1')->whereRaw('JSON_CONTAINS(leader, ?)', [json_encode((string) auth()->id())]);
            }
            if(request('users_id') > 0){
                $userReport = $userReport->where('id',request('users_id'));
            }
            if(request('leader_id') > 0){
                $userReport = $userReport->whereRaw('JSON_CONTAINS(leader, ?)', [json_encode((string) request('leader_id'))]);
            }
    
            $userReport = $userReport->whereNotIn('email',['lead-admin-uae@madaproperties.com','lead-admin-ksa@madaproperties.com'])
            ->orderBy('email');
        }

            
        return $userReport;	
    }

    public function map($rs): array
    {
        $data =array();
        $status = Status::where('active','1')->get();
        if(!empty(Request('from')) && !empty(Request('to'))){
            $from = date('Y-m-d 00:00:00', strtotime(Request('from')));
            $to = date('Y-m-d 23:59:59', strtotime(Request('to')));
        }
        if(!empty(Request('last_update_from')) && !empty(Request('last_update_to'))){
            $last_update_from = date('Y-m-d 00:00:00', strtotime(Request('last_update_from')));
            $last_update_to = date('Y-m-d 23:59:59', strtotime(Request('last_update_to')));
        }

        $finalTotal = 0;
        $data[]=$rs->name;
        foreach($status as $state){

            $leadTotal = Contact::where('status_id',$state->id)->where('user_id',$rs->id);
            if(!empty(Request('from')) && !empty(Request('to'))){
                $leadTotal->whereBetween('created_at',[ $from,$to ]);
            }
            if(!empty(Request('last_update_from')) && !empty(Request('last_update_to'))){
                $leadTotal->whereBetween('updated_at',[ $last_update_from,$last_update_to ]);
            }
            if(!empty(Request('country_id'))){
                $leadTotal->where('unit_country',Request('country_id'));
            }
            if(!empty(Request('project_id'))){
                $leadTotal->where('project_id',Request('project_id'));
            }
            if(!empty(Request('campaign_id'))){
                $leadTotal->where('campaign',Request('campaign_id'));
            }	
            if(userRole() == 'sales director'){
                $leadTotal->whereHas('project', function($q2) {
                    $q2->where('projects.country_id',getSalesDirectorCountryId());
                });
            }
            $leadTotal = $leadTotal->count();
            $finalTotal += $leadTotal;
            $data[]=$leadTotal > 0 ? $leadTotal : '0';
        }
        $data[] = $finalTotal > 0 ? $finalTotal : '0';
        return $data; 
    }    

    public function headings(): array
    {
      $head = array();
      $status = Status::where('active','1')->get();
      $head[] = 'Name';
      foreach($status as $statu){
        $head[] = $statu->name;
      }
      $head[] = 'Total';

      return array_map('ucfirst',$head);
    }
  

}

