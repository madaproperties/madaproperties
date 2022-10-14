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

class ProjectDataExport implements FromQuery, WithHeadings, ShouldAutoSize, WithMapping
{
    use Exportable;

    public function query()
    {
      if(Request()->has('search') || Request()->has('ADVANCED')){
        $data = ProjectData::where(function ($q){
          $this->filterPrams($q);
        })->orderBy('id','desc');
  
        if(!checkLeader()){
          $data = $data->where('unit_country',1);
        }elseif(!checkLeaderUae()){
          $data = $data->where('unit_country',2);
        }
      }else{
        if(!checkLeader()){
          $data = ProjectData::where('country_id',1)->orderBy('id','desc');
        }elseif(!checkLeaderUae()){
          $data = ProjectData::where('country_id',2)->orderBy('id','desc');
        }else{
          $data = ProjectData::orderBy('id','desc');
        }
      }
      return $data;
    }

    public function map($data): array
    {
        $country = $data->country ? $data->country->name : 'N/A';
        $project = $data->project ? $data->project->name : 'N/A';
        $developer = $data->developer ? $data->developer->name : 'N/A';
        return [
          $country,
          $data->city_name,
          $data->district_name,
          $developer,
          $data->unit_name,
          $project,
          $data->property_type,
          $data->area_bua,
          $data->area_plot,
          $data->bedroom,
          $data->price,
          $data->completion_date,
          $data->payment_status,
          $data->govt_docs,
          $data->floor_no,
          $data->commission,
          $data->down_payment,
          $data->status,
        ];
    }    

    public function headings(): array
    {
      return array_map('ucfirst',[
        __('site.country'),
        __('site.city_name'),
        __('site.district_name'),
        __('site.developer'),
        __('site.unit_name'),
        __('site.project'),
        __('site.property_type'),
        __('site.area_bua'),
        __('site.area_plot'),
        __('site.bedroom'),
        __('site.price'),
        __('site.completion_date'),
        __('site.payment_status'),
        __('site.govt_docs'),
        __('site.floor_no'),
        __('site.commission'),
        __('site.down_payment'),
        __('site.status'),
      ]);
    }
  
    private function filterPrams($q){

      if(request()->has('ADVANCED')){
        $uri = '';
        $feilds = request()->all();
        $allowedFeilds =[
          "project_id" ,
          "property_type" ,
          "bedroom" ,
          "developer_id" ,
          "payment_status" ,
        ];
  
        foreach($feilds as $feild => $value){
          if(in_array($feild,$allowedFeilds) AND !empty($value)){
              $q->where($feild,$value);
          }
        }
      }
    } 
}

