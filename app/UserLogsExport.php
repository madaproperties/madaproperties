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
use App\Log;

class UserLogsExport implements FromQuery, WithHeadings, ShouldAutoSize, WithMapping
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
        
        $activities = Log::where('user_id',$rs->id);
        if(!empty(Request('from')) && !empty(Request('to'))){
            $activities->whereBetween('log_date',[ $from,$to ]);
        }
        if(!empty(Request('last_update_from')) && !empty(Request('last_update_to'))){
            $last_update_from = date('Y-m-d 00:00:00', strtotime(Request('last_update_from')));
            $last_update_to = date('Y-m-d 23:59:59', strtotime(Request('last_update_to')));
            $activities->whereBetween('updated_at',[ $last_update_from,$last_update_to]);
        }

        $activities = $activities->get();
        $callCount = $activities->where('type','call')->count();
        $meetingCount = $activities->where('type','meeting')->count();
        $whatsappCount = $activities->where('type','whatsapp')->count();
        $emailCount = $activities->where('type','email')->count();

        $data[] = $rs->name;
        $data[] = $callCount > 0 ? $callCount : '0';
        $data[] = $meetingCount > 0 ? $meetingCount : '0';
        $data[] = $whatsappCount > 0 ? $whatsappCount : '0';
        $data[] = $emailCount > 0 ? $emailCount : '0';

        return $data; 
    }    

    public function headings(): array
    {
      $head = array();
      $head[] = 'Name';
      $head[] = 'Call';
      $head[] = 'Meeting';
      $head[] = 'WhatsApp';
      $head[] = 'Email';

      return array_map('ucfirst',$head);
    }
  

}

