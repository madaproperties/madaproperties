@push('css')
    
       <style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 100%;
  border-radius: 5px;
  margin-right: 20px;
  margin-bottom: 20px;
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

img {
  border-radius: 5px 5px 0 0;
  style="width:100%;height: 100%;
}
.web-project{
    font-size: 22px;
    font-weight: 500;
    color: #000;
    text-transform: uppercase;
    padding-top: 12px;
    padding-bottom: 20px;
    text-align: center;    
  
  }
  .webcard
  {
    margin-bottom: 20px;
  }

    </style>
@endpush
@extends('admin.layouts.main')
@section('content')

  <!--begin::Content-->
  <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
      <div class="d-flex flex-column-fluid">
       <div class="container">
        <div class="row">
       @foreach($data as $datas)
      <div class="col-md-4 webcard">
        <div class="card" >
  <img src="{{ asset('public/uploads/projectData/'.$datas->project->image)}}" alt="Avatar">
  <a class="web-project" href="{{route('admin.projectdata.view',$datas->project->id)}}">  {{$datas->project->name}}  </a>
   
  
</div>
</div>
@endforeach
</div>
       </div>
    </div>
    <!--end::Entry-->
  </div>
  </div>
  <!--end::Content-->

@endsection
@push('js')
<script src="{{ asset('public/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('public/assets/js/pages/crud/datatables/basic/scrollable.js') }}"></script>
@endpush
