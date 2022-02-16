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

class DealExport implements FromQuery, WithHeadings, ShouldAutoSize, WithMapping
{
    use Exportable;

    public function query()
    {
      if(Request()->has('search')){
        $deals = Deal::where('unit_name','LIKE','%'. Request('search') .'%')->orderBy('deal_date','desc');
          
      }else{
        $deals = Deal::orderBy('deal_date','desc');
      }
      return $deals;
    }

    public function map($deal): array
    {
        $country = $deal->country ? $deal->country->name : '';
        $project = $deal->project ? $deal->project->name : '';
        $agent = $deal->agent ? $deal->agent->email : '';
        $leader = $deal->leader ? $deal->leader->email : '';
        $developer_name = $deal->developer ? $deal->developer->name : '';

        return [
          $country,
          $project,
          $deal->purpose,
          $deal->purpose_type,
          $deal->unit_name,
          $developer_name,
          date('d-m-Y',strtotime($deal->deal_date)),
          $deal->source->name,
          $deal->invoice_number,
          $deal->client_name,
          $deal->client_name,
          $deal->client_mobile_no,
          $deal->client_email,
          ($deal->price),
          $deal->commission_type,
          $deal->commission,
          ($deal->commission_amount),
          $deal->vat,
          ($deal->vat_amount),
          $deal->vat_received,
          ($deal->total_invoice),
          $deal->token,
          ($deal->down_payment),
          $deal->spa,
          date('d-m-Y',strtotime($deal->expected_date)),
          date('d-m-Y',strtotime($deal->invoice_date)),
          $agent,
          $deal->agent_commission_percent,
          ($deal->agent_commission_amount),
          $deal->agent_commission_received,
          $leader,
          $deal->agent_leader_commission_percent,
          ($deal->agent_leader_commission_amount),
          $deal->agent_leader_commission_received,
          $deal->third_party,
          ($deal->third_party_amount),
          $deal->third_party_name,
          $deal->mada_commission,
          $deal->mada_commission_received,
          $deal->notes,
          timeZone($deal->created_at),
          timeZone($deal->updated_at),
        ];
    }    

    public function headings(): array
    {
      return array_map('ucfirst',[
        __('site.unit country'),
        __('site.project'),
        __('site.Purpose'),
        __('site.purpose type'),
        __('site.unit_name'),
        __('site.developer_name'),
        __('site.deal_date'),
        __('site.source'),
        __('site.invoice_number'),
        __('site.client_name'),
        __('site.client_mobile_no'),
        __('site.client_email'),
        __('site.price'),
        __('site.commission_type'),
        __('site.commission'),
        __('site.commission_amount'),
        __('site.vat'),
        __('site.vat_amount'),
        __('site.vat_received'),
        __('site.total_invoice'),
        __('site.token'),
        __('site.down_payment'),
        __('site.spa'),
        __('site.expected_date'),
        __('site.invoice_date'),
        __('site.Agent'),
        __('site.agent_commission_percent'),
        __('site.agent_commission_amount'),
        __('site.agent_commission_received'),
        __('site.Leader'),
        __('site.agent_leader_commission_percent'),
        __('site.agent_leader_commission_amount'),
        __('site.agent_leader_commission_received'),
        __('site.third_party'),
        __('site.third_party_amount'),
        __('site.third_party_name'),
        __('site.mada_commission'),
        __('site.mada_commission_received'),
        __('site.notes'),
        __('site.created_at'),
        __('site.updated_at'),
      ]);
  }
  
