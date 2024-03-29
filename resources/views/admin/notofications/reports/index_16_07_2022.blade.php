@push('css')
    <style>
        @media(max-width: 775px)
        {
            .container
            {
                margin-top:180px;
            }
        }
    </style>
@endpush
@extends('admin.layouts.main')
@section('content')

	@if(request()->has('type') AND request('type') == 'leaders')
	<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
  		<!--begin::Entry-->
  		<div class="d-flex flex-column-fluid">
  		   <div class="container">
  							<!--start: Datatable-->
  							<div class="card-body">
  								<div class="card card-custom" style="padding:20px">
  								    
  								    <form action="" method="get">
  								        <input type="hidden" name="type" value="leaders" />
  								        
  								         <div class="row">
  								   	<div class="col-md-6 col-sm--12">
  					                  <div class="form-group ">
  					                     <label class="">{{ __('site.from') }} </label>
  					                     <div class="">
  					                       <div class="input-group input-group-solid date"
                                   id="from-date" data-target-input="nearest">
  					                         <input value="{{request('from')}}" required type="date"
  																	  
  																	 class="form-control form-control-solid "
  					                        
  					                          name="from" >
  					                          
  					                        
  					                       </div>
  					                     </div>
  					                   </div>
  					                </div>
  					                
  					                <div class="col-md-6 col-sm--12">
  					                  <div class="form-group ">
  					                     <label class="">{{ __('site.to') }}</label>
  					                     <div class="">
  					                       <div class="input-group input-group-solid ">
  					                         <input value="{{request('to')}}" required type="date" class="form-control form-control-solid "
  					                         data-toggle=""
  																	
  					                          name="to" >
  					                         
  					                         </div>
  					                         </div>
  					                       </div>
  					                     </div>
  					                   </div>
  					                </div>
  					                
  					                	<button type="submit" class="btn btn-primary mr-2">{{__('site.Search')}}</button>

  								   </div>
  								    </form>
  							
  								
  								<div class="table-responsive">
  								<table class="table table-separate table-head-custom table-checkable " id="kt_datatable1">
  									<thead>
  										<tr>
  											<th>leader </th>
  											<th>Leads Count</th>
  										</tr>
  									</thead>
  									<tbody>
  										<tr>
  									    @foreach($leaders as $lead)
  											<td>{{$lead->email}}</td>
  											<td>{{$lead->count }}</td>
  										</tr>
  										@endforeach



  									</tbody>
  								</table>
  								<!--end: Datatable-->
  							</div>
  							</div>
  						</div>
  						</div>
  						</div>
  						</div>
  						@endif



    @if(Request('type') == 'campaing-analytics')
      @include('admin.reports.campainganalytics')
    @endif

    @if(Request('type') == 'campaing')
      @include('admin.reports.campaign')
   @else
	<!--end::Content-->


	  @if(request()->has('type') AND request('type') == 'users')
  	<!--begin::Content-->
  	<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
  		<!--begin::Entry-->
  		<div class="d-flex flex-column-fluid">
  		   <div class="container">
  				 <!--begin::Card-->
  					<div class="card card-custom gutter-b">
  						<div class="card-header flex-wrap border-0 pt-6 pb-0">
  							<div class="card-title">
  								<h3 class="card-label">{{ __('site.reports') }}
  							</div>
  						</div>

  						<div class="card-body">
  							<!--begin: Datatable-->
  							<div class="card card-custom">
  							 <!--begin::Form-->
  							 <form action="" class="form" action="get" id="search-form">
  								  <div class="card-body">

                      <input type="hidden" name="type" value="users" />

  								   <div class="form-group">
  								    <label>{{__('site.account')}}</label>
  								    <div class="input-icon">
  								     <select class="form-control " id="users" required
                                             name="users_id" data-select2-id="" tabindex="-1" aria-hidden="true">
  										<option value="">{{ __('site.choose') }}</option>
  	                                   @foreach($users as $choosedUser)
  	        							<option
  	                                    {{request('users_id') == $choosedUser->id ? 'selected' : ''}}
  	                                    value="{{$choosedUser->id}}" data-select2-id="{{$choosedUser->id}}">{{$choosedUser->name}}</option>
  	                                    @endforeach
          							</select>
  								     <span><i class="flaticon2-search-1 icon-md"></i></span>
  								    </div>
  								   </div>

  								   <div class="row">
  								   	<div class="col-md-6 col-sm--12">
  					                  <div class="form-group ">
  					                     <label class="">{{ __('site.from') }} </label>
  					                     <div class="">
  					                       <div class="input-group input-group-solid date"
                                   id="from-date" data-target-input="nearest">
  					                         <input value="{{request('from')}}" required type="text"
  																	  max="{{date('Y-m-d')}}"
  																	 class="form-control form-control-solid datetimepicker-input"
  					                         data-toggle="datetimepicker"
  					                          name="from" data-target="#from-date" autocomplete="off">
  					                         <div class="input-group-append" data-target="#from-date" data-toggle="datetimepicker">
  					                           <span class="input-group-text">
  					                             <i class="ki ki-calendar"></i>
  					                           </span>
  					                         </div>
  					                       </div>
  					                     </div>
  					                   </div>
  					                </div>
  					                <div class="col-md-6 col-sm--12">
  					                  <div class="form-group ">
  					                     <label class="">{{ __('site.to') }}</label>
  					                     <div class="">
  					                       <div class="input-group input-group-solid date to-date-el" id="to-date" data-target-input="nearest">
  					                         <input value="{{request('to')}}" required type="text" class="form-control form-control-solid datetimepicker-input"
  					                         data-toggle="datetimepicker"
  																	 min="{{date('Y/m/d')}}"
  					                          name="to" data-target="#to-date" autocomplete="off">
  					                         <div class="input-group-append" data-target="#to-date" data-toggle="datetimepicker" >
  					                           <span class="input-group-text">
  					                             <i class="ki ki-calendar"></i>
  					                           </span>
  					                         </div>
  					                       </div>
  					                     </div>
  					                   </div>
  					                </div>

  								   </div>

  							   		<button type="submit" class="btn btn-primary mr-2">{{__('site.Search')}}</button>
  								  </div>
  							 </form>

  							 <!--end::Form-->
  							</div>

  							@if(request()->has('from') 
  							AND request()->has('to') 
  							AND request()->has('users_id') )
  							<!--start: Datatable-->
  							<div class="card-body">
  								<div class="card card-custom" style="padding:20px">
  								<h4>
  									<a class="btn btn-success" href="?">{{__('site.Reset')}}</a>
  								</h4>
  								<!--begin: Datatable-->
  								<p>{{__('site.from')}}: [{{ request('from') }}]  {{__('site.to')}} [{{ request('to') }}]
  								<div class="table-responsive">
  								<table class="table table-separate table-head-custom table-checkable " id="kt_datatable1">
  									<thead>
  										<tr>
  											<th>{{__('site.actvity')}} & {{__('site.status')}}</th>
  											<th>{{__('site.target')}}</th>
  											@foreach($report_dates as $date)
  												<th>{{ str_replace('00:00:00','',$date) }}</th>
  											@endforeach
  											<th>{{__('site.total')}}</th>
  											<th>{{__('site.variance')}}</th>
  											<th>{{__('site.variance')}}%</th>
  										</tr>
  									</thead>
  									<tbody>
  										<tr>
  											<td>Call</td>
  											<td>{{ $user->target_call  * count($report_dates) - ($weekends * $user->target_call) }}</td>
  											@foreach($report_dates as $date)
  											<td>{{ $activities->where('date',$date)->where('type','call')->count() }}</td>
  											@endforeach
  											<td>{{ $activities->where('type','call')->count()}}</td>
  											<td>{{ ($user->target_call * count($report_dates)) - $activities->where('type','call')->count() }}</td>
  											<td>{{ getvariance($activities->where('type','call')->count(),$user->target_call) }}</td>
  										</tr>
  										<tr>
  											<td>Meeting</td>
  											<td>{{ $user->target_meeting  * count($report_dates) - ($weekends * $user->target_meeting)}}</td>
  											@foreach($report_dates as $date)
  											<td>{{ $activities->where('date',$date)->where('type','meeting')->count() }}</td>
  											@endforeach
  											<td>{{ $activities->where('type','meeting')->count()}}</td>
  											<td>{{ ($user->target_meeting * count($report_dates)) - $activities->where('type','meeting')->count() }}</td>
  											<td>{{ getvariance($activities->where('type','meeting')->count(),$user->target_meeting) }}</td>
  										</tr>
  										<tr>
  											<td>whatsupp</td>
  											<td>{{ $user->target_whatsapp * count($report_dates) - ($weekends * $user->target_whatsapp)}}</td>
  											@foreach($report_dates as $date)
  											<td>{{ $activities->where('date',$date)->where('type','whatsapp')->count() }}</td>
  											@endforeach
  											<td>{{ $activities->where('type','whatsapp')->count()}}</td>
  											<td>{{ ($user->target_whatsapp * count($report_dates)) - $activities->where('type','whatsapp')->count() }}</td>
  											<td>{{ getvariance($activities->where('type','whatsapp')->count(),$user->target_whatsapp) }}</td>
  										</tr>
  										<tr>
  											<td>Email</td>
  											<td>{{ $user->target_email * count($report_dates) - ($weekends * $user->target_email) }}</td>
  											@foreach($report_dates as $date)
  											<td>{{ $activities->where('date',$date)->where('type','email')->count() }}</td>
  											@endforeach
  											<td>{{ $activities->where('type','email')->count()}}</td>
  											<td>{{ ($user->target_email * count($report_dates)) - $activities->where('type','email')->count() }}</td>
  											<td>{{ getvariance($activities->where('type','email')->count(),$user->target_email) }}</td>

  										</tr>
  										@foreach($status as $state)
  										<tr>
  											<td>#{{$state->name}}</td>
  											<td>*</td>
  											@foreach($report_dates as $date)
  											<td>{{$user_contacts->where('created_at',$date)->where('status_id',$state->id)->count()}}</td>
  											@endforeach
  											<td>*</td>
  											<td>*</td>
  											<td>*</td>
  										</tr>
  										@endforeach



  									</tbody>
  								</table>
  								<!--end: Datatable-->
  							</div>
  							</div>
  						</div>
  						@if($status_not_changed_after_48_hours)
  						<div class="card-body" style="background:#fff;margin:10px 0">
  							<!--begin: Datatable-->
  								<div class="row">
  									<div class="col-lg-12">
  										<!--begin::Card-->
  										<div class="table-responsive">
  											<h4>
  												{{__('site.48 hours have passed and the status  has not changed')}}
  											</h4>
  										  <table class="table" style="background:#f4f4f4">
  												<thead>
  													<tr>
  														@foreach($status as $state)
  															<th>{{$state->name}}</th>
  														@endforeach
  													</tr>
  												</thead>
  												 <tbody>
  													 <tr>
  														 @foreach($status as $state)
   															<th scope="row">
  																<a href="{{route('admin.')}}?user={{$user->id}}&status={{$state->id}}">
  																	{{$status_not_changed_after_48_hours->where('status_id',$state->id)->count()}}
  																</a>
  															</th>
   														@endforeach
  													 </tr>
  													</tbody>
  										  </table>
  										</div>
  										<!--end::Card-->
  									</div>

  								</div>
  							<!--end: Datatable-->
  							</div>
  							@endif <!-- end  -->
  						@endif

  						</div>
  					</div>
  					@endif

  			 @if(request()->has('type') AND request('type') == 'report')
  	<!--begin::Content-->
  	<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
  		<!--begin::Entry-->
  		<div class="d-flex flex-column-fluid">
  		   <div class="container">
  				 <!--begin::Card-->
  					<div class="card card-custom gutter-b">
  						<div class="card-header flex-wrap border-0 pt-6 pb-0">
  							<div class="card-title">
  								<h3 class="card-label">{{ __('site.reports') }}
  							</div>
  						</div>
							<div class="card-body">
  			         
  			         
  							<!--begin: Datatable-->
  							<div class="card card-custom">
  							 <!--begin::Form-->
  							 <form action="" class="form" action="get" >
  								  <div class="card-body">

                      <input type="hidden" name="type" value="report" />



  								   <div class="row">
  								       
			  								   	<div class="col-md-6 col-sm--12">
  					                  <div class="form-group ">
  					                     <label class="">{{ __('site.from') }} </label>
  					                    
  					                       <div class="input-group input-group-solid date" id="" data-target-input="nearest">
  					                         <input value="{{request('from')}}" required type="date"
  										 max="{{date('Y-m-d')}}"  class="form-control form-control-solid "
  					                          name="from" autocomplete="off">
  					                     		</div>
  					                   </div>
  					                </div>
  					                <div class="col-md-6 col-sm--12">
  					                  <div class="form-group ">
  					                     <label class="">{{ __('site.to') }} </label>
  					                     <div class="">
  					                       <div class="input-group input-group-solid date"  data-target-input="nearest">
  					                         <input value="{{request('to')}}" required type="date"
  										 max="{{date('Y-m-d')}}"
  																	 class="form-control form-control-solid "
  					                          name="to" autocomplete="off">
  					                         
  					                       </div>
  					                     </div>
  					                   </div>
  					                </div>
													</div>

  								   </div>

  							   		<button type="submit" class="btn btn-primary mr-2">{{__('site.Search')}}</button>
  								  </div>
  							 </form>

  							 <!--end::Form-->
								 </div>
	 						</div>
							 </div>
	 						</div>
							 </div>
	 						</div>
	 						</div>
  					<!--end::Card-->
  				@if($canvas)
  					<div class="card-body" style="background:#fff">
  						<!--begin: Datatable-->
  							<div class="row">
  								<div class="col-lg-12">
  									<!--begin::Card-->
  									<canvas height="200vh" id="line-chart" width="400" height="400"></canvas>
  									<!--end::Card-->
  								</div>

  							</div>
  						<!--end: Datatable-->
  					</div>
  					@endif
  				</div>
  			@endif

         </div>
  		</div>
  		<!--end::Entry-->
  	</div>
  	<!--end::Content-->
    @endif
    
    
    
