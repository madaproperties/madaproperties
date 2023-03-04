@push('css')
    <style>
        table, tbody, tr, td, th{
           text-align:center;
        }          
        .border-none{
            border:none !important;
            text-align:center;
        }  
        .source {
            background-color: #ccc7c7;
        }

    </style>
@endpush
@php
if(isset($reportData->source_wise_amount)){
    $data = (array) json_decode($reportData->source_wise_amount,true);
}
$tempArr = [];
$from = date('Y-m-d 00:00:00', strtotime($reportData->start_from));
$to = date('Y-m-d 23:59:59', strtotime($reportData->end_to));
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
                <th scope="col" rowspan="2">Campaign County</th>
                <th class="source">{{ 'Facebook & Instagram' }}</th>
                @php
                    $i = 3;
                @endphp
                @foreach($sources_data as $source)
                <th class="{{ ($i%2) == 0 ? 'source' : ''}}">{{ ucfirst($source->name) }}</th>
                @php
                    $i++;
                @endphp

                @endforeach
                <th class="source">{{ __('site.Total') }}</th>
            </tr>
            <tr>
                <td >
                    <table width="400px">
                    <tr>
                        <th class="border-none" width="100px">{{ 'Fb Leads' }}</th>
                        <th class="border-none" width="100px">{{ 'In Leads' }}</th>
                        <th class="border-none" width="100px">{{ __('site.Amount') }}</th>
                        <th class="border-none" width="100px">{{ __('site.CPL') }}</th>
                    </tr>
                    </table>
                </td>
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
                @php 
                    $tempFace = App\Contact::where('project_id',$reportData->project_id)
                        ->where('campaign_country',$country->id)
                        ->where('source','facebook')
                        ->whereBetween('created_at',[ $from,$to ])
                        ->count();
                    $tempInsta = App\Contact::where('project_id',$reportData->project_id)
                        ->where('campaign_country',$country->id)
                        ->where('source','instagram')
                        ->whereBetween('created_at',[ $from,$to ])
                        ->count();
                    $tempOne = $tempFace + $tempInsta;                        
                    $totalCount += $tempOne;
                @endphp
                <th scope="row">
                    <table class="">
                        <tr>
                            @php
                            $tempArr[] = $country->id;
                            $amount = isset($data[$country->id]['facebook_instagram']) ? $data[$country->id]['facebook_instagram'] : 0;
                            $totalAmount += $amount;
                            $cpl = $tempOne > 0 ? $amount/$tempOne : 0;

                            @endphp
                            <th class="border-none" width="100px">{{ $tempFace }}</th>
                            <th class="border-none" width="100px">{{ $tempInsta }}</th>
                            <th class="border-none" width="100px">{{ $amount }}</th>
                            <th class="border-none" width="100px">{{ number_format($cpl,2) }}</th>
                        </tr>
                    </table>
                </th>
                @foreach($sources_data as $statu)
                @php 
                    $tempOne = App\Contact::where('project_id',$reportData->project_id)
                    ->where('campaign_country',$country->id)
                    ->where('source',$statu->name)
                    ->whereBetween('created_at',[ $from,$to ])
                    ->count();
                    $totalCount += $tempOne;
                @endphp
                <th scope="row">
                    <table class="">
                        <tr>
                            @php
                            $tempArr[] = $country->id;
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
                    @php 
                        $tempFace = App\Contact::where('project_id',$reportData->project_id)
                        ->whereIn('campaign_country',$europeCountries)
                        ->where('source','facebook')
                        ->whereBetween('created_at',[ $from,$to ])
                        ->count();
                        $tempInsta = App\Contact::where('project_id',$reportData->project_id)
                        ->whereIn('campaign_country',$europeCountries)
                        ->where('source','instagram')
                        ->whereBetween('created_at',[ $from,$to ])
                        ->count();
                        $tempOne = $tempFace + $tempInsta;
                        $totalCount += $tempOne;
                    @endphp
                    <th scope="row" >
                        <table class="">
                            <tr>
                                @php
                                $tempArr = array_merge($tempArr,$europeCountries);
                                $amount = isset($data[$cDataVar]['facebook_instagram']) ? $data[$cDataVar]['facebook_instagram'] : 0;
                                $totalAmount += $amount;
                                $cpl = $tempOne > 0 ? $amount/$tempOne : 0;

                                @endphp
                                <th class="border-none" width="100px">{{ $tempFace }}</th>
                                <th class="border-none" width="100px">{{ $tempInsta }}</th>
                                <th class="border-none" width="100px">{{ $amount }}</th>
                                <th class="border-none" width="100px">{{ number_format($cpl,2) }}</th>
                            </tr>
                        </table>
                    </th>

                    @foreach($sources_data as $statu)
                        @php 
                            $tempOne = App\Contact::where('project_id',$reportData->project_id)
                            ->whereIn('campaign_country',$europeCountries)
                            ->where('source',$statu->name)
                            ->whereBetween('created_at',[ $from,$to ])
                            ->count();
                            $totalCount += $tempOne;
                        @endphp
                        <th scope="row">
                            <table class="">
                                <tr>
                                    @php
                                    $tempArr = array_merge($tempArr,$europeCountries);
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

            @if($russiaCountries)
            @php $totalCount =0;  $totalAmount =0; $totalCpl=0; @endphp
            <tr class="">
                <th scope="row" style="background:#eee">Europe</th>
                        @php 
                        
                        $tempFace = App\Contact::where('project_id',$reportData->project_id)
                        ->whereIn('campaign_country',$russiaCountries)
                        ->where('source','facebook')
                        ->whereBetween('created_at',[ $from,$to ])
                        ->count();
                        $tempInsta = App\Contact::where('project_id',$reportData->project_id)
                        ->whereIn('campaign_country',$russiaCountries)
                        ->where('source','instagram')
                        ->whereBetween('created_at',[ $from,$to ])
                        ->count();
                        $tempOne = $tempFace + $tempInsta;
                        $totalCount += $tempOne;
                        @endphp
                        <th scope="row">
                            <table class="">
                                <tr>
                                    @php
                                    $tempArr = array_merge($tempArr,$russiaCountries);
                                    $amount = isset($data[$rDataVar]['facebook_instagram']) ? $data[$rDataVar]['facebook_instagram'] : 0;
                                    $totalAmount += $amount;
                                    $cpl = $tempOne > 0 ? $amount/$tempOne : 0;

                                    @endphp
                                    <th class="border-none" width="100px">{{ $tempFace }}</th>
                                    <th class="border-none" width="100px">{{ $tempInsta }}</th>
                                    <th class="border-none" width="100px">{{ $amount }}</th>
                                    <th class="border-none" width="100px">{{ number_format($cpl,2) }}</th>
                                </tr>
                            </table>
                        </th>
                    @foreach($sources_data as $statu)
                        @php $tempOne = App\Contact::where('project_id',$reportData->project_id)
                        ->whereIn('campaign_country',$russiaCountries)
                        ->where('source',$statu->name)
                        ->whereBetween('created_at',[ $from,$to ])
                        ->count();
                            $totalCount += $tempOne;
                        @endphp
                        <th scope="row">
                            <table class="">
                                <tr>
                                    @php
                                    $tempArr = array_merge($tempArr,$russiaCountries);
                                    $amount = isset($data[$rDataVar][$statu->name]) ? $data[$rDataVar][$statu->name] : 0;
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
                <th scope="col" width="87px" colspan="1" style="text-align:right;padding-top: 20px;">{{ __('site.grand_total') }}</th>
                <th>
                    <table>
                        <tr>
                            <th scope="col" class="border-none" width="133px">{{ $finalTotalCount }}</th>
                            <th scope="col" class="border-none" width="133px">{{ $finalTotalAmount }}</th>
                            <th scope="col" class="border-none" width="133px">{{ number_format($finalTotalCpl,2) }}</th>
                        </tr>
                    </table>
                </th>                    
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
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
   <div class="container" style="overflow: scroll;max-height: 1000px;">
