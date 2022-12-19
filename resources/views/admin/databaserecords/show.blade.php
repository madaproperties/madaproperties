@extends('admin.layouts.main')
@section('content')

<hr />
<div class="container">
    
	

					<!--begin::Profile Overview-->
							<div class="">
							        
								<!--begin::Aside-->
									@include('admin.databaserecords.components.sidebar')
								<!--begin::Content-->
								<div class="col-sm-8">
    
									<div class="example-preview">
										<ul class="nav nav-tabs" id="myTab" role="tablist">
											<li class="nav-item">
												<a class="nav-link active" id="notes-tab" data-toggle="tab" href="#notes" aria-controls="notes">
													<span class="nav-icon">
														<i class="fa fa-bell"></i>
													</span>
													<span class="nav-text">{{__('site.notes')}}</span>
												</a>
											</li>
											
									</ul>
		
									<div class="tab-content mt-5" id="myTabContent">
										<div class="tab-pane fade active show" id="notes" role="tabpanel" aria-labelledby="notes-tab">
											@include('admin.databaserecords.components.notes')
										</div>
									</div>
								</div>

								<!--end::Content-->
							</div>
							<!--end::Profile Overview-->
						</div>
<!-- Add Database Note Modal-->
<div class="modal fade" id="add-database-note" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('site.new note')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-custom">
               <!--begin::Form-->
                 <form id="add-note-form" action="{{route('admin.database-note.store')}}" method="POST">
                   @csrf
                   <input type="hidden" value="{{isset($data->id) ? $data->id : '' }}" name="database_id">

                   <div class="form-group">
                     <label class="d-block">{{ __('site.description') }}</label>
                     <textarea  name="description" id="note-description">{{old('description')}}</textarea>
                   </div>

                  <div class="card-footer">
                   <button type="submit" form="add-note-form" class="btn btn-primary mr-2">{{__('site.save')}}</button>
                   <button data-dismiss="modal" form="add-note-form"  class="btn btn-secondary">{{__('site.cancel')}}</button>
                  </div>
                 </form>
                 <!--end::Form-->
                </div>

            </div>
        </div>
    </div>
</div>
<!--- Eit Database Note Model -->

