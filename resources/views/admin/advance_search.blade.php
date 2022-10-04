@push('css')
<style>
	#headingOne
	{
	padding: 0;
	}
	#headingOne button
	{
	color:#000;
	text-decoration: none
	}
</style>
@endpush
<div id="accordion">
	<div class="">
		<div class="card-header" id="headingOne">
			<h5 class="mb-0">
			</h5>
		</div>
		<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
			<form method="GET" action="" class="search-from" >
				<div class="row"> <!--- row -->
					<div class="form-group col-md-3 col-sm-3">
						<label>{{__('site.project') }}</label>
						<input type="hidden" name="type" value="campaing">
						<select class="form-control" name="project_id">
							<option value="">{{ __('site.choose') }}</option>
						@foreach($projects_options as $project)
							<option {{Request('project_id') == $project->id ? 'selected' : ''}} value="{{$project->id}}">{{$project->name}}</option>
						@endforeach
						</select>
					</div>

					@if(userRole() != 'sales admin uae' && userRole() != 'sales admin saudi')
					<div class="form-group col-md-3 col-sm-12">
						<label for="country">{{__('site.project') }} {{__('site.country')}}</label>
						<select class="form-control " id="project_country_id"
						name="project_country_id" data-select2-id="" tabindex="-1" aria-hidden="true">
							<option value="">{{ __('site.choose') }}</option>
							@foreach($countries_data as $country)
								<option {{Request('project_country_id') == $country->id ? 'selected' : ''}} value="{{$country->id}}" data-select2-id="{{$country->id}}">{{$country->name}}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group col-md-3 col-sm-12">
						<label for="country">{{__('site.country')}}</label>
						<select class="form-control " id="country_id"
						name="country_id" data-select2-id="" tabindex="-1" aria-hidden="true">
							<option value="">{{ __('site.choose') }}</option>
							@foreach($countries_data as $country)
								<option {{Request('country_id') == $country->id ? 'selected' : ''}} value="{{$country->id}}" data-select2-id="{{$country->id}}">{{$country->name}}</option>
							@endforeach
						</select>
					</div>
					@endif


					<div class="form-group col-md-3 col-sm-12">
						<label for="country">{{__('site.source')}}</label>
						<select class="form-control" name="source">
							<option value="">{{ __('site.choose') }}</option>
							@foreach($sources_data as $source)
							<option {{Request('source') == $source->name ? 'selected' : ''}} value="{{$source->name}}">{{$source->name}}</option>
							@endforeach      
						</select>
					</div>					


					<div class="form-group col-md-3 col-sm--12">
						<div class="form-group ">
							<label class="">{{__('site.Created')}} {{ __('site.from') }} </label>
							<div class="">
							<div class="input-group date" id="from-date" data-target-input="nearest">
							<input value="{{request('from')}}" type="text"
							max="{{date('d-m-Y')}}"
							class="form-control datetimepicker-input"
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
					<div class="form-group col-md-3 col-sm--12">
					<div class="form-group ">
						<label class="">{{__('site.Created')}} {{ __('site.to') }}</label>
						<div class="">
							<div class="input-group  date to-date-el" id="to-date" data-target-input="nearest">
							<input value="{{request('to')}}" type="text" class="form-control datetimepicker-input"
							data-toggle="datetimepicker"
							min="{{date('d-m-Y')}}"
							name="to" data-target="#to-date" autocomplete="off">
							<div class="input-group-append" data-target="#to-date" data-toggle="datetimepicker">
								<span class="input-group-text">
								<i class="ki ki-calendar"></i>
								</span>
							</div>
							</div>
						</div>
						</div>
					</div>
				</div> <!-- end row -->
				<button type="submit" class="btn btn-primary">{{__('site.search')}}</button>
				@if(!isset($advance_campaign))
				<a href="{{request()->fullUrlWithQuery(['exportData' => '1'])}}" class="btn btn-primary font-weight-bolder" id="exportButton" target="_blank" onclick="exportdata()">
					<span class="svg-icon svg-icon-md">
					<i class="fas fa-database" style="color:#fff"></i>
					</span>{{__('site.export') }}
				</a>	
				@endif			
			</form>
		</div>
	</div>
</div>
