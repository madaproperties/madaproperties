<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
<!--begin::Entry-->
<div class="">
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
@foreach($campaings as $campaing)
@php
  $totalCount = App\Contact::where(function ($q) use ($users){

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
                      })->where('campaign',$campaing->name);
                    if(Request('country') && !empty(request('country'))){
                        $totalCount = $totalCount->where('country_id',request('country'));
                    }
                    if(Request('source') && !empty(request('source'))){
                        $totalCount = $totalCount->where('source',request('source'));
                    }
                    if(Request('city') && !empty(request('city'))){
                        $totalCount = $totalCount->where('city_id',request('city'));
                    }
                    if(Request('project_id') && !empty(request('project_id'))){
                        $totalCount = $totalCount->where('project_id',request('project_id'));
                    }
                    
                    if(Request('from') && Request('to')){
                        $from = date('Y-m-d 00:00:00', strtotime(Request('from')));
                        $to = date('Y-m-d 23:59:59', strtotime(Request('to')));
                        $totalCount = $totalCount->whereBetween('created_at',[$from,$to]);
                    }else{   
                        if(Request('from')){
                            $from = date('Y-m-d 00:00:00', strtotime(Request('from')));
                            $totalCount = $totalCount->where('created_at','>=', $from);
                        }   
                        if(Request('to')){
                            $to = date('Y-m-d 23:59:59', strtotime(Request('to')));
                            $totalCount = $totalCount->where('created_at','<=',$to);
                        }            
                    }



                $totalCount = $totalCount->count();
@endphp
<tr class="{{ $totalCount == '0' ? 'd-none' : ''}}">

       <th scope="row" style="background:#eee">{{$campaing->name }}</th>

          @foreach($status as $statu)
          <th scope="row">
            <a href="{{route('admin.home')}}?status={{$statu->id}}&campaign={{$campaing->name}}">
              <!---
<a class="text-dark"
href="{{route('admin.home')}}?status={{$statu->id}}&campaign={{ $campaing->name}}"> -->
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
                })->
                where('campaign',$campaing->name)
                ->where('status_id',$statu->id);
                if(Request('country') && !empty(request('country'))){
                    $tempOne = $tempOne->where('country_id',request('country'));
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
        @endphp
    {{ $tempOne }}
<!-- </a> -->
</a>
</th>

@endforeach
<th scope="row">
<a href="{{route('admin.home')}}?status=&campaign={{$campaing->name}}">
{{ $totalCount }}
</a>
</th>
</tr>
@endforeach

            </tbody>
            {{$campaings->withQueryString()->links()}}
            </table>
            {{$campaings->withQueryString()->links()}}
        </div>
</div>
<!--end::Entry-->
</div>
