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
					<div class="form-group col-md-4 col-sm-12">
						<label>{{__('site.project') }}</label>
						<input type="hidden" name="type" value="campaing">
						<select class="form-control" name="project_id">
							<option value="">{{ __('site.choose') }}</option>
							@foreach($projects_options as $project)
								@php
								$selected = "";
								if(Request('project_id') == $project->id){
									$selected = "selected";
								}else if(isset($reportData->project_id) && $project->id == $reportData->project_id){
									$selected = "selected";
								}
								@endphp
								<option {{ $selected }} value="{{$project->id}}">{{$project->name}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group col-md-4 col-sm--12">
						<div class="form-group ">
							<label class="">{{ __('site.from') }} </label>
							<div class="">
								<div class="input-group input-group-solid date"
								id="lastupdatefrom-date" data-target-input="nearest">
								@php
								$last_update_from = "";
								if(Request('last_update_from')){
									$last_update_from = Request('last_update_from');
								}else if(isset($reportData->start_from)){
									$last_update_from = date('d/m/Y',strtotime($reportData->start_from));
								}
								@endphp

								<input value="{{$last_update_from}}" type="text"
								max="{{date('d-m-Y')}}"
								class="form-control form-control-solid datetimepicker-input"
								data-toggle="datetimepicker"
								name="last_update_from" data-target="#lastupdatefrom-date" autocomplete="off">
								<div class="input-group-append" data-target="#lastupdatefrom-date" data-toggle="datetimepicker">
									<span class="input-group-text">
									<i class="ki ki-calendar"></i>
									</span>
								</div>
								</div>
							</div>
							</div>
						</div>
						<div class="form-group col-md-4 col-sm--12">
						<div class="form-group ">
							<label class="">{{ __('site.to') }}</label>
							<div class="">
								<div class="input-group input-group-solid date to-date-el" id="lastupdateto-date" data-target-input="nearest">
								@php
								$last_update_to = "";
								if(Request('last_update_to')){
									$last_update_to = Request('last_update_to');
								}else if(isset($reportData->end_to)){
									$last_update_to = date('d/m/Y',strtotime($reportData->end_to));
								}
								@endphp


								<input value="{{ $last_update_to }}" type="text" class="form-control form-control-solid datetimepicker-input"
								data-toggle="datetimepicker"
								min="{{date('d-m-Y')}}"
								name="last_update_to" data-target="#lastupdateto-date" autocomplete="off">
								<div class="input-group-append" data-target="#lastupdateto-date" data-toggle="datetimepicker">
									<span class="input-group-text">
									<i class="ki ki-calendar"></i>
									</span>
								</div>
								</div>
							</div>
							</div>
						</div>


				</div> <!-- end row -->
				@if(isset($advance_campaign_repot))
					<button type="submit" class="btn btn-primary">{{__('site.load report')}}</button>
					<a href="{{route('admin.advance-campaign-report.index')}}" class="btn btn-warning">{{__('site.back to listing page')}}</a>
					@if(isset($reportData->id))
						<a href="{{ route('admin.advance-campaign-report.edit',$reportData->id) }}" class="btn btn-warning">{{__('site.Edit')}}</a>
					@endif
				@elseif(isset($advance_campaign))				
					<button type="submit" class="btn btn-primary">{{__('site.add update report')}}</button>
				@endif
			</form>
		</div>
	</div>
</div>

@push('js')
<script>
	$(`#from-date,#lastupdatefrom-date`).datepicker({
    format: 'dd/mm/yyyy',
    todayHighlight:'TRUE',
    autoclose: true,
  });

  $(`#to-date,#lastupdateto-date`).datepicker({
	format: 'dd/mm/yyyy',
    todayHighlight:'TRUE',
    autoclose: true,
  });
</script>
@endpush
