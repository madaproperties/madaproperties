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
			@page {
				size: auto;
				margin: 0mm;
			}
			main{
				margin-top:200px;
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
                padding: 1px;
				max-width:20px;
				font-size:13px;
				padding-left: 5px;
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
						<td style="text-align:center;border:0px;text-decoration: underline;padding-bottom: 35px;" colspan="8"><b>TAX INVOICE</b></td>
                    </tr>
					<tr>
						<td style="text-align:left;border:0px;" colspan="8">Invoice Date : {{$deal->invoice_date}}</td>
                    </tr>
					<tr>
						<td style="text-align:left;border:0px;padding-bottom: 15px;" colspan="8">Invoice Number : {{$deal->invoice_number}}</td>
                    </tr>
					<tr>
						<td style="text-align:left;border:0px;" colspan="5"><b>Mada Properties</b></td>
						<td colspan="3" style="border:0px;"><b>Invoiced To :</b></td>
                    </tr>
					<tr>
						<td style="text-align:left;border:0px;" colspan="5">TRN : 100506324100003</td>
						<td colspan="3" style="border:0px;">{{$deal->developer->name}}</td>
                    </tr>
					<tr>
						<td style="text-align:left;border:0px;" colspan="5">Telephone : +97142434692</td>
						<td colspan="3" style="border:0px;">{{$deal->developer->company_address}}</td>
                    </tr>
					<tr>
						<td style="text-align:left;border:0px;" colspan="5">Email: admin-dxb@madaproperties.com</td>
						<td colspan="3" style="border:0px;">TRN : {{isset($deal->developer->trn) ? $deal->developer->trn : ''}}</td>
                    </tr>
					<tr>
						<td style="border:0px;padding-bottom: 30px;" colspan="8">Website : www.madaproperties.com</td>
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
						<td colspan="6" style="border:0px;"></td>
						<td><b>Total:</b></td>
						<td><b>{{number_format($deal->commission_amount+$deal->vat_amount)}}</b></td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered" style="width: 50%;">
                <tbody>
					<tr>
						<td colspan="2" style="text-align:left"><b>Bank Details</b></td>
						
                    </tr>
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
						<td width="200px">AE140500000000019004835</td>
                    </tr>
					<tr>
						<td><b>Account Type</b></td>
						<td>UAE</td>
                    </tr>
                </tbody>
            </table>
            <table style="text-align:right;margin-top:80px;border:0px;">
                <tbody>
					<tr>
						<td>_____________________________</td>
                    </tr>
                </tbody>
            </table>



        </main>
    </body>
</html>