  function filterPrams($q){

    if(request()->has('ADVANCED')){
      $feilds = request()->all();
      $allowedFeilds =[
        "country_id" ,
        "project_id" ,
        "purpose" ,
        "agent_id" ,
        "leader_id" ,
      ];

      foreach($feilds as $feild => $value){
        if(in_array($feild,$allowedFeilds) AND !empty($value)){
            $q->where($feild,$value);
        }
      }

      //Added by Javed
      if(Request('from') && Request('to')){
        $from = date('Y-m-d 00:00:00', strtotime(Request('from')));
        $to = date('Y-m-d 23:59:59', strtotime(Request('to')));
        $q->whereBetween('created_at',[$from,$to]);
      }else{   
        if(Request('from')){
          $from = date('Y-m-d 00:00:00', strtotime(Request('from')));
          $q->where('created_at','>=', $from);
        }   
        if(Request('to')){
          $to = date('Y-m-d 23:59:59', strtotime(Request('to')));
          $q->where('created_at','<=',$to);
        }            
      }
      //End
              
      return $q;
    }

    if(Request()->has('search') AND Request()->has('my-contacts')  AND Request()->has('filter_status')){
      return $q->where('status_id',Request('filter_status'))
          ->where('user_id', auth()->id())
          ->where(function ($q){
              $q ->OrWhere('last_name','LIKE','%'. Request('search') .'%')
                ->OrWhere('first_name','LIKE','%'. Request('search') .'%')
                ->OrWhere('phone','LIKE','%'. Request('search') .'%')
                ->OrWhere('scound_phone','LIKE','%'. Request('search') .'%')
                ->OrWhere('campaign','LIKE','%'. Request('search') .'%')
                ->OrWhere('source','LIKE','%'. Request('search') .'%')
                ->OrWhere('medium','LIKE','%'. Request('search') .'%');
          });
    }

    if(Request()->has('filter_status') AND Request()->has('search')){
      echo "dfdfsddsfd";
      die;
      return $q->where('status_id',Request('filter_status'))
        ->where(function ($q){
          $q ->OrWhere('last_name','LIKE','%'. Request('search') .'%')
            ->OrWhere('first_name','LIKE','%'. Request('search') .'%')
            ->OrWhere('phone','LIKE','%'. Request('search') .'%')
            ->OrWhere('scound_phone','LIKE','%'. Request('search') .'%')
            ->OrWhere('campaign','LIKE','%'. Request('search') .'%')
            ->OrWhere('source','LIKE','%'. Request('search') .'%')
            ->OrWhere('medium','LIKE','%'. Request('search') .'%');
      });
    }

    if(Request()->has('campaign')){
      if(!request('status')){
        return $q->where('campaign', request('campaign'));
      }
      return $q->where('status_id', request('status'))
              ->where('campaign', request('campaign'));
    }


    if(Request()->has('search') AND Request()->has('my-contacts')){
        return $q->where('user_id','LIKE',auth()->id())
          ->where(function ($q){
            $q ->OrWhere('last_name','LIKE','%'. Request('search') .'%')
              ->OrWhere('first_name','LIKE','%'. Request('search') .'%')
              ->OrWhere('phone','LIKE','%'. Request('search') .'%')
              ->OrWhere('scound_phone','LIKE','%'. Request('search') .'%')
              ->OrWhere('campaign','LIKE','%'. Request('search') .'%')
              ->OrWhere('source','LIKE','%'. Request('search') .'%')
              ->OrWhere('medium','LIKE','%'. Request('search') .'%');
        });
    }


    if(Request()->has('my-contacts') AND Request()->has('filter_status')){
      return $q->where('status_id', Request('filter_status'))->where('user_id', auth()->id());
    }

    if(Request()->has('my-contacts')){
      return $q->where('user_id', auth()->id());
    }

    if(Request()->has('filter_status')){
      return $q->where('status_id', Request('filter_status'));
    }


    if(Request()->has('unassigned')){
      $notAssignedLevel = User::select('id','rule')
                              ->where('rule','admin')
                              ->OrWhere('rule','sales admin')->get();

      return $q->where('user_id',null)
              ->orWhereIn('user_id',$notAssignedLevel->pluck('id')->toArray());
    }



    if(request()->has('status') AND request()->has('user')){
      return  $q->where('status_changed_at', '<=', Carbon::today()->subDays( 2 ))
                ->where('status_id',request('status'))
                ->where('user_id',request('user'));

    }


    if(request()->has('export')){
      $req = request('export');
      $campaing = Campaing::select('id','name')->where('id',$req)->first();

      if($campaing)
      {
          return $q->where('campaign',$campaing->name);
      }
    }

    if(Request()->has('search')){
      return $q->where('first_name','LIKE','%'. Request('search') .'%')
              ->OrWhere('last_name','LIKE','%'. Request('search') .'%')
              ->OrWhere('phone','LIKE','%'. Request('search') .'%')
              ->OrWhere('scound_phone','LIKE','%'. Request('search') .'%')
              ->OrWhere('campaign','LIKE','%'. Request('search') .'%')
              ->OrWhere('source','LIKE','%'. Request('search') .'%')
              ->OrWhere('medium','LIKE','%'. Request('search') .'%');
    }
  }

}

