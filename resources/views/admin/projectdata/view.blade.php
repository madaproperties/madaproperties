@push('css')
    <style>
        /*.row .card-body
        {
            background:#9fce31;
        }*/
        .availability-unit table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}
body#kt_body .contentArea{padding-left:0;width:100%;}
#kt_header,
#kt_header_mobile,
.menuSideView{display:none;}
.availability-unit td, th {
  border: 1px solid #ebedf3;
  text-align: left;
  padding: 15px;
  padding-left: 20px;
  font-size:13px;
}
.availability-unit .card.card-custom > .card-body {
    padding-bottom: 10px !important;
}
.fixed_footer_icons .whatsapp_footer {
    position: fixed;
    width: 60px;
    height: 60px;
    bottom: 160px;
    right: 10px;
    background-color: #25d366;
    color: #fff;
    border-radius: 50px;
    text-align: center;
    font-size: 35px;
    box-shadow: 2px 2px 3px #999;
    z-index: 100;
}
.fixed_footer_icons i.fa {
    padding-top: 15px;
    font-size: 24px;
    color: #FFF;
    font-weight: 900;
}
.fixed_footer_icons i.fab{
        color: #fff;
    font-size: 37px;
    padding: 10px 0px 0px 0px;
}
.fixed_footer_icons .call_footer {
    position: fixed;
    width: 60px;
    height: 60px;
    bottom: 90px;
    right: 10px;
    background-color: #0125db;
    color: #fff;
    border-radius: 50px;
    text-align: center;
    font-size: 35px;
    box-shadow: 2px 2px 3px #999;
    z-index: 100;
}
.fixed_footer_icons i.fa {
    padding-top: 15px;
}
.location .row
{
    margin:auto;
    text-align:center;
}
.location span
{
    font-size: 15px;
    font-weight: bold;
}
.projectdetails .btn.btn-info:hover {
    border: 1px solid #fff !important;
}
.availability-unit .unitlist li.available {
    color: #9fc538;
    font-weight: bold;
}
.bottom_header{    background: url(/public/imgs/bannermada.jpg);
    background-position: bottom;
    background-repeat: no-repeat;
    background-size: cover;
    padding-bottom: 30px;
    padding-top: 30px;
    height:450px;
}
.bottom_header_one{    background: url(/public/imgs/banner1.jpg);
    background-position: bottom;
    background-repeat: no-repeat;
    background-size: cover;
    padding-bottom: 30px;
    padding-top: 30px;
    height:450px;
}
.projectdetails a{width: 160px;
    margin-right: 15px;
    margin-left: 15px;font-size:18px;}
.projectdetails{justify-content: center;
    padding-top: 50px;}
