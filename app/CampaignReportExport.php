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

class CampaignReportExport implements FromQuery, WithHeadings, ShouldAutoSize, WithMapping
{
    use Exportable;

    public function query()
    {		
        $projects_data = Project::orderBy('name_en','asc');	
        if(Request('project_id') && !empty(request('project_id'))){
            $projects_data = $projects_data->where('id',request('project_id'));
        }
        if(Request('project_country_id') && !empty(request('project_country_id'))){
            $projects_data = $projects_data->where('country_id',Request('project_country_id'));
        }
        if(Request('campaing_id') && !empty(request('campaing_id'))){
            $tempIds = Contact::where('campaign',request('campaing_id'))->get()->pluck('project_id');
            $projects_data = $projects_data->whereIn('id',$tempIds);
        }
                

        return $projects_data;	
    }

    public function map($campaing): array
    {
      $data =array();
      $data[] = $campaing->name_en;
      $total = 0;
      $status = Status::where('active','1')->orderBy('weight','ASC')->get();
      if(userRole() == 'leader'){
          $users = User::select('id','leader')
                    ->where('leader',auth()->id())
                    ->OrWhere('id', auth()->id())
                    ->get();
          $users = $users->pluck('id');
      }else{
          $users = [];
      }

      foreach($status as $statu){
        $tempOne = Contact::where(function ($q) use ($users){
          if(userRole() == 'leader')
          {
              return $q->whereIn('user_id',$users)
                      ->orWhereIn('created_by',$users)
                      ->get();
          }else if(userRole() == 'sales admin uae') {
              return $q->whereHas('project', function($q2) {
                  $q2->where('projects.country_id','2');
              })->get();

          }else if(userRole() == 'sales admin saudi'){
              return $q->whereHas('project', function($q2) {
                  $q2->where('projects.country_id','1');
              })->get();
          }
        })
        ->where('project_id',$campaing->id)
        ->where('status_id',$statu->id);
        if(Request('country') && !empty(request('country'))){
            $tempOne = $tempOne->where('country_id',request('country'));
        }
        if(Request('project_country_id') && !empty(request('project_country_id'))){
            $value = Request('project_country_id');
            $tempOne = $tempOne->whereHas('project', function($q2) use($value) {
                $q2->where('projects.country_id',$value);
            });
        }
        if(Request('source') && !empty(request('source'))){
            $tempOne = $tempOne->where('source',request('source'));
        }
        if(Request('city') && !empty(request('city'))){
            $tempOne = $tempOne->where('city_id',request('city'));
        }
        if(Request('project_id') && !empty(request('project_id'))){
            $tempOne = $tempOne->where('project_id',request('project_id'));
        }
        


        if(Request('from') && Request('to')){
            $from = date('Y-m-d 00:00:00', strtotime(Request('from')));
            $to = date('Y-m-d 23:59:59', strtotime(Request('to')));
            $tempOne = $tempOne->whereBetween('created_at',[$from,$to]);
        }else{   
            if(Request('from')){
                $from = date('Y-m-d 00:00:00', strtotime(Request('from')));
                $tempOne = $tempOne->where('created_at','>=', $from);
            }   
            if(Request('to')){
                $to = date('Y-m-d 23:59:59', strtotime(Request('to')));
                $tempOne = $tempOne->where('created_at','<=',$to);
            }            
        }
        $queryCount = $tempOne->count();
        $data[] = $queryCount > 0 ? $queryCount : '0'; 
        $total +=  $queryCount;
      }    
      $data[] = $total > 0 ? $total : '0';
      return $data; 
    }    

    public function headings(): array
    {
      $head = array();
      $status = Status::where('active','1')->orderBy('weight','ASC')->get();
      $head[] = '#';
      foreach($status as $statu){
        $head[] = $statu->name;
      }
      $head[] = 'Total';

      return array_map('ucfirst',$head);
    }
  

}

