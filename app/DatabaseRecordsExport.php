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

class DatabaseRecordsExport implements FromQuery, WithHeadings, ShouldAutoSize, WithMapping
{
    use Exportable;

    public function query()
    {
      if(Request()->has('search')){
          $deals = DatabaseRecords::where('name','LIKE','%'. Request('search') .'%')->orderBy('id','desc');
      }else{
          $deals = DatabaseRecords::orderBy('id','desc');
      }
      return $deals;
    }

    public function map($deal): array
    {
      $country = $deal->country ? $deal->country->name : '';
      $assign_to = $deal->user ? $deal->user->name : '';
      $unit_country=Country::where('id',$deal->unit_country)->select('name_en')->first();
       // $status=Status::where('id',$deal->status)->first();
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
          $deal->community,
          $deal->sub_community,
          $deal->developer,
          $unit_country, 
          isset($status->name_en) ? $status->name_en : 'N/A',
          $created_by,
          $assign_to,
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
        __('site.status'),
        __('site.assigned to'),
        __('site.comment'),
      ]);
    }
  

}

