<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
   <div class="container">
   @include('admin.reports.advance_search')
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        @foreach($status as $statu)
            <th scope="col">{{  $statu->name }}</th>
        @endforeach
        <th scope="col">Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach($projects_data as $campaing)
    @php $totalCount =0 @endphp
    <tr class="">
       <th scope="row" style="background:#eee">{{$campaing->name_en }}</th>
          @foreach($status as $statu)
          @php $tempOne =0 @endphp
          <th scope="row">
            <a href="{{route('admin.home')}}?ADVANCED=search&status_id={{$statu->id}}&project_id={{$campaing->id}}&project_country_id={{Request('project_country_id')}}&country_id={{Request('country_id')}}&source={{Request('source')}}&from={{Request('from')}}&to={{Request('to')}}">
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
                })->where('project_id',$campaing->id)->where('status_id',$statu->id);
                if(Request('country_id') && !empty(request('country_id'))){
                    $tempOne = $tempOne->where('country_id',request('country_id'));
                }
                if(Request('project_country_id') && !empty(request('project_country_id'))){
                    $value = Request('project_country_id');
                    $tempOne = $tempOne->whereHas('project', function($q2) use($value) {
                        $q2->where('projects.country_id',$value);
                    });
                }

                if(Request('source') && !empty(request('source'))){
                    $tempOne = $tempOne->where('source',request('source'));
                }
                if(Request('city') && !empty(request('city'))){
                    $tempOne = $tempOne->where('city_id',request('city'));
                }
                if(Request('project_id') && !empty(request('project_id'))){
                    $tempOne = $tempOne->where('project_id',request('project_id'));
                }

                if(Request('from') && Request('to')){
                    $from = date('Y-m-d 00:00:00', strtotime(Request('from')));
                    $to = date('Y-m-d 23:59:59', strtotime(Request('to')));
                    $tempOne = $tempOne->whereBetween('created_at',[$from,$to]);
                }else{   
                    if(Request('from')){
                        $from = date('Y-m-d 00:00:00', strtotime(Request('from')));
                        $tempOne = $tempOne->where('created_at','>=', $from);
                    }   
                    if(Request('to')){
                        $to = date('Y-m-d 23:59:59', strtotime(Request('to')));
                        $tempOne = $tempOne->where('created_at','<=',$to);
                    }            
                }

                $tempOne =  $tempOne->count(); 
                $totalCount += $tempOne;
        @endphp
    {{ $tempOne }}
<!-- </a> -->
</a>
</th>

@endforeach
<th scope="row">
<a href="{{route('admin.home')}}?ADVANCED=search&status_id=&project_id={{$campaing->id}}&country_id={{Request('country_id')}}&project_country_id={{Request('project_country_id')}}&source={{Request('source')}}&from={{Request('from')}}&to={{Request('to')}}">
{{ $totalCount }}
</a>
</th>
</tr>
@endforeach

            </tbody>
            {{$projects_data->withQueryString()->links()}}
            </table>
        {{$projects_data->withQueryString()->links()}}
            
        </div>
</div>
<!--end::Entry-->
</div>
