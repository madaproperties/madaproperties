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

class CashExport implements FromQuery, WithHeadings, ShouldAutoSize, WithMapping
{
    use Exportable;

    public function query()
    {
      if(Request()->has('search')){
        $deals = Cash::where(function ($q){
          $this->filterPrams($q);
        })->orderBy('id','desc');
  
      }else{
          $deals = Cash::orderBy('id','desc');
      }
      return $deals;
    }

    public function map($deal): array
    {
        return [
          $deal->cheque_date,
          $deal->cheque_number,
          $deal->paid,
          $deal->amount,
          $deal->description,
          timeZone($deal->created_at),
          timeZone($deal->updated_at),
        ];
    }    

    public function headings(): array
    {
      return array_map('ucfirst',[
        __('site.cheque_date'),
        __('site.cheque_number'),
        __('site.paid'),
        __('site.amount'),
        __('site.description'),
        __('site.created_at'),
        __('site.updated_at'),
      ]);
    }

    private function filterPrams($q){

      if(Request()->has('search')){
        $uri = Request()->fullUrl();
        return $q->where('cheque_date','LIKE','%'. Request('search') .'%')
        ->orWhere('amount','LIKE','%'. Request('search') .'%')
        ->orWhere('cheque_number','LIKE','%'. Request('search') .'%')
        ->orWhere('description','LIKE','%'. Request('search') .'%')
        ->get();
      }
    }  
  
  

}

