@push('css')
    <style>
        th,td{
                text-align:center;
            }
    </style>
@endpush
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
   @include('admin.reports.advance_campaign_search')
   
   @if(empty($project_id))
        <h2 class="text-center">Please select project, start date and end date to insert or update report data.</h2>
   @else 
   <form action="{{route('admin.advance-campaign-report.store')}}" method="post">
   @csrf
   <div class="col-md-12" style="overflow: scroll;max-height: 1000px;">
   <input type="hidden" name="project_id" value="{{$project_id}}">
   <input type="hidden" name="start_from" value="{{request('last_update_from')}}">
   <input type="hidden" name="end_to" value="{{request('last_update_to')}}">
   <input type="submit" class="form-control">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nationality</th>
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
                    <input type="text" name="data[{{$cData}}][{{$statu->name}}]" value="{{isset($data[$cData][$statu->name]) ? $data[$cData][$statu->name] : 0}}">
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
