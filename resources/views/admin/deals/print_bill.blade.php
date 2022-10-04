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
				margin: 0mm;
			}
			main{
				margin-top:200px;
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
                padding: 1px;
				max-width:20px;
				font-size:12px;
				padding-left: 5px;
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
				
			</div>		
            <table class="table table-bordered">
                <tbody>
					<tr>
						<td style="text-align:center;border:0px;text-decoration: underline;padding-bottom: 35px;padding-left:100px;" colspan="8"><b>TAX INVOICE</b></td>
                    </tr>
					<tr>
						<td style="text-align:left;border:0px;" colspan="8">Invoice Date : {{$deal->invoice_date}}</td>
                    </tr>
					<tr>
						<td style="text-align:left;border:0px;padding-bottom: 15px;" colspan="8">Invoice Number : {{$deal->invoice_number}}</td>
                    </tr>
					@if($deal->unit_country == 1) <!-- if country Saudi Arabia -->
					<tr>
						<td style="text-align:left;border:0px;" colspan="5"><b>Mada Properties</b></td>
						<td colspan="3" style="border:0px;text-align:left;"><b>Invoiced To :</b></td>
                    </tr>
					<tr>
						<td style="text-align:left;border:0px;" colspan="5">TRN : 311064002300003</td>
						<td colspan="3" style="border:0px;text-align:left;">{{isset($deal->developer->name) ? $deal->developer->name : ''}}</td>
                    </tr>
					<tr>
						<td style="text-align:left;border:0px;" colspan="5">Telephone : +966 11 4455199</td>
						<td colspan="3" style="border:0px;text-align:left;">{{isset($deal->developer->company_address) ? $deal->developer->company_address : ''}}</td>
                    </tr>
					<tr>
						<td style="text-align:left;border:0px;padding-bottom:30px;" colspan="5">Email: admin-ksa@madaproperties.com</td>
						<td colspan="3" style="border:0px;text-align:left;padding-bottom:30px;">TRN : {{isset($deal->developer->trn) ? $deal->developer->trn : ''}}</td>
                    </tr>
					@else <!-- if country United Arab Emirates -->
					<tr>
						<td style="text-align:left;border:0px;" colspan="5"><b>Mada Properties LLC</b></td>
						<td colspan="3" style="border:0px;text-align:left;"><b>Invoiced To :</b></td>
                    </tr>
					<tr>
						<td style="text-align:left;border:0px;" colspan="5">TRN : 100506324100003</td>
						<td colspan="3" style="border:0px;text-align:left;">{{isset($deal->developer->name) ? $deal->developer->name : ''}}</td>
                    </tr>
					<tr>
						<td style="text-align:left;border:0px;" colspan="5">Telephone : +97142434692</td>
						<td colspan="3" style="border:0px;text-align:left;">{{isset($deal->developer->company_address) ?$deal->developer->company_address : ''}}</td>
                    </tr>
					<tr>
						<td style="text-align:left;border:0px;padding-bottom:30px;" colspan="5">Email: admin-dxb@madaproperties.com</td>
						<td colspan="3" style="border:0px;text-align:left;padding-bottom:30px;">TRN : {{isset($deal->developer->trn) ? $deal->developer->trn : ''}}</td>
                    </tr>
					@endif
					
					<tr>
						<td style="text-align:center;"><b>Project</b></td>
						<td style="text-align:center;"><b>Unit</br> Details</b></td>
						<td style="text-align:center;"><b>Client</br> Name</b></td>
						<td style="text-align:center;"><b>Selling</br> Price</b></td>
						<td style="text-align:center;"><b>Commission</br> %</b></td>
						<td style="text-align:center;">
						    	@if($deal->unit_country == 1) <!-- if country Saudi Arabia -->
						    <b>Commission</br> Amt. (SAR)</b>
						    	@else
						    	 <b>Commission</br> Amt. (AED)</b>
						    	 @endif
						    </td>
						<td style="text-align:center;"><b>VAT %</b></td>
						<td style="text-align:center;">
						    	@if($deal->unit_country == 1) <!-- if country Saudi Arabia -->
						    <b>VAT</br> Amt. (SAR)</b>
						    	@else
						    	<b>VAT</br> Amt. (AED)</b>
						    	 @endif
						    </td>
						<td style="text-align:center;">
						    	@if($deal->unit_country == 1) <!-- if country Saudi Arabia -->
						    <b>Commission</br>Amt Incl VAT (SAR)</b>
						    @else
						    <b>Commission</br>Amt Incl VAT (AED)</b>
						     @endif
						    </td>
                    </tr>
					<tr>
						<td style="text-align:center;padding:7px;">{{$deal->project->project_name}}</td>
						<td style="text-align:center;padding:7px;word-wrap: break-word;">{{$deal->unit_name}}</td>
						<td style="text-align:center;padding:7px;">{{$deal->client_name}}</td>
						<td style="text-align:center;padding:7px;">{{number_format($deal->price, 2)}}</td>
						<td style="text-align:center;padding:7px;">{{$deal->commission}} %</td>
						<td style="text-align:center;padding:7px;">{{number_format($deal->commission_amount, 2)}}</td>
						<td style="text-align:center;padding:7px;">{{$deal->vat}} %</td>
						<td style="text-align:center;padding:7px;">{{number_format($deal->vat_amount, 2)}}</td>
						<td style="text-align:center;padding:7px;">{{number_format(($deal->commission_amount+$deal->vat_amount), 2)}}</td>
                    </tr>
					<tr>
						<td colspan="7" style="border:0px;"></td>
						<td style="text-align:center;"><b>Total:</b></td>
						<td style="text-align:center;"><b>{{number_format(($deal->commission_amount+$deal->vat_amount),2)}}</b></td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered" style="width: 50%;">
                <tbody>
					<tr>
						<td colspan="2" style="text-align:left"><b>Bank Details</b></td>
						
                    </tr>
					@if($deal->unit_country == 1) <!-- if country Saudi Arabia -->
					<tr>
						<td><b>Account Number</b></td>
						<td>0337-95022281-001</td>
                    </tr>
					<tr>
						<td><b>Bank Name</b></td>
						<td>Bank Aljazira</td>
                    </tr>
					<tr>
						<td><b>Swift Code</b></td>
						<td>BJAZSAJE</td>
                    </tr>
					<tr>
						<td><b>IBAN #</b></td>
						<td>SA9060100033795022281001</td>
                    </tr>
					<tr>
						<td><b>Account Type</b></td>
						<td>Saudi Arabia</td>
                    </tr>
					@else
					<tr>
						<td><b>Account Number</b></td>
						<td>19004835</td>
                    </tr>
					<tr>
						<td><b>Bank Name</b></td>
						<td>ADIB</td>
                    </tr>
					<tr>
						<td><b>Swift Code</b></td>
						<td>ABDIAEAD</td>
                    </tr>
					<tr>
						<td><b>IBAN #</b></td>
						<td>AE140500000000019004835</td>
                    </tr>
					<tr>
						<td><b>Account Type</b></td>
						<td>UAE</td>
                    </tr>
					@endif
                </tbody>
            </table>
            <table style="text-align:right;margin-top:200px;border:0px;">
                <tbody>
					<tr>
						<td>_____________________________</td>
                    </tr>
                </tbody>
            </table>



        </main>
    </body>
</html>