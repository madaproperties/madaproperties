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

class DealProjectExport implements FromQuery, WithHeadings, ShouldAutoSize, WithMapping
{
    use Exportable;

    public function query()
    {
      if(Request()->has('search')){
        if(!checkLeader()){
          $deals = DealProject::where('country_id',1)->where('project_name','LIKE','%'. Request('search') .'%')->orderBy('id','desc');
        }elseif(!checkLeaderUae()){
          $deals = DealProject::where('country_id',2)->where('project_name','LIKE','%'. Request('search') .'%')->orderBy('id','desc');
        }else{
          $deals = DealProject::where('project_name','LIKE','%'. Request('search') .'%')->orderBy('id','desc');
        }
      }else{
        if(!checkLeader()){
          $deals = DealProject::where('country_id',1)->orderBy('id','desc');
        }elseif(!checkLeaderUae()){
          $deals = DealProject::where('country_id',2)->orderBy('id','desc');
        }else{
          $deals = DealProject::orderBy('id','desc');
        }
      }
      return $deals;
    }

    public function map($deal): array
    {
        $country = $deal->country ? $deal->country->name : '';
        return [
          $country,
          $deal->project_name,
          timeZone($deal->created_at),
          timeZone($deal->updated_at),
        ];
    }    

    public function headings(): array
    {
      return array_map('ucfirst',[
        __('site.country'),
        __('site.project').' '.__('site.name'),
        __('site.created_at'),
        __('site.updated_at'),
      ]);
    }
  

}

