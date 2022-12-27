@push('css')
    <style>
        .row .card-body
        {
            background:#9fce31;
        }
        .availibility .card-body a{
                font-size: 22px;
    font-weight: 500;
    color: #fff;
        }
         .availibility .card-body img{margin-bottom:10px;}
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
             
             <div class="row availibility">
                    @foreach($data as $datas)
                    <div class="col-xl-4">
                                        <!--begin::Tiles Widget 2-->
                                        
                                          <div class="text-center card card-custom bg-success  gutter-b" style="">
                                          <!--begin::Body-->
                                          <div class="card-body d-flex flex-column p-0">
                                            <!--begin::Stats-->
                                            <div class="flex-grow-1 card-spacer-x pt-6 pb-6">
                                              <div class="text-inverse-danger font-weight-bold">
                                                 
                                            <img src="{{ asset('public/uploads/projectData/'.$datas->project->image)}}" width="320" height="200">
                                              <a href="{{route('admin.projectdata.view',$datas->project->id)}}" > {{$datas->project->name}}  </a>
                                              </div>
                                              <div class="text-inverse-danger font-weight-bolder font-size-h1">
                                                      
                                              </div>
                                            </div>
                                            <!--end::Stats-->
                                            <!--begin::Chart-->
                                            <!--end::Chart-->
                                          </div>
                                          <!--end::Body-->
                                        </div>
                                        
                                        <!--end::Tiles Widget 2-->
                                      </div>
                                      @endforeach
                                      
                                      
                                      
                    
                </div>
              
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
