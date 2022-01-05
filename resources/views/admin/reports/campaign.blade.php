<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
   <div class="container">


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
                              return $q->whereIn('user_id',$users)
                              ->orWhereIn('created_by',$users)
                              ->get();
                          }else if(userRole() == 'sales admin uae') {
                            return $q->whereHas('project', function($q2) {
                                $q2->where('projects.country_id','2');
                            })->get();

                            }else if(userRole() == 'sales admin saudi'){
                            return $q->whereHas('project', function($q2) {
                                $q2->where('projects.country_id','1');
                            })->get();
                        }
                      })->
                      where('campaign',$campaing->name)
                      ->count();
@endphp
<tr class="{{ $totalCount == '0' ? 'd-none' : ''}}">

       <th scope="row" style="background:#eee">{{$campaing->name }}</th>

          @foreach($status as $statu)
          <th scope="row">
            <a href="{{route('admin.home')}}?status={{$statu->id}}&campaign={{$campaing->name}}">
              <!---
<a class="text-dark"
href="{{route('admin.home')}}?status={{$statu->id}}&campaign={{ $campaing->name}}"> -->
  {{ App\Contact::where(function ($q) use ($users){

                    if(userRole() == 'leader')
                    {
                        return $q->whereIn('user_id',$users)
                                ->orWhereIn('created_by',$users)
                                ->get();
                    }else if(userRole() == 'sales admin uae') {
                        return $q->whereHas('project', function($q2) {
                            $q2->where('projects.country_id','2');
                        })->get();

                    }else if(userRole() == 'sales admin saudi'){
                        return $q->whereHas('project', function($q2) {
                            $q2->where('projects.country_id','1');
                        })->get();
                    }
                })->
                where('campaign',$campaing->name)
                ->where('status_id',$statu->id)
                ->count() }}
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
<th scope="row" style="background:#eee">
No campaign
</th>

   @foreach($status as $statu)
          <th scope="row">
            <a href="{{route('admin.home')}}?status={{$statu->id}}&campaign=">
              {{ App\Contact::where(function ($q) use ($users){

                                if(userRole() == 'leader')
                                {
                      return $q->whereIn('user_id',$users)
                                ->orWhereIn('created_by',$users)
                                ->get();
                                }else if(userRole() == 'sales admin uae') {
                                    return $q->whereHas('project', function($q2) {
                                        $q2->where('projects.country_id','2');
                                    })->get();

                                }else if(userRole() == 'sales admin saudi'){
                                    return $q->whereHas('project', function($q2) {
                                        $q2->where('projects.country_id','1');
                                    })->get();
                                }
                            })->where('campaign',null)
                            ->where('status_id',$statu->id)
                            ->count() }}
              </a>
          </th>
  @endforeach

     <th scope="row">
       <a href="{{route('admin.home')}}?status=&campaign=">
              {{ App\Contact::where('campaign',null)
                            ->where(function ($q) use ($users) {

                                if(userRole() == 'leader')
                                {
                            return $q->whereIn('user_id',$users)
                                    ->orWhereIn('created_by',$users)
                                 ->get();
                                }else if(userRole() == 'sales admin uae') {
                                    return $q->whereHas('project', function($q2) {
                                        $q2->where('projects.country_id','2');
                                    })->get();

                                }else if(userRole() == 'sales admin saudi'){
                                    return $q->whereHas('project', function($q2) {
                                        $q2->where('projects.country_id','1');
                                    })->get();
                               }
                            })
                            ->count() }}
              </a>
          </th>

            </tbody>
          </table>
        </div>
</div>
<!--end::Entry-->
</div>
