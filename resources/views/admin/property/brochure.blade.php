<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>{{$property->title}}</title>
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
</style>
    </head>
    <body>
        <main id="section-to-print">
            <table width="800" cellpadding="0" cellspacing="0" border="0" align="center" style="background-color:#FFFFFF">
				<tr>
					<td height="40"></td>
				</tr>
				<tr>
					<td height="30">
						<table cellpadding="0" cellspacing="0" border="0"  width="800">
							<tr>
								<td><img class="logo" src="{{ asset('public/imgs/logo.png') }}"/></td>
							</tr>
							<tr>
								<td align="center" style="font-size:22px;word-spacing:0px;letter-spacing: 0px; font-family: inherit;font-weight:bold; color:#000;">{{$property->title}}</td>
							</tr>
							<tr>
								<td align="center" style="font-size:13pt; font-family: Arial, Helvetica, sans-serif; font-weight:bold; color:#000;">{{$property->sale_rent == 1 ? 'For Sale' : 'For Rent'}} | {{$property->area_name}}</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td valign="top">
						<table cellpadding="0" cellspacing="0" border="0"  width="800">
							<tr>
								<td width="7">&nbsp;</td>
	  							@if(isset($property->images[0]->temp_image))
								<td  width="530" height="339" valign="top">
									<!-- <img src="{{asset('public/uploads/property/'.$property->id.'/images/'.$property->images[0]->images_link) }}"  width="530" height="340"/> -->
									<img src="{{url($property->images[0]->temp_image) }}"  width="530" height="340"/> 
									
								</td>
								@endif
				
								<td width="7">&nbsp;</td>
								<td  bgcolor="#444" valign="top"  height="260" style="background-color:#444 !important; color: #FFF;">
									<table width="254" height="60" border="0" cellpadding="0" cellspacing="0" style="line-height:17px;text-align:left;" id="feat_table">
										<tr>
											<td width="47" height="47">&nbsp;</td>
											<td width="182" >&nbsp;</td>
											<td width="47">&nbsp;</td>
										</tr>
										<tr>
											<td width="47">&nbsp;</td>
											<td  style="font-size:18px; font-family: Arial, Helvetica, sans-serif; font-weight:bold; color:#FFF;" valign="top">Highlights</td>
											<td width="47">&nbsp;</td>
										</tr>
										<tr>
											<td width="47">&nbsp;</td>
											<td >&nbsp;</td>
											<td width="47">&nbsp;</td>
										</tr>
										<tr>
											<td width="47">&nbsp;</td>
											<td>
											<ul>
											@if($property->project_name)
												<li style="font-size:12px !important; font-family: Arial, Helvetica, sans-serif; color:#FFF; padding-left:2px;">
												{{$property->project_name}}</li>
											@endif

											<li style="font-size:12px !important; font-family: Arial, Helvetica, sans-serif; color:#FFF; padding-left:2px;">
											{{$property->bedrooms }} Bedrooms</li>

											<li style="font-size:12px !important; font-family: Arial, Helvetica, sans-serif; color:#FFF; padding-left:2px;"> 
											{{$property->baths }} Baths</li>


											<li style="font-size:12px !important; font-family: Arial, Helvetica, sans-serif; color:#FFF; padding-left:2px;"> BUA: {{$property->buildup_area }} {{$property->measure_unit == 1 ? 'Sqft' : 'Sqmeter' }} </li>
											</ul>
											<br />
											</td>
											<td width="47">&nbsp;</td>
										</tr>

										<tr>
											<td width="47">&nbsp;</td>
											<td style="font-size:18px; font-family: Arial, Helvetica, sans-serif; font-weight:bold; color:#FFF;" valign="top">
											AED {{number_format($property->price)}}</td>
											<td width="47">&nbsp;</td>
										</tr>
									</table>
								</td>
								<td width="7">&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr>
					<td>
						<table cellpadding="0" cellspacing="0" border="0"  width="800">
						@php($i=0)
						@if(count($property->images) > 0)
							@foreach($property->images->take(6) as $rs)
								@if(!empty($rs->temp_image))
									@php($i++)
									@if($i==1)
									<tr>
									@endif
										<!-- <td width="262"><img src="{{asset('public/uploads/property/'.$property->id.'/images/'.$rs->images_link) }}" width="262" height="169"/></td>-->
										<td width="4">&nbsp;</td>
										<td><img src="{{url($rs->temp_image) }}" width="250" height="169"/></td>
										<td width="4">&nbsp;</td>

									@if($i==3)
									@php($i=0)
									</tr>
									<tr>
										<td height="2">&nbsp;</td>
									</tr>
									@endif
								@endif
							@endforeach
						@endif
						</table>
					</td>
				</tr>

				<tr>
					<td>
						<table cellpadding="0" cellspacing="0" border="0"  width="800" style="text-align: left;">
							<tr>
								<td width="7">&nbsp;</td>
								<td>{!! $property->description !!}</td>
								<td width="7">&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
        </main>
		<div class="content" style="min-height: auto;">
			<div class="content-wrapper p-1">
			<a href="mailto:?subject={{$property->title}}&amp;body=Check out this property {{ route('property.brochure',$property->id) }}" class="btn btn-info white">Send in email</a>

			<a href="javascript:void(0)" onclick="window.print()" target="_blank" class="btn btn-success white">Create PDF</a>
			<a href="whatsapp://send?text={{ route('property.brochure',$property->id) }}" data-action="share/whatsapp/share" class="btn btn-danger white">Share via Whatsapp</a>
			</div>
		</div>
    </body>
</html>