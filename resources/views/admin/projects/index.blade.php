@extends('admin.layouts.main')
@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content" style="padding-top:10px">
						<!--begin::Subheader-->
						<div class="subheader py-2 py-lg-6 subheader-transparent" id="kt_subheader">
							<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
								<!--begin::Info-->
								<div class="d-flex align-items-center flex-wrap mr-1">

									<!--end::Mobile Toggle-->
									<!--begin::Page Heading-->
									<div class="d-flex align-items-baseline flex-wrap mr-5">
										<!--begin::Page Title-->
										<h5 class="text-dark font-weight-bold my-1 mr-5">{{__('site.Projects')}}</h5>
										<!--end::Page Title-->

									</div>
									<!--end::Page Heading-->
								</div>
								<!--end::Info-->

							</div>
						</div>
						<!--end::Subheader-->
						<!--begin::Entry-->
						<div class="d-flex flex-column-fluid">
							<!--begin::Container-->
							<div class="container">
								<!--begin::Profile Change Password-->
								<div class="d-flex flex-row">
									<!--begin::Aside-->
									@include('admin.layouts.aside')
									<!--end::Aside-->
									<!--begin::Content-->
									<div class="flex-row-fluid ml-lg-8">
										<!--begin::Card-->
										<div class="card card-custom gutter-b">
									<!--begin::Header-->
									<div class="card-header border-0 py-5">
										<h3 class="card-title align-items-start flex-column">
											<span class="card-label font-weight-bolder text-dark">{{__('site.Projects')}}</span>
											<span class="text-muted mt-3 font-weight-bold font-size-sm">{{$project_count}} {{__('site.Projects')}}</span>
										</h3>
										<div class="card-toolbar">
											<a href="#" id="kt_quick_user_toggle" class="btn btn-success font-weight-bolder font-size-sm">
											<span class="svg-icon svg-icon-md svg-icon-white">
												<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg-->
												<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
												  <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
												</svg>
												<!--end::Svg Icon-->
											</span>{{__('site.New Project')}}</a>
										</div>
									</div>
									<!--end::Header-->
									<form class="ml-5" action="">
										<div class="input-group input-group-sm input-group-solid" style="max-width:260px">
											<input type="text" name="search" style="" class="form-control" id="kt_subheader_search_form" value="{{request('search')}}" placeholder="{{ __('site.search') }}">
										</div><br>
									</form>		
									<!--begin::Body-->
									<div class="card-body py-0">
										<!--begin::Table-->
										<div class="table-responsive">
										<div class="custom-table-responsive">							

											<table class="table table-separate table-head-custom table-checkable table-striped" id="kt_advance_table_widget_1">
												<thead>
													<tr class="text-left">
														<th style="min-width: 150px">{{__('site.ID')}}</th>
														<th style="min-width: 150px">{{__('site.Name AR')}}</th>
														<th style="min-width: 150px">{{__('site.Name EN')}}</th>
														<th style="min-width: 150px">{{__('site.status')}}</th>
														<th class="pr-0 " style="min-width: 150px">{{__('site.action')}}</th>
													</tr>
												</thead>
												<tbody>
													@foreach($projects as $project)
													<tr>
														<td class="pl-0">
															<span class="text-muted font-weight-bold text-muted d-block">#{{$project->id}}</span>
														</td>
														<td class="pl-0">
															<span class="text-muted font-weight-bold text-muted d-block">{{$project->name_ar}}</span>
														</td>
														<td>
															<span class="text-muted font-weight-bold">{{$project->name_en}}</span>
														</td>
														<td>
															<span class=" font-weight-bold text-{{ $project->active == '1' ? 'success' : 'danger'}}">
																{{$project->active == '1'? 'active' : 'inActive'}}
															</span>
														</td>


														<td class="pr-0 ">

															<a href=""
															data-toggle="modal" data-target="#edit-{{$project->id}}"
															class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Edit details">	 
														<i class="fa fa-edit"></i>
														 </a>
													

											 <div class="modal fade" id="edit-{{$project->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
										    <div class="modal-dialog" role="document">
									        <div class="modal-content">
									            <div class="modal-header">
									                <h5 class="modal-title" id="exampleModalLabel">{{__('site.edit')}}</h5>
									                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									                    <i aria-hidden="true" class="ki ki-close"></i>
									                </button>
									            </div>
									            <div class="modal-body">
																<form class="form" method="post" id="edit-{{$project->id}}-form" action="{{route('admin.projects.update',$project->id)}}">
																	@csrf
																	@method('PUT')
						<div class="card-body">
						    
