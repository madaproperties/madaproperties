<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>{{$project->name_en}}</title>
		<link href="{{ asset('public/assets/css/style.bundle.css?t='.time())}}" rel="stylesheet" type="text/css" />

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
				margin-top:20px;
                width: 100%;
                max-width: 100%;
				padding:20px;
			}
            table {
                max-width: 100%;
                border-spacing: 0;
                border-collapse: collapse;
                background-color: transparent;
				margin-bottom:15px;
				text-align:center;
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
			.logo{
				max-height:80px;
			}
        </style>

		<style>
body{
padding:0px;
margin:0px;
background:#e7e7e8;
font-size:14px;
font-family:Arial, Helvetica, sans-serif;
color:#404040;
}
 
 
h1{
font-family:Arial, Helvetica, sans-serif; 
font-size: 18px; 
padding: 7px 0px 5px 0px; 
margin: 0px; 
font-weight: bold; 
color: #002244;
}
h2{
font-family:Arial, Helvetica, sans-serif; 
font-size:18px; 
padding:5px 0px 0px 0px; 
margin:0px; 
font-weight:normal; 
color:#002244;

}

h3{
font-family:Arial, Helvetica, sans-serif; 
font-size:16px; 
padding:5px 0px 0px 0px; 
margin:0px; 
font-weight:normal; 
color:#002244;

}
.seprator
{
 
height:5px;
width:35px;
margin-top:10px;
padding: 0px;
margin: 0px;
}
 
.default-heading-color {
    border-bottom: #002244 3px solid !important;
    margin: 5px 0px;
}
.quick_summary ul{
    padding: 0px 0px 0px 0px;
    margin: 10px 0px 0px 10px;
    list-style: none;
}

.quick_summary ul li{
    border-bottom:dotted 1px #ccc;
    padding: 0px 0px 0px 0px;
}

.quick_summary ul label{
    padding: 10px 0px 0px 0px;
    margin: 0px;
}

.title2 {
    font-size: 15px;
    font-weight: bold;
    color: #002244;
    padding: 5px 0 5px 0;
    border-bottom: #CCC 2px solid;
    margin-bottom: 10px;
}

#map-canvas {
    width: 780px;
    height: 350px;
}

.features{
    list-style: none;
}

p{	
font-size:14px !important; line-height:12px; font-family: Arial, Helvetica, sans-serif !important; line-height:17px; margin-top:17px; color:#000 !important;
}

ul li{
	 
	font-size:12px !important;
	
	}
        
@media print { body { -webkit-print-color-adjust: exact; }
 a[href]:after {
 content: none !important;
  } 
  }

@font-face {
	font-family: Helvetica_lt;
	src: url(https://crm.299.com/app/webroot/fonts/HelveticaNeue-Light.ttf);
  }
@font-face {
	font-family: Helvetica_bold;
	src: url(https://crm.299.com/app/webroot/fonts/helvetica-neue-bold.ttf);
  }
  #desc_table{
      color:#000;
  }
#desc_table ul, #feat_table ul {
	  padding:0px 0px 0px 13px; 
	  }
#desc_table ul li ,#feat_table ul li { list-style-type:initial; line-height: 17px; }
#desc_table ul li, #desc_table ul p  { font-size:14px !important; }
#desc_table ul li { line-height:17px; }

@media print {
  body * {
    visibility: hidden;
  }
  #section-to-print, #section-to-print * {
    visibility: visible;
  }
  #section-to-print {
    position: absolute;
    left: 0;
    top: 0;
  }
}

