@push('css')
    <style>
        /*.row .card-body
        {
            background:#9fce31;
        }*/
        table,td{
          border: 1px solid black;
          width: 65%;
        }
    </style>
@endpush
@extends('admin.layouts.main')
@section('content')

  <!--begin::Content-->
  <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
       <div class="container">
         <!--begin::Card-->
          <div class="card card-custom gutter-b">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
            </div>
            <div class="card-body table-responsive" style="padding:20px">
              <h4 align="center" style="font-size:21px;">{{$project_name['name']}}</h4>
                   <button type="button" class="bg-success" style="width: 17px;height: 17px;"></button> :Available
                      <button type="button" class="bg-danger" style="width: 17px;height: 17px;"></button> :Sold out
                      <button type="button" class="bg-primary" style="width: 17px;height: 17px;"></button> :Reserved
                     @foreach($arr as $res)
                      <h4 style="text-align: center;">Floor :{{$res->floor_no}}</h4>
                      <div class="row">
                      @foreach($res['unit_name'] as $unit_name)
                    <div class="col-xl-4">
                                        <!--begin::Tiles Widget 2-->
                                         @if($unit_name->status== 'Available')
                                          <div class="text-center card card-custom bg-success  gutter-b" style="">
                                            @elseif($unit_name->status== 'Sold out')
                                            <div class="text-center card card-custom bg-danger  gutter-b" style="">
                                              @else
                                            <div class="text-center card card-custom bg-primary  gutter-b" style="">
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
                                              <a href="" class="btn btn-primary"
                data-toggle="modal" data-target="#assign-leads-{{$unit_name->id}}" style="margin-top: 5px;">
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
                          <table >
                           <tr>
                            <td>
                             Country :
                            </td>
                            <td>{{$unit_name->country->name}}</td>
                           </tr> 
                           <tr>
                             <tr>
                            <td>
                             District :
                            </td>
                            <td>{{$unit_name->district_name}}</td>
                           </tr>
                           <tr>
                            <td>
                             Project :
                            </td>
                            <td>{{$unit_name->project->name}}</td>
                           </tr> 
                           <tr>
                            <tr>
                            <td>
                             Developer :
                            </td>
                            <td>{{$unit_name->developer->name}}</td>
                           </tr> 
                            <td>
                            Unit name :
                            </td>
                            <td>{{$unit_name->unit_name}}</td>
                           </tr>
                           <tr>
                            <tr>
                            <td>
                             Floor No :
                            </td>
                            <td>{{$unit_name->floor_no}}</td>
                           </tr>
                           <tr>
                            <td>
                             Area(BUA) :
                            </td>
                            <td>{{$unit_name->area_bua}}</td>
                           </tr>
                           <tr>
                            <td>
                             Price :
                            </td>
                            <td>{{$unit_name->price}}</td>
                           </tr>
                            <tr>
                            <td>
                             Downpayment :
                            </td>
                            <td>{{$unit_name->down_payment}}</td>
                           </tr>
                          </table>
                        
                      </div>
                      @elseif($unit_name->status == 'Sold out')
                      <p style="color:red;font-size:15px;font-weight:500;"> Sorry the unit already sold </p>
                      @else
                      <p style="color:blue;font-size:15px;font-weight:500; "> Sorry the unit is reserved </p>
                      @endif
                    </div>
                    
                      <div class="modal-footer">
                        @if($unit_name->status == 'Available')
                        <a href="{{ route('project.brochure',$unit_name->id) }}" target="_blank" style="margin: 5px;" class="btn btn-info btn-xs assign-all" >

                        See Brochure
                        </a>
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
