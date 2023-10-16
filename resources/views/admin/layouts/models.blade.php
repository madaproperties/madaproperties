@push('css')
    <style>

    </style>
@endpush
<!-- Add Task Modal-->
<div class="modal fade" id="add-task" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('site.new task')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-custom">
                  <!--begin::Form-->
                  <form id="add-task-form" action="{{route('admin.tasks.store')}}" method="POST">
                    @csrf
                    <div class="card-body">
                      <div>
                        <label>{{__('site.name')}}</label>
                        <input type="text" name="name" class="form-control" value="{{old('name')}}" >
                      </div>
                      <hr />
                      <input type="hidden" value="{{$contact->id}}" name="contact_id">
                      <div class="row">
                        <div class="col-md-6 col-sm--12">
                          <div class="form-group ">
                            <label class="">{{__('site.date')}}</label>
                            <div class="">
                              <div class="input-group input-group-solid date" id="kt_datetimepicker_3" data-target-input="nearest">
                                <input value="{{old('date')}}" required type="text" class="form-control form-control-solid datetimepicker-input"
                                data-toggle="datetimepicker"
                                name="date" data-target="#kt_datetimepicker_3">
                                <div class="input-group-append" data-target="#kt_datetimepicker_3" data-toggle="datetimepicker">
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
                            <label class="">{{__('site.time')}}</label>
                            <div class="">
                              <div class="input-group input-group-solid date" id="kt_datetimepicker_4" data-target-input="nearest">
                                <input required value="{{old('time')}}" type="text" class="form-control form-control-solid datetimepicker-input"
                                data-toggle="datetimepicker"
                                name="time" data-target="#kt_datetimepicker_4">
                                <div class="input-group-append" data-target="#kt_datetimepicker_4" data-toggle="datetimepicker">
                                  <span class="input-group-text">
                                    <i class="ki ki-clock"></i>
                                  </span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <hr />
                      <div class="form-group">
                        <label class="d-block">{{__('site.description')}}</label>
                        <textarea name="description" id="task-description">{{old('description')}}</textarea>
                      </div>

                      <div class="form-group">
                        <label for="task-type">{{__('site.type')}}</label>
                        <select name="type" class="form-control" required>
                          <option value="">{{__('site.select option')}}</option>
                          <option
                          {{old('type') == 'email' ? 'selected' : '' }}
                          value="email">{{__('site.email')}}</option>
                          <option
                          {{old('type') == 'call' ? 'selected' : '' }}
                          value="call">{{__('site.call')}}</option>
                          <option
                          {{old('type') == 'whatsapp' ? 'selected' : '' }}
                          value="whatsapp">{{__('site.whatsapp')}}</option>
                          <option
                          {{old('type') == 'viewing' ? 'selected' : '' }}
                          value="viewing">{{__('site.viewing')}}</option>
                           <option
                          {{old('type') == 'photoshoot' ? 'selected' : '' }}
                          value="photoshoot">{{__('site.photoshoot')}}</option>
                          <option
                          {{old('type') == 'fieldvisit' ? 'selected' : '' }}
                          value="fieldvisit">{{__('site.field_visit')}}</option>
                        </select>
                      </div>

                    </div>
                    <div class="card-footer">
                      <button type="submit" form="add-task-form" class="btn btn-primary mr-2">{{__('site.save')}}</button>
                      <button data-dismiss="modal" form="add-task-form"  class="btn btn-secondary">{{__('site.cancel')}}</button>
                    </div>
                  </form>
                  <!--end::Form-->

                </div>
            </div>
        </div>
    </div>
</div>
<!--- Eit Information Model -->
<!-- Add Note Modal-->
<div class="modal fade" id="add-note" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
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
                 <form id="add-note-form" action="{{route('admin.note.store')}}" method="POST">
                   @csrf
                   <input type="hidden" value="{{$contact->id}}" name="contact_id">

                   <div class="form-group">
                     <label class="d-block">{{ __('site.description') }}</label>
                     <textarea  name="description" id="note-description">{{old('description')}}</textarea>
                   </div>

                  <div class="form-group">
                    <div class="checkbox-list">
                        <div class="row">
                          <div class="col-md-6 col-sm-12">
                            <label class="checkbox" style="float:left">
                                <input type="checkbox"
                                {{old('withtask') ? 'checked' : ''}}
                                 class="show-task" name="withtask"/>
                                <span></span>
                                {{ __('site.with Task') }}
                            </label>
                          </div>
                          <div class="col-md-6 col-sm-12">
                            <strong style="padding:5px"></strong>
                            <label class="checkbox" style="float:left">
                              <input type="checkbox" style="margin-left:20px"
                              {{old('sned_notofication') ? 'checked' : ''}}
                              name="sned_notofication"/>
                              <span></span>
                              {{__('site.send notofication')}}
                            </label>
                          </div>
                        </div>
                    </div>
                  </div>
                  <div class="task form-group" style="display:none">
                    <div class="row">
                     <div class="col-md-6 col-sm--12">
                       <div class="form-group ">
                  				<label class="">{{__('site.date')}}</label>
                  				<div class="">
                  					<div class="input-group input-group-solid date" id="kt_datetimepicker_10" data-target-input="nearest">
                  						<input value="{{old('date')}}"  type="text" class="form-control form-control-solid datetimepicker-input"
                              data-toggle="datetimepicker"
                              name="date" data-target="#kt_datetimepicker_10">
                  						<div class="input-group-append" data-target="#kt_datetimepicker_10" data-toggle="datetimepicker">
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
                			<label class="">{{__('site.time')}}</label>
                			<div class="">
                				<div class="input-group input-group-solid date" id="kt_datetimepicker_11" data-target-input="nearest">
                					<input  value="{{old('time')}}" type="text" class="form-control form-control-solid datetimepicker-input"
                          data-toggle="datetimepicker"
                          name="time" data-target="#kt_datetimepicker_11">
                					<div class="input-group-append" data-target="#kt_datetimepicker_11" data-toggle="datetimepicker">
                						<span class="input-group-text">
                							<i class="ki ki-clock"></i>
                						</span>
                					</div>
                				</div>
                			</div>
                		</div>
                   </div>
                   </div>
                   <div class="form-group">
                     <label for="task-type">{{__('site.type')}}</label>
                     <select name="type" class="form-control" >
                       <option value="">{{__('site.select option')}}</option>
                       <option
                       {{old('type') == 'email' ? 'selected' : '' }}
                       value="email">{{__('site.email')}}</option>
                       <option
                       {{old('type') == 'call' ? 'selected' : '' }}
                       value="call">{{__('site.call')}}</option>
                       <option
                       {{old('type') == 'whatsapp' ? 'selected' : '' }}
                       value="whatsapp">{{__('site.whatsapp')}}</option>
                     </select>
                   </div>
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
<!--- Eit Note Model -->