.bottom-line {
  border-bottom: 1pt solid black;
}
</style>
    </head>
    <body>
        <main id="section-to-print">
            <table width="800" cellpadding="0" cellspacing="0" border="0" align="center" style="background-color:#FFFFFF">
				
				<tr>
					<td height="30"> {{ date('d/M/y, H:i A') }}

						<table cellpadding="0" cellspacing="0" border="0"  width="800">
							<tr>
								<td><img class="logo" src="{{ asset('public/imgs/logo.png') }}"/></td>
							</tr>
							<tr>
								<td align="center" style="font-size:22px;word-spacing:0px;letter-spacing: 0px; font-family: inherit;font-weight:bold; color:#000;"></td>
							</tr>
							<tr>
								<td align="center" style="font-size:13pt; font-family: Arial, Helvetica, sans-serif; color:#000;">Quatation</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td valign="top">
						<table cellpadding="0" cellspacing="0"  width="800">
							<tr>
					          <td width="14">&nbsp;</td>
								<td   valign="top" >
									<table width="80%" height="60" align="center">
									
										<tr class="bottom-line">
											<td style="text-align:left">Floor No</td>
											<td style="text-align:right;font-size:14px; font-family: Arial, Helvetica, sans-serif;  color:black;" valign="top">{{$project->floor_no}}</td>
										</tr>
                                        <tr class="bottom-line">
											<td style="text-align:left">Type</td>
											<td style="text-align:right;font-size:14px; font-family: Arial, Helvetica, sans-serif;  color:black;" valign="top">{{$project->property_type}}</td>

										</tr>
										<tr class="bottom-line">
											<td style="text-align:left">Unit No</td>
											<td style="text-align:right;font-size:14px; font-family: Arial, Helvetica, sans-serif;  color:black;" valign="top">{{$project->unit_name}}</td>
										</tr>
										<tr class="bottom-line">
											<td style="text-align:left">Total Area (sqft)</td>
											<td style="text-align:right;font-size:14px; font-family: Arial, Helvetica, sans-serif;  color:black;" valign="top">{{$project->area_bua}}</td>

										</tr>
										<tr class="bottom-line">
											<td style="text-align:left">Price in SAR</td>
											<td style="text-align:right;font-size:14px; font-family: Arial, Helvetica, sans-serif;  color:black;" valign="top">{{$project->price}}</td>
										</tr>
                                  </table>
								</td>
				          <br>
				
					<table style="border:1px solid black; margin-left: 200px;">
						<th style="border:1px solid black;width: 200px; background-color: grey;" >Mada Fee 2.5% (+15% VAT)</th>
						
						<th style="border:1px solid black;width: 200px;background-color: grey;">{{$project->commission}}</th>
						<tr>
							<td style="border:1px solid black;" >Account name </td>
							<td style="border:1px solid black;">Mada Real Estate</td>
						</tr>
						<tr>
							<td>IBAN </td>
							<td style="border:1px solid black;width: 250px;">IBANSA9060100033795022281001</td>
						</tr>
						<tr style="border:1px solid black;">
							<td>Bank Name	  </td>
							<td style="border:1px solid black;">Aljazira</td>
						</tr>	
					</table>
					@if($project->developer)
					<br>
					<table style="border:1px solid black; margin-left: 200px;">
						<th style="border:1px solid black;width: 200px; background-color: grey;" >Down Payment 20%</th>
						
						<th style="border:1px solid black;width: 200px;background-color: grey;">{{$project->down_payment}}</th>
						<tr>
							<td style="border:1px solid black;" >Account name </td>
							<td style="border:1px solid black;">{{$project->developer->name}}</td>
						</tr>
						<tr>
							<td>IBAN </td>
							<td style="border:1px solid black;width: 250px;">{{$project->developer->iban}}</td>
						</tr>
						<tr style="border:1px solid black;">
							<td>Bank Name</td>
							<td style="border:1px solid black;">{{$project->developer->bank_name}}</td>
						</tr>	
					</table>
					@endif
					@if($project->floor_plan)
																				
					<table>
						<tr>
							<td><img src="{{env('APP_URL').'/public/uploads/projectData/'.$project->floor_plan}}" ></td>
						</tr>	
					</table>
					@endif
				</td>
				</tr>
				
				
             
             				

			</table>
        </main>
		<div class="content" style="min-height: auto;">
			<div class="content-wrapper p-1">
			<a href="mailto:?subject={{$project->title}}&amp;body=Check out this property {{URL::to('/project-data/brochure/'.$project->id)}}" class="btn btn-info white">Send in email</a>

			<a href="javascript:void(0)" onclick="window.print()" target="_blank" class="btn btn-success white">Create PDF</a>
			<a href="whatsapp://send?text={{URL::to('/project-data/brochure/'.$project->id)}}" data-action="share/whatsapp/share" class="btn btn-danger white">Share via Whatsapp</a>
			</div>
		</div>
    </body>
</html>