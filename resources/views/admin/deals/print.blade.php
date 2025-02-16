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
            td.line{padding-top:50px;}
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
						<td>{{number_format($deal->price, 2)}} @ {{$deal->commission}} %</td>
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
                	<th>Sales Agent 1</th>
					<tr>
						<td>Agent 1</td>
						<!-- <td>{{isset($deal->agent->name) ? $deal->agent->name : 'N/A'}}</td> -->
						<td>{{isset($deal->agent->name) ? explode('@',$deal->agent->name)[0] : 'N/A'}}</td>
						
                    </tr>
					<tr>
						<td>
						     @if($deal->unit_country == 1) <!-- if country Saudi Arabia -->
						    Agent 1 Amount (SAR) Commission Percent - {{$deal->agent_commission_percent.'%'}}
						    @else
						   Agent 1 Amount (AED) Commission Percent - {{$deal->agent_commission_percent.'%'}}
						    @endif
						    </td>
						<td>{{number_format($deal->agent_commission_amount, 2)}}</td>
						
                    </tr>
                    <!--updated by fazal on 31-08-23-->
                    	<tr>
						<td>  Sales Manager 1 Name</td>
						<td>{{isset($deal->leader) ? explode('@',$deal->leader->name)[0] : 'N/A'}}</td>
						
                    </tr>
					<tr>
						<td> @if($deal->unit_country == 1) <!-- if country Saudi Arabia -->
							Sales Manager 1 Amount (SAR) - {{$deal->agent_leader_commission_percent.'%'}}
						@else
							Sales Manager 1 Amount (AED) - {{$deal->agent_leader_commission_percent.'%'}}
						@endif
					</td>
						<td>{{$deal->agent_leader_commission_amount}}</td>
						
                    </tr>
                    	@if(isset($deal->salesDirector))
					<tr>
						<td>  Sales Director 1 Name</td>
						<td>{{isset($deal->salesDirector) ? explode('@',$deal->salesDirector->name)[0] : 'N/A'}}</td>
						
                    </tr>
					<tr>
						<td>
						    @if($deal->unit_country == 1) <!-- if country Saudi Arabia -->
						    Sales Director 1 Amount (SAR) -  {{$deal->sales_director_commission_percent.'%'}}
						    @else
						    Sales Director 1 Amount (AED) - {{$deal->sales_director_commission_percent.'%'}}
						    @endif
						    </td>
						<td>{{$deal->sales_director_commission_amount}}</td>
						
                    </tr>
					@endif
                    <!--end-->
                    </tbody>
                </table>
                <table class="table table-bordered">
                <tbody>
					@if(isset($deal->agentTwo))
					<th>Sales Agent 2</th>
					<tr>
						<td>Agent 2</td>
						<!-- <td>{{isset($deal->agentTwo->name) ? $deal->agentTwo->name : 'N/A'}}</td> -->
						<td>{{isset($deal->agentTwo->name) ? explode('@',$deal->agentTwo->name)[0] : 'N/A'}}</td>
						
                    </tr>
					<tr>
						<td>
						      @if($deal->unit_country == 1) <!-- if country Saudi Arabia -->
						      Agent 2 Amount (SAR) Commission Percent - {{$deal->agent2_commission_percent.'%'}}
						      @else
						      Agent 2 Amount (AED) Commission Percent - {{$deal->agent2_commission_percent.'%'}}
						      @endif
						      </td>
						<td>{{number_format($deal->agent2_commission_amount, 2)}}</td>
						
                    </tr>
					@endif
				   @if(isset($deal->leaderTwo))
					<tr>
						<td>Sales Manager 2 Name</td>
						<td>{{isset($deal->leaderTwo) ? explode('@',$deal->leaderTwo->name)[0] : 'N/A'}}</td>
						
                    </tr>
					<tr>
						<td>
						    @if($deal->unit_country == 1) <!-- if country Saudi Arabia -->
						    Sales Manager 2 Amount (SAR) - {{$deal->agent2_leader_commission_percent.'%'}}
						    @else
						    Sales Manager 2 Amount (AED) - {{$deal->agent2_leader_commission_percent.'%'}}
						    @endif
						    </td>
						<td>{{$deal->agent2_leader_commission_amount}}</td>
						
                    </tr>
					@endif
						@if(isset($deal->salesDirector2))
					<tr>
						<td>Sales Director 2 Name</td>
						<td>{{isset($deal->salesDirector2) ? explode('@',$deal->salesDirector2->name)[0] : 'N/A'}}</td>
						
                    </tr>
					<tr>
						<td>
						    @if($deal->unit_country == 1) <!-- if country Saudi Arabia -->
						    Sales Director Amount (SAR) - {{$deal->sales_director_2_commission_percent.'%'}}
						    @else
						    Sales Director Amount (AED) - {{$deal->sales_director_2_commission_percent.'%'}}
						    @endif
						    </td>
						<td>{{$deal->sales_director_2_commission_amount}}</td>
						
                    </tr>
					@endif
				</tbody>
			</table>
			 <table class="table table-bordered">
                <tbody>
                    <!-- added by fazal -->
                   @if(isset($deal->agentListing)) 
                   <th>Listing Agent</th>
                    <tr>
						<td>Listing Agent</td>
						<!-- <td>{{isset($deal->agentListing->name) ? $deal->agentListing->name : 'N/A'}}</td> -->
						<td>{{isset($deal->agentListing->name) ? explode('@',$deal->agentListing->name)[0] : 'N/A'}}</td>

						
                    </tr>
					<tr>
						<td>
						      @if($deal->unit_country == 1) <!-- if country Saudi Arabia -->
						      Listing Agent Amount (SAR) Commission Percent - {{$deal->listing_agent_commission_percent.'%'}}
						      @else
						      Listing Agent Amount (AED) Commission Percent - {{$deal->listing_agent_commission_percent.'%'}}
						      @endif
						      </td>
						<td>{{number_format($deal->listing_agent_commission_amount, 2)}}</td>
						
                    </tr>
				
				   @if(isset($deal->listing_leader_id))
					<tr>
						<td>Listing Agent Sales Manager Name</td>
						<td>{{isset($deal->leaderListing) ? explode('@',$deal->leaderListing->name)[0] : 'N/A'}}</td>
						
                    </tr>
					<tr>
						<td>
						    @if($deal->unit_country == 1) <!-- if country Saudi Arabia -->
						    Listing Agent Sales Manager Amount (SAR)
						    @else
						    Listing Agent Sales Manager Amount (AED)
						    @endif
						    </td>
						<td>{{$deal->listing_agent_leader_commission_amount}}</td>
						
                    </tr>
					@endif
						@if(isset($deal->listing_director_id))
					<tr>
						<td>Listing Agent Sales Director  Name</td>
						<td>{{isset($deal->salesDirectorlisting) ? explode('@',$deal->salesDirectorlisting->name)[0] : 'N/A'}}</td>
						
                    </tr>
					<tr>
						<td>
						    @if($deal->unit_country == 1) <!-- if country Saudi Arabia -->
						    Listing Agent Sales Director Amount (SAR)
						    @else
						     Listing Agent Sales Director Amount (AED)
						    @endif
						    </td>
						<td>{{$deal->listing_director_commission_amount}}</td>
						
                    </tr>
					@endif
					<!-- end -->

                    @endif
                  </tbody>
              </table>
               <table class="table table-bordered">
                <tbody>

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
				
                    @if($deal->unit_country == 1) <!-- if country Saudi Arabia -->
                    	<tr>
						<td>__________________</td>
                    </tr>
					<tr>
						<td>Mr. Amir Hamd</td>
                    </tr>
					<tr>
						<td>Finance Manager</td>
                    </tr>
                    	@else <!-- if country United Arab Emirates -->
                    		<tr>
						<td>Mr. Mohamad Alhaj:</td>
                    </tr>
					<tr>
						<td>(Managing Director)</td>
                    </tr>
                    
                    	<tr>
						<td class="line">__________________</td>
                    </tr>
                    	<tr>
						<td>Mr. Ahmad Adnan:</td>
                    </tr>
					<tr>
						<td>(Sales Director)</td>
                    </tr>
                    		@endif
                </tbody>
            </table>
        </main>
    </body>
</html>
