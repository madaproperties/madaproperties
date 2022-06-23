@push('css')
    <style>
        table, tbody, tr, td, th{
           text-align:center;
        }          
        .border-none{
            border:none !important;
        }  
    </style>
@endpush
@php
if(isset($reportData->source_wise_amount)){
    $data = (array) json_decode($reportData->source_wise_amount,true);
}
@endphp   

<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
   <div class="container">
   @include('admin.reports.advance_campaign_search',$reportData)
   

   @if(!isset($reportData->source_wise_amount))
        <h2 class="text-center">No data found for selected request.</h2>
   @else 
   <form action="{{route('admin.storeReportAdvanceCampaing')}}" method="post">
   @csrf
   <div class="col-md-12" style="overflow: scroll;max-height: 1000px;">
   <input type="hidden" name="project_id" value="{{$project_id}}">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col" rowspan="2">Nationality</th>
                @foreach($sources_data as $source)
                    <th scope="col">{{ ucfirst($source->name) }}</th>
                @endforeach
                    <th scope="col">{{ __('site.Total') }}</th>
            </tr>
            <tr>
                @foreach($sources_data as $source)
                <td>
                    <table class="">
                    <tr>
                        <th class="border-none">{{ __('site.Leads') }}</th>
                        <th class="border-none">{{ __('site.Amount') }}</th>
                        <th class="border-none">{{ __('site.CPL') }}</th>
                    </tr>
                    </table>
                </td>
                @endforeach
                <td>
                    <table class="">
                    <tr>
                        <th class="border-none">{{ __('site.Leads') }}</th>
                        <th class="border-none">{{ __('site.Amount') }}</th>
                        <th class="border-none">{{ __('site.CPL') }}</th>
                    </tr>
                    </table>
                </td>
            </tr>
        </thead>
        <tbody>
            @php $finalTotalCount =0;  $finalTotalAmount =0; $finalTotalCpl=0; @endphp
            @foreach($countries_data as $country)
            @php $totalCount =0;  $totalAmount =0; $totalCpl=0; @endphp
            <tr class="">
                <th scope="row" style="background:#eee">{{$country->name }}</th>
                @foreach($sources_data as $statu)
                @php $tempOne = App\Contact::where(function ($q) use ($users){

                    if(userRole() == 'leader')
                    {
                        $q->where(function($q2) use ($users){
                            $q2->whereIn('user_id',$users)
                            ->orWhereIn('created_by',$users);
                        });
                    }else if(userRole() == 'sales admin uae') {
                        return $q->where('projects.country_id','2')->get();

                    }else if(userRole() == 'sales admin saudi'){
                        return $q->where('projects.country_id','1')->get();
                    }
                    })->where('country_id',$country->id)->where('source',$statu->name)->count();
                    $totalCount += $tempOne;
                @endphp
                <th scope="row">
                    <table class="">
                        <tr>
                            @php
                            $amount = isset($data[$country->id][$statu->name]) ? $data[$country->id][$statu->name] : 0;
                            $totalAmount += $amount;
                            $cpl = $tempOne > 0 ? $amount/$tempOne : 0;

                            @endphp
                            <th class="border-none" width="87px">{{ $tempOne }}</th>
                            <th class="border-none" width="87px">{{ $amount }}</th>
                            <th class="border-none" width="87px">{{ number_format($cpl,2) }}</th>
                        </tr>
                    </table>
                </th>
                @endforeach
                <th scope="row">
                    <table class="">
                        <tr>
                            @php
                                $totalCpl = $totalCount > 0 ? $totalAmount/$totalCount : 0;
                                $finalTotalCount += $totalCount;
                                $finalTotalAmount += $totalAmount;
                            @endphp
                            <th class="border-none" width="87px">{{ $totalCount }}</th>
                            <th class="border-none" width="87px">{{ $totalAmount }}</th>
                            <th class="border-none" width="87px">{{ number_format($totalCpl,2) }}</th>
                        </tr>
                    </table>
                </th>

            </tr>
            @endforeach

            @if($europeCountries)
            @php $totalCount =0;  $totalAmount =0; $totalCpl=0; @endphp
            <tr class="">
                <th scope="row" style="background:#eee">Europe</th>
                    @foreach($sources_data as $statu)
                        @php $tempOne = App\Contact::where(function ($q) use ($users){
                            if(userRole() == 'leader')
                            {
                                $q->where(function($q2) use ($users){
                                    $q2->whereIn('user_id',$users)
                                    ->orWhereIn('created_by',$users);
                                });
                            }else if(userRole() == 'sales admin uae') {
                                return $q->where('projects.country_id','2')->get();

                            }else if(userRole() == 'sales admin saudi'){
                                return $q->where('projects.country_id','1')->get();
                            }
                            })->whereIn('country_id',$europeCountries)->where('source',$statu->name)->count();
                            $totalCount += $tempOne;
                        @endphp
                        <th scope="row">
                            <table class="">
                                <tr>
                                    @php
                                    $amount = isset($data[$cDataVar][$statu->name]) ? $data[$cDataVar][$statu->name] : 0;
                                    $totalAmount += $amount;
                                    $cpl = $tempOne > 0 ? $amount/$tempOne : 0;

                                    @endphp
                                    <th class="border-none" width="87px">{{ $tempOne }}</th>
                                    <th class="border-none" width="87px">{{ $amount }}</th>
                                    <th class="border-none" width="87px">{{ number_format($cpl,2) }}</th>
                                </tr>
                            </table>
                        </th>
                    @endforeach
                    <th scope="row">
                        <table class="">
                            <tr>
                                @php
                                    $totalCpl = $totalCount > 0 ? $totalAmount/$totalCount : 0;
                                    $finalTotalCount += $totalCount;
                                    $finalTotalAmount += $totalAmount;
                                @endphp
                                <th class="border-none" width="87px">{{ $totalCount }}</th>
                                <th class="border-none" width="87px">{{ $totalAmount }}</th>
                                <th class="border-none" width="87px">{{ number_format($totalCpl,2) }}</th>
                            </tr>
                        </table>
                    </th>

            </tr>
            @endif
            <tr>
                @php
                    $finalTotalCpl = $finalTotalCount > 0 ? $finalTotalAmount/$finalTotalCount : 0;
                @endphp
                <th scope="col" width="87px" colspan="17" style="text-align:right">{{ __('site.grand_total') }}</th>
                <th scope="col" width="87px">{{ $finalTotalCount }}</th>
                <th scope="col" width="87px">{{ $finalTotalAmount }}</th>
                <th scope="col" width="87px">{{ number_format($finalTotalCpl,2) }}</th>
                    
            <tr>
                    
        </tbody>
    </table> 
    </div>
    </form>
    @endif
    <br>
</div>
</div>
<!--end::Entry-->
</div>