<div class="separator separator-dashed my-5"></div>
<div class="form-group">
<label>{{__('site.country')}}:</label>
    <select class="form-control " id="countries" required
    name="country_id" data-select2-id="" tabindex="-1" aria-hidden="true">
    <option value="">{{ __('site.country') }}</option>
    @foreach($countries as $country)
    							<option
    data-code="{{$country->code}}" 
    {{$project->country_id == $country->id ? 'selected' : ''}}
    value="{{$country->id}}" data-select2-id="{{$country->id}}">{{$country->name}}</option>
    @endforeach
    </select>
</div>

											<div class="form-group">
																			<label>{{__('site.Name AR')}}:</label>
																			<input type="text" name="name_ar" value="{{$project->name_ar}}" class="form-control" >
																		</div>
																		<div class="separator separator-dashed my-5"></div>
																		<div class="form-group">
																			<label>{{__('site.Name EN')}}:</label>
																			<input type="text" name="name_en" value="{{$project->name_en}}" class="form-control" >
																		</div>
																		<div class="separator separator-dashed my-5"></div>
																		<div class="form-group">
																			<label>{{__('site.status')}}:</label>
																			<select name="active" class="form-control form-control-lg form-control-solid mb-2 select-rule" required="">
																				<option {{$project->active == '1' ? 'selected' : ''}} value="1">{{__('site.Active')}}</option>
																				<option {{$project->active == '0' ? 'selected' : ''}} value="0">{{__('site.In Active')}}</option>
																			</select>
																		</div>
																	</div>
																	<div class="card-footer">
																		<button type="submit" form="edit-{{$project->id}}-form" class="btn btn-primary mr-2">{{__('site.save')}}</button>
																	</div>
																</form>
									            </div>

									        </div>
										    </div>
										</div>

														</td>
													</tr>
													@endforeach
												</tbody>
											</table>
											</div>
											{{$projects->links()}}
										</div>
										<!--end::Table-->
									</div>
									<!--end::Body-->
								</div>
									</div>
									<!--end::Content-->
								</div>
								<!--end::Profile Change Password-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Entry-->
					</div>
					<!-- new Account --->
					<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
					<!--begin::Header-->
					<div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
					<h3 class="font-weight-bold m-0">New Project</h3>

					</div>
					<!--end::Header-->
					<!--begin::Content-->
					<div class="offcanvas-content pr-5 mr-n5">
						<!--begin::Header-->
						<div class="d-flex align-items-center mt-5">

						<div class="d-flex flex-column">

							<div class="navi mt-2">
								<form class="form" method="post" id="new-project" action="{{route('admin.projects.index')}}">
									@csrf
<div class="card-body">
 
<div class="form-group">
<label>{{__('site.country')}}:</label>
    <select class="form-control " id="countries" required
    name="country_id" data-select2-id="" tabindex="-1" aria-hidden="true">
    <option value="">{{ __('site.country') }}</option>
    @foreach($countries as $country)
    							<option
    data-code="{{$country->code}}" 
    {{old('country_id') == $country->id ? 'selected' : ''}}
    value="{{$country->id}}" data-select2-id="{{$country->id}}">{{$country->name}}</option>
    @endforeach
    </select>
</div>
   <div class="separator separator-dashed my-5"></div>
											<div class="form-group">
												<label>{{__('site.Name AR')}}:</label>
												<input type="text" name="name_ar" value="{{old('name_ar')}}" class="form-control" >
											</div>
											<div class="separator separator-dashed my-5"></div>
											<div class="form-group">
												<label>{{__('site.Name EN')}}:</label>
												<input type="text" name="name_en" value="{{old('name_en')}}" class="form-control" >
											</div>
											

									
                                      <!--end::Group-->
											<div class="separator separator-dashed my-5"></div>
										</div>
										<div class="card-footer">
											<button type="submit" form="new-project" class="btn btn-primary mr-2">{{__('site.save')}}</button>
											<button id="kt_quick_user_close" class=" btn btn-secondary">{{__('site.cancel')}}</button>
										</div>
									</form>


							</div>
						</div>
					</div>
					<!--end::Header-->

					</div>
					<!--end::Content-->
					</div>

@endsection
