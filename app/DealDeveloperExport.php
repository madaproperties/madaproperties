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

class DealDeveloperExport implements FromQuery, WithHeadings, ShouldAutoSize, WithMapping
{
    use Exportable;

    public function query()
    {
      if(Request()->has('search')){
        if(!checkLeader()){
          $deals = DealDeveloper::where('country_id',1)->where('name_en','LIKE','%'. Request('search') .'%')->orderBy('id','desc');
        }elseif(!checkLeaderUae()){
          $deals = DealDeveloper::where('country_id',2)->where('name_en','LIKE','%'. Request('search') .'%')->orderBy('id','desc');
        }else{
          $deals = DealDeveloper::where('name_en','LIKE','%'. Request('search') .'%')->orderBy('id','desc');
        }
      }else{
        if(!checkLeader()){
          $deals = DealDeveloper::where('country_id',1)->orderBy('id','desc');
        }elseif(!checkLeaderUae()){
          $deals = DealDeveloper::where('country_id',2)->orderBy('id','desc');
        }else{
          $deals = DealDeveloper::orderBy('id','desc');
        }
      }
      return $deals;
    }

    public function map($deal): array
    {
        $country = $deal->country ? $deal->country->name : '';
        return [
          $country,
          $deal->name_en,
          $deal->company_address,
          $deal->trn,
        ];
    }    

    public function headings(): array
    {
      return array_map('ucfirst',[
        __('site.country'),
        __('site.name'),
        __('site.company_address'),
        __('site.trn'),
      ]);
    }
  

}

