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
// use App\Zones;

class DatabaseRecordsExport implements FromQuery, WithHeadings, ShouldAutoSize, WithMapping
{
    use Exportable;

    public function query()
    {
      if(Request()->has('search')){
          $deals = DatabaseRecords::where('name','LIKE','%'. Request('search') .'%')->orderBy('id','desc');
      }else{
        if(auth()->user()->rule=='sales')
        {
           $deals = DatabaseRecords::where('user_id',auth()->id());
        }
        elseif(auth()->user()->rule=='sales admin uae')
        {
          $deals = DatabaseRecords::where('country_id',2);
        }
        elseif(auth()->user()->rule=='sales admin saudi')
        {
          $deals = DatabaseRecords::where('country_id',1);
        }
        elseif(auth()->user()->rule=='sales director')
        {
          $user=User::where('id',auth()->id())->first();
          if($user->time_zone=='Asia/Dubai')
          {
          $deals = DatabaseRecords::where('country_id',2);  
          }
          else{
          $deals = DatabaseRecords::where('country_id',1);  
          }
        }
        else{
          $deals = DatabaseRecords::orderBy('id','desc');
        }
        
      }
      return $deals;
    }

    public function map($deal): array
    {
      $country = $deal->country ? $deal->country->name : '';
      $assign_to = $deal->user ? $deal->user->name : '';
      $unit_country=Country::where('id',$deal->user_country_id)->first();
      $zone= $deal->zone ? $deal->zone->zone_name : 'N/A';
      $districts= $deal->district ? $deal->district->name : 'N/A';
      $community=$deal->community ? $deal->community->name_en : 'N/A';
      $subcommunity=$deal->subcommunity ? $deal->subcommunity->name_en : 'N/A'; 
      
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
          $community,
          $subcommunity,
          $deal->developer,
          $unit_country->name_en, 
          isset($status->name_en) ? $status->name_en : 'N/A',
          // $created_by,
          // $assign_to,
          $zone,
          $districts,
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
         __('site.user_country'),
        __('site.status'),
        __('site.zone'),
        __('site.district'),
        __('site.assigned to'),
        __('site.comment'),
      ]);
    }
  

}

