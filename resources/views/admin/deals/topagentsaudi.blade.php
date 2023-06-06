
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<!--[if gt IE 8]>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />    <![endif]--> 
<title>Mada Board</title>
<link href="css/stylesheets.css" rel="stylesheet" type="text/css" />
<!--[if lt IE 8]>
<link href="css/ie7.css" rel="stylesheet" type="text/css" />
<![endif]-->
 
<link href="css/bxslider.css"  rel="stylesheet" type="text/css"  />
<script type='text/javascript' src='js/plugins/jquery/jquery-1.10.2.min.js'></script>
<script type='text/javascript' src='js/plugins/bootstrap.min.js'></script>
<script type="text/javascript" src="js/bxslider.js"></script>
<style>
body{ font-size:14px !important;}
.bx-wrapper{border:none !important;}
.nc {
    border-radius: 50%;
    behavior: url(PIE.htc); /* remove if you don't care about IE8 */
    width: 13px;
    height: 13px;
    padding: 4px;
    background: #fff;
    border: 2px solid #9FCE31;
    color: #000;
    text-align: center;
    font: 11px Arial, sans-serif;
	font-weight:bold;
	margin-right:5px;
}
.nc1 {
    border-radius: 50%;
    behavior: url(PIE.htc); /* remove if you don't care about IE8 */
    width: 24px;
    height: 24px;
    padding: 8px;
    background: #fff;
    border: 2px solid #9FCE31;
    color: #000;
    text-align: center;
    font: 15px Arial, sans-serif;
	font-weight:bold;
	margin-right:0px;
}
.table-bordered th, .table-bordered td{border-left:none;}
[class*="block"] .table tr th, [class*="block"] .table tr td {border-right:none}
[class*="block"] .table tr th, [class*="block"] .table tr td{border-right:none;}
[class*="block"] .table tr td {background:none;}
/* width */
::-webkit-scrollbar {
    width: 10px;
}
/* Track */
::-webkit-scrollbar-track {
    background: gray; 
}
/* Handle */
::-webkit-scrollbar-thumb {
    background: #FFF; 
}
/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: #555; 
}
.table th, .table td{
	border-top:none;
	}
 
	
	.right_table1 table tr td, .right_table2 table tr td, .left_table table tr td {
		color:#000;
		}
		.left_table{
			overflow:hidden;
			}

