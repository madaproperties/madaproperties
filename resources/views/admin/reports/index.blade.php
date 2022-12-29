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
  					                         <input value="{{request('from')}}"  type="date"
  																	  
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
  					                         <input value="{{request('to')}}"  type="date" class="form-control form-control-solid date"
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

    @if(isset($advance_campaign_repot))
      @include('admin.reports.advance-campaign-report')
		@elseif(isset($advance_campaign))
			@include('admin.reports.create-advance-campaign')
		@elseif(Request('type') == 'campaing')
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

									@if(userRole() =='admin')
									 <!--  -->
                                   <div class="row">
  								   	<div class="col-md-6 col-sm--12">
  					                  <div class="form-group ">
  					                     <label class="">{{ __('site.country') }}</label>
  					                     <div class="">
  					                       <div class="input-group input-group-solid to-date-el" data-target-input="nearest">
  					                        <select class="form-control" id="country" name="country_id">
  					                        	<option value="">Choose</option>
  					                        	@foreach($countries as $country)
                                                 

                                            <option {{request('country_id') == $country->id ? 'selected' : ''}}
  	                                    value="{{$country->id}}" data-select2-id="{{$country->id}}">{{$country->name_en}}</option>

  					                        	@endforeach
  					                        </select>
  					                       </div>
  					                     </div>
  					                   </div>
  					                </div>
  					                <div class="col-md-6 col-sm--12">
  					                  <div class="form-group ">
  					                     <label class="">{{ __('site.project') }}</label>
  					                     <div class="">
  					                       <div class="input-group input-group-solid to-date-el" data-target-input="nearest">
  					                       <select class="form-control" id="project" name="project_id">
  					                       	<option value="">Choose</option>
  					                       		@foreach($projects as $proj)
  					                       	
                                            <option {{request('project_id') == $proj->id ? 'selected' : ''}}
  	                                    value="{{$proj->id}}" data-select2-id="{{$proj->id}}">{{$proj->name_en}}</option>
                                      

  					                       	@endforeach
  					                       </select>
  					                       </div>
  					                     </div>
  					                   </div>
  					                </div>

  								   </div>
  								   <div class="row">
  								   <div class="col-md-6 col-sm--12">
  					                  <div class="form-group ">
  					                     <label class="">{{ __('site.Leaders') }}</label>
  					                     <div class="">
  					                       <div class="input-group input-group-solid to-date-el" data-target-input="nearest">
  					                       <select class="form-control" id="leader" name="leader_id">
  					                       	<option value="">Choose</option>
  					                       	@foreach($leaders as $lea)
                                            <option {{request('leader_id') == $lea->id ? 'selected' : ''}} value="{{$lea->id}}" data-select2-id="{{$lea->id}}">{{$lea->name}}</option>
  					                       	@endforeach
  					                       </select>
  					                       </div>
  					                     </div>
  					                   </div>
  					                </div>	
  								   </div>
  								   
  								   <div class="form-group">
  								    <label>{{__('site.account')}}</label>
  								    <div class="input-icon">
  								     <select class="form-control " id="users" name="users_id" data-select2-id="" tabindex="-1" aria-hidden="true">
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

                                      <!--  added by  fazal-->
  								   @elseif(userRole()=='sales director')
  								   <div class="row">
  								   	
                                    <div class="col-md-6 col-sm--12">
  					                  <div class="form-group ">
  					                     <label class="">{{ __('site.project') }}</label>
  					                     <div class="">
  					                       <div class="input-group input-group-solid to-date-el"  data-target-input="nearest">
  					                       <select class="form-control" id="project" name="project_id">
  					                       	<option value="">choose</option>
  					                       	@foreach($projects as $proj)
  					                       	
                                            <option {{request('project_id') == $proj->id ? 'selected' : ''}}
  	                                    value="{{$proj->id}}" data-select2-id="{{$proj->id}}">{{$proj->name_en}}</option>
                                      

  					                       	@endforeach
  					                       </select>
  					                       </div>
  					                     </div>
  					                   </div>
  					                </div>

  								   
  								   <div class="col-md-6 col-sm--12">
  					                  <div class="form-group ">
  					                     <label class="">{{ __('site.Leaders') }}</label>
  					                     <div class="">
  					                       <div class="input-group input-group-solid to-date-el"  data-target-input="nearest">
  					                       <select class="form-control" id="leader" name="leader_id" >
  					                       	<option value="">choose</option>
  					                       	@foreach($leaders as $lea)
                                            <option {{request('leader_id') == $lea->id ? 'selected' : ''}} value="{{$lea->id}}" data-select2-id="{{$lea->id}}">{{$lea->name}}</option>
  					                       	@endforeach
  					                       </select>
  					                       </div>
  					                     </div>
  					                   </div>
  					                </div>	
  								   </div>
  								   
  								   <div class="form-group">
  								    <label>{{__('site.account')}}</label>
  								    <div class="input-icon">
  								     <select class="form-control " id="users" name="users_id" data-select2-id="" tabindex="-1" aria-hidden="true">
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
  								   <!-- admin uae -->
  								   @elseif(userRole()=='sales admin saudi')
  								   <div class="row">
  								   	
                                    <div class="col-md-6 col-sm--12">
  					                  <div class="form-group ">
  					                     <label class="">{{ __('site.project') }}</label>
  					                     <div class="">
  					                       <div class="input-group input-group-solid to-date-el"  data-target-input="nearest">
  					                       <select class="form-control" id="project" name="project_id">
  					                       	<option value="">choose</option>
  					                       	@foreach($projects as $proj)
  					                       	
                                            <option {{request('project_id') == $proj->id ? 'selected' : ''}}
  	                                    value="{{$proj->id}}" data-select2-id="{{$proj->id}}">{{$proj->name_en}}</option>
                                      

  					                       	@endforeach
  					                       </select>
  					                       </div>
  					                     </div>
  					                   </div>
  					                </div>

  								   
  								   <div class="col-md-6 col-sm--12">
  					                  <div class="form-group ">
  					                     <label class="">{{ __('site.Leaders') }}</label>
  					                     <div class="">
  					                       <div class="input-group input-group-solid to-date-el" data-target-input="nearest">
  					                       <select class="form-control" id="leader" name="leader_id" >
  					                       	<option value="">choose</option>
  					                       	@foreach($leaders as $lea)
                                            <option {{request('leader_id') == $lea->id ? 'selected' : ''}} value="{{$lea->id}}" data-select2-id="{{$lea->id}}">{{$lea->name}}</option>
  					                       	@endforeach
  					                       </select>
  					                       </div>
  					                     </div>
  					                   </div>
  					                </div>	
  								   </div>
  								   
  								   <div class="form-group">
  								    <label>{{__('site.account')}}</label>
  								    <div class="input-icon">
  								     <select class="form-control " id="users" name="users_id" data-select2-id="" tabindex="-1" aria-hidden="true">
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
  								   <!-- end  -->
  								   <!-- adimin saudi -->
  								   @elseif(userRole()=='sales admin uae')
  								   <div class="row">
  								   	
                                    <div class="col-md-6 col-sm--12">
  					                  <div class="form-group ">
  					                     <label class="">{{ __('site.project') }}</label>
  					                     <div class="">
  					                       <div class="input-group input-group-solid to-date-el" data-target-input="nearest">
  					                       <select class="form-control" id="project" name="project_id">
  					                       	<option value="">choose</option>
  					                       	@foreach($projects as $proj)
  					                       	<option {{request('project_id') == $proj->id ? 'selected' : ''}}
  	                                    value="{{$proj->id}}" data-select2-id="{{$proj->id}}">{{$proj->name_en}}</option>
                                           @endforeach
  					                       </select>
  					                       </div>
  					                     </div>
  					                   </div>
  					                </div>

  								   
  								   <div class="col-md-6 col-sm--12">
  					                  <div class="form-group ">
  					                     <label class="">{{ __('site.Leaders') }}</label>
  					                     <div class="">
  					                       <div class="input-group input-group-solid to-date-el" data-target-input="nearest">
  					                       <select class="form-control" id="leader" name="leader_id" >
  					                       	<option value="">choose</option>
  					                       	@foreach($leaders as $lea)
                                            <option {{request('leader_id') == $lea->id ? 'selected' : ''}} value="{{$lea->id}}" data-select2-id="{{$lea->id}}">{{$lea->name}}</option>
  					                       	@endforeach
  					                       </select>
  					                       </div>
  					                     </div>
  					                   </div>
  					                </div>	
  								   </div>
  								   
  								   <div class="form-group">
  								    <label>{{__('site.account')}}</label>
  								    <div class="input-icon">
  								     <select class="form-control " id="users" name="users_id" data-select2-id="" tabindex="-1" aria-hidden="true">
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
  								   <!-- end added by fazal -->

                               

    					           @elseif(userRole() != 'sales')
    					          
  								   <div class="form-group">
  								    <label>{{__('site.account')}}</label>
  								    <div class="input-icon">
  								     <select class="form-control " id="users" name="users_id" data-select2-id="" tabindex="-1" aria-hidden="true">
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

								    @endif

  								   <div class="row">
  								   	<div class="col-md-6 col-sm--12">
  					                  <div class="form-group ">
  					                     <label class="">{{ __('site.from') }} </label>
  					                     <div class="">
  					                       <div class="input-group input-group-solid date"
                                   id="from-date" data-target-input="nearest">
  					                         <input value="{{request('from')}}"  type="text"
  																	  max="{{date('Y-m-d')}}"
  																	 class="form-control form-control-solid date"
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
  					                         <input value="{{request('to')}}"  type="text" class="form-control form-control-solid date"
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
  							

							@if($allUsersReport)
								@include('admin.reports.allUsersReport')
							 <!-- added by fazal -->
							@elseif($leader != 0 || userRole()=='sales director')
  					        @include('admin.reports.allLeaderUser')

  					        
							@elseif(userRole()=='sales' || (request()->has('from') && request()->has('to')))
  							<!--start: Datatable-->
  							
  						<div class="card-body" style="background:#fff;margin:10px 0">
  							<!--begin: Datatable-->
  								<div class="row">
  									<div class="col-lg-12">
  										<!--begin::Card-->
  										<div class="table-responsive">
  											<h4>
  												{{__('site.contacts')}}
  											</h4>
  										  <table class="table" style="background:#f4f4f4">
  												<thead>
  													<tr>
  														@foreach($status as $state)
  															<th>{{$state->name}}</th>
  														@endforeach
															<th>Total</th>
  													</tr>
  												</thead>
  												 <tbody>
  													 <tr>
														 @php 			
														 $from = date('Y-m-d 00:00:00', strtotime(Request('from')));
															$to = date('Y-m-d 23:59:59', strtotime(Request('to')));
															$finalTotal = 0;
															@endphp
  														 @foreach($status as $state)
   															<th scope="row">
  																<a href="{{route('admin.home')}}?ADVANCED=search&user_id={{$user->id}}&status_id={{$state->id}}&from={{Request('from')}}&to={{Request('to')}}">
																		@php
																		$totalLead = App\Contact::where('status_id',$state->id)
																			->where('user_id',$user->id)
																			->whereBetween('created_at',[ $from,$to ])
																			->count();
																		$finalTotal += $totalLead;
																		@endphp
																		{{ $totalLead }}
  																</a>
  															</th>
   														@endforeach
															 <th>
																<a href="{{route('admin.home')}}?ADVANCED=search&user_id={{$user->id}}&status_id=&from={{Request('from')}}&to={{Request('to')}}">
																{{$finalTotal}}
															</th>
  													 </tr>
  													</tbody>
  										  </table>
  										</div>
  										<!--end::Card-->
  									</div>

  								</div>
  							<!--end: Datatable-->
  							</div>

												
								<div class="card-body">
  								<div class="card card-custom" style="padding:20px">
  								<h4>
  									<a class="btn btn-success" href="{{route('admin.users-report')}}?type=users">{{__('site.Reset')}}</a>
  								</h4>
  								<!--begin: Datatable-->
  								<p>{{__('site.from')}}: [{{ request('from') }}]  {{__('site.to')}} [{{ request('to') }}]
  								<div class="table-responsive">
  								<table class="table table-separate table-head-custom table-checkable " id="kt_datatable1">
  									<thead>
  										<tr>
  											<th>{{__('site.actvity')}} & {{__('site.status')}}</th>
  											<th>{{__('site.total')}}</th>
  										</tr>
  									</thead>
  									<tbody>
  										<tr>
  											<td>Call</td>
												@php
													$call = $activities->where('type','call')->count();
													$meeting = $activities->where('type','meeting')->count();
													$whatsapp = $activities->where('type','whatsapp')->count();
													$email = $activities->where('type','email')->count();
												@endphp
  											<td>{{ $call}}</td>
  										</tr>
  										<tr>
  											<td>Meeting</td>
  											<td>{{ $meeting}}</td>
  										</tr>
  										<tr>
  											<td>WhatsApp</td>
  											<td>{{ $whatsapp}}</td>
  										</tr>
  										<tr>
  											<td>Email</td>
  											<td>{{ $email}}</td>
  										</tr>
  									
  										<tr>
  											<th>Total</th>
  											<td>{{ $call + $meeting + $whatsapp + $email }}</td>
  										</tr>
  									


  									</tbody>
  								</table>
  								<!--end: Datatable-->
  							</div>
  							</div>
  						</div>
							@if(count($two_week_report))
									<!--start: Datatable-->
								<div class="card-body" style="background:#fff;margin:10px 0">
									<!--begin: Datatable-->
										<div class="row">
											<div class="col-lg-12">
												<!--begin::Card-->
												<div class="table-responsive">
													<h4>
													{{'Last 2 week leads'}}
													</h4>
													<table class="table" style="background:#f4f4f4">
														<thead>
															<tr>
																@foreach($status as $state)
																	<th>{{$state->name}}</th>
																@endforeach
																<th>Total</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																@php
																$finalTotal = 0;
																@endphp
																@foreach($status as $state)
																	<th scope="row">
																		<a href="{{route('admin.home')}}?ADVANCED=search&user_id={{$user->id}}&status_id={{$state->id}}&last_update_from={{$last14days}}">
																		@php
																		$leadTotal = $two_week_report->where('status_id',$state->id)->count();
																		$finalTotal += $leadTotal;
																		@endphp
																		{{$leadTotal}}
																		</a>
																	</th>
																@endforeach
																<th>
																	<a href="{{route('admin.home')}}?ADVANCED=search&user_id={{$user->id}}&status_id=&last_update_from={{$last14days}}">
																	{{$finalTotal}}
																</th>

															</tr>
															</tbody>
													</table>
												</div>
												<!--end::Card-->
											</div>

										</div>
									<!--end: Datatable-->
									</div>
								@endif																

							@if(count($status_not_changed_after_1_week))
									<!--start: Datatable-->
								<div class="card-body" style="background:#fff;margin:10px 0">
									<!--begin: Datatable-->
										<div class="row">
											<div class="col-lg-12">
												<!--begin::Card-->
												<div class="table-responsive">
													<h4>
													{{'2 week have passed and the status has not changed'}}
													</h4>
													<table class="table" style="background:#f4f4f4">
														<thead>
															<tr>
																@foreach($status as $state)
																	<th>{{$state->name}}</th>
																@endforeach
																<th>Total</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																@php
																$finalTotal = 0;
																@endphp
																@foreach($status as $state)
																	<th scope="row">
																		<a href="{{route('admin.home')}}?ADVANCED=search&user_id={{$user->id}}&status_id={{$state->id}}&last_update_to={{$last14days}}">
																		@php
																		$leadTotal = $status_not_changed_after_1_week->where('status_id',$state->id)->count();
																		$finalTotal += $leadTotal;
																		@endphp
																		{{$leadTotal}}
																		</a>
																	</th>
																@endforeach
																<th>
																	<a href="{{route('admin.home')}}?ADVANCED=search&user_id={{$user->id}}&status_id=&last_update_to={{$last14days}}">
																	{{$finalTotal}}
																</th>

															</tr>
															</tbody>
													</table>
												</div>
												<!--end::Card-->
											</div>

										</div>
									<!--end: Datatable-->
									</div>
								@endif

  							@endif <!-- end  -->
                            
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
  					                     <label class="">{{ __('site.from1') }} </label>
  					                    
  					                       <div class="input-group input-group-solid date" id="" data-target-input="nearest">
  					                         <input value="{{request('from')}}"  type="date"
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
  					                         <input value="{{request('to')}}"  type="date"
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
 <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
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
  
  $(document).ready(function () {
            $('#country').on('change', function () {
                var idCountry = this.value;
       
                $.ajax({
                    url: "{{url('fetch-project')}}",
                    type: "POST",
                    data: {
                        country_id: idCountry,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#project').html('<option value="">Select project</option>');

                        $.each(result.project, function (key, value) {
                            $("#project").append('<option value="' + value
                                .id + '">' + value.name_en + '</option>');
                        });
                        $('#leader').html('<option value="">Select leader</option>');
                        $.each(result.leaders, function (key, value) {

                            $("#leader").append('<option value="' + value
                                .id + '">' + value.email + '</option>');
                        });
                        $.each(result.director, function (key, value) {

                            $("#leader").append('<option value="' + value
                                .id + '">' + value.email + '</option>');
                        });

                        
                    }
                });
            }); 
        // 
         $('#leader').on('change', function () {
                var leader_id = this.value;

                $.ajax({
                    url: "{{url('fetch-agent')}}",
                    type: "POST",
                    data: {
                       leader_id : leader_id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#users').html('<option value="">choose</option>');

                        $.each(result.agents, function (key, value) {
                            $("#users").append('<option value="' + value
                                .id + '">' + value.email + '</option>');
                        });
                        
                       
                        
                    }
                });
            });
        // 


           });

  
  
  var date = new Date() ;
   date.setDate(date.getDate()-1)

  $('.date').datetimepicker({
      format: 'L'
      //minDate:date
  });

//   $(`#to-date`).datetimepicker({
//       format: 'L'
//       //minDate:new Date()
//   });

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