@endsection
@push('js')
<script src="{{ asset('public/assets/js/pages/crud/forms/widgets/select2.js') }}"></script>
<script>

  $(document).on('submit','#search-form', function (e){
    // let from = $('#from-datefrom-date').val();
    // let to = $('#to-date-input').val();
    // if(from < to)
    // {
    //   return true;
    // }else{
    //   alert('Please Choose Correct Date !');
    //   return false;
    // }
  });
  
  

  
  var date = new Date() ;
   date.setDate(date.getDate()-1)

  $(`#from-date`).datetimepicker({
      format: 'L'
      //minDate:date
  });

  $(`#to-date`).datetimepicker({
      format: 'L'
      //minDate:new Date()
  });

</script>
  @if(!empty($sources))
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.1/chart.min.js" integrity="sha512-5vwN8yor2fFT9pgPS9p9R7AszYaNn0LkQElTXIsZFCL7ucT8zDCAqlQXDdaqgA1mZP47hdvztBMsIoFxq/FyyQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

      @if(!Request('campaing'))
              <script>

              let colors = ['#00ffa1','red','blue'];
              let i = 0;

              new Chart(document.getElementById("line-chart"), {
                type: 'line',
                data: {
                  labels: {!! $created_at_dats !!},
                  datasets: [
                 		@foreach($sources as $soruce => $data )
              	    {
              	        data: [
              		     	{{implode(',',$data->data)}}
              		     ]
              	        ,
              	        label: "{{$soruce}}",
              	        borderColor: colors[i++],
              	        fill: false
              	      },
              	    @endforeach
                  ]
                },
                options: {
                  title: {
                    display: true,
                    text: 'World population per region (in millions)'
                  }
                }
              });

          </script>
      @endif
  @endif
@endpush
