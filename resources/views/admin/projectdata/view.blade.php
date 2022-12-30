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

.availability-unit td, th {
  border: 1px solid #ebedf3;
  text-align: left;
  padding: 15px;
  padding-left: 20px;
}

.availability-unit tr:nth-child(even) {
  background-color: #f5ffe0;
}
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
        margin-top: 117px;
        margin-bottom: 143px;
        width: 261px;
       }
       .availability-unit .bg-success .bg-danger .bg-primary
       {
        width: 17px;
        height: 17px;
       }
       .availability-unit .sold{
        color:red;
        font-size:15px;
        font-weight:500;
       }
       .availability-unit .floor{
        text-align: center;

       }
       .availability-unit .view{
         margin-top: 5px;
       }
       .availability-unit .reserved{
        color:blue;
        font-size:15px;
        font-weight:500;
       }
       .availability-unit .unitlist{
         margin-left:20px;
       }
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
       .inf .card-body{
        padding:20px;
       }
       .availability-unit .projectdetails
       {
       margin-bottom:30px;
       margin-left: 20px;
       }
       .availability-unit .brochureinf
       {
        margin: 5px;
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
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
            </div>
            <div class="card-body table-responsive availability-unit">

              <h4 align="center" >{{$project_name['name']}}</h4>
              
                
<button type="button" class="collapsible" data-toggle="collapse" data-target="#demo"><b>About Project</b></button>
<div class="collapse" id="demo">
  <div class="row projectdetails">
    @if($project_name['video'])
    <embed type="video/webm" src="{{ asset('public/uploads/projectData/'.$project_name['video'])}}" width="400" height="300">
    @endif
    <a href="{{ asset('public/uploads/projectData/'.$project_name['brochure'])}}" class="btn btn-info brochure"   target="_blank" >Brochure </a>
   
    <a href="{{ asset('public/uploads/projectData/'.$project_name['payment_plan'])}}" class="btn btn-info" target="_blank">Payment plan </a>
  </div>
</div>
  <!--  -->
  <button type="button" class="collapsible" data-toggle="collapse" data-target="#units"><b>Units</b></button>
<div class="collapse" id="units">
     <div class="row unitlist">
        <button type="button" class="bg-success" ></button>&nbsp; : Available &nbsp;
        <button type="button" class="bg-danger" ></button>&nbsp; : Sold out&nbsp;&nbsp;
        <button type="button" class="bg-primary"></button>&nbsp; : Reserved 
    </div>
                     @foreach($arr as $res)
                      <h4 class="floor">Floor :{{$res->floor_no}}</h4>
                      <div class="row">
                      @foreach($res['unit_name'] as $unit_name)
                    <div class="col-xl-4">
                                        <!--begin::Tiles Widget 2-->
                                         @if($unit_name->status== 'Available')
                                          <div class="text-center card card-custom bg-success  gutter-b" >
                                            @elseif($unit_name->status== 'Sold out')
                                            <div class="text-center card card-custom bg-danger  gutter-b" >
                                              @else
                                            <div class="text-center card card-custom bg-primary  gutter-b">
                                             @endif
                                          
                                          <!--begin::Body-->
                                          <div class="card-body d-flex flex-column p-0">
                                            <!--begin::Stats-->
                                            <div class="flex-grow-1 card-spacer-x pt-6 pb-6">
                                              <div class="text-inverse-danger font-weight-bold font-size-h1">
                                              {{$unit_name->unit_name}}
                                              </div>
                                              <div class="text-inverse-danger font-weight-bolder ">
                                                {{$unit_name->bedroom}}:Bed room  | Area :{{$unit_name->area_bua}}  
                                              </div>
                                              <a href="" class="btn btn-primary view "
                data-toggle="modal" data-target="#assign-leads-{{$unit_name->id}}">
                    View Details</i>  
                  </a>
                   <!-- Modal -->
                <div class="modal fade" id="assign-leads-{{$unit_name->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Property Details</h5>
                      </div>
                      <div class="modal-body">
                        @if($unit_name->status == 'Available')
                        <div class="form-group">
                          <table>
                            <tr>
                             <td>Country</td>
                             <td>{{$unit_name->country->name}}</td>
                            </tr>
                              <tr>
                                <td>District</td>
                                <td>{{$unit_name->district_name}}</td>
                              </tr>
                              <tr>
                                <td>Project</td>
                                <td>{{$unit_name->project->name}}</td>
                              </tr>
                              <tr>
                                <td>Developer</td>
                                <td>{{$unit_name->developer->name}}</td>
                              </tr>
                              <tr>
                                <td>Unit name</td>
                                <td>{{$unit_name->unit_name}}</td>
                              </tr>
                              <tr>
                                <td>Floor No</td>
                                <td>{{$unit_name->floor_no}}</td>
                              </tr>
                              <tr>
                                <td>Area(BUA)</td>
                                <td>{{$unit_name->area_bua}}</td>
                              </tr>
                              <tr>
                                <td>Price</td>
                                <td>{{$unit_name->price}}</td>
                              </tr>
                              <tr>
                                <td>Downpayment</td>
                                <td>{{$unit_name->down_payment}}</td>
                              </tr>
                            </table>
                      </div>
                      @elseif($unit_name->status == 'Sold out')
                      <p class="sold"> Sorry the unit already sold </p>
                      @else
                      <p class="reserved"> Sorry the unit is reserved </p>
                      @endif
                     </div>
                      <div class="modal-footer">
                        @if($unit_name->status == 'Available')
                        <a href="{{ route('project.brochure',$unit_name->id) }}" target="_blank"  class="btn btn-info btn-xs brochureinf  " >See Brochure</a>
                        @endif
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
               </div>
               </div>
               </div>
              </div>
              @endforeach 
              </div> 
             @endforeach   
            </div>
            <!--  -->
           <!--end: Datatable-->
            </div>
          </div>
          <!--end::Card-->
       </div>
    </div>
    <!--end::Entry-->
  </div>
  <!--end::Content-->
   
@endsection
@push('js')
<script src="{{ asset('public/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('public/assets/js/pages/crud/datatables/basic/scrollable.js') }}"></script>
@endpush
