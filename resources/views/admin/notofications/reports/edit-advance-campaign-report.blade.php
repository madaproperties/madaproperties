@push('css')
    <style>
        @media(max-width: 775px)
        {
            .container
            {
                margin-top:180px;
            }
        }
        th,td{
                text-align:center;
            }
    </style>
@endpush
@extends('admin.layouts.main')
@section('content')
@php
$data = [];
if(isset($reportData->source_wise_amount)){
    $data = (array) json_decode($reportData->source_wise_amount,true);
}
@endphp   

<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
   <div class="container">
   <div id="accordion">
	<div class="">
		<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="row"> <!--- row -->
                <div class="form-group col-md-4 col-sm-12">
                    <label>{{__('site.project') }} : {{ $reportData->project->name}}</label>
                </div>
                <div class="form-group col-md-4 col-sm--12">
                    <div class="form-group ">
                        <label class="">{{ __('site.from') }} : {{ date('d/m/Y',strtotime($reportData->start_from)) }}</label>
                    </div>
                </div>
                <div class="form-group col-md-4 col-sm--12">
                    <div class="form-group ">
                        <label class="">{{ __('site.to') }} : {{ date('d/m/Y',strtotime($reportData->end_to)) }}</label>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-bottom: 10px;"> <!--- row -->
                <a href="{{route('admin.advance-campaign-report.index')}}" class="btn btn-warning">{{__('site.back to listing page')}}</a>
            </div>
        </div>
	</div>
</div>

   
   @if(empty($project_id))
        <h2 class="text-center">Please select project, start date and end date to insert or update report data.</h2>
   @else 
   <form action="{{route('admin.advance-campaign-report.update',$reportData->id)}}" method="post">
   @csrf
   @method('PATCH')
   <div class="col-md-12" style="overflow: scroll;max-height: 1000px;">
   <input type="hidden" name="project_id" value="{{$project_id}}">
   <input type="hidden" name="start_from" value="{{$reportData->start_from}}">
   <input type="hidden" name="end_to" value="{{$reportData->end_to}}">
   <input type="submit" class="form-control">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Campaign County</th>
                @foreach($sources_data as $source)
                    <th scope="col">{{ ucfirst($source->name) }} <br> Amount</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($countries_data as $country)
            <tr class="">
                <th scope="row" style="background:#eee">{{$country->name }}</th>
                @foreach($sources_data as $statu)
                <th scope="row">
                    <input type="text" name="data[{{$country->id}}][{{$statu->name}}]" value="{{isset($data[$country->id][$statu->name]) ? $data[$country->id][$statu->name] : 0}}">
                </th>
                @endforeach
            </tr>
            @endforeach

            @if($europeCountries)
            <tr class="">
                <th scope="row" style="background:#eee">Europe</th>
                @foreach($sources_data as $statu)
                <th scope="row">
                    <input type="text" name="data[{{$europeCountries}}][{{$statu->name}}]" value="{{isset($data[$europeCountries][$statu->name]) ? $data[$europeCountries][$statu->name] : 0}}">
                </th>
                @endforeach
            </tr>
            @endif

            @if($russiaCountries)
            <tr class="">
                <th scope="row" style="background:#eee">Rassia</th>
                @foreach($sources_data as $statu)
                <th scope="row">
                    <input type="text" name="data[{{$russiaCountries}}][{{$statu->name}}]" value="{{isset($data[$russiaCountries][$statu->name]) ? $data[$russiaCountries][$statu->name] : 0}}">
                </th>
                @endforeach
            </tr>
            @endif

        </tbody>
    </table> 
    </div>
    <input type="submit" class="form-control">
    </form>
    @endif
    <br>
</div>
</div>
<!--end::Entry-->
</div>



@endsection