<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>{{$project->project->name}} -  {{$project->unit_name}}</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
				margin:auto;
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
.mada_table tr th{font-size:16px;}

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
.mada_table tr td{padding:5px;}
.mada_table tr{ border-bottom: 1px solid #9FCE31;}
.mada_table{margin-top:70px;}
.terms_condition{margin-top:100px;margin-bottom: 100px;}
	span.date{
		float: left;
    padding: 15px;
	}
	table.about_company{margin-top:100px;}
	.about_company i.fa{color: #9FCE31;
    font-size: 14px;
    padding-right: 10px;}
	img.jood_logo{max-height: 200px;margin-top:30px;}
td.center span {
    font-weight: bold;
    padding-left: 45px;
}
	.floor_plan img{margin-top:50px;width:90%;margin-bottom:50px;}
</style>
    </head>
    <body>
        <main id="section-to-print">
		<table width="800" cellpadding="0" cellspacing="0" border="0" align="center" style="background-color:#FFFFFF">
			<tr>
		<td height="30"> <span class="date">{{date("d/M/y", strtotime($date))}},{{ $time}} </span>
		</td></tr>
				<tr>
					<!--<td height="30"> <span class="date">{{ now()->format('Y-m-d') }}</span> </td>-->
					<td>
				
					
						<table cellpadding="0" cellspacing="0" border="0"  width="800">
							<tr>
							    
									 <!-- updated by fazal 29-.3--> 
								<td><img class="jood_logo" src="{{ asset('public/uploads/projectData/'.$project->project->project_logo) }}"/></td>
                                  								<!--end-->
                                  								
							</tr>
							<tr>
								<td align="center" style="font-size:22px;word-spacing:0px;letter-spacing: 0px; font-family: inherit;font-weight:bold; color:#000;"></td>
							</tr>
							<tr>
								<td align="center" style="font-size: 16pt;font-family: Arial, Helvetica, sans-serif;color: #9FCE31;text-decoration: underline;padding-top: 50px;font-weight: bold;text-decoration-color: #9FCE31;text-transform: uppercase;">Sales Offer</td>
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
									<table width="80%" height="60" align="center" class="mada_table">
									<tr class="bottom-line">
											<td style="text-align:left">Project</td>
											<td class="center" valign="top"><span>{{$project->project->name}}</span></td>
											<td style="text-align:right">المشروع</td>
										</tr>
									
										<tr class="bottom-line">
											<td style="text-align:left">Floor No</td>
											<td class="center" valign="top"><span>{{$project->floor_no}}</span></td>
											<td style="text-align:right">رقم الدور</td>
										</tr>
                                        <tr class="bottom-line">
											<td style="text-align:left">Type</td>
											<td class="center" valign="top"><span>{{$project->property_type}}</span></td>
											<td style="text-align:right">الفئة</td>
										</tr>
										<tr class="bottom-line">
											<td style="text-align:left">Unit No</td>
											<td class="center" style="" valign="top"><span>{{$project->unit_name}}</span></td>
											<td style="text-align:right">رقم الوحدة</td>
										</tr>
										<tr class="bottom-line">
											<td style="text-align:left">Total Area (sqm)</td>
											<td class="center" valign="top"><span>{{$project->area_bua}}</span></td>
											<td style="text-align:right">المساحة الإجمالية (بالمتر المربع)</td>

										</tr>
										<tr class="bottom-line">
											<td style="text-align:left">Price in SAR</td>
											<td class="center" valign="top"><span>{{number_format(intval($project->price), 2)}}</span></td>
											<td style="text-align:right">السعر بالريال السعودي</td>
										</tr>
                                  </table>
								</td>	
							</tr>
						</table>
					</td>
					<tr>
						<td   valign="top" >
				
    					<table class="mada_table">
    						<th style="width: 200px; background-color: #9FCE31;color:#000;font-weight:bold;padding: 5px;" >Mada Fee</th>
    						<th style="color:#000;font-weight:bold;width: 200px;background-color: #9FCE31;padding: 5px;">{{$project->commission}}*</th>
    						<th style="color:#000;font-weight:bold;width: 200px;background-color: #9FCE31;padding: 5px;">عمولة مدى</th>
    						<tr>
    							<td>Account name </td>
    							<td>Company Mada Real Estate</td>
    							<td>اسم الحساب</td>
    						</tr>
    						<tr>
    							<td>IBAN </td>
    							@if(isset($project->project) && $project->project->name=='Judya')
    							<td style="width: 250px;">SA6410000026100000337206</td>
    						    @else
    							<td style="width: 250px;">SA9060100033795022281001</td>
    							@endif
    							
    							<td>رقم الايبان </td>
    						</tr>
    						<tr>
    							<td>Bank Name</td>
    							@if(isset($project->project) && $project->project->name=='Judya')
    						<td>Al Ahli Bank</td>
    							@elseif(isset($project->project) && $project->project->name=='Royal Residence')
    						<td>AlJazira Bank</td>
    							@else
    							<td>بنك الجزيرة</td>
    							@endif
    						 <td>اسم البنك</td>
    						</tr>	
    					</table>
    					</td>
    				</tr>
					@if($project->developer)
					<tr>
						<td   valign="top" >
        					<table class="mada_table">
        					
        						<th style="color:#000;font-weight:bold;width: 200px; background-color: #9FCE31;padding: 5px;" >Down Payment {{$project->down_payment_percentage}}%</th>
        						<th style="color:#000;font-weight:bold;width: 200px;background-color: #9FCE31;padding: 5px;">{{number_format((str_replace(",","",$project->down_payment)))}}*</th>
        						<th style="color:#000;font-weight:bold;width: 200px;background-color: #9FCE31;direction:rtl;padding: 5px;">دفعة أولى  {{$project->down_payment_percentage}}%</th
        						
        						
        						>
        						<tr>
        							<td>Account name </td>
        							<td>{{$project->developer->name}}</td>
        							<td>اسم الحساب</td>
        						</tr>
        						<tr>
        							<td>IBAN </td>
        							<td style="width: 250px;">{{$project->developer->iban}}</td>
        							<td>رقم الايبان</td>
        						</tr>
        						<tr>
        							<td>Bank Name</td>
        							<td>{{$project->developer->bank_name}}</td>
        							<td>اسم البنك</td>
        						</tr>	
        					</table>
        				</td>
        			</tr>
					<tr>
						<td   valign="top" >
        					<table class="terms_condition">
        					<tr>
        					<td>*This Sales Offer is valid only for 3 days. Price and payment plan are subject to change without prior notice.</td>
        					</tr>
        					</table>
        				</td>
        			</tr>
					
				@endif
					@if($project->floor_plan)
					<tr>
						<td valign="top" >
        					<table class="floor_plan">
            					<tr>
            						<td align="center" style="font-size: 16pt;font-family: Arial, Helvetica, sans-serif;color: #9FCE31;text-decoration: underline;font-weight: bold;text-decoration-color: #9FCE31;text-transform: uppercase;">Floor Plan</td>
            					</tr>
        						<tr>
        							<td><img src="{{env('APP_URL').'/public/uploads/projectData/'.$project->floor_plan}}" ></td>
        						</tr>	
        					</table>
        					<table class="about_company" width="80%">
        						<tr>
            						<td>
                						<table>
                							<tr>
                							<td><img class="logo" src="{{ asset('public/imgs/logo.png') }}"/></td>
                							</tr>
                						</table>
            						</td>
        					    </tr>
            					<tr>
                					<td>
                					<table style="margin-top:20px;width:100%;">
                						
                							<tr>
                							<td style="font-size: 16px;color: #9FCE31;font-weight: bold;"><img src="{{ asset('public/imgs/KSAflag.png') }}" width="50" style="  padding-right: 10px;"/>Riyadh</td>
                							<td style="font-size: 16px;color: #9FCE31;font-weight: bold;"><img src="{{ asset('public/imgs/UAEflag.png') }}" width="50" style="  padding-right: 10px;"/>Dubai </td>
                							
                							
                						</tr>
                						<tr>
                						
                							<td>Prince Muhammad Ibn Salman St. Al Aqiq, Office 15, </br>2nd floor, Riyadh 13515</td>
                							<td>PO Box: 112037, Office 1106, Opal Tower, </br> Business Bay, Dubai</td>
                							
                						</tr>	
                						<tr>
                						<td> +966 55 008 8601 | +966 11 4455199</td>
                						<td>+971 50 377 0780 | +971 424 34 692</td>
                						</tr>
                						<tr>
                						<td>
                						<a href="https://www.facebook.com/madaproperties" target="_blank"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
                						<a href="https://www.instagram.com/madaproperties" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                						<a href="https://twitter.com/MadaProperties" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                						<a href="https://www.youtube.com/channel/UCeFvODTAaNG-pIiqSTsT39w" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                						<a href="https://www.linkedin.com/company/madaproperties" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                						</td>
                						<td>
                						<a href="https://www.facebook.com/madapropertiesuae" target="_blank"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
                						<a href="https://www.instagram.com/madaproperties.uae/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                						<a href="https://twitter.com/MadaPropUAE" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                						<a href="https://www.youtube.com/channel/UCQWJrg12NV5GxxsBD9StC8Q" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                						<a href="https://www.linkedin.com/company/mada-properties-uae" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                						</td>
                
                						</td>
                						</tr>
                					</table>
        					    </td>
        					</tr>
        				</td>
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