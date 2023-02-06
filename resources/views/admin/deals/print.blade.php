<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <style>
            * {
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
            }
			@page {
				size: auto;
				margin: 0;
			}			
			main{
				
                width: 100%;
                max-width: 100%;
				padding:20px;
			}
            table {
                width: 100%;
                max-width: 100%;
                border-spacing: 0;
                border-collapse: collapse;
                background-color: transparent;
				margin-bottom:15px;
            }
            .table td  {
                border: 1px solid #000;
                padding: 6px;
				max-width:20px;
				font-size:12px;
				font-family:Calibri;
            }
			.center{
				text-align:center;
			}
			img{
				max-height:80px;
			}
        </style>
    </head>
    <body onload="window.print()">
        <main>
			<div class="logo center">
				<img alt="Logo" src="{{ asset('public/imgs/logo.png') }}" class="max-h-30px">
				<h3 style="text-decoration:underline;">Commission Report</h3>
			</div>
            <table class="table table-bordered">
                <tbody>
					<tr>
						<td style="border:0px;text-align:left">Invoice Number: {{$deal->invoice_number}}</td>
						
                    </tr>
					<tr>
						<td>Developer:</td>
						<td colspan="2">{{isset($deal->developer->name) ? $deal->developer->name : 'N/A'}}</td>
                    </tr>
					<tr>
						<td>Project Name:</td>
						<td colspan="2">{{isset($deal->project->project_name) ? $deal->project->project_name : 'N/A'}}</td>
                    </tr>
					<tr>
						<td>Unit No.:</td>
						<td colspan="2">{{$deal->unit_name}}</td>
                    </tr>
					<tr>
						<td>Type of Property</td>
						<td colspan="2">{{$deal->purpose_type}}</td>
                    </tr>
					<tr>
						<td>Purpose:</td>
						<td colspan="2">{{$deal->purpose}}</td>
					
                    </tr>
					<tr>
						<td>Type:</td>
						<td colspan="2">{{$deal->project_type}}</td>
					
                    </tr>                   
					<tr>
						<td>Source:</td>
						<td colspan="2">{{isset($deal->source->name) ? $deal->source->name : 'N/A'}}</td>
					
                    </tr>
					<tr>
					    <td>Commission Type:</td>
					<td colspan="2">{{$deal->commission_type}}</td>
					
                    </tr>
					<tr>
						<td>
						      @if($deal->unit_country == 1) <!-- if country Saudi Arabia -->
						      Price (SAR):
						      @else
						    Price (AED):
						    @endif</td>
						<td>{{number_format($deal->price, 2)}}</td>
						<td>Date of Signing: {{date('d-m-Y',strtotime($deal->deal_date))}}</td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered">
                <tbody>
					<tr>
						<td>Client Name:</td>
						<td colspan="2">{{$deal->client_name}}</td>
                    </tr>
					<tr>
						<td>Passport No.:</td>
						<td colspan="2"></td>
                    </tr>
					<tr>
						<td>Mobile No.:</td>
						<td colspan="2">{{$deal->client_mobile_no}}</td>
                    </tr>
					<tr>
						<td>Email ID:</td>
						<td colspan="2">{{$deal->client_email}}</td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered">
                <tbody>
					<tr>
						<td>Property Consultant</td>
						<td>{{isset($deal->agent->name) ? $deal->agent->name : 'N/A'}}</td>
						
                    </tr>
					<tr>
						<td>
						     @if($deal->unit_country == 1) <!-- if country Saudi Arabia -->
						    Property Consultant Amount (SAR) Commission Percent - {{$deal->agent_commission_percent.'%'}}
						    @else
						    Property Consultant Amount (AED) Commission Percent - {{$deal->agent_commission_percent.'%'}}
						    @endif
						    </td>
						<td>{{number_format($deal->agent_commission_amount, 2)}}</td>
						
                    </tr>
					@if(isset($deal->agentTwo))
					<tr>
						<td>Property Consultant 2</td>
						<td>{{isset($deal->agentTwo->name) ? $deal->agentTwo->name : 'N/A'}}</td>
						
                    </tr>
					<tr>
						<td>
						      @if($deal->unit_country == 1) <!-- if country Saudi Arabia -->
						      Property Consultant 2 Amount (SAR) Commission Percent - {{$deal->agent2_commission_percent.'%'}}
						      @else
						      Property Consultant 2 Amount (AED) Commission Percent - {{$deal->agent2_commission_percent.'%'}}
						      @endif
						      </td>
						<td>{{number_format($deal->agent2_commission_amount, 2)}}</td>
						
                    </tr>
					@endif
					@if(isset($deal->salesDirector))
					<tr>
						<td>Sales Director Name</td>
						<td>{{isset($deal->salesDirector) ? explode('@',$deal->salesDirector->name)[0] : 'N/A'}}</td>
						
                    </tr>
					<tr>
						<td>
						    @if($deal->unit_country == 1) <!-- if country Saudi Arabia -->
						    Sales Director Amount (SAR)
						    @else
						    Sales Director Amount (AED)
						    @endif
						    </td>
						<td>{{$deal->sales_director_commission_amount}}</td>
						
                    </tr>
					@endif
					<tr>
						<td>Sales Manager Name</td>
						<td>{{isset($deal->leader) ? explode('@',$deal->leader->name)[0] : 'N/A'}}</td>
						
                    </tr>
					<tr>
						<td> @if($deal->unit_country == 1) <!-- if country Saudi Arabia -->
							Sales Manager Amount (SAR)
						@else
							Sales Manager Amount (AED)
						@endif
					</td>
						<td>{{$deal->agent_leader_commission_amount}}</td>
						
                    </tr>
					@if(isset($deal->leaderTwo))
					<tr>
						<td>Sales Manager 2 Name</td>
						<td>{{isset($deal->leaderTwo) ? explode('@',$deal->leaderTwo->name)[0] : 'N/A'}}</td>
						
                    </tr>
					<tr>
						<td>
						    @if($deal->unit_country == 1) <!-- if country Saudi Arabia -->
						    Sales Manager 2 Amount (SAR)
						    @else
						    Sales Manager 2 Amount (AED)
						    @endif
						    </td>
						<td>{{$deal->agent2_leader_commission_amount}}</td>
						
                    </tr>
					@endif

					<tr>
						<td>3rd Party Name</td>
						<td>{{$deal->third_party_name}}</td>
						
                    </tr>
						<tr>
						<td>
						     @if($deal->unit_country == 1) <!-- if country Saudi Arabia -->
						    3rd Party Amount (SAR)
						    @else
						    3rd Party Amount (AED)
						    @endif
						    </td>
						<td>{{number_format($deal->third_party_amount, 2)}}</td>
						
                    </tr>
						<tr>
						<td>
						    @if($deal->unit_country == 1) <!-- if country Saudi Arabia -->
						Mada Commission (SAR)
						@else
						Mada Commission (AED)
						@endif
						</td>
						<td>{{number_format($deal->mada_commission, 2)}}</td>
						
                    </tr>
					
                </tbody>
            </table>
			  <table class="table table-bordered">
                <tbody>
				<tr>
						<td>
						    @if($deal->unit_country == 1) <!-- if country Saudi Arabia -->
						     Commission (SAR)
						    @else
						     Commission (AED)
						    @endif
						   </td>
						<td>{{number_format($deal->commission_amount, 2)}}</td>
                    </tr>
					<tr>
						<td>
						    @if($deal->unit_country == 1) <!-- if country Saudi Arabia -->
						    VAT (SAR)
						    @else
						    VAT (AED)
						    @endif
						    </td>
						<td>{{number_format($deal->vat_amount, 2)}}</td>
						
                    </tr>
					<tr>
						<td>
						    @if($deal->unit_country == 1) <!-- if country Saudi Arabia -->
						    <b>Total Commission Inc VAT (SAR)</b>
						    @else
						    <b>Total Commission Inc VAT (AED)</b>
						    @endif
						    </td>
						<td><b>{{number_format(($deal->commission_amount+$deal->vat_amount), 2)}}</b></td>
						
                    </tr>
				</tbody>
				</table>
            <table class="table table-bordered">
                <tbody>
					<tr>
						<td>Notes: {{$deal->notes}}</td>
                    </tr>
                </tbody>
            </table>

            <table class="" style="border:0px;margin-top:20px">
                <tbody>
					<tr>
						<td>__________________</td>
                    </tr>
                    @if($deal->unit_country == 1) <!-- if country Saudi Arabia -->
					<tr>
						<td>Mr. Abdullah Al-Qahtani.</td>
                    </tr>
					<tr>
						<td>(CEO)</td>
                    </tr>
                    	@else <!-- if country United Arab Emirates -->
                    		<tr>
						<td>Mr. Mohamad Alhaj:</td>
                    </tr>
					<tr>
						<td>(Managing Director)</td>
                    </tr>
                    		@endif
                </tbody>
            </table>
        </main>
    </body>
</html>