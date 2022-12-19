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
										<h5 class="text-dark font-weight-bold my-1 mr-5" Status</h5>
										<!--end::Page Title-->

									</div>
									<!--end::Page Heading-->
								</div>
								<!--end::Info-->

							</div>
						</div>
						<!--end::Subheader-->
						<!--begin::Entry-->
						<div class="">
							<!--begin::Container-->
							<div class="container">
								<!--begin::Profile Change Password-->
								<div class="row">
									<!--begin::Aside-->
									@include('admin.layouts.aside')
									<!--end::Aside-->
									<!--begin::Content-->
									<div class="col-sm-8">
										<!--begin::Card-->
										<div class="card card-custom gutter-b">
									<!--begin::Header-->
									<div class="card-header border-0 py-5">
										<h3 class="card-title align-items-start flex-column">
											<span class="card-label font-weight-bolder text-dark">
											 {{__('site.campaign')}}</span>
											<span class="text-muted mt-3 font-weight-bold font-size-sm">{{count($status)}} {{__('site.campaign')}}</span>
										</h3>
										<div class="card-toolbar">
											<a href="#" id="kt_quick_user_toggle" class="btn btn-success font-weight-bolder font-size-sm">
											<span class="svg-icon svg-icon-md svg-icon-white">
												<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg-->
												<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
												  <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
												</svg>
												<!--end::Svg Icon-->
											</span>Add New Campaign</a>
										</div>
									</div>
									<!--end::Header-->
									<!--begin::Body-->
									<div class="card-body py-0">
										<!--begin::Table-->
										<div class="table-responsive">
											<table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_1">
												<thead>
													<tr class="text-left">
														<th style="min-width: 150px">{{ __('site.ID') }}</th>
														<th style="min-width: 150px">{{ __('site.Name') }}</th>
														<th style="min-width: 150px">{{ __('site.project') }}</th>
														<th style="min-width: 150px">{{ __('site.cost') }}</th>
														<th style="min-width: 150px">{{ __('site.Status') }}</th>
														<th class="pr-0 " style="min-width: 150px">{{ __('site.action') }}</th>
													</tr>
												</thead>
												<tbody>
													@foreach($status as $statu)
													<tr>
														<td class="pl-0">
															<span class="text-muted font-weight-bold text-muted d-block">#{{$statu->id}}</span>
														</td>
														<td class="pl-0">
															<span class="text-muted font-weight-bold text-muted d-block">{{$statu->name}}</span>
														</td>
														<td class="pl-0">
															<span class="text-muted font-weight-bold text-muted d-block">{{$statu->project?$statu->project->name : 'N/A'}}</span>
														</td>
														<td class="pl-0">
															<span class="text-muted font-weight-bold text-muted d-block">{{$statu->cost}}</span>
														</td>

														<td>
															<span class=" font-weight-bold text-{{ $statu->active == '1' ? 'success' : 'danger'}}">
																{{$statu->active == '1'? __('site.Active') : __('site.In Active')}}
															</span>
														</td>


														<td class="pr-0 ">

															<a href=""
															data-toggle="modal" data-target="#edit-{{$statu->id}}"
															class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Edit details">	                            <span class="svg-icon svg-icon-md">
																<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect x="0" y="0" width="24" height="24"></rect>											<path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "></path>											<path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>										</g>									</svg>
															</span>
														 </a>
														  <!--
														<a href="{{route('admin.status.destroy',$statu->id)}}"
															onclick="event.preventDefault();
										                        document.getElementById('destroy-project-{{$statu->id}}').submit();"
															class="delete btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon" title="Delete">
															<span class="svg-icon svg-icon-md">
															<svg xmlns="http://www.w3.org/2000/svg"
																 xmlns:xlink="http://www.w3.org/1999/xlink"
																  width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																		<rect x="0" y="0" width="24" height="24"></rect>
																		<path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"></path>
																		<path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"></path
																		</g>
																</svg>
															</span>
														</a>

														<form id="destroy-project-{{$statu->id}}" action="{{route('admin.status.destroy',$statu->id)}}" method="POST" class="d-none">
										            @csrf
																@method('DELETE')
										        </form> -->

											 <div class="modal fade" id="edit-{{$statu->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
										    <div class="modal-dialog" role="document">
									        <div class="modal-content">
									            <div class="modal-header">
									                <h5 class="modal-title" id="exampleModalLabel">{{__('site.edit')}}</h5>
									                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									                    <i aria-hidden="true" class="ki ki-close"></i>
									                </button>
									            </div>
									            <div class="modal-body">
																<form class="form" method="post" id="edit-{{$statu->id}}-form"
																action="{{route('admin.campaigns.update',$statu->id)}}">
																	@csrf
																	@method('PUT')
																	<div class="card-body">
																		<div class="form-group">
																			<label>{{__('site.Name')}}:</label>
																			<input type="text" name="name" value="{{$statu->name}}" class="form-control" >
																		</div>
																		<div class="separator separator-dashed my-5"></div>
																		<div class="form-group">
																			<label>{{__('site.cost')}}:</label>
																			<input type="number" name="cost" value="{{$statu->cost}}" class="form-control" >
																		</div>
																		<div class="separator separator-dashed my-5"></div>

																		<div class="form-group">
																			<label for="country">{{__('site.project')}}</label>
																			<select class="form-control" name="project_id">
																				<option value="">{{__('site.project')}}</option>
																				@foreach($projects as $project)
																					<option {{$statu->project_id == $project->id ? 'selected':  '' }}
																					value="{{$project->id}}">{{$project->name}}</option>
																				@endforeach
																			</select>
																		</div>

																		<div class="separator separator-dashed my-5"></div>
																		<div class="form-group">
																			<label>{{__('site.status')}}:</label>
																			<select name="active" class="form-control form-control-lg form-control-solid mb-2 select-rule" required="">
																				<option {{$statu->active == '1' ? 'selected' : ''}} value="1">{{__('site.Active')}}</option>
																				<option {{$statu->active == '0' ? 'selected' : ''}} value="0">{{__('site.In Active')}}</option>
																			</select>
																		</div>
																	</div>
																	<div class="card-footer">
																		<button type="submit" form="edit-{{$statu->id}}-form" class="btn btn-primary mr-2">{{__('site.save')}}</button>
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
												{{$status->links()}}
											</table>
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
					<h3 class="font-weight-bold m-0">New campaign</h3>

					</div>
					<!--end::Header-->
					<!--begin::Content-->
					<div class="offcanvas-content pr-5 mr-n5">
						<!--begin::Header-->
						<div class="d-flex align-items-center mt-5">

						<div class="d-flex flex-column">

							<div class="navi mt-2">
								<form class="form" method="post" id="new-project"
								action="{{route('admin.campaigns.index')}}">
									@csrf
										<div class="card-body">
											<div class="form-group">
												<label>{{__('site.Name')}}:</label>
												<input type="text" name="name" value="{{old('name')}}" class="form-control" >
											</div>
											<div class="separator separator-dashed my-5"></div>
											<div class="form-group">
												<label>{{__('site.cost')}}:</label>
												<input type="number" name="cost" value="{{old('cost')}}" class="form-control" >
											</div>
											<div class="separator separator-dashed my-5"></div>
											<div class="form-group">
												<label for="country">{{__('site.project')}}</label>
												<select class="form-control" name="project_id">
													<option value="">{{__('site.project')}}</option>
													@foreach($projects as $project)
														<option {{old('project_id') == $project->id ? 'selected':  '' }}
														value="{{$project->id}}">{{$project->name}}</option>
													@endforeach
												</select>
											</div>

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
