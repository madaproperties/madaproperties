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
use Carbon\Carbon;

class UserWeekStatusExport implements FromQuery, WithHeadings, ShouldAutoSize, WithMapping
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
                $userReport = User::where('active','1')->whereRaw('JSON_CONTAINS(leader, ?)', [auth()->id()]);
            }
            if(request('users_id') > 0){
                $userReport = $userReport->where('id',request('users_id'));
            }
            if(request('leader_id') > 0){
                $userReport = $userReport->whereRaw('JSON_CONTAINS(leader, ?)', [request('leader_id')]);
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
        $finalTotal = 0;
        $data[]=$rs->name;
        $status_not_changed_after_1_week = Contact::select('id','user_id','status_id','status_changed_at')
									->where('user_id',$rs->id)
									->whereDate('updated_at', '<=', Carbon::today()->subDays( 14 ));

        if(!empty(Request('country_id'))){
            $status_not_changed_after_1_week = $status_not_changed_after_1_week->where('country_id',Request('country_id'));
        }										
        if(!empty(Request('project_id'))){
            $status_not_changed_after_1_week = $status_not_changed_after_1_week->where('project_id',Request('project_id'));
        }										
        if(userRole() == 'sales director'){
            $status_not_changed_after_1_week = $status_not_changed_after_1_week->whereHas('project', function($q2) {
                $q2->where('projects.country_id',getSalesDirectorCountryId());
            });
        }									
        $status_not_changed_after_1_week = $status_not_changed_after_1_week->get();
        foreach($status as $state){
            $leadTotal = $status_not_changed_after_1_week->where('status_id',$state->id)->count();
            $finalTotal += $leadTotal;
            $data[] = $leadTotal > 0 ? $leadTotal : '0';
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

