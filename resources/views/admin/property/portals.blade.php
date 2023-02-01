@push('css')
<style>
input#portals {
    margin-left: 8px;
    margin-top: 11px;
}
</style>
@endpush
    <div class="modal fade" id="portals_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Select property portals.</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
                <form method="post" action="{{url('property/save-portals')}}" enctype="multipart/form-data" id="saveportals">
                    <div class="modal-body">
                        <div class="form-group">
							@csrf
                            <div class="row col-xl-12">
                                <p class="loader" style="display:none">Request in-process. please wait.</p>   
                            </div>                            
                            <div class="row col-xl-12">
                                @foreach(__('config.portals') as $key =>$value)
                                <div class="col-xl-3">
                                    <span>{{$value}}</span>
                                    @if(isset($property->id))
                                    <input type="checkbox" value="{{$key}}" id="portals" name="portals[]" {{ (isset($property->portals) && in_array($key,$propertyPortals)) ? 'checked' : '' }} multiple>
                                    @else
                                    <input type="checkbox" value="{{$key}}" id="portals" name="portals[]" {{ ($key == '4')  ? 'checked' : '' }} multiple>
                                    @endif
                                    <div class="fv-plugins-message-container"></div>    
                                </div>
                                @endforeach
                            </div>
                            <input type="hidden" name="property_id" value="{{isset($property->id) ? $property->id : '0'}}">
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary font-weight-bolder px-9 py-4" value="{{__('site.save')}}">
                        <button data-dismiss="modal" class="btn btn-secondary font-weight-bolder px-9 py-4">{{__('site.close')}}</button>
                    </div>
                </form>   
			</div>
		</div>
	</div>
@push('js')
	<script type="text/javascript">
    $(document).ready(function(){
        $("form#saveportals").submit(function(e) {
            e.preventDefault();    
            var formData = new FormData(this);
            $.ajax({
                headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },                    
                url: "{{url('property/save-portals')}}",
                type: 'POST',
                data: formData,
                success: function (data) {
                    $("#loadingHolder").hide();
                    alert('portals added successfully!');
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });      

    });
</script>
@endpush