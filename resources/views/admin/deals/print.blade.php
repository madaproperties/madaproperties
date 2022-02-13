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
				<h3>Commission Report</h3>
			</div>
            <table class="table table-bordered">
                <tbody>
					<tr>
						<td style="border:0px"></td>
						<td style="border:0px;text-align:right">Invoice Number:</td>
						<td style="border:0px">{{$deal->invoice_number}}</td>
                    </tr>
					<tr>
						<td>Developer:</td>
						<td colspan="2">{{$deal->developer->name}}</td>
                    </tr>
					<tr>
						<td>Project Name:</td>
						<td colspan="2">{{$deal->project->name}}</td>
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
						<td>Deal Type:</td>
						<td>{{$deal->commission_type}}</td>
						<td>Source: {{'0'}}</td>
                    </tr>
					<tr>
						<td>Price:</td>
						<td colspan="2">{{number_format($deal->price)}}</td>
                    </tr>
					<tr>
						<td>Period:</td>
						<td>{{'0'}}</td>
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
						<td>Company:</td>
						<td colspan="2">{{$deal->developer->company_address}}</td>
                    </tr>
					<tr>
						<td>Property Consultant:</td>
						<td colspan="2">{{$deal->agent ? substr($deal->agent->email, 0, strpos($deal->agent->email, "@")) : 'N/A'}}</td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered">
                <tbody>
					<tr>
						<td colspan="2" class="center">Commission</td>
						<td>Total Commission (Inc. VAT)</td>
                    </tr>
					<tr>
						<td>Total Commission</td>
						<td>{{number_format($deal->commission_amount)}}</td>
						<td></td>
                    </tr>
					<tr>
						<td>{{$deal->vat}}% VAT</td>
						<td>{{number_format($deal->vat_amount)}}</td>
						<td>{{number_format($deal->commission_amount+$deal->vat_amount)}}</td>
                    </tr>
					<tr>
						<td>Company</td>
						<td>{{number_format($deal->mada_commission)}}</td>
						<td>{{'0'}}</td>
                    </tr>
					<tr>
						<td>Property Consultant: {{$deal->agent ? substr($deal->agent->email, 0, strpos($deal->agent->email, "@")) : 'N/A'}}</td>
						<td></td>
						<td></td>
                    </tr>
					<tr>
						<td>SM Commission</td>
						<td>{{number_format($deal->agent_commission_amount)}}</td>
						<td>{{'0'}}</td>
                    </tr>
					<tr>
						<td>Third Party Commission</td>
						<td>{{number_format($deal->third_party_amount)}}</td>
						<td>{{'0'}}</td>
                    </tr>
					<tr>
						<td>Total Commission</td>
						<td colspan="2">{{number_format($deal->commission_amount)}}</td>
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
					<tr>
						<td>Mr. Mohamad Alhaj:</td>
                    </tr>
					<tr>
						<td>(Managing Director)</td>
                    </tr>
                </tbody>
            </table>
        </main>
    </body>
</html>