<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Invoice Number</title>
        <style>
            * {
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
            }
			main{
                width: 100%;
                max-width: 100%;
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
                border: 1px solid #ddd;
                padding: 6px;
				max-width:20px;
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
			</div>		
            <table class="table table-bordered">
                <tbody>
					<tr>
						<td style="text-align:center;" colspan="8">TAX INVOICE</td>
                    </tr>
					<tr>
						<td style="text-align:right;border:0px;" colspan="8">Invoice Date : {{$deal->invoice_date}}</td>
                    </tr>
					<tr>
						<td style="text-align:right;border:0px;" colspan="8">Invoice Number : {{$deal->invoice_number}}</td>
                    </tr>
					<tr>
						<td style="text-align:left;border:0px;" colspan="5"><b>Mada Properties</b></td>
						<td colspan="3"><b>Invoiced To :</b></td>
                    </tr>
					<tr>
						<td style="text-align:left;border:0px;" colspan="5">TRN : 100506324100003</td>
						<td colspan="3">{{$deal->developer->name}}</td>
                    </tr>
					<tr>
						<td style="text-align:left;border:0px;" colspan="5">Telephone : +97142434692</td>
						<td colspan="3">{{$deal->developer->company_address}}</td>
                    </tr>
					<tr>
						<td style="text-align:left;border:0px;" colspan="5">Email: admin-dxb@madaproperties.com</td>
						<td colspan="3">TRN : {{isset($deal->developer->trn) ? $deal->developer->trn : ''}}</td>
                    </tr>
					<tr>
						<td style="border:0px;" colspan="8">Website : www.madaproperties.com</td>
                    </tr>
					<tr>
						<td><b>Unit Details</b></td>
						<td><b>Client Name</b></td>
						<td><b>Selling Price</b></td>
						<td><b>Commission %</b></td>
						<td><b>Commission Amt. AED</b></td>
						<td><b>VAT %</b></td>
						<td><b>VAT Amt. AED</b></td>
						<td><b>Commission Amt. Incl. VAT</b></td>
                    </tr>
					<tr>
						<td>{{$deal->project->name .' '.$deal->unit_name}}</td>
						<td>{{$deal->client_name}}</td>
						<td>{{number_format($deal->price)}}</td>
						<td>{{$deal->commission}} %</td>
						<td>{{number_format($deal->commission_amount)}}</td>
						<td>{{$deal->vat}} %</td>
						<td>{{number_format($deal->vat_amount)}}</td>
						<td>{{number_format($deal->commission_amount+$deal->vat_amount)}}</td>
                    </tr>
					<tr>
						<td colspan="7"><b>Total:</b></td>
						<td>{{number_format($deal->commission_amount)}}</td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered">
                <tbody>
					<tr>
						<td colspan="2" style="text-align:center"><b>Bank Details</b></td>
						<td><b>Invoice Summary</b></td>
						<td><b>Amount</b></td>
                    </tr>
					<tr>
						<td><b>Account Number</b></td>
						<td>19004835</td>
						<td><b>Total Commission excluding VAT</b></td>
						<td>{{number_format($deal->commission_amount)}}</td>
                    </tr>
					<tr>
						<td><b>Bank Name</b></td>
						<td>ADIB</td>
						<td><b>VAT Amount</b></td>
						<td>{{number_format($deal->vat_amount)}}</td>
                    </tr>
					<tr>
						<td><b>Swift Code</b></td>
						<td>ABDIAEAD</td>
						<td><b>Current Due (AED) INCL. VAT</b></td>
						<td></td>
                    </tr>
					<tr>
						<td><b>IBAN #</b></td>
						<td width="200px">AE140500000000019004835</td>
						<td rowspan="2"><b>Total Commission Including VAT</b></td>
						<td rowspan="2">{{number_format($deal->vat_amount + $deal->commission_amount)}}</td>
                    </tr>
					<tr>
						<td><b>Account Type</b></td>
						<td>UAE</td>
                    </tr>
                </tbody>
            </table>
            <table style="text-align:right;margin-top:50px;border:0px;">
                <tbody>
					<tr>
						<td>_____________________________</td>
                    </tr>
                </tbody>
            </table>


            <table style="text-align:center;margin-top:50px;">
                <tbody>
					<tr>
						<td>Office 1106, Opal Tower, Business Bay, Dubai, United Arab Emirates</td>
                    </tr>
					<tr>
						<td>C.R. 880719 | RERA no. 23609 | T +971 4 243 4692</td>
                    </tr>
					<tr>
						<td>info@madaproperties.com | www.madaproperties.com</td>
                    </tr>
                </tbody>
            </table>

        </main>
    </body>
</html>