<!-- Add Database Note Modal-->
<div class="modal fade" id="edit-database" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('site.edit')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-custom">

					<div class="row justify-content-center">
						<div class="col-xl-12 col-xxl-10">

							<!--begin::Wizard Form-->
							<form class="form fv-plugins-bootstrap fv-plugins-framework" method="post" action="{{route('admin.database-records.update',$data->id)}}" id="kt_form">
								@csrf
								@method('PATCH')
								<div class="row justify-content-center">
									<div class="col-xl-6">
										<!--begin::Wizard Step 1-->
										<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">

											<!--begin::Group-->
											<div class="form-group row fv-plugins-icon-container" data-select2-id="39">
												<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.country')}} </label>
												<div class="col-lg-9 col-xl-9" data-select2-id="38">
													<select class="form-control " id="country_id"
													name="country_id" data-select2-id="" tabindex="-1" aria-hidden="true">
														<option value="">{{ __('site.choose') }}</option>
														@foreach($countries as $country)
															<option {{$data->country_id == $country->id ? 'selected' : ''}} value="{{$country->id}}" data-select2-id="{{$country->id}}">{{$country->name}}</option>
														@endforeach
													</select>
												</div>
											</div>
											<!--begin::Group-->
											<div class="form-group row fv-plugins-icon-container">
												<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.name')}}</label>
												<div class="col-lg-9 col-xl-9">
													<input class="form-control form-control-solid form-control-lg" 	name="name" type="text" value="{{$data->name}}" placeholder="{{__('site.name')}}">
													<div class="fv-plugins-message-container"></div>
												</div>
											</div>
											<!--end::Group-->
											<!--begin::Group-->
											<div class="form-group row fv-plugins-icon-container">
												<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.email')}}</label>
												<div class="col-lg-9 col-xl-9">
													<input class="form-control form-control-solid form-control-lg" 	name="email" type="text" value="{{$data->email}}" placeholder="{{__('site.email')}}">
													<div class="fv-plugins-message-container"></div>
												</div>
											</div>
											<!--end::Group-->
											<!--begin::Group-->
											<div class="form-group row fv-plugins-icon-container">
												<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.phone')}}</label>
												<div class="col-lg-9 col-xl-9">
													<input class="form-control form-control-solid form-control-lg" 	name="phone" type="text" value="{{$data->phone}}" placeholder="{{__('site.phone')}}">
													<div class="fv-plugins-message-container"></div>
												</div>
											</div>
											<!--end::Group-->

											<!--begin::Group-->
											<div class="form-group row fv-plugins-icon-container">
												<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.city')}}</label>
												<div class="col-lg-9 col-xl-9">
													<input class="form-control form-control-solid form-control-lg" 	name="city" type="text" value="{{$data->city}}" placeholder="{{__('site.city')}}">
													<div class="fv-plugins-message-container"></div>
												</div>
											</div>
											<!--end::Group-->

											<!--begin::Group-->
											<div class="form-group row fv-plugins-icon-container">
												<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.area')}}</label>
												<div class="col-lg-9 col-xl-9">
													<input class="form-control form-control-solid form-control-lg" 	name="area" type="text" value="{{$data->area}}" placeholder="{{__('site.area')}}">
													<div class="fv-plugins-message-container"></div>
												</div>
											</div>
											<!--end::Group-->
											<!--begin::Group-->
											<div class="form-group row fv-plugins-icon-container">
												<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.project_name')}}</label>
												<div class="col-lg-9 col-xl-9">
													<input class="form-control form-control-solid form-control-lg" id="project_id" 	name="project_id" type="text" value="{{$data->project_id}}" placeholder="{{__('site.project_name')}}" autocomplete="off">
													<div class="fv-plugins-message-container"></div>
												</div>
											</div>
											<!--end::Group-->
											
											<!--begin::Group-->
											<div class="form-group row fv-plugins-icon-container">
												<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.building_name')}}</label>
												<div class="col-lg-9 col-xl-9">
													<input class="form-control form-control-solid form-control-lg" 	name="building_name" type="text" value="{{$data->building_name}}" placeholder="{{__('site.building_name')}}">
													<div class="fv-plugins-message-container"></div>
												</div>
											</div>
											<!--end::Group-->

											<!--begin::Group-->
											<div class="form-group row fv-plugins-icon-container">
												<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.unit_name')}}</label>
												<div class="col-lg-9 col-xl-9">
													<input class="form-control form-control-solid form-control-lg" 	name="unit_name" type="text" value="{{$data->unit_name}}" placeholder="{{__('site.unit_name')}}">
													<div class="fv-plugins-message-container"></div>
												</div>
											</div>
											<!--end::Group-->

											<!--begin::Group-->
											<div class="form-group row fv-plugins-icon-container">
												<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.price')}}</label>
												<div class="col-lg-9 col-xl-9">
													<input class="form-control form-control-solid form-control-lg" 	name="price" type="text" value="{{$data->price}}" placeholder="{{__('site.price')}}">
													<div class="fv-plugins-message-container"></div>
												</div>
											</div>
											<!--end::Group-->

											

										</div>
									</div>

									<div class="col-xl-6">
										<!--begin::Wizard Step 1-->
										<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
										
											<!--begin::Group-->
											<div class="form-group row fv-plugins-icon-container">
												<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.bedroom')}}</label>
												<div class="col-lg-9 col-xl-9">
													<input class="form-control form-control-solid form-control-lg" 	name="bedroom" type="text" value="{{$data->bedroom}}" placeholder="{{__('site.bedroom')}}">
													<div class="fv-plugins-message-container"></div>
												</div>
											</div>
											<!--end::Group-->
											<!--begin::Group-->
											<div class="form-group row fv-plugins-icon-container">
												<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.local_phone_no_or_reference')}}</label>
												<div class="col-lg-9 col-xl-9">
													<input class="form-control form-control-solid form-control-lg" id="local_phone_no_or_reference" name="local_phone_no_or_reference" type="text" value="{{$data->local_phone_no_or_reference}}" placeholder="{{__('site.local_phone_no_or_reference')}}" autocomplete="off">
													<div class="fv-plugins-message-container"></div>
												</div>
											</div>
											<!--end::Group-->
											
											<!--begin::Group-->
											<div class="form-group row fv-plugins-icon-container">
												<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.options')}}</label>
												<div class="col-lg-9 col-xl-9">
													<select class="form-control" name="options" id="options">
														<option value="">{{ __('site.choose') }}</option>
														<option {{$data->options == 'buy' ? 'selected' : ''}} value="buy">{{__('site.buy')}}</option>
														<option {{$data->options == 'sell' ? 'selected' : ''}} value="sell">{{__('site.sell')}}</option>
														<option {{$data->options == 'rent' ? 'selected' : ''}} value="rent">{{__('site.rent')}}</option>
													</select>
												</div>
											</div>
											<!--end::Group-->
											
											<!--begin::Group-->
											<div class="form-group row fv-plugins-icon-container">
												<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.response')}}</label>
												<div class="col-lg-9 col-xl-9">
													<select class="form-control" name="response" id="response">
														<option value="">{{ __('site.choose') }}</option>
														<option {{$data->response == 'intrested' ? 'selected' : ''}} value="intrested">{{__('site.intrested')}}</option>
														<option {{$data->response == 'not intrested' ? 'selected' : ''}} value="not intrested">{{__('site.not intrested')}}</option>
														<option {{$data->response == 'follow up' ? 'selected' : ''}} value="follow up">{{__('site.follow up')}}</option>
														<option {{$data->response == 'unsubscribe' ? 'selected' : ''}} value="unsubscribe">{{__('site.unsubscribe')}}</option>
													</select>
												</div>
											</div>
											<!--end::Group-->
											
											<!--begin::Group-->
											<div class="form-group row fv-plugins-icon-container">
												<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.community')}}</label>
												<div class="col-lg-9 col-xl-9">
													<input class="form-control form-control-solid form-control-lg" 	name="community" type="text" value="{{$data->community}}" placeholder="{{__('site.community')}}">
													<div class="fv-plugins-message-container"></div>
												</div>
											</div>
											<!--end::Group-->
											<!--begin::Group-->
											<div class="form-group row fv-plugins-icon-container">
												<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.sub_community')}}</label>
												<div class="col-lg-9 col-xl-9">
													<input class="form-control form-control-solid form-control-lg" 	name="sub_community" type="text" value="{{$data->sub_community}}" placeholder="{{__('site.sub_community')}}">
													<div class="fv-plugins-message-container"></div>
												</div>
											</div>
											<!--end::Group-->
											<!--begin::Group-->
											<div class="form-group row fv-plugins-icon-container">
												<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.developer')}}</label>
												<div class="col-lg-9 col-xl-9">
													<input class="form-control form-control-solid form-control-lg" 	name="developer" type="text" value="{{$data->developer}}" placeholder="{{__('site.developer')}}">
													<div class="fv-plugins-message-container"></div>
												</div>
											</div>
											<!--end::Group-->

											<!--begin::Group-->
											<div class="form-group row fv-plugins-icon-container">
												<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.status')}}</label>
												<div class="col-lg-9 col-xl-9">
													<select class="form-control" name="status" id="status">
														<option value="">{{ __('site.choose') }}</option>
														<option {{$data->status == 'Ready' ? 'selected' : ''}} value="Ready">{{__('site.Ready')}}</option>
														<option {{$data->status == 'Not Ready' ? 'selected' : ''}} value="Not Ready">{{__('site.Not Ready')}}</option>
													</select>
												</div>
											</div>
											<!--end::Group-->
											@if(count($sellers))
											<!--begin::Group-->
											<div class="form-group row fv-plugins-icon-container">
												<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.assigned to')}} </label>
												<div class="col-lg-9 col-xl-9">
													<select class="form-control"  name="assign_to">
														<option value="">{{ __('site.choose') }}</option>
														@foreach($sellers as $seller)
														<option {{$data->assign_to == $seller->id ? 'selected' : ''}} value="{{$seller->id}}">{{$seller->name}}</option>
														@endforeach
													</select>
												</div>
											</div>
											@endif
											<!--end::Group-->

										</div>
									</div>
									<div class="col-xl-12">
										<!--begin::Wizard Step 1-->
										<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
											<!--begin::Group-->
											<div class="form-group row fv-plugins-icon-container">
												<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.comment')}}</label>
												<div class="col-lg-9 col-xl-9">
													<textarea class="form-control form-control-solid form-control-lg" name="comment" placeholder="{{__('site.comment')}}">{{$data->comment}}</textarea>
													<div class="fv-plugins-message-container"></div>
												</div>
											</div>
											<!--end::Group-->
										</div>
									</div>
									<div class="col-xl-12">
										<!--begin::Wizard Actions-->
										<div class="d-flex justify-content-between border-top pt-10 mt-15">
											<div>
												<input type="submit" class="btn btn-primary font-weight-bolder px-9 py-4" value="{{__('site.save')}}"/>
												<button data-dismiss="modal" form="add-note-form"  class="btn btn-secondary">{{__('site.cancel')}}</button>											</div>
										</div>
										<!--end::Wizard Actions-->
									</div>
								</div>
							</form>
							<!--end::Wizard Form-->
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
<!--- Eit Database Note Model -->


@endsection
@push('js')
<script>
var KTCkeditor = function () {
    // Private functions
    var demos = function () {
    ClassicEditor
      .create( document.querySelector( '#note-description' ) )
      .then( editor => {

      } )
      .catch( error => {
        console.error( error );
      } );
	}
    return {
        // public functions
        init: function() {
            demos();
        }
    };
}();
// Initialization
KTCkeditor.init();
</script>
@endpush