<table class="table">
    <thead>
    <tr>
        <th scope="col" rowspan="2">Nationality</th>
        @php $colspan =1; @endphp
        @foreach($status as $statu)
        @php $colspan++; @endphp
            <th scope="col">{{  $statu->name }}</th>
        @endforeach
        <th scope="col">Total</th>
    </tr>
    </thead>
    <tbody>
        @if(isset($reportData->project_id))
            @php $grand_total =0;
            $tempArr = array_unique($tempArr);
            @endphp
            @foreach($countries as $country)
                @php $totalCount =0 @endphp
                @php 
                    $temp = App\Contact::where('project_id',$reportData->project_id)
                    ->where('country_id',$country->id)
                    ->whereIn('campaign_country',$tempArr)
                    ->whereBetween('created_at',[ $from,$to ])
                    ->whereNotNull('source');
                    $temp =  $temp->count(); 
                @endphp
                @if($temp > 0)
                <tr class="">
                    <th scope="row" style="background:#eee">{{$country->name}}</th>
                    @foreach($status as $statu)
                        @php $tempOne =0 @endphp
                        <th scope="row">
                            <a href="{{route('admin.home')}}?ADVANCED=search&status_id={{$statu->id}}&country_id={{$country->id}}&project_id={{$reportData->project_id}}&from={{$from}}&to={{$to}}&campaign_country={{implode(',',$tempArr)}}">
                                @php 
                                    $tempOne = App\Contact::where('project_id',$reportData->project_id)
                                    ->where('country_id',$country->id)
                                    ->whereIn('campaign_country',$tempArr)
                                    ->where('status_id',$statu->id)
                                    ->whereBetween('created_at',[ $from,$to ])
                                    ->whereNotNull('source');
                                    $tempOne =  $tempOne->count(); 
                                    $totalCount += $tempOne;
                                @endphp
                                {{ $tempOne }}
                            </a>
                        </th>
                    @endforeach
                    <th scope="row">
                        <a href="{{route('admin.home')}}?ADVANCED=search&status_id=&country_id={{$country->id}}&project_id={{$reportData->project_id}}&from={{$from}}&to={{$to}}&campaign_country={{implode(',',$tempArr)}}">
                            @php $grand_total +=$totalCount @endphp
                            {{ $totalCount }}
                        </a>
                    </th>
                </tr>
                @endif
            @endforeach
            <tr>
                <th  colspan="{{$colspan}}" style="text-align:right;">Grand Total</th>
                <th>{{$grand_total}}</th>
            </tr>
        @endif
        </tbody>
    </table>
    
</div>
</div>
<!--end::Entry-->
</div>