.availability-unit a{color:#000;}
.bg-available{background:#9fc538;color:#fff;}
.bg-reserve{background:#ffff00;color:#000 !important;}
.bg-sold{background:#F64E60;}
.availability-unit tr:nth-child(even) {
  background-color: #f5ffe0;
}
div#units{padding:30px;}
        .availability-unit .collapsible {
            color: black;
            cursor: pointer;
            padding: 18px;
            width: 100%;
            border: none;
            text-align: left;
            outline: none;
           font-size: 15px;
           text-align: center;
           margin-bottom:20px;
        }
       .availability-unit .btn-info
       {
        margin:30px;
    width: 170px;
    border-radius: 5px;
    font-size: 16px;
    /*text-transform: uppercase !important;*/
       }
       .availability-unit .bg-success .bg-danger .bg-primary
       {
        width: 17px;
        height: 17px;
       }
       .availability-unit .modal-body .sold{
       color: #ff0000;
    font-size: 15px;
    font-weight: 500;
    padding: 10px;
    max-width: 300px;
    text-align: center;
    margin: auto;
       }
       .availability-unit .floor{
        text-align: left;

       }
       h4.floor {
    padding-top: 30px;
    padding-bottom: 10px;
}
.floor_box {
     padding: 30px 20px 30px 20px;
    box-shadow: 0 0 5px #e2cece;
    margin: 20px 0px 20px 0px;
     border-radius:6px;
     
}
       .availability-unit .view{
         margin-top: 5px;
       }
       .availability-unit .modal-body .reserved{
        color: #ff0000;
    font-size: 15px;
    font-weight: 500;
    max-width: 300px;
    padding: 10px;
    margin: auto;
       }
       .card-header img{padding: 20px 0px 20px 0px;width:200px;height:auto;}
       .availability-unit .unitlist{
         padding-top:50px;
         padding-bottom:50px;
         margin: 0px 0px 45px 0px;
         background:#f7f7f7;
         border-radius:6px;
       }
       .unitlist ul{display: flex; margin: auto;padding-left:0;}
       .unitlist ul li {
    padding: 10px;
    list-style-position: inside;
    font-size:16px;
}
 .unitlist span {
    padding-right: 10px;
    display:flex;
}
.unitlist .col-xl-4{display:flex;}
       .unitlist button{padding:10px;width: 10px;
    height: 10px;}
       .availability-unit embed{
        border: 3px solid black; 
        margin-left: 15px;
       }
       .availability-unit .brochure{
        margin-left: 91px; 
        margin-right: 30px;
       }
       .availability-unit h4
       {
        font-size:21px;
        text-transform: uppercase;
       }
     /* .unitlist ul li.available{color:#9fc538;}
       .unitlist ul li.reserved{color:#ffff00;}
        .unitlist ul li.sold{color:#F64E60;}*/
         .unitlist ul li{}
       .availability-unit h2{
            font-size: 24px;
            text-transform: uppercase;
            color: #9fc538;
            font-weight: 500;
            padding-bottom: 50px;
            text-decoration: underline;
       }
       .inf .card-body{
        padding:20px;
       }
       .availability-unit .projectdetails
       {
       margin-bottom:30px;
       margin-left: 20px;
       justify-content:Center;
       }
       .availability-unit .brochureinf
       {
        margin: 5px;
       }
       .developer-logo{
         display: block;
  margin-left: auto;
  margin-right: auto;
  max-width: 300px;
       }
 
       
     @media screen and (max-width: 979px) {
 .unit_box {
    margin-bottom: 10px;
}
.unitlist button {
    padding: 7px;
    width: 7px;
    height: 7px;
}
.unitlist ul {
    display: block;
}
      .floor_box .row{margin:auto;}
        .availability-unit .floor {
    text-align: center;
}
}
      @media screen and (max-width: 768px) {
          .unitlist .col-xl-4{display:block;}
        .floor_box .row{margin:auto;}
        .availability-unit .floor {
    text-align: center;
}
.developer-logo {
    max-width: 200px;
}
.bottom_header_one
{
    height: 300px;
}
 .unit_box {
    margin-bottom: 10px;
}
.unitlist ul {
    display: block;
}
.modal-open .modal{overflow:visible;}
.unitlist button {
    padding: 7px;
    width: 7px;
    height: 7px;
}
}
</style> 
@endpush
@extends('admin.layouts.main')
@section('content')

  <!--begin::Content-->
  <div class="content d-flex flex-column flex-column-fluid " id="kt_content">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <div class="container">
         <!--begin::Card-->
            <div class="card card-custom gutter-b ">
                <div class="card-header m-auto flex-wrap border-0 pt-6 pb-0">
                    <img class="logo" src="{{ asset('public/imgs/logo.png') }}" width="200" />
                </div>
                 @if($project_id==47)
                <div class="bottom_header_one">
                    <img class="developer-logo" src="{{ asset('public/uploads/projectData/'.$project_name['project_logo']) }}">
                    <h2 align="center" style="color:#FFFFFF;padding-top: 12px;" >{{$project_name['name']}}</h2>  
                    <div class="developer_detail">
                        <div class="unit" id="demo">
                            <div class="row projectdetails">
                                @if($project_name['video'])
                                <embed type="video/webm" src="{{ asset('public/uploads/projectData/'.$project_name['video'])}}" width="400" height="300">
                                @endif
                                <a href="{{ asset('public/uploads/projectData/'.$project_name['brochure'])}}" class="btn btn-info brochure"   target="_blank" >Brochure </a>
                                @if($project_name['payment_plan'])
                                <a href="{{ asset('public/uploads/projectData/'.$project_name['payment_plan'])}}" class="btn btn-info" target="_blank">Payment plan </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @else
                  <div class="bottom_header">
                    <img class="developer-logo" src="{{ asset('public/uploads/projectData/'.$project_name['project_logo']) }}">
                    <h2 align="center" >{{$project_name['name']}}</h2>  
                    <div class="developer_detail">
                        <div class="unit" id="demo">
                            <div class="row projectdetails">
                                @if($project_name['video'])
                                <embed type="video/webm" src="{{ asset('public/uploads/projectData/'.$project_name['video'])}}" width="400" height="300">
                                @endif
                                <a href="{{ asset('public/uploads/projectData/'.$project_name['brochure'])}}" class="btn btn-info brochure"   target="_blank" >Brochure </a>
                                @if($project_name['payment_plan'])
                                <a href="{{ asset('public/uploads/projectData/'.$project_name['payment_plan'])}}" class="btn btn-info" target="_blank">Payment plan </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="card-body table-responsive availability-unit">
        
          <!--  -->
          <div class="unit" id="units">
           <div class="row unitlist pt-3 pb-5">
               <div class="col-xl-8">
                   <ul>
                       <li class="available">Available: {{$available}}</li>
                       <li class="reserved">Reserved: {{$reserved}}</li>
                       <li class="sold">Sold out: {{$sold_out}}</li>
                       <li class="total">Total Units: {{$total}}</li>
                   </ul>
               </div>
               <div class="col-xl-4 pt-3">
            <span><button type="button" class="bg-available" ></button><p>&nbsp;: Available</p></span>
            <span><button type="button" class="bg-sold" ></button><p>&nbsp; : Sold out&nbsp;&nbsp;</p></span>
            <span><button type="button" class="bg-reserve"></button><p>&nbsp; : Reserved</p> </span>
            </div>
          </div>
                     @foreach($arr as $res)
           <div class="floor_box row">
                       <!--updated by fazal on 20-12-23-->
                      @if($res->floor_no==0)
                      <h4 class="floor col-xs-12 col-sm-12 col-lg-3">Floor : G</h4>
                      @else
                      <h4 class="floor col-xs-12 col-sm-12 col-lg-3">
                       @if($res->property_type == "Villa")
                        Villa :{{$res->floor_no}}
                        @else
                        Floor :{{$res->floor_no}}
                        @endif


                      </h4>
                      @endif
                      <!--end-->
                      <div class="row col-xs-12 col-sm-12 col-lg-9">
                      @foreach($res['unit_name'] as $unit_name)
                      @if($unit_name->status!= 'Resale')
                        <div class="col-xs-12 col-sm-4 col-lg-4 unit_box unit_box"  style="margin-bottom: 5px;">
                            <!--begin::Tiles Widget 2-->
                            @if($unit_name->status== 'Available')
                            <div class="text-center card card-custom bg-available" >
                            @elseif($unit_name->status== 'Sold out')
                            <div class="text-center card card-custom bg-sold" >
                             @else
                            <div class="text-center card card-custom bg-reserve">
                            @endif
                            <!--begin::Body-->
                            <div class="card-body d-flex flex-column">
                            <!--begin::Stats-->
                                <a href="javascript:void(0)" class="view" onclick="loadViewInPupUp({{$unit_name->id}})">
                                    <div class="flex-grow-1">
                                        <div class="font-weight-bold">
                                        {{$unit_name->unit_name}}
                                        </div>
                                          @if($unit_name->property_type=='Commercial')
                                           <div class="font-weight-bolder ">
                                           {{$unit_name->property_type}}: {{$unit_name->unit_type}} 
                                          </div>
                                          @else
                                          <div class="font-weight-bolder ">
                                          {{$unit_name->bedroom}} Bedroom 
                                          </div>
                                          @endif
                                        <div class="font-weight-bolder">
                                        Area :{{$unit_name->area_bua}} 
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                  </div>
                        @endif
                @endforeach 
              </div>
              </div> 
             @endforeach   
            </div>
            <!--  -->
           <!--end: Datatable-->
            
      </div>
          </div>
            <div class=location>
              <div class="row col-sm-8">
                  <div class="col-sm-6">
                    <img src="{{ asset('public/imgs/KSAflag.png') }}" width="80" style="  padding-right: 10px;"/><span>Riyadh</span>
                    <p>Al Imam Saud Ibn Faysal Rd, As Sahafah,</br>Riyadh 13321, Saudi Arabia<br/>Call :+966 55 008 8601</p>
                    
                    </div>
                  <div class="col-sm-6">
                   <img src="{{ asset('public/imgs/UAEflag.png') }}" width="80" style="  padding-right: 10px;"/><span>Dubai</span>
                   <p>PO Box: 112037, Office 1106, Opal Tower, </br> Business Bay, Dubai, UAE </br> Call :+971 50 377 0780</p>
                  
                  </div>
                  
              </div>
              </div>
          </div>
          <!--end::Card-->
       </div>
    </div>
    <div class="fixed_footer_icons">
                <a href="https://api.whatsapp.com/send?phone=++966550088601&amp;text=مرحباً،+أنا+مهتم+بمشروع+ريفييرا+المربع" class="whatsapp_footer">
                  <i class="fab fa-whatsapp" aria-hidden="true"></i></a><br>
                <a href="tel:+966550088601" class="call_footer"><i class="fa fa-phone" aria-hidden="true"></i></a>
            </div>
    <!--end::Entry-->
  </div>
  <!--end::Content-->
   
@endsection
@push('js')
<script src="{{ asset('public/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('public/assets/js/pages/crud/datatables/basic/scrollable.js') }}"></script>
<script>
function loadViewInPupUp(id){
  let token = $('meta[name=csrf-token]').attr('content');
  let route = '{{route("projectdata.getPupUpByAjax")}}';
  $("#loadingHolder").show();
  $.ajax({
    type:'POST',
    url: route,
    data:{_token:token,id:id},
    success: (res) => {
      $('#getPupUpByAjax').html(res);
      $('#getPupUpByAjax').modal();
      $("#loadingHolder").hide();
    },
    error: function(res){
      $('#getPupUpByAjax').html(res);
      $('#getPupUpByAjax').modal();
      $("#loadingHolder").hide();
    }
  });

}
</script>
@endpush