<!-- Button trigger modal-->
<!-- Modal-->
<div class="modal fade" id="edit-contact" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{__('site.edit contact')}}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <i aria-hidden="true" class="ki ki-close"></i>
              </button>
          </div>
          <div class="modal-body">
            <!--begin::Wizard Form-->
            <form class="form fv-plugins-bootstrap fv-plugins-framework"
            method="post"
            action="{{route('admin.contact.update',$contact->id)}}" id="kt_form">
              @csrf
              @method('PUT')
              <div class="row justify-content-center">
                <div class="col-xl-9">
                  <!--begin::Wizard Step 1-->
                  <div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">

                    <!--begin::Group-->
                    <div class="form-group row fv-plugins-icon-container">
                      <label class="col-xl-3 col-lg-3 col-form-label">{{__('site.email')}}</label>
                      <div class="col-lg-9 col-xl-9">
                        <div class="input-group input-group-solid input-group-lg">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="la la-at"></i>
                            </span>
                          </div>
                          <input type="email"  {{ userRole() != 'admin' ? 'disabled' : ''}}  class="form-control form-control-solid form-control-lg" name="email"  value="{{$contact->email }}">
                        </div>
                    </div>
                    </div>
                    <!--end::Group-->
                    <!--begin::Group-->
                    <div class="form-group row fv-plugins-icon-container">
                      <label class="col-xl-3 col-lg-3 col-form-label">{{__('site.first Name')}}</label>
                      <div class="col-lg-9 col-xl-9">
                        <input class="form-control form-control-solid form-control-lg" required name="first_name"
                      type="text" value="{{$contact->first_name}}" placeholder="first name">
                      <div class="fv-plugins-message-container"></div></div>
                    </div>
                    <!--end::Group-->
                    <!--begin::Group-->
                    <div class="form-group row fv-plugins-icon-container">
                      <label class="col-xl-3 col-lg-3 col-form-label">{{__('site.last name')}}</label>
                      <div class="col-lg-9 col-xl-9">
                        <input class="form-control form-control-solid form-control-lg"  name="last_name"
                      type="text" value="{{$contact->last_name}}" placeholder="last name">
                      <div class="fv-plugins-message-container"></div></div>
                    </div>
                    <!--end::Group-->
                    <!--begin::Group-->
                    <div class="form-group row fv-plugins-icon-container" data-select2-id="39">
                      <label class="col-xl-3 col-lg-3 col-form-label">{{__('site.country')}} </label>
                      <div class="col-lg-9 col-xl-9" data-select2-id="38">
                        <select class="form-control" id="countries" {{ userRole() != 'admin' ? 'disabled' : ''}}
                        data-select2-id="" tabindex="-1" aria-hidden="true" name="country_id">
                         @foreach($countries as $country)
                          <option
                          {{$contact->country_id == $country->id ? 'selected' : ''}}
                          value="{{$country->id}}" data-select2-id="{{$country->id}}">{{$country->name}}</option>
                          @endforeach
                        </select>
                      </div>
                     </div>
                    <!--end::Group-->
                    <!--begin::Group-->
                    <div class="form-group row fv-plugins-icon-container">
                      <label class="col-xl-3 col-lg-3 col-form-label">{{__('site.city')}}</label>
                      <div class="col-lg-9 col-xl-9 get-selcted-city"  data-value="{{$contact->city_id}}">
                        <select id="cities" class="form-control"  name="city_id" data-selected="{{$contact->city_id}}">
                         <option value="">{{__('site.select country')}}</option>
                        </select>
                      </div>
                     </div>
                    <!--end::Group-->
                    <!--begin::Group-->
                    <div class="form-group row fv-plugins-icon-container">
                      <label class="col-xl-3 col-lg-3 col-form-label">{{__('site.contact phone')}}</label>
                      <div class="col-lg-9 col-xl-9">
																					<div class="row">

												<div class="col-2" style="padding:0;text-align:center">
												        <div class="input-group input-group-solid input-group-lg">

																				<input type="number" disabled
         id="show-coutry-code"
         style="padding:0;"

         value="{{$contact->country ? $contact->country->code :''}}"
		class="form-control text-center form-control-solid form-control-lg" >
																					</div>

												</div>
												<div class="col-10">
												    <div class="input-group input-group-solid input-group-lg">
																						<div class="input-group-prepend">
																							<span class="input-group-text">
																								<i class="la la-phone"></i>
																							</span>
																						</div>
																						<input type="number"
																						value="{{$contact->phone}}"
																{{ userRole() != 'admin' ? 'disabled' : ''}}						class="form-control form-control-solid form-control-lg" required name="phone" placeholder="{{__('site.contact phone')}}">
																					</div>
												</div>
																					</div>
																			</div>
                    </div>
                    <!--end::Group-->
                    <!--begin::Group-->
                    <div class="form-group row fv-plugins-icon-container">
                      <label class="col-xl-3 col-lg-3 col-form-label">{{__('site.scound Phone')}}</label>
                      <div class="col-lg-9 col-xl-9">
                        <div class="input-group input-group-solid input-group-lg">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="la la-phone"></i>
                            </span>
                          </div>
                          <input  class="form-control form-control-solid form-control-lg"
                          value="{{$contact->scound_phone}}"
                           name="scound_phone" placeholder="{{__('site.please include country code')}}">
                        </div>
                    </div>
                    </div>
                    <!--end::Group-->
                    <!--begin::Group-->
                    <div class="form-group row fv-plugins-icon-container">
																				<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.budget')}}</label>
																				<div class="col-lg-9 col-xl-9">
																					<div class="input-group input-group-solid input-group-lg">
																						<div class="input-group-prepend">
																							<span class="input-group-text">
																								<i class="la la-money-bill"></i>
																							</span>
									</div>


																						<select class="form-control"  name="budget">
																						<option value="">{{ __('site.budget') }}</option>
																						@foreach(budgets() as $budget)
								 														<option
																						{{$contact->budget == $budget ? 'selected' : ''}}
																						 value="{{$budget}}">{{$budget}}</option>
																						@endforeach
								 													</select>
																					</div>
																			</div>
																			</div>
                    <!--end::Group-->
                    <!--begin::Group-->
                     <div class="form-group row">
                      <label class="col-xl-3 col-lg-3 col-form-label">{{__('site.currencies')}}</label>
                      <div class="col-lg-9 col-xl-9">
                        <select class="form-control"  name="currency">
                          <option value="">{{__('site.choose')}}</option>
                          @foreach($currencies as $currencie)
                          <option
                          {{$contact->currency == $currencie->currency ? 'selected' : ''}}
                           value="{{$currencie->id}}">{{$currencie->currencyname}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <!--end::Group-->
<!--begin::Group-->
<div class="form-group row fv-plugins-icon-container" data-select2-id="39">
<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.unit country')}}</label>
<div class="col-lg-9 col-xl-9" data-select2-id="38">
  <select class="form-control " id="unit_country"
   name="unit_country" data-select2-id="" tabindex="-1" aria-hidden="true">
   <option value="">{{__('site.choose')}} {{ $contact->unit_country }}</option>
   @foreach($countries as $country)
    <option
    {{$contact->unit_country == $country->id ? 'selected' : ''}}
    value="{{$country->id}}" data-select2-id="{{$country->id}}">{{$country->name}}</option>
    @endforeach
  </select>
</div>
</div>
<!--end::Group-->
<!-- added by fazal -->
<!--begin::Group-->
<div class="form-group row fv-plugins-icon-container" data-select2-id="39">
<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.city')}}</label>
<div class="col-lg-9 col-xl-9" data-select2-id="38">
  <select class="form-control " id="city_id"
   name="city" data-select2-id="" tabindex="-1" aria-hidden="true">
   <option value="">{{__('site.choose')}} </option>
   @foreach($cities as $city)
    <option
    {{$contact->city == $city->id ? 'selected' : ''}}
    value="{{$city->id}}" data-select2-id="{{$city->id}}">{{$city->name_en}}</option>
    @endforeach
  </select>
</div>
</div>
<!--end::Group-->
@if($contact->unit_country==2)
<!--begin::Group-->
<div id="community-subcommunity">
<div class="form-group row fv-plugins-icon-container" data-select2-id="39">
<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.community')}}</label>
<div class="col-lg-9 col-xl-9" data-select2-id="38">
  <select class="form-control " id="community_id"
   name="community_id" data-select2-id="" tabindex="-1" aria-hidden="true">
   <option value="">{{__('site.choose')}} </option>
   @foreach($communities as $community)
    <option
    {{$contact->community_id == $community->id ? 'selected' : ''}}
    value="{{$community->id}}" data-select2-id="{{$community->id}}">{{$community->name_en}}</option>
    @endforeach
  </select>
</div>
</div>
<!--end::Group-->
<!--begin::Group-->
<div class="form-group row fv-plugins-icon-container" data-select2-id="39">
<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.subcommunity')}}</label>
<div class="col-lg-9 col-xl-9" data-select2-id="38">
  <select class="form-control " id="subcommunities_id"
   name="subcommunities_id" data-select2-id="" tabindex="-1" aria-hidden="true">
   <option value="">{{__('site.choose')}}</option>
   @foreach($subcommunities as $subcommunity)
    <option
    {{$contact->subcommunities_id == $subcommunity->id ? 'selected' : ''}}
    value="{{$subcommunity->id}}" data-select2-id="{{$subcommunity->id}}">{{$subcommunity->name_en}}</option>
    @endforeach
  </select>
</div>
</div>
</div>
<!--  -->

<!--begin::Group-->
<div id="zone-district" style="display:none;">
<div class="form-group row fv-plugins-icon-container" data-select2-id="39">
<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.zone')}}</label>
<div class="col-lg-9 col-xl-9" data-select2-id="38">
  <select class="form-control " id="zone_id"
   name="zone_id" data-select2-id="" tabindex="-1" aria-hidden="true">
   <option value="">{{__('site.choose')}}</option>
   @foreach($zones as $zone)
    <option
    {{$contact->zone_id == $zone->id ? 'selected' : ''}}
    value="{{$zone->id}}" data-select2-id="{{$zone->id}}">{{$zone->zone_name}}</option>
    @endforeach
  </select>
</div>
</div>
<!--end::Group-->
<!--begin::Group-->
<div class="form-group row fv-plugins-icon-container" data-select2-id="39">
<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.district')}}</label>
<div class="col-lg-9 col-xl-9" data-select2-id="38">
  <select class="form-control " id="district_id"
   name="district_id" data-select2-id="" tabindex="-1" aria-hidden="true">
   <option value="">{{__('site.choose')}}</option>
   @foreach($districts as $district)
    <option
    {{$contact->district_id == $district->id ? 'selected' : ''}}
    value="{{$district->id}}" data-select2-id="{{$district->id}}">{{$district->name}}</option>
    @endforeach
  </select>
</div>
</div>
</div>


<!--  -->
<!--end::Group-->
@endif
@if($contact->unit_country==1)
<!--begin::Group-->
<div id="zone-district">
<div class="form-group row fv-plugins-icon-container" data-select2-id="39">
<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.zone')}}</label>
<div class="col-lg-9 col-xl-9" data-select2-id="38">
  <select class="form-control " id="zone_id"
   name="zone_id" data-select2-id="" tabindex="-1" aria-hidden="true">
   <option value="">{{__('site.choose')}}</option>
   @foreach($zones as $zone)
    <option
    {{$contact->zone_id == $zone->id ? 'selected' : ''}}
    value="{{$zone->id}}" data-select2-id="{{$zone->id}}">{{$zone->zone_name}}</option>
    @endforeach
  </select>
</div>
</div>
<!--end::Group-->
<!--begin::Group-->
<div class="form-group row fv-plugins-icon-container" data-select2-id="39">
<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.district')}}</label>
<div class="col-lg-9 col-xl-9" data-select2-id="38">
  <select class="form-control " id="district_id"
   name="district_id" data-select2-id="" tabindex="-1" aria-hidden="true">
   <option value="">{{__('site.choose')}}</option>
   @foreach($districts as $district)
    <option
    {{$contact->district_id == $district->id ? 'selected' : ''}}
    value="{{$district->id}}" data-select2-id="{{$district->id}}">{{$district->name}}</option>
    @endforeach
  </select>
</div>
</div>
</div>
<!--end::Group-->
<!--  -->
 <div id="community-subcommunity" style="display:none;">
 <div class="form-group row fv-plugins-icon-container" data-select2-id="39">
<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.community')}}</label>
<div class="col-lg-9 col-xl-9" data-select2-id="38">
  <select class="form-control " id="community_id"
   name="community_id" data-select2-id="" tabindex="-1" aria-hidden="true">
   <option value="">{{__('site.choose')}} </option>
   @foreach($communities as $community)
    <option
    {{$contact->community_id == $community->id ? 'selected' : ''}}
    value="{{$community->id}}" data-select2-id="{{$community->id}}">{{$community->name_en}}</option>
    @endforeach
  </select>
</div>
</div>
<!--end::Group-->
<!--begin::Group-->
<div class="form-group row fv-plugins-icon-container" data-select2-id="39">
<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.subcommunity')}}</label>
<div class="col-lg-9 col-xl-9" data-select2-id="38">
  <select class="form-control " id="subcommunities_id"
   name="subcommunities_id" data-select2-id="" tabindex="-1" aria-hidden="true">
   <option value="">{{__('site.choose')}}</option>
   @foreach($subcommunities as $subcommunity)
    <option
    {{$contact->subcommunities_id == $subcommunity->id ? 'selected' : ''}}
    value="{{$subcommunity->id}}" data-select2-id="{{$subcommunity->id}}">{{$subcommunity->name_en}}</option>
    @endforeach
  </select>
</div>
</div>

 </div>

<!--  -->
@endif
<!-- end added by fazal -->



<!--begin::Group-->
 <div class="form-group row {{ !$contact->project_id ? 'prject-area' : '' }}" id="project-area">
  <label class="col-xl-3 col-lg-3 col-form-label">{{__('site.project')}}</label>
  <div class="col-lg-9 col-xl-9">
    <select class="form-control other-select" id="" name="project_id" style="width:100%">

      @if(isset($contact->project->country_id) && $contact->project_id)
      <option
      id="project-value-{{$contact->project->id}}"
      data-text="{{$contact->project->name}}"
      value="{{$contact->project->id}}"
      data-select2-id="{{$contact->project->name}}">
          {{$contact->project->name}}
     </option>
      @endif

    </select>
  </div>
</div>
<!--end::Group-->
                    <!--begin::Group-->
                    @php
                        if($contact->project){
                        
                        if($contact->project->name == 'others' 
                      OR $contact->project->name == 'أخري')
                      {
                        $contactProject = false;
                      }else{
                        $contactProject = true;
                       }
                       
                    
                      
                      }else{
                        $contactProject= false;
                      }
                    @endphp
                    
                    <div class="related-to-project" 
                    {{!$contactProject ? 'style=display:none':''}}>

                      <!--begin::Group-->
                      <div class="form-group row fv-plugins-icon-container" data-select2-id="39">
                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('site.unit city')}}</label>
                        <div class="col-lg-9 col-xl-9" data-select2-id="38">
                          <select id="unit_city" class="form-control "
                          data-selected="{{$contact->unit_city}}"
                           name="unit_city"  tabindex="-1" aria-hidden="true">
                           <option value="">{{__('site.select country')}}</option>
                          </select>
                        </div>
                       </div>
                      <!--end::Group-->
                      <!--begin::Group-->
                      <div class="form-group row fv-plugins-icon-container">
                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('site.unit zone')}}</label>
                        <div class="col-lg-9 col-xl-9">
                          <input class="form-control form-control-solid form-control-lg"
                          name="{{$contact->unit_zone}}" type="text" value="{{old('unit_zone')}}" placeholder="">
                        </div>
                      </div>
                      <!--end::Group-->
                    </div>
                    <!--end::Group-->
                    <!--begin::Group-->
                     <div class="form-group row">
                      <label class="col-xl-3 col-lg-3 col-form-label">{{__('site.status')}}</label>
                      <div class="col-lg-9 col-xl-9">
                        <select class="form-control follow_up_status_id"  name="status_id" style="width:100%">
                          @foreach($status as $statu)
                          <option
                          {{$contact->status_id == $statu->id ? 'selected' : ''}}
                          value="{{$statu->id}}" data-select2-id="{{$statu->name}}">{{$statu->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <!--end::Group-->

                    <div class="form-group row follow_up_date" style="display:{{$contact->status_id != '5' ? 'none' : ''}}">
                      <label class="col-xl-3 col-lg-3 col-form-label">{{__('site.follow_up_date')}}</label>
                      <div class="col-lg-9 col-xl-9">
                        <div class="input-group input-group-solid date" id="kt_datetimepicker_33334444" data-target-input="nearest">
                          <input value="{{old('follow_up_date')}}"  type="text" class="form-control form-control-solid datetimepicker-input"
                          data-toggle="datetimepicker" name="follow_up_date" data-target="#kt_datetimepicker_33334444">
                          <div class="input-group-append" data-target="#kt_datetimepicker_33334444" data-toggle="datetimepicker">
                            <span class="input-group-text">
                              <i class="ki ki-calendar"></i>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>






                    <!--begin::Group-->
                    <div class="form-group row fv-plugins-icon-container">
                      <label class="col-xl-3 col-lg-3 col-form-label">{{__('site.last mile conversion')}}</label>
                      <div class="col-lg-9 col-xl-9">
                        <select class="form-control" required name="last_mile_conversion" tabindex="-1" aria-hidden="true">
                            <option value="">{{__('site.choose') }}</option>
                         @foreach($miles as $mile)
                          <option
                          {{$contact->last_mile_conversion == $mile->id ? 'selected' : ''}}
                          value="{{$mile->id}}" last_mile_conversion="{{$mile->name}}">{{$mile->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <!--end::Group-->
                    <!--end::Group-->
                    @php
                     $lead_types = ['Hot','Cold','Warm'];
                    @endphp
                    <!--begin::Group-->
                    <div class="form-group row fv-plugins-icon-container">
                      <label class="col-xl-3 col-lg-3 col-form-label">{{__('site.lead type')}}</label>
                      <div class="col-lg-9 col-xl-9">
                        <select class="form-control"  name="lead_type" tabindex="-1" aria-hidden="true">
                        <option value="">choose</option>
               @foreach($lead_types as $lead_type)
                       <option {{strtolower($contact->lead_type) == strtolower($lead_type)  ? 'selected' : ''}}
                      value="{{$lead_type}}">{{$lead_type}}</option>
             @endforeach
                        </select>
                      </div>
                    </div>
                    <!--end::Group-->
                  
                    <div class="form-group row fv-plugins-icon-container">
                      <label class="col-xl-3 col-lg-3 col-form-label">{{__('site.campaign')}}</label>
                      <div class="col-lg-9 col-xl-9">
                        <select class="form-control"  name="campaign" tabindex="-1" aria-hidden="true">
												<option value="">{{ __('site.choose') }}</option>
       @foreach($campaigns as $campaign)
        <option
        {{strtolower($contact->campaign) == strtolower($campaign->name)  ? 'selected' : ''}}
        value="{{$campaign->name}}">{{$campaign->name}}</option>
        @endforeach
      </select>
                      </div>
                    </div>
                    <!--end::Group-->

                            <!--begin::Group-->
                            <div class="form-group row fv-plugins-icon-container">
                                <label class="col-xl-3 col-lg-3 col-form-label">{{__('site.campaign_country')}}</label>
                                <div class="col-lg-9 col-xl-9">
                                  <select class="form-control"  name="campaign_country" tabindex="-1" aria-hidden="true">
                                    <option value="">{{ __('site.choose') }}</option>
                                    @foreach($countries as $country)
                                      <option data-code="{{$country->code}}" {{$contact->campaign_country == $country->id ? 'selected' : ''}}
                                      value="{{$country->id}}" data-select2-id="{{$country->id}}">{{$country->name}}</option>
                                    @endforeach
                                  </select>

                                </div>
                              </div>
																			<!--end::Group-->

                    <!--begin::Group-->
                    <div class="form-group row fv-plugins-icon-container">
                      <label class="col-xl-3 col-lg-3 col-form-label">{{__('site.source')}}</label>
                      <div class="col-lg-9 col-xl-9">

                        <select class="form-control"  name="source" tabindex="-1" aria-hidden="true">
                                        	<option value="">{{ __('site.choose') }}</option>
                                           @foreach($sources as $source)
                                            <option
                                            {{strtolower($contact->source) == strtolower($source->name)  ? 'selected' : ''}}
                                            value="{{$source->name}}">{{$source->name}}</option>
                                            @endforeach
                                          </select>
                      </div>
                    </div>
                    <!--end::Group-->
                    <!--begin::Group-->
                    <div class="form-group row fv-plugins-icon-container">
                      <label class="col-xl-3 col-lg-3 col-form-label">{{__('site.medium')}}</label>
                      <div class="col-lg-9 col-xl-9">
                        <select class="form-control"  name="medium" tabindex="-1" aria-hidden="true">
                                        	<option value="">{{ __('site.choose') }}</option>
                                           @foreach($mediums as $medium)
                                            <option
                                            {{$contact->medium == $medium->name ? 'selected' : ''}}
                                            value="{{$medium->name}}">{{$medium->name}}</option>
                                            @endforeach
                                          </select>
                      </div>
                    </div>
                    <!--end::Group-->
                    <!--begin::Group-->
                    <div class="form-group row fv-plugins-icon-container">
                      <label class="col-xl-3 col-lg-3 col-form-label">{{__('site.content')}}</label>
                      <div class="col-lg-9 col-xl-9">
                         <select class="form-control"  name="content" tabindex="-1" aria-hidden="true">
                                        	<option value="">{{ __('site.choose') }}</option>
                                           @foreach($contents as $content)
                                            <option
                                            {{strtolower($contact->content) == strtolower($content->name)  ? 'selected' : ''}}
                                            value="{{ $content->name}}">{{$content->name}}</option>
                                            @endforeach
                                          </select>
                      </div>
                    </div>
                    <!--end::Group-->
                    <!--begin::Group-->
                    <div class="form-group row fv-plugins-icon-container" data-select2-id="39">
                      <label class="col-xl-3 col-lg-3 col-form-label">{{__('site.language')}}</label>
                      <div class="col-lg-9 col-xl-9" data-select2-id="38">
                        <select class="form-control"  name="lang">
                          <option {{$contact->lang == 'arabic' ? 'selected' : 'arabic'}} value="arabic">عربي</option>
                          <option {{$contact->lang == 'english' ? 'selected' : ''}} value="english">english</option>
                          <option {{$contact->lang == 'russian' ? 'selected' : ''}} value="russian">russian</option>
                          <option {{$contact->lang == 'French' ? 'selected' : ''}} value="French">French</option>

                        </select>
                      </div>
                     </div>
                    <!--end::Group-->
                    @if(userRole() != 'seller')
                    <!--begin::Group-->
                    <div class="form-group row fv-plugins-icon-container" data-select2-id="39">
                      <label class="col-xl-3 col-lg-3 col-form-label">{{__('site.contact owner')}}</label>
                      <div class="col-lg-9 col-xl-9" data-select2-id="38">
                        <select class="form-control"  name="user_id">
                        <option value="">{{ __('site.select option') }} </option>
                          @foreach($sellers as $seller)
                          <option {{$contact->user_id == $seller->id ? 'selected' : ''}}
                            value="{{$seller->id}}"
                            >{{$seller->name}}</option>
                          @endforeach
                        </select>
                      </div>
                     </div>
                    <!--end::Group-->
                    @endif
                    <!--begin::Group-->
                    <div class="form-group row fv-plugins-icon-container" data-select2-id="39">
                      <label class="col-xl-3 col-lg-3 col-form-label">{{__('site.purpose type')}}</label>
                      <div class="col-lg-9 col-xl-9" data-select2-id="38">
                        <select class="form-control"  name="purpose_type">
                          <option value="">choose</option>
                          @foreach($purposetype as $purpType)
                          <option {{strtolower($contact->purpose_type) == strtolower($purpType->name) ? 'selected' : ''}} value="{{$purpType->name}}">{{$purpType->name}}</option>
                          @endforeach
                        </select>
                      </div>
                     </div>

                     @if(count($purpose) == 1)
                        <input type="hidden" value="{{$purpose[0]}}" name="purpose" />
                      @elseif(count($purpose)>1)
                      <!--begin::Group-->
                      <div class="form-group row fv-plugins-icon-container" data-select2-id="39">
                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('site.Purpose')}} </label>
                        <div class="col-lg-9 col-xl-9" data-select2-id="38">
                          <select class="form-control"  name="purpose">
                            <option value="">{{ __('site.choose') }}</option>
                            @foreach($purpose as $purp)
                            <option {{strtolower($contact->purpose) == strtolower($purp) ? 'selected' : ''}} value="{{$purp}}">{{$purp}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <!--end::Group-->
                      @endif
                    <!--end::Group-->
                      <!--begin::Group-->
                      <div class="form-group row fv-plugins-icon-container">
                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('site.Agent')}} {{__('site.Purpose')}} </label>
                        <div class="col-lg-9 col-xl-9">
                          <select class="form-control"  name="agent_purpose">
                            <option value="">{{ __('site.choose') }}</option>
                            @foreach($purpose as $purp)
                            <option {{strtolower($contact->agent_purpose) == strtolower($purp) ? 'selected' : ''}} value="{{$purp}}">{{$purp}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <!--end::Group-->
                  </div>
                  <!--end::Wizard Step 1-->
<!--begin::Group-->
<div class="form-group row fv-plugins-icon-container" data-select2-id="">
		<label class="col-xl-3 col-lg-3 col-form-label">{{__('site.lead_category')}} </label>
		<div class="col-lg-9 col-xl-9" data-select2-id="">
			<select class="form-control"  name="lead_category" id="lead_category">
				<option {{$contact->lead_category == 'Primary' ? 'selected' : ''}} value="Primary">{{__('site.Primary')}}</option>
				<option {{$contact->lead_category == 'Secondary' ? 'selected' : ''}} value="Secondary">{{__('site.Secondary')}}</option>
			</select>
		</div>
	</div>
	<!--end::Group-->	
                  <!--begin::Wizard Actions-->
                  <div class="d-flex justify-content-between border-top pt-10 mt-15">
                    <div>
                        <input type="submit" class="btn btn-primary font-weight-bolder px-9 py-4" value="{{__('site.save')}}"/>
                    </div>
                  </div>
                  <!--end::Wizard Actions-->
                </div>
              </div>
            <div>
            </div>
            <div>
            </div>
            <div>
            </div>
          </form>
            <!--end::Wizard Form-->
          </div>

      </div>
  </div>
</div>
<!-- Add Log-email Modal-->
<div class="modal fade" id="add-log-email" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{__('site.log email')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i aria-hidden="true" class="ki ki-close"></i>
        </button>
      </div>
      <div class="modal-body">
        <div class="card card-custom">
          <!--begin::Form-->
            <form id="add-log-email-form" action="{{route('admin.logs.store')}}" method="POST">
              @csrf
              <input type="hidden" value="email" name="type" />
             <div class="card-body">
              <input type="hidden" value="{{$contact->id}}" name="contact_id">
              <div class="row">
                <div class="col-md-6 col-sm--12">
                  <div class="form-group ">
                     <label class="">{{__('site.date')}}</label>
                     <div class="">
                       <div class="input-group input-group-solid date" id="kt_datetimepicker_33" data-target-input="nearest">
                         <input value="{{old('date')}}" required type="text" class="form-control form-control-solid datetimepicker-input"
                         data-toggle="datetimepicker"
                         name="date" data-target="#kt_datetimepicker_33">
                         <div class="input-group-append" data-target="#kt_datetimepicker_33" data-toggle="datetimepicker">
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
                 <label class="">{{__('site.time')}}</label>
                 <div class="">
                   <div class="input-group input-group-solid date" id="kt_datetimepicker_444" data-target-input="nearest">
                     <input required value="{{old('time')}}" type="text" class="form-control form-control-solid datetimepicker-input"
                     data-toggle="datetimepicker"
                     name="time" data-target="#kt_datetimepicker_444">
                     <div class="input-group-append" data-target="#kt_datetimepicker_444" data-toggle="datetimepicker">
                       <span class="input-group-text">
                         <i class="ki ki-clock"></i>
                       </span>
                     </div>
                   </div>
                 </div>
               </div>
              </div>
              </div>
              <hr />
              <div class="form-group">
                <label class="d-block">{{ __('site.description') }}</label>
                <textarea name="description"  id="log-email-description">{{old('description')}}</textarea>
              </div>

        <!--begin::Group-->
		
				<!--begin::Group-->
				 <div class="form-group ">
					<label class="">{{__('site.status')}}</label>

						<select class="form-control"  name="status_id" style="width:100%">
							@foreach($status as $statu)
							<option
							{{$contact->status_id == $statu->id ? 'selected' : ''}}
							value="{{$statu->id}}" data-select2-id="{{$statu->name}}">{{$statu->name}}</option>
							@endforeach
						</select>

				</div>
				<!--begin::Group-->
				<div class="form-group  fv-plugins-icon-container">
					<label class="">{{__('site.lead type')}}</label>
					<div class="">
						<select class="form-control"  name="lead_type" tabindex="-1" aria-hidden="true">
						<option value="">choose</option>
						 @foreach(lead_types() as $lead_type)
							<option
							{{strtolower($contact->lead_type) == strtolower($lead_type)  ? 'selected' : ''}}
							value="{{$lead_type}}">{{$lead_type}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<!--end::Group-->
			
        <!--end::Group-->

             <div class="form-group">
               <div class="checkbox-list">
                   <label class="checkbox">
                       <input type="checkbox"
                       {{old('withtask') ? 'checked' : ''}}
                        class="show-task" name="withtask"/>
                       <span></span>
                       {{ __('site.with Task') }}
                   </label>
               </div>
             </div>
             <div class="task form-group" style="display:none">
               <div class="row">
                <div class="col-md-6 col-sm--12">
                  <div class="form-group ">
                     <label class="">{{__('site.date')}}</label>
                     <div class="">
                       <div class="input-group input-group-solid date" id="kt_datetimepicker_333" data-target-input="nearest">
                         <input value="{{old('task_date')}}"  type="text" class="form-control form-control-solid datetimepicker-input"
                         data-toggle="datetimepicker"
                         name="task_date" data-target="#kt_datetimepicker_333">
                         <div class="input-group-append" data-target="#kt_datetimepicker_333" data-toggle="datetimepicker">
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
                 <label class="">{{__('site.time')}}</label>
                 <div class="">
                   <div class="input-group input-group-solid date" id="kt_datetimepicker_4444" data-target-input="nearest">
                     <input  value="{{old('task_time')}}" type="text" class="form-control form-control-solid datetimepicker-input"
                     data-toggle="datetimepicker"
                     name="task_time" data-target="#kt_datetimepicker_4444">
                     <div class="input-group-append" data-target="#kt_datetimepicker_4444" data-toggle="datetimepicker">
                       <span class="input-group-text">
                         <i class="ki ki-clock"></i>
                       </span>
                     </div>
                   </div>
                 </div>
               </div>
              </div>
              </div>
              <div class="form-group">
                <label for="task-type">{{__('site.type')}}</label>
                <select name="task_type" class="form-control">
                  <option value="">{{__('site.select option')}}</option>
                  <option
                  {{old('task_type') == 'email' ? 'selected' : '' }}
                  value="email">{{__('site.email')}}</option>
                  <option
                  {{old('task_type') == 'call' ? 'selected' : '' }}
                  value="call">{{__('site.call')}}</option>
                  <option
                  {{old('task_type') == 'whatsapp' ? 'selected' : '' }}
                  value="whatsapp">{{__('site.whatsapp')}}</option>
                </select>
              </div>
             </div>
             </div>
             <div class="card-footer">
              <button type="submit" form="add-log-email-form" class="btn btn-primary mr-2">{{__('site.save')}}</button>
              <button data-dismiss="modal" form="add-log-email-form"  class="btn btn-secondary">{{__('site.cancel')}}</button>
             </div>
            </form>
            <!--end::Form-->
        </div>
      </div>
    </div>
  </div>
</div>
<!--- Eit Log-email Model -->
<!-- Add Log-CALL Modal-->
<div class="modal fade" id="add-log-call" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{__('site.log call')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i aria-hidden="true" class="ki ki-close"></i>
        </button>
      </div>
      <div class="modal-body">
        <div class="card card-custom">
          <!--begin::Form-->
            <form id="add-log-call-form" action="{{route('admin.logs.store')}}" method="POST">
              @csrf
              <input type="hidden" value="call" name="type" />
             <div class="card-body">
              <input type="hidden" value="{{$contact->id}}" name="contact_id">
              <div class="row">
                <div class="col-md-6 col-sm--12">
                  <div class="form-group ">
                     <label class="">{{__('site.date')}}</label>
                     <div class="">
                       <div class="input-group input-group-solid date" id="kt_datetimepicker_33333" data-target-input="nearest">
                         <input value="{{old('date')}}" required type="text" class="form-control form-control-solid datetimepicker-input"
                         data-toggle="datetimepicker"
                         name="date" data-target="#kt_datetimepicker_33333">
                         <div class="input-group-append" data-target="#kt_datetimepicker_33333" data-toggle="datetimepicker">
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
                 <label class="">{{__('site.time')}}</label>
                 <div class="">
                   <div class="input-group input-group-solid date" id="datapicker_logcall_pickertime" data-target-input="nearest">
                     <input required value="{{old('time')}}" type="text" class="form-control form-control-solid datetimepicker-input"
                     data-toggle="datetimepicker"
                     name="time" data-target="#datapicker_logcall_pickertime">
                     <div class="input-group-append" data-target="#datapicker_logcall_pickertime" data-toggle="datetimepicker">
                       <span class="input-group-text">
                         <i class="ki ki-clock"></i>
                       </span>
                     </div>
                   </div>
                 </div>
               </div>
              </div>
              </div>
              <hr />
              <div class="form-group">
               <label for="task-type">{{__('site.call outCome')}}</label>
               @php
                 $outcomes = ['busy','connected','no answer','wrong number','switch off'];
               @endphp
               <select name="call_outcome" id="log_call_outcome_el" class="form-control" required style="text-transform: capitalize;">
                 <option value="">{{__('site.select option')}}</option>
                 @foreach($outcomes as $outcome)
                   <option
                      {{ old('connected') == $outcome ? 'selected' : '' }}
                    value="{{$outcome}}">{{__('site.'.$outcome)}}</option>
                 @endforeach
               </select>
             </div>

              <div class="form-group" id="log-call-description-parent" style="display:block">
                <label class="d-block">{{ __('site.description') }}</label>
                <textarea name="description" id="log-call-description">{{ old('description') }}</textarea>
              </div>

              <!--begin::Group-->
					
		 				 <!--begin::Group-->
		 					<div class="form-group ">
		 					 <label class="">{{__('site.status')}}</label>

		 						 <select class="form-control follow_up_status_id"  name="status_id"   style="width:100%">
		 							 @foreach($status as $statu)
		 							 <option
		 							 {{$contact->status_id == $statu->id ? 'selected' : ''}}
		 							 value="{{$statu->id}}" data-select2-id="{{$statu->name}}">{{$statu->name}}</option>
		 							 @endforeach
		 						 </select>

		 				 </div>


              <div class="row follow_up_date" style="display:none" id="">
                <div class="col-md-6 col-sm-6">
                  <div class="form-group ">
                    <label class="">{{__('site.follow_up_date')}}</label>
                    <div class="input-group input-group-solid date" id="kt_datetimepicker_3333444" data-target-input="nearest">
                      <input value="{{old('follow_up_date')}}"  type="text" class="form-control form-control-solid datetimepicker-input"
                      data-toggle="datetimepicker" name="follow_up_date" data-target="#kt_datetimepicker_3333444">
                      <div class="input-group-append" data-target="#kt_datetimepicker_3333444" data-toggle="datetimepicker">
                        <span class="input-group-text">
                          <i class="ki ki-calendar"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
		 				 <!--begin::Group-->
		 				 <div class="form-group  fv-plugins-icon-container">
		 					 <label class="">{{__('site.lead type')}}</label>
		 					 <div class="">
		 						 <select class="form-control"  name="lead_type" tabindex="-1" aria-hidden="true">
		 						 <option value="">choose</option>
		 							@foreach(lead_types() as $lead_type)
		 							 <option
		 							 {{strtolower($contact->lead_type) == strtolower($lead_type)  ? 'selected' : ''}}
		 							 value="{{$lead_type}}">{{$lead_type}}</option>
		 							 @endforeach
		 						 </select>
		 					 </div>
		 				 </div>
		 				 <!--end::Group-->
		 				
        <!--end::Group-->

             <div class="form-group">
               <div class="checkbox-list">
                   <label class="checkbox">
                       <input type="checkbox"
                       {{old('withtask') ? 'checked' : ''}}
                        class="show-task" name="withtask"/>
                       <span></span>
                       {{ __('site.with Task') }}
                   </label>
               </div>
             </div>
             <div class="task form-group" style="display:none">
               <div class="row">
                <div class="col-md-6 col-sm--12">
                  <div class="form-group ">
                     <label class="">{{__('site.date')}}</label>
                     <div class="">
                       <div class="input-group input-group-solid date" id="kt_datetimepicker_3333" data-target-input="nearest">
                         <input value="{{old('task_date')}}"  type="text" class="form-control form-control-solid datetimepicker-input"
                         data-toggle="datetimepicker"
                         name="task_date" data-target="#kt_datetimepicker_3333">
                         <div class="input-group-append" data-target="#kt_datetimepicker_3333" data-toggle="datetimepicker">
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
                 <label class="">{{__('site.time')}}</label>
                 <div class="">
                   <div class="input-group input-group-solid date" id="kt_datetimepicker_444444" data-target-input="nearest">
                     <input  value="{{old('task_time')}}" type="text" class="form-control form-control-solid datetimepicker-input"
                     data-toggle="datetimepicker"
                     name="task_time" data-target="#kt_datetimepicker_444444">
                     <div class="input-group-append" data-target="#kt_datetimepicker_444444" data-toggle="datetimepicker">
                       <span class="input-group-text">
                         <i class="ki ki-clock"></i>
                       </span>
                     </div>
                   </div>
                 </div>
               </div>
              </div>
              </div>
              <div class="form-group">
                <label for="task-type">Type</label>
                <select name="task_type" class="form-control">
                  <option value="">{{__('site.select option')}}</option>
                  <option
                  {{old('task_type') == 'email' ? 'selected' : '' }}
                  value="email">email</option>
                  <option
                  {{old('task_type') == 'call' ? 'selected' : '' }}
                  value="call">call</option>
                  <option
                  {{old('task_type') == 'whatsapp' ? 'selected' : '' }}
                  value="whatsapp">whatsapp</option>
                  <option
                  {{old('type') == 'viewing' ? 'selected' : '' }}
                  value="viewing">{{__('site.viewing')}}</option>
                  <option {{old('type') == 'photoshoot' ? 'selected' : '' }}
                  value="photoshoot">{{__('site.photoshoot')}}</option>
                  <option {{old('type') == 'fieldvisit' ? 'selected' : '' }}
                  value="fieldvisit">{{__('site.field_visit')}}</option>

                </select>
              </div>
             </div>
             </div>
             <div class="card-footer">
              <button type="submit" form="add-log-call-form" class="btn btn-primary mr-2">{{__('site.save')}}</button>
              <button data-dismiss="modal" form="add-log-call-form"  class="btn btn-secondary">{{__('site.cancel')}}</button>
             </div>
            </form>
            <!--end::Form-->
        </div>
      </div>
    </div>
  </div>
</div>
<!--- Eit Log-CALL Model -->
<!-- Add meeting Modal-->
<div class="modal fade" id="add-log-meeting" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{__('site.log meeting')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i aria-hidden="true" class="ki ki-close"></i>
        </button>
      </div>
      <div class="modal-body">
        <div class="card card-custom">
          <!--begin::Form-->
            <form id="add-log-meeting-form" action="{{route('admin.logs.store')}}" method="POST">
              @csrf
              <input type="hidden" value="meeting" name="type" />
             <div class="card-body">
               <div>
                 <label>{{__('site.duration')}}</label>
                 <select name="duration" class="form-control" >
                   <option value="">{{__('site.select option')}}</option>
                   @foreach($durations as $duration)
                     <option
                     {{old('duration') == $duration ? 'selected' : ''}}
                      value="{{$duration}}">{{$duration}}</option>
                   @endforeach
                 </select>
               </div>
             <hr />
              <input type="hidden" value="{{$contact->id}}" name="contact_id">
              <div class="row">
                <div class="col-md-6 col-sm--12">
                  <div class="form-group ">
                     <label class="">{{__('site.date')}}</label>
                     <div class="">
                       <div class="input-group input-group-solid date" id="kt_datetimepicker_3333333" data-target-input="nearest">
                         <input value="{{old('date')}}" required type="text" class="form-control form-control-solid datetimepicker-input"
                         data-toggle="datetimepicker"
                         name="date" data-target="#kt_datetimepicker_3333333">
                         <div class="input-group-append" data-target="#kt_datetimepicker_3333333" data-toggle="datetimepicker">
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
                 <label class="">{{__('site.time')}}</label>
                 <div class="">
                   <div class="input-group input-group-solid date" id="kt_datetimepicker_4444444" data-target-input="nearest">
                     <input required value="{{old('time')}}" type="text" class="form-control form-control-solid datetimepicker-input"
                     data-toggle="datetimepicker"
                     name="time" data-target="#kt_datetimepicker_4444444">
                     <div class="input-group-append" data-target="#kt_datetimepicker_4444444" data-toggle="datetimepicker">
                       <span class="input-group-text">
                         <i class="ki ki-clock"></i>
                       </span>
                     </div>
                   </div>
                 </div>
               </div>
              </div>
              </div>
              <hr />
              <div class="form-group">
               <label for="task-type">{{__('site.meeting outcome')}}</label>
               @php
                 $outcomes = ['scheduled','completed','no show','canceled'];
               @endphp
               <select name="call_outcome" class="form-control" required>
                 <option value="">{{__('site.select option')}}</option>
                 @foreach($outcomes as $outcome)
                   <option
                   {{old('call_outcome') == $outcome ? 'selected' : ''}}
                    value="{{$outcome}}">{{__('site.'.$outcome)}}</option>
                 @endforeach
               </select>
             </div>
              <div class="form-group">
                <label class="d-block">{{ __('site.description') }}</label>
                <textarea name="description"  id="log-meeting-description">{{old('description')}}</textarea>
              </div>


					
							<!--begin::Group-->
			         <div class="form-group ">
			          <label class="">{{__('site.status')}}</label>

			            <select class="form-control"  name="status_id" style="width:100%">
			              @foreach($status as $statu)
			              <option
			              {{$contact->status_id == $statu->id ? 'selected' : ''}}
			              value="{{$statu->id}}" data-select2-id="{{$statu->name}}">{{$statu->name}}</option>
			              @endforeach
			            </select>

			        </div>
			        <!--begin::Group-->
			        <div class="form-group  fv-plugins-icon-container">
			          <label class="">{{__('site.lead type')}}</label>
			          <div class="">
			            <select class="form-control"  name="lead_type" tabindex="-1" aria-hidden="true">
			            <option value="">choose</option>
			             @foreach(lead_types() as $lead_type)
			              <option
			              {{strtolower($contact->lead_type) == strtolower($lead_type)  ? 'selected' : ''}}
			              value="{{$lead_type}}">{{$lead_type}}</option>
			              @endforeach
			            </select>
			          </div>
			        </div>
			        <!--end::Group-->
						

             <div class="form-group">
               <div class="checkbox-list">
                   <label class="checkbox">
                       <input type="checkbox"
                       {{old('withtask') ? 'checked' : ''}}
                        class="show-task" name="withtask"/>
                       <span></span>
                       {{ __('site.with Task') }}
                   </label>
               </div>
             </div>
             <div class="task form-group" style="display:none">
               <div class="row">
                <div class="col-md-6 col-sm--12">
                  <div class="form-group ">
                     <label class="">{{__('site.date')}}</label>
                     <div class="">
                       <div class="input-group input-group-solid date" id="kt_datetimepicker_333333" data-target-input="nearest">
                         <input value="{{old('task_date')}}"  type="text" class="form-control form-control-solid datetimepicker-input"
                         data-toggle="datetimepicker"
                         name="task_date" data-target="#kt_datetimepicker_333333">
                         <div class="input-group-append" data-target="#kt_datetimepicker_333333" data-toggle="datetimepicker">
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
                 <label class="">{{__('site.time')}}</label>
                 <div class="">
                   <div class="input-group input-group-solid date" id="kt_datetimepicker_44444444" data-target-input="nearest">
                     <input  value="{{old('task_time')}}" type="text" class="form-control form-control-solid datetimepicker-input"
                     data-toggle="datetimepicker"
                     name="task_time" data-target="#kt_datetimepicker_44444444">
                     <div class="input-group-append" data-target="#kt_datetimepicker_44444444" data-toggle="datetimepicker">
                       <span class="input-group-text">
                         <i class="ki ki-clock"></i>
                       </span>
                     </div>
                   </div>
                 </div>
               </div>
              </div>
              </div>
              <div class="form-group">
                <label for="task-type">Type</label>
                <select name="task_type" class="form-control">
                  <option value="">{{__('site.select option')}}</option>
                  <option
                  {{old('task_type') == 'email' ? 'selected' : '' }}
                  value="email">{{__('site.email')}}</option>
                  <option
                  {{old('task_type') == 'call' ? 'selected' : '' }}
                  value="call">{{__('site.call')}}</option>
                  <option
                  {{old('task_type') == 'whatsapp' ? 'selected' : '' }}
                  value="whatsapp">{{__('site.whatsapp')}}</option>
                </select>
              </div>
             </div>
             </div>
             <div class="card-footer">
              <button type="submit" form="add-log-meeting-form" class="btn btn-primary mr-2">{{__('site.save')}}</button>
              <button data-dismiss="modal" form="add-log-meeting-form"  class="btn btn-secondary">{{__('site.cancel')}}</button>
             </div>
            </form>
            <!--end::Form-->
        </div>
      </div>
    </div>
  </div>
</div>
<!--- Eit meeting Model -->
<!-- Add meeting Modal-->
<div class="modal fade" id="add-new-meeting" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{__('site.new meeting')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i aria-hidden="true" class="ki ki-close"></i>
        </button>
      </div>
      <div class="modal-body">
        <div class="card card-custom">
          <!--begin::Form-->
            <form id="add-new-meeting-form" action="{{route('admin.logs.store')}}" method="POST">
              @csrf
              <input type="hidden" value="meeting" name="type" />
              <input type="hidden" value="0" name="is_log" />
             <div class="card-body">
             <div>
               <label>{{__('site.duration')}}</label>
               <select name="duration" class="form-control" >
                 <option value="">select</option>
                 @foreach($durations as $duration)
                   <option
                   {{old('duration') == $duration ? 'selected' : ''}}
                    value="{{$duration}}">{{$duration}}</option>
                 @endforeach
               </select>
             </div>
             <hr />
              <input type="hidden" value="{{$contact->id}}" name="contact_id">
              <div class="row">
                <div class="col-md-6 col-sm--12">
                  <div class="form-group ">
                     <label class="">{{__('site.date')}}</label>
                     <div class="">
                       <div class="input-group input-group-solid date" id="datetimepicker_newmeeting" data-target-input="nearest">
                         <input value="{{old('date')}}" required type="text" class="form-control form-control-solid datetimepicker-input"
                         data-toggle="datetimepicker"
                         name="date" data-target="#datetimepicker_newmeeting">
                         <div class="input-group-append" data-target="#datetimepicker_newmeeting" data-toggle="datetimepicker">
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
                 <label class="">{{__('site.time')}}</label>
                 <div class="">
                   <div class="input-group input-group-solid date" id="kt_datapicker_addnewmeeting" data-target-input="nearest">
                     <input required value="{{old('time')}}" type="text" class="form-control form-control-solid datetimepicker-input"
                     data-toggle="datetimepicker"
                     name="time" data-target="#kt_datapicker_addnewmeeting">
                     <div class="input-group-append" data-target="#kt_datapicker_addnewmeeting" data-toggle="datetimepicker">
                       <span class="input-group-text">
                         <i class="ki ki-clock"></i>
                       </span>
                     </div>
                   </div>
                 </div>
               </div>
              </div>
              </div>

              <div class="form-group">
                <label class="d-block">{{ __('site.description') }}</label>
                <textarea name="description"  id="new-meeting-description">{{old('description')}}</textarea>
              </div>

        <input type="hidden" name="lead_type" value="{{ strtolower($lead_type) }}">


             </div>
             <div class="card-footer">
              <button type="submit" form="add-new-meeting-form" class="btn btn-primary mr-2">{{__('site.save')}}</button>
              <button data-dismiss="modal" form="add-new-meeting-form"  class="btn btn-secondary">{{__('site.cancel')}}</button>
             </div>
            </form>
            <!--end::Form-->
        </div>
      </div>
    </div>
  </div>
</div>
<!--- Eit meeting Model -->
<!-- Add Log-CALL Modal-->
<div class="modal fade" id="add-log-whatsapp" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{__('site.log whatsapp')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i aria-hidden="true" class="ki ki-close"></i>
        </button>
      </div>
      <div class="modal-body">
        <div class="card card-custom">
          <!--begin::Form-->
            <form id="add-log-whatsapp-form" action="{{route('admin.logs.store')}}" method="POST">
              @csrf
              <input type="hidden" value="whatsapp" name="type" />
             <div class="card-body">
              <input type="hidden" value="{{$contact->id}}" name="contact_id">
              <div class="row">
                <div class="col-md-6 col-sm--12">
                  <div class="form-group ">
                     <label class="">{{__('site.date')}}</label>
                     <div class="">
                       <div class="input-group input-group-solid date" id="whatsapp_add_logs" data-target-input="nearest">
                         <input value="{{old('date')}}" required type="text" class="form-control form-control-solid datetimepicker-input"
                         data-toggle="datetimepicker"
                         name="date" data-target="#whatsapp_add_logs">
                         <div class="input-group-append" data-target="#whatsapp_add_logs" data-toggle="datetimepicker">
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
                 <label class="">{{__('site.time')}}</label>
                 <div class="">
                   <div class="input-group input-group-solid date" id="datapicker_logwhatssupp_pickertime" data-target-input="nearest">
                     <input required value="{{old('time')}}" type="text" class="form-control form-control-solid datetimepicker-input"
                     data-toggle="datetimepicker"
                     name="time" data-target="#datapicker_logwhatssupp_pickertime">
                     <div class="input-group-append" data-target="#datapicker_logwhatssupp_pickertime" data-toggle="datetimepicker">
                       <span class="input-group-text">
                         <i class="ki ki-clock"></i>
                       </span>
                     </div>
                   </div>
                 </div>
               </div>
              </div>
              </div>
              <hr />
              <div class="form-group">
                <label class="d-block">{{ __('site.description') }}</label>
                <textarea name="description"  id="log-whatsapp-description">{{old('description')}}</textarea>
              </div>
    <!--begin::Group-->

		<!--begin::Group-->
		 <div class="form-group ">
			<label class="">{{__('site.status')}}</label>

				<select class="form-control"  name="status_id" style="width:100%">
					@foreach($status as $statu)
					<option
					{{$contact->status_id == $statu->id ? 'selected' : ''}}
					value="{{$statu->id}}" data-select2-id="{{$statu->name}}">{{$statu->name}}</option>
					@endforeach
				</select>

		</div>
		<!--begin::Group-->
		<div class="form-group  fv-plugins-icon-container">
			<label class="">{{__('site.lead type')}}</label>
			<div class="">
				<select class="form-control"  name="lead_type" tabindex="-1" aria-hidden="true">
				<option value="">choose</option>
				 @foreach(lead_types() as $lead_type)
					<option
					{{strtolower($contact->lead_type) == strtolower($lead_type)  ? 'selected' : ''}}
					value="{{$lead_type}}">{{$lead_type}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<!--end::Group-->
	
        <!--end::Group-->
             <div class="form-group">
               <div class="checkbox-list">
                   <label class="checkbox">
                       <input type="checkbox"
                       {{old('withtask') ? 'checked' : ''}}
                        class="show-task" name="withtask"/>
                       <span></span>
                       {{ __('site.with Task') }}
                   </label>
               </div>
             </div>
             <div class="task form-group" style="display:none">
               <div class="row">
                <div class="col-md-6 col-sm--12">
                  <div class="form-group ">
                     <label class="">{{__('site.date')}}</label>
                     <div class="">
                       <div class="input-group input-group-solid date" id="whatsapp_add_logs_task" data-target-input="nearest">
                         <input value="{{old('task_date')}}"  type="text" class="form-control form-control-solid datetimepicker-input"
                         data-toggle="datetimepicker"
                         name="task_date" data-target="#whatsapp_add_logs_task">
                         <div class="input-group-append" data-target="#whatsapp_add_logs_task" data-toggle="datetimepicker">
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
                 <label class="">{{__('site.time')}}</label>
                 <div class="">
                   <div class="input-group input-group-solid date" id="datapicker_logwhatssupp_pickertime_task" data-target-input="nearest">
                     <input  value="{{old('task_time')}}" type="text" class="form-control form-control-solid datetimepicker-input"
                     data-toggle="datetimepicker"
                     name="task_time" data-target="#datapicker_logwhatssupp_pickertime_task">
                     <div class="input-group-append" data-target="#datapicker_logwhatssupp_pickertime_task" data-toggle="datetimepicker">
                       <span class="input-group-text">
                         <i class="ki ki-clock"></i>
                       </span>
                     </div>
                   </div>
                 </div>
               </div>
              </div>
              </div>
              <div class="form-group">
                <label for="task-type">{{__('site.type')}}</label>
                <select name="task_type" class="form-control">
                  <option value="">{{__('site.select option')}}</option>
                  <option
                  {{old('task_type') == 'email' ? 'selected' : '' }}
                  value="email">{{__('site.email')}}</option>
                  <option
                  {{old('task_type') == 'call' ? 'selected' : '' }}
                  value="call">{{__('site.call')}}</option>
                  <option
                  {{old('task_type') == 'whatsapp' ? 'selected' : '' }}
                  value="whatsapp">{{__('site.whatsapp')}}</option>
                </select>
              </div>
             </div>
             </div>
             <div class="card-footer">
              <button type="submit" form="add-log-whatsapp-form" class="btn btn-primary mr-2">{{__('site.save')}}</button>
              <button data-dismiss="modal" form="add-log-whatsapp-form"  class="btn btn-secondary">{{__('site.cancel')}}</button>
             </div>
            </form>
            <!--end::Form-->
        </div>
      </div>
    </div>
  </div>
</div>
<!--- Eit Log-CALL Model -->

@push('js')
<script>


$('#kt_datetimepicker_33334444').datetimepicker({
    format: 'L'
});
$('#kt_datetimepicker_3333444').datetimepicker({
    format: 'L'
});
$('#kt_datetimepicker_333344').datetimepicker({
    format: 'L'
});
$(document).on('change','#log_call_outcome_el',function (){
    renderDescriptionStatus();
});

$(document).on('change','.follow_up_status_id',function (){
  if($(this).val() == '5'){ //Follow Up status
    $("input[name='follow_up_date']").attr('required',true);
    $(".follow_up_date").show();
  }else{
    $("input[name='follow_up_date']").removeAttr('required');
    $(".follow_up_date").hide();
  }
});



function renderDescriptionStatus()
{
    let selected_val = $('#log_call_outcome_el');
    let descEl = $('#log-call-description-parent');
    let textArea  = $('#log-call-description-parent textarea');

    if(selected_val.val() == 'connected' || selected_val.val() == 'busy' ||selected_val.val() == 'no answer')
    {
        descEl.css('display','block');
    }else{
        descEl.css('display','none');
        textArea.val(' ');
    }
};renderDescriptionStatus();

var KTCkeditor = function () {
    // Private functions
    var demos = function () {
        ClassicEditor
      .create( document.querySelector( '#task-description' ) )
      .then( editor => {

      } )
      .catch( error => {
        console.error( error );
      } );

    ClassicEditor
      .create( document.querySelector( '#note-description' ) )
      .then( editor => {

      } )
      .catch( error => {
        console.error( error );
      } );
    ClassicEditor
      .create( document.querySelector( '#note-description-edit' ) )
      .then( editor => {

      } )
      .catch( error => {
        console.error( error );
      } );

    ClassicEditor
      .create( document.querySelector( '#log-email-description' ) )
      .then( editor => {

      } )
      .catch( error => {
        console.error( error );
      } );

    ClassicEditor
      .create( document.querySelector( '#log-meeting-description' ) )
      .then( editor => {

      } )
      .catch( error => {
        console.error( error );
      } );

    ClassicEditor
      .create( document.querySelector( '#log-whatsapp-description' ) )
      .then( editor => {

      } )
      .catch( error => {
        console.error( error );
      } );
    ClassicEditor
      .create( document.querySelector( '#new-meeting-description' ) )
      .then( editor => {

      } )
      .catch( error => {
        console.error( error );
      } );
    ClassicEditor
      .create( document.querySelector( '#log-call-description' ) )
      .then( editor => {

      } )
      .catch( error => {
        console.error( error );
      } );
    ClassicEditor
      .create( document.querySelector( '.description' ) )
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
 $( document ).ready(function (){
$('#unit_country').on('change', function (){
var country_id = this.value;
getCountryCities($('#unit_country').val(),$("#city_id"));
if(country_id==1)
{
  $('#community-subcommunity').hide();
  $('#zone-district').show();
   $.ajax({
        url: "{{url('contactsfetch-')}}",
        type: "POST",
        data: {
            community_id: community_id,
            _token: '{{csrf_token()}}'
        },
        dataType: 'json',
        success: function (result) {
          $('#subcommunities_id').html('<option value="">Select</option>');
          $.each(result.subcommunities, function (key, value) {
            $("#subcommunities_id").append('<option value="' + value
                    .id + '">' + value.name_en + '</option>');
          });
        }
      });
}
if(country_id==2)
{
 $('#community-subcommunity').show();
  $('#zone-district').hide();
}

});
$('#city_id').on('change', function () {
    var city_id = this.value;
      $.ajax({
        url: "{{url('contactsfetch-community')}}",
        type: "POST",
        data: {
            city_id: city_id,
            _token: '{{csrf_token()}}'
        },
        dataType: 'json',
        success: function (result) {
          $('#community_id').html('<option value="">Select</option>');
          $.each(result.communities, function (key, value) {
            $("#community_id").append('<option value="' + value
                    .id + '">' + value.name_en + '</option>');
          });
        }
      });
  });
   //fetch subcommunity
   $('#community_id').on('change', function () {
    var community_id = this.value;
      $.ajax({
        url: "{{url('contactsfetch-subcommunity')}}",
        type: "POST",
        data: {
            community_id: community_id,
            _token: '{{csrf_token()}}'
        },
        dataType: 'json',
        success: function (result) {
          $('#subcommunities_id').html('<option value="">Select</option>');
          $.each(result.subcommunities, function (key, value) {
            $("#subcommunities_id").append('<option value="' + value
                    .id + '">' + value.name_en + '</option>');
          });
        }
      });
    });
    // fetch zone
  $('#city_id').on('change', function () {
    var city_id = this.value;
    $.ajax({
        url: "{{url('contactsfetch-zone')}}",
        type: "POST",
        data: {
          city_id: city_id,
          _token: '{{csrf_token()}}'
        },
        dataType: 'json',
        success: function (result) {
          $('#zone_id').html('<option value="">Select</option>');
          $.each(result.zones, function (key, value) {
            $("#zone_id").append('<option value="' + value
                    .id + '">' + value.zone_name + '</option>');
          });
        }
    });
  });
  //fetch district
   $('#zone_id').on('change', function () {
    var zone_id = this.value;
    $.ajax({
        url: "{{url('contactsfetch-district')}}",
        type: "POST",
        data: {
            zone_id: zone_id,
            _token: '{{csrf_token()}}'
        },
        dataType: 'json',
        success: function (result) {
          $('#district_id').html('<option value="">Select</option>');
          $.each(result.districts, function (key, value) {
           $("#district_id").append('<option value="' + value
                    .id + '">' + value.name + '</option>');
          });
        }
    });
   });
 });
// end added by fazal
</script>
@endpush
