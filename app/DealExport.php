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
      if(Request()->has('search') || Request()->has('ADVANCED')){
        $deals = Deal::where(function ($q){
          $this->filterPrams($q);
        })->orderBy('deal_date','desc');

        if(!checkLeader()){
          $deals = $deals->where('unit_country',1);
        }elseif(!checkLeaderUae()){
          $deals = $deals->where('unit_country',2);
        }
          
      }else{
        if(!checkLeader()){
          $deals = Deal::where('unit_country',1)->orderBy('deal_date','desc');
        }elseif(!checkLeaderUae()){
          $deals = Deal::where('unit_country',2)->orderBy('deal_date','desc');
        }else{
          $deals = Deal::orderBy('deal_date','desc');
        }
      }
      return $deals;
    }

    public function map($deal): array
    {
      $exportArray = [];
      if(Request()->has('select') && !empty(Request('select'))) {
        $select = implode(",",Request('select'));
        $i=0;
        $select = explode(",",str_replace(" ","_",strtolower($select)));
        if(in_array('project_country',$select)){
          $exportArray[++$i] = $deal->country ? $deal->country->name : '';
        }
        if(in_array('project',$select)){
          $exportArray[++$i] = $deal->project ? $deal->project->project_name : '';
        }
        if(in_array('purpose',$select)){
          $exportArray[++$i] = $deal->purpose;
        }
        if(in_array('purpose_type',$select)){
          $exportArray[++$i] = $deal->purpose_type;
        }
        if(in_array('project_type',$select)){
          $exportArray[++$i] = $deal->project_type;
        }
        if(in_array('unit_name',$select)){
          $exportArray[++$i] = $deal->unit_name;
        }
        if(in_array('developer_name',$select)){
          $exportArray[++$i] = $deal->developer ? $deal->developer->name : '';
        }
        if(in_array('deal_date',$select)){
          if(!empty($deal->deal_date)){
            $exportArray[++$i] = date('d-m-Y',strtotime($deal->deal_date));
          }else{
            $exportArray[++$i] = '';
          }
        }
        if(in_array('source',$select)){
          $exportArray[++$i] = $deal->source ? $deal->source->name : '';
        }
        if(in_array('invoice_number',$select)){
          $exportArray[++$i] = $deal->invoice_number;
        }
        if(in_array('client_name',$select)){
          $exportArray[++$i] = $deal->client_name;
        }
        if(in_array('client_mobile_number',$select)){
          $exportArray[++$i] = $deal->client_mobile_no;
        }
        if(in_array('client_email',$select)){
          $exportArray[++$i] = $deal->client_email;
        }
        if(in_array('price',$select)){
          $exportArray[++$i] = $deal->price;
        }
        if(in_array('commission_type',$select)){
          $exportArray[++$i] = $deal->commission_type;
        }
        if(in_array('commission',$select)){
          $exportArray[++$i] = $deal->commission;
        }
        if(in_array('commission_amount',$select)){
          $exportArray[++$i] = $deal->commission_amount;
        }
        if(in_array('vat',$select)){
          $exportArray[++$i] = $deal->vat;
        }
        if(in_array('vat_amount',$select)){
          $exportArray[++$i] = $deal->vat_amount;
        }
        if(in_array('vat_paid',$select)){
          $exportArray[++$i] = $deal->vat_received;
        }
        if(in_array('total_invoice',$select)){
          $exportArray[++$i] = $deal->total_invoice;
        }
        if(in_array('token',$select)){
          $exportArray[++$i] = $deal->token;
        }
        if(in_array('down_payment',$select)){
          $exportArray[++$i] = $deal->down_payment;
        }
        if(in_array('spa',$select)){
          $exportArray[++$i] = $deal->spa;
        }
        if(in_array('expected_date',$select)){
          if(!empty($deal->expected_date)){
            $exportArray[++$i] = date('d-m-Y',strtotime($deal->expected_date));
          }else{
            $exportArray[++$i] = '';
          }
        }
        if(in_array('invoice_date',$select)){
          if(!empty($deal->invoice_date)){
            $exportArray[++$i] = date('d-m-Y',strtotime($deal->invoice_date));
          }else{
            $exportArray[++$i] = '';
          }
        }
        if(in_array('commission_received_date',$select)){
          if(!empty($deal->commission_received_date)){
            $exportArray[++$i] = date('d-m-Y',strtotime($deal->commission_received_date));
          }else{
            $exportArray[++$i] = '';
          }
        }
        if(in_array('agent',$select)){
          $exportArray[++$i] = $deal->agent ? $deal->agent->name : '';
        }
        if(in_array('agent_commission_percent',$select)){
          $exportArray[++$i] = $deal->agent_commission_percent;
        }
        if(in_array('agent_commission_amount',$select)){
          $exportArray[++$i] = $deal->agent_commission_amount;
        }
        if(in_array('agent_commission_received',$select)){
          $exportArray[++$i] = $deal->agent_commission_received;
        }

        if(in_array('agent2',$select)){
          $exportArray[++$i] = $deal->agenTwo ? $deal->agentTwo->name : '';
        }
        if(in_array('agent2_commission_percent',$select)){
          $exportArray[++$i] = $deal->agent2_commission_percent;
        }
        if(in_array('agent2_commission_amount',$select)){
          $exportArray[++$i] = $deal->agent2_commission_amount;
        }
        if(in_array('agent2_commission_received',$select)){
          $exportArray[++$i] = $deal->agent2_commission_received;
        }


        if(in_array('leader',$select)){
          $exportArray[++$i] = $deal->leader ? $deal->leader->name : '';
        }
        if(in_array('agent_leader_commission_percent',$select)){
          $exportArray[++$i] = $deal->agent_leader_commission_percent;
        }
        if(in_array('agent_leader_commission_amount',$select)){
          $exportArray[++$i] = $deal->agent_leader_commission_amount;
        }
        if(in_array('agent_leader_commission_received',$select)){
          $exportArray[++$i] = $deal->agent_leader_commission_received;
        }

        if(in_array('leader2',$select)){
          $exportArray[++$i] = $deal->leaderTwo ? $deal->leaderTwo->name : '';
        }
        if(in_array('agent2_leader_commission_percent',$select)){
          $exportArray[++$i] = $deal->agent2_leader_commission_percent;
        }
        if(in_array('agent2_leader_commission_amount',$select)){
          $exportArray[++$i] = $deal->agent2_leader_commission_amount;
        }
        if(in_array('agent2_leader_commission_received',$select)){
          $exportArray[++$i] = $deal->agent2_leader_commission_received;
        }

        if(in_array('sales_director',$select)){
          $exportArray[++$i] = $deal->salesDirector ? $deal->salesDirector->name : '';
        }
        if(in_array('sales_director_commission_percent',$select)){
          $exportArray[++$i] = $deal->sales_director_commission_percent;
        }
        if(in_array('sales_director_commission_amount',$select)){
          $exportArray[++$i] = $deal->sales_director_commission_amount;
        }
        if(in_array('sales_director_commission_received',$select)){
          $exportArray[++$i] = $deal->sales_director_commission_received;
        }



        if(in_array('third_party',$select)){
          $exportArray[++$i] = $deal->third_party;
        }
        if(in_array('third_party_amount',$select)){
          $exportArray[++$i] = $deal->third_party_amount;
        }
        if(in_array('third_party_commission_received',$select)){
          $exportArray[++$i] = $deal->third_party_commission_received;
        }
        if(in_array('third_party_name',$select)){
          $exportArray[++$i] = $deal->third_party_name;
        }
        if(in_array('mada_commission',$select)){
          $exportArray[++$i] = $deal->mada_commission;
        }
        if(in_array('mada_commission_received',$select)){
          $exportArray[++$i] = $deal->mada_commission_received;
        }
        if(in_array('notes',$select)){
          $exportArray[++$i] = $deal->notes;
        }
        if(in_array('created_at',$select)){
          $exportArray[++$i] = timeZone($deal->created_at);
        }
        if(in_array('updated_at',$select)){
          $exportArray[++$i] = timeZone($deal->updated_at);
        }
        return $exportArray;
      }else{
        $country = $deal->country ? $deal->country->name : '';
        $project = $deal->project ? $deal->project->project_name : '';
        $developer_name = $deal->developer ? $deal->developer->name : '';
        $source = $deal->source ? $deal->source->name : '';
        $agent = $deal->agent ? $deal->agent->name : '';
        $agent2 = $deal->agentTwo ? $deal->agentTwo->name : '';
        $leader = $deal->leader ? $deal->leader->name : '';
        $leader2 = $deal->leaderTwo ? $deal->leaderTwo->name : '';
        $sales_director = $deal->salesDirector ? $deal->salesDirector->name : '';
        $deal_date = '';
        if(!empty($deal->deal_date)){
          $deal_date = date('d-m-Y',strtotime($deal->deal_date));
        }
        $expected_date = '';
        if(!empty($deal->expected_date)){
          $expected_date = date('d-m-Y',strtotime($deal->expected_date));
        }
        $invoice_date = '';
        if(!empty($deal->invoice_date)){
          $invoice_date = date('d-m-Y',strtotime($deal->invoice_date));
        }
        $commission_received_date = '';
        if(!empty($deal->commission_received_date)){
          $commission_received_date = date('d-m-Y',strtotime($deal->commission_received_date));
        }
        return [
          $country,
          $project,
          $deal->purpose,
          $deal->purpose_type,
          $deal->project_type,
          $deal->unit_name,
          $developer_name,
          $deal_date,
		      $source,
          $deal->invoice_number,
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
          $expected_date,
          $invoice_date,
          $commission_received_date,
          $agent,
          $deal->agent_commission_percent,
          ($deal->agent_commission_amount),
          $deal->agent_commission_received,
          $agent2,
          $deal->agent2_commission_percent,
          ($deal->agent2_commission_amount),
          $deal->agent2_commission_received,
          $leader,
          $deal->agent_leader_commission_percent,
          ($deal->agent_leader_commission_amount),
          $deal->agent_leader_commission_received,
          $leader2,
          $deal->agent2_leader_commission_percent,
          ($deal->agent2_leader_commission_amount),
          $deal->agent2_leader_commission_received,
          $sales_director,
          $deal->sales_director_commission_percent,
          ($deal->sales_director_commission_amount),
          $deal->sales_director_commission_received,
          $deal->third_party,
          ($deal->third_party_amount),
          $deal->third_party_commission_received,
          $deal->third_party_name,
          $deal->mada_commission,
          $deal->mada_commission_received,
          $deal->notes,
          timeZone($deal->created_at),
          timeZone($deal->updated_at),
        ];
      }


      
    }    

    public function headings(): array
    {
      if(Request()->has('select') && !empty(Request('select'))) {
        return array_map('ucfirst',Request('select'));
      }else{
      return array_map('ucfirst',[
        __('site.unit country'),
        __('site.project'),
        __('site.Purpose'),
        __('site.purpose type'),
        __('site.project_type'),
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
        __('site.commission_received_date'),
        __('site.Agent'),
        __('site.agent_commission_percent'),
        __('site.agent_commission_amount'),
        __('site.agent_commission_received'),
        __('site.Agent2'),
        __('site.agent2_commission_percent'),
        __('site.agent2_commission_amount'),
        __('site.agent2_commission_received'),
        __('site.Leader'),
        __('site.agent_leader_commission_percent'),
        __('site.agent_leader_commission_amount'),
        __('site.agent_leader_commission_received'),
        __('site.Leader2'),
        __('site.agent2_leader_commission_percent'),
        __('site.agent2_leader_commission_amount'),
        __('site.agent2_leader_commission_received'),
        __('site.sales_director'),
        __('site.sales_director_commission_percent'),
        __('site.sales_director_commission_amount'),
        __('site.sales_director_commission_received'),
          __('site.third_party'),
        __('site.third_party_amount'),
        __('site.third_party_commission_received'),
        __('site.third_party_name'),
        __('site.mada_commission'),
        __('site.mada_commission_received'),
        __('site.notes'),
        __('site.created_at'),
        __('site.updated_at'),
      ]);
      }
  }
  
  private function filterPrams($q){

    if(request()->has('ADVANCED')){
      $feilds = request()->all();
      $allowedFeilds =[
        "unit_country" ,
        "project_id" ,
        "purpose" ,
        "purpose_type" ,
        "project_type" ,
        "developer_id",
        "agent_id",
        "leader_id",
        "vat_received",
        "agent_commission_received",
        "agent_leader_commission_received",
        "mada_commission_received",
        "third_party_commission_received",
        "third_party"
      ];

      foreach($feilds as $feild => $value){
        if(in_array($feild,$allowedFeilds) AND !empty($value)){
            $q->where($feild,$value);
        }
      }

      //Added by Javed
      if(Request('from') && Request('to')){
        $uri = Request()->fullUrl();
        $from = date('Y-m-d 00:00:00', strtotime(Request('from')));
        $to = date('Y-m-d 23:59:59', strtotime(Request('to')));
        $q->whereBetween('deal_date',[$from,$to]);
      }else{   
        if(Request('from')){
          $uri = Request()->fullUrl();
          $from = date('Y-m-d 00:00:00', strtotime(Request('from')));
          $q->where('deal_date','>=', $from);
        }   
        if(Request('to')){
          $uri = Request()->fullUrl();
          $to = date('Y-m-d 23:59:59', strtotime(Request('to')));
          $q->where('deal_date','<=',$to);
        }            
      }
      //End

      //Added by Javed
      if(Request('from_commission_received_date') && Request('to_commission_received_date')){
        $uri = Request()->fullUrl();
        $from = date('Y-m-d 00:00:00', strtotime(Request('from_commission_received_date')));
        $to = date('Y-m-d 23:59:59', strtotime(Request('to_commission_received_date')));
        $q->whereBetween('commission_received_date',[$from,$to]);
      }else{   
        if(Request('from_commission_received_date')){
          $uri = Request()->fullUrl();
          $from = date('Y-m-d 00:00:00', strtotime(Request('from_commission_received_date')));
          $q->where('commission_received_date','>=', $from);
        }   
        if(Request('to_commission_received_date')){
          $uri = Request()->fullUrl();
          $to = date('Y-m-d 23:59:59', strtotime(Request('to_commission_received_date')));
          $q->where('commission_received_date','<=',$to);
        }            
      }
      //End
      

      return $q->get();
    }

    if(Request()->has('search')){
      $uri = Request()->fullUrl();
      return $q->where('unit_name','LIKE','%'. Request('search') .'%')
              ->get();
    }
  }  

}

