@extends('admin.layouts.main')
@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content" style="padding-top:10px">
            <!--begin::Subheader-->
            <div class="subheader py-2 py-lg-6 subheader-transparent" id="kt_subheader">
              <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-1">

                  <!--end::Mobile Toggle-->
                  <!--begin::Page Heading-->
                  <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">{{__('site.Mada Board')}}</h5>
                    <!--end::Page Title-->

                  </div>
                  <!--end::Page Heading-->
                </div>
                <!--end::Info-->

              </div>
            </div>
            <!--end::Subheader-->
            <!--begin::Entry-->
            <div class="d-flex flex-column-fluid">
              <!--begin::Container-->
              <div class="container">
                <!--begin::Profile Change Password-->
                <div class="d-flex flex-row">
                  <!--begin::Aside-->
                  
                  <!--end::Aside-->
                  <!--begin::Content-->
                  <div class="flex-row-fluid ml-lg-8">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b">
                  <!--begin::Header-->
                  <div class="card-header border-0 py-5">
                    <h3 class="card-title align-items-start flex-column">
                      <span class="card-label font-weight-bolder text-dark">{{__('site.Mada Board')}}</span>
                      <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                    </h3>
                   
                  </div>
                  <!--end::Header-->
                  <!--begin::Body-->
                  <div class="card-body py-0">
                    <!--begin::Table-->
                    <div class="table-responsive">
                      <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_1">
                        <thead>
                          <tr class="text-left">
                            
                            <th style="min-width: 150px">{{__('site.title')}}</th>
                            <th style="min-width: 150px">{{__('site.image')}}</th>
                            
                            <th class="pr-0 " style="min-width: 150px">{{__('site.action')}}</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($datas as $data) 
                          <tr>
                            <td class="pl-0">
                              <span class="text-muted font-weight-bold text-muted d-block">{{$data->title}}</span>
                            </td>
                            <td>
                             <embed  src="{{$data->image }}" style="width: 75px;height: 50px;" />

                            </td>
                            
                            <td class="pr-0 ">

                              <a href="{{ route('admin.madaboard.show',$data->id) }}" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Edit details"><i class="fa fa-edit"></i></a> 
                           
                             </a>
                             <form id="destory-{{$data->id}}" class="delete" onsubmit="return confirm('{{__('site.confirm')}}');"
                      action="{{ route('admin.madaboard.destroy',$data->id) }}" method="POST" >
                      @csrf
                      @method('DELETE')
                      <a href="javascript:void(0)" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Delete">
                      <i class="fa fa-trash" onclick="submitForm('{{$data->id}}')"></i></a>
                      <button type="submit" style="display:none"></button>
                    </form>
                               </td>
                           </tr>
                           @endforeach
                           </td>
                          </tr>
                          
                        </tbody>
                        
                      </table>
                    </div>
                    <!--end::Table-->
                  </div>
                  <!--end::Body-->
                </div>
                  </div>
                  <!--end::Content-->
                </div>
                <!--end::Profile Change Password-->
              </div>
              <!--end::Container-->
            </div>
            <!--end::Entry-->
          </div>
          <!-- new Account --->
          <div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
          <!--begin::Header-->
          <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
          <h3 class="font-weight-bold m-0">New Leave</h3>

          </div> 
          <!--end::Header-->
          <!--begin::Content-->
          <div class="offcanvas-content pr-5 mr-n5">
            <!--begin::Header-->
            <div class="d-flex align-items-center mt-5">

            <div class="d-flex flex-column">

              <div class="navi mt-2">
                <form class="form" method="post" id="new-project" action="{{route('admin.madaboard.store')}}">
                  @csrf
<div class="card-body">
 

   <div class="separator separator-dashed my-5"></div>
                      
                      <div class="separator separator-dashed my-5"></div>
                      <div class="form-group">
                        <label>{{__('site.title')}}:</label>
                        <input type="text" name="title" value="{{old('title')}}" class="form-control" >
                      </div>
                      <div class="form-group">
                        <label>{{__('site.image')}}:</label>
                        <input type="file" name="image" value="" class="form-control" >
                      </div>
                      

                  
                                      <!--end::Group-->
                      <div class="separator separator-dashed my-5"></div>
                    </div>
                    <div class="card-footer">
                      <button type="submit" form="new-project" class="btn btn-primary mr-2">{{__('site.save')}}</button>
                      <button id="kt_quick_user_close" class=" btn btn-secondary">{{__('site.cancel')}}</button>
                    </div>
                  </form>


              </div>
            </div>
          </div>
          <!--end::Header-->

          </div>
          <!--end::Content-->
          </div>
          <script>
function submitForm(id){
  $("#destory-"+id).submit();
}

</script>

@endsection