.top_blue{text-align: center; padding: 50px 0px 50px 30px; font-size: 52px; color: #FFF; letter-spacing: 8px; background: #9FCE31;}
.myyellow{
background:#9FCE31 !important;
font-size:14px;
font-weight:bold;
color:#FFF;
padding-x:0rem !important;
}
.mymywhite{
background:#FFF !important;
	}
.title2 {
	font-size:32px; text-align:left; margin:20px 0px 10px 0px; letter-spacing:5px; color:#000;
}
.lb_name{
font-size:18px;
font-weight:bold;
}
.lb_desig{
	font-size:14px;
	padding:5px 0px;
}
.lb_target{
	font-size:14px;
	font-weight:bold;
}
.addstyle tr td { padding:8px 2px 8px 8px;  border-bottom: 1px solid #9FCE31;  font-size:13px; border-bottom:1px solid #9FCE31; }
/*table tr td, table tr th{ padding: 0.40rem 0.40rem !important;}*/
.pt-80 { padding-top: 80px; }
</style>
</head>
<body onload="load()" style="overflow:hidden; background:#DDE2E9;">
<ul class="bxslider">
<li>
<div class="wrapper"> 
<div class="content" style="padding:none;">        
<div class="workplace" style="padding:none;">
<div class="row-fluid">
<div class="span12" style="background:#F5F0E9">
<div class="head clearfix">
    <div class="top_blue">Mada STARS - {{ \Carbon\Carbon::now()->format('M') }} {{ \Carbon\Carbon::now()->format('Y') }} </div>
<div class="col-md-12 pt-50">
<div class="block-fluid tabs" style="border:none; background:none;"> 
<div id="tabs-1" style="height:1200px; overflow-y:hidden;">
<div style="">
	
<table cellpadding="10" cellspacing="10" width="100%" class="table full_height" align="center">
<tbody><tr>
<td style="background:none; text-align:center; border-bottom:none; vertical-align:top; border-right:2px solid #9FCE31;" width="50%">
<table width="85%" border="0" align="center" cellpadding="0" cellspacing="0" class="leadboard_table">
<tbody><tr>
<td  width="57%" style="background:none;">
	<!-- tab 1 start -->
<table border="0" cellpadding="0" cellspacing="0">
<tbody>
	<tr><td align="center" valign="top" style="background:none; border-bottom:none; border-bottom:none; padding:100px 30px 30px 30px !important; ">
@if($emp1)

<img src="{{ asset('public/uploads/users/'.$emp1->user_pic)}}" class="img-circle" style="width:250px;margin-top:70px;border-radius: 50%;"> 
@else
<img src="{{ asset('public/imgs/dummy.jpg')}}" class="img-circle" style="width:250px;margin-top:70px;border-radius: 50%;"> 

@endif
</td>
</tr>
<tr>
<td align="center" valign="top" style="background:none;">
	@if($emp1)
<span class="lb_name"><span style="font-size:52px;  ">#1</span>&nbsp;&nbsp; {{ explode('@',$emp1->email)[0]}}</span><br>
@else
<span class="lb_name"><span style="font-size:52px;  ">#1</span>&nbsp;&nbsp;</span><br>
@endif 
</td>
</tr>
</tbody></table>	<!-- end -->
<br>
<br>
</td>
<td  width="43%" style="background:none;">
<table>
<tr><td><table width="100%" class="table" style="width:100%; float:left;">
<tbody><tr><td align="center" style="background:none; border-bottom:none; border-bottom:none;"><br /><br />
     @if($emp2)
	<img src="{{ asset('public/uploads/users/'.$emp2->user_pic)}}" class="img-circle" style="width:200px; border-radius :50%">
	@else
	<img src="{{ asset('public/imgs/dummy.jpg')}}" class="img-circle" style="width:180px; border-radius :50%">
	@endif 
</td>
</tr>
<tr>
<td align="center" valign="top" style="background:none; border-bottom:none; border-bottom:none;">
@if($emp2)
<span class="lb_name"><span style="font-size:42px;   ">#2</span>&nbsp;&nbsp; {{ explode('@',$emp2->email)[0]}}</span><br> 
@else
<span class="lb_name"><span style="font-size:42px;   ">#2</span>&nbsp;&nbsp; </span><br> 
@endif
</td>
</tr>
</tbody></table></td></tr>


<tr><td><table width="100%" class="table" style="width:100%; float:left;">
<tbody><tr><td align="center" style="background:none; border-bottom:none; border-bottom:none;"><br /><br /><br />
     @if($emp3)
	<img src="{{ asset('public/uploads/users/'.$emp3->user_pic)}}" class="img-circle" style="width:150px; border-radius: 50%;">
	@else
	<img src="{{ asset('public/imgs/dummy.jpg')}}" class="img-circle" style="width:150px; border-radius: 50%;">
	@endif 
</td>
</tr>
<tr>
<td align="center" valign="top" style="background:none; border-bottom:none; border-bottom:none;">
@if($emp3)
<span class="lb_name"><span style="font-size:42px;   ">#3</span>&nbsp;&nbsp; {{ explode('@',$emp3->email)[0]}}</span><br> 
@else
<span class="lb_name"><span style="font-size:42px;   ">#3</span>&nbsp;&nbsp;</span><br>
@endif 
</td>
</tr>
</tbody></table></td></tr>

</table>
</td>


 
</tr> 
</tbody>
</table>
<div>
<div width="100%" style=" background:none; border-bottom:none; vertical-align:top; padding:30px !important; " align="center">
<div width="90%" align="center" class="table" style="background:none; width:90%;">
<div class="d-flex">

<div>
<!-- <div style="background:none; vertical-align:top; padding: 10px !important;">
<img src="https://crm.299.com/img/user_photos/>" class="img-circle" style="width:70px; "></br>
<div style="font-weight:bold; margin-bottom:8px;">4</div></div> -->

</div>


</div></div>
</div>
</div>


</div>
</td>
<td width="50%" style=" background:none; border-bottom:none; vertical-align:top; padding:10px !important; " align="center">
<table width="90%" align="center" class="table" style="background:none; width:90%;">
<tbody>
    
    <tr>
<td width="20%" style="background:none; vertical-align:top;  border-bottom:1px solid #9FCE31;padding:4px !important;">
<img src="{{ asset('public/imgs/dummy.jpg')}}" class="img-circle" style="width:70px; border-radius: 50%; "></td>
<td width="80%" style="background:none; border-bottom:none; font-size:18px;border-bottom:1px solid #9FCE31;">
<div style="font-weight:bold; margin-bottom:8px;padding-top:5px;"></div>
<div style="font-weight:bold;">Reham</div>
<div style="font-weight:bold;">March  2023</div>
</td>
</tr>
<tr>
<td width="20%" style="background:none; vertical-align:top;  border-bottom:1px solid #9FCE31;padding:4px !important;">
<img src="{{ asset('public/imgs/dummy.jpg')}}" class="img-circle" style="width:70px;border-radius: 50%;  "></td>
<td width="80%" style="background:none; border-bottom:none; font-size:18px;border-bottom:1px solid #9FCE31;">
<div style="font-weight:bold; margin-bottom:8px;padding-top:5px;"></div>
<div style="font-weight:bold;">Khaled</div>
<div style="font-weight:bold;">February 2023</div>
</td>
</tr>
<tr>
<td width="20%" style="background:none; vertical-align:top;  border-bottom:1px solid #9FCE31;padding:4px !important;">
<img src="./img/noprofile.png" class="img-circle" style="width:70px; "></td>
<td width="80%" style="background:none; border-bottom:none; font-size:18px;border-bottom:1px solid #9FCE31;">
<div style="font-weight:bold; margin-bottom:8px;padding-top:5px;"></div>
<div style="font-weight:bold;">Hazem</div>
<div style="font-weight:bold;">October 2021</div>
</td>
</tr>
<tr>
<td width="20%" style="background:none; vertical-align:top;  border-bottom:1px solid #9FCE31; padding: 4px !important;">
<img src="./img/noprofile.png" class="img-circle" style="width:70px;"> </td>
<td width="80%" style="background:none; border-bottom:none; font-size:18px;    border-bottom:1px solid #9FCE31;">
<div style="font-weight:bold; margin-bottom:8px;padding-top:5px;"></div>
<div style="font-weight:bold;">Khaled</div>
<div style="font-weight:bold;">September 2021</div>
</td>
</tr>
<tr>
<td width="20%" style="background:none; vertical-align:top;  border-bottom:1px solid #9FCE31;padding:4px !important;">
<img src="./img/noprofile.png" class="img-circle" style="width:70px; "></td>
<td width="80%" style="background:none; border-bottom:none; font-size:18px;border-bottom:1px solid #9FCE31;">
<div style="font-weight:bold; margin-bottom:8px;padding-top:5px;"></div>
<div style="font-weight:bold;">Nesrin</div>
<div style="font-weight:bold;">August 2021</div>
</td>
</tr>
<tr>
<td width="20%" style="background:none; vertical-align:top;  border-bottom:1px solid #9FCE31;padding:4px !important;">
<img src="./img/noprofile.png" class="img-circle" style="width:70px; "></td>
<td width="80%" style="background:none; border-bottom:none; font-size:18px;border-bottom:1px solid #9FCE31;">
<div style="font-weight:bold; margin-bottom:8px;padding-top:5px;"></div>
<div style="font-weight:bold;">Sara</div>
<div style="font-weight:bold;">July 2021</div>
</td>
</tr>
<tr>
<td width="20%" style="background:none; vertical-align:top;  border-bottom:1px solid #9FCE31;padding:4px !important;">
<img src="./img/noprofile.png" class="img-circle" style="width:70px; "></td>
<td width="80%" style="background:none; border-bottom:none; font-size:18px;border-bottom:1px solid #9FCE31;">
<div style="font-weight:bold; margin-bottom:8px;padding-top:5px;"></div>
<div style="font-weight:bold;">Omar ALi</div>
<div style="font-weight:bold;">June 2021</div>
</td>
</tr>
<tr>
<td width="20%" style="background:none; vertical-align:top;  border-bottom:1px solid #9FCE31;padding:4px !important;">
<img src="./img/noprofile.png" class="img-circle" style="width:70px; "></td>
<td width="80%" style="background:none; border-bottom:none; font-size:18px;border-bottom:1px solid #9FCE31;">
<div style="font-weight:bold; margin-bottom:8px;padding-top:5px;"></div>
<div style="font-weight:bold;">Karishma</div>
<div style="font-weight:bold;">May 2021</div>
</td>
</tr>
<tr>
<td width="20%" style="background:none; vertical-align:top;  border-bottom:1px solid #9FCE31; padding:4px !important;">
<img src="./img/evegenia.jpg" class="img-circle" style="width:70px; "></td>
<td width="80%" style="background:none; border-bottom:none; font-size:18px;border-bottom:1px solid #9FCE31;">
<div style="font-weight:bold; margin-bottom:8px;padding-top:5px;"></div>
<div style="font-weight:bold;">Evgenia</div>
<div style="font-weight:bold;">April 2021</div>
</td>
</tr>
<tr>
<td width="20%" style="background:none; vertical-align:top;  border-bottom:1px solid #9FCE31; padding: 4px !important;">
<img src="./img/noprofile.png" class="img-circle" style="width:70px;"> </td>
<td width="80%" style="background:none; border-bottom:none; font-size:18px;    border-bottom:1px solid #9FCE31;">
<div style="font-weight:bold; margin-bottom:8px;padding-top:5px;"></div>
<div style="font-weight:bold;">Madiha</div>
<div style="font-weight:bold;">March 2021</div>
</td>
</tr>
<tr>
<td width="20%" style="background:none; vertical-align:top;  border-bottom:1px solid #9FCE31; padding:4px !important;">
<img src="./img/noprofile.png" class="img-circle" style="width:70px;"></td>
<td width="80%" style="background:none; border-bottom:none; font-size:18px;    border-bottom:1px solid #9FCE31;">
<div style="font-weight:bold; margin-bottom:8px;padding-top:5px;"></div>
<div style="font-weight:bold;">Janna</div>
<div style="font-weight:bold;">Februray 2021</div>
</td>
</tr>
<tr>
<td width="20%" style="background:none; vertical-align:top;  border-bottom:1px solid #9FCE31; padding: 4px !important;">
<img src="./img/noprofile.png" class="img-circle" style="width:70px; "></td>
<td width="80%" style="background:none; border-bottom:none; font-size:18px;    border-bottom:1px solid #9FCE31;">
<div style="font-weight:bold; margin-bottom:8px;padding-top:5px;"></div>
<div style="font-weight:bold;">Sara</div>
<div style="font-weight:bold;">January 2021</div>
</td>
</tr>

</tbody></table>
</td>
</tr>

</tbody></table>
</div>
</div>
</div>
</div>
</div>                                 
</div>
</div>
</div></div></div>
</li>

</ul>
</body>
</html>