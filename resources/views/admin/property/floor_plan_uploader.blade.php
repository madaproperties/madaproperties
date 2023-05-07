	<div class="modal fade" id="floor_plan_uploader" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">You can upload multiple images here.</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
                <form method="post" action="{{url('floor-plan/upload/store')}}" enctype="multipart/form-data" id="floorPlanUploader">
				@csrf
                    <div class="modal-body">
                        <div class="form-group propertyFloors">
                            @php($j=1)
                            @if(isset($property->floorPlans) && count($property->floorPlans) > 0)
                                @foreach($property->floorPlans as $document)
                                <div class="row col-xl-12">
                                    <div class="col-xl-5 propertyVar">
                                        <input type="hidden" name="floor_plan_id[]" value="{{$document->id}}">
                                        <input class="form-control form-control-solid form-control-lg" value="{{$document->name}}" type="text" class="form-control" name="floorPlansName[]" placeholder="{{ucfirst(__('site.title'))}}">
                                        <div class="fv-plugins-message-container"></div>    
                                    </div>
                                    <div class="col-xl-5">
                                        <input class="form-control form-control-solid form-control-lg" 	type="file" class="form-control" name="floorPlans[]" accept=".pdf,.jpg,.jpeg,.png">
                                        <div class="fv-plugins-message-container"></div>   
                                        <img src="{{s3AssetUrl('uploads/property/'.$property->id.'/floor_plan/'.$document->document_link) }}" target="_blank"  style="height: 130px;">
                                    </div>
                                    @if($j==1)
                                    <div class="col-xl-2">
                                        <button type="button" class="btn btn-info addFloor">{{__('site.add_more')}}</button>
                                    </div>
                                    @else
                                    <div class="col-xl-2">
                                        <button type="button" class="btn btn-info removeFloor" value="{{$document->id}}">{{__('site.remove')}}</button>
                                    </div>
                                    @endif
                                </div>
                                @php($j++)
                                @endforeach    
                            @endif
                            @if(!isset($property->floorPlans) || (isset($property->floorPlans) && count($property->floorPlans) == 0))
                                <div class="row col-xl-12">
                                    <div class="col-xl-5">
                                        <input class="form-control form-control-solid form-control-lg" type="text" class="form-control" name="floorPlansNameNew[]" placeholder="{{ucfirst(__('site.title'))}}">
                                        <div class="fv-plugins-message-container"></div>    
                                    </div>
                                    <div class="col-xl-5">
                                        <input class="form-control form-control-solid form-control-lg" 	type="file" class="form-control" name="floorPlansNew[]" accept=".pdf,.jpg,.jpeg,.png">
                                        <div class="fv-plugins-message-container"></div>    
                                    </div>
                                    <div class="col-xl-2">
                                        <button type="button" class="btn btn-info addFloor">{{__('site.add_more')}}</button>
                                    </div>
                                </div>
                            @endif

                            <input type="hidden" name="property_id" value="{{isset($property->id) ? $property->id : '0'}}">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{__('site.save')}}</button>
                        <button data-dismiss="modal" form="add-task-form" id="floor_plan_uploader_close" class="btn btn-secondary">{{__('site.close')}}</button>
                    </div>                
                </form>   
			</div>
		</div>
	</div>
@push('js')
<script type="text/javascript">
$(document).ready(function(){
    $("form#floorPlanUploader").submit(function(e) {
        e.preventDefault();    
        var formData = new FormData(this);
        $(".loader").show();
        $.ajax({
            headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },                    
            url: "{{url('floor-plan/upload/store')}}",
            type: 'POST',
            data: formData,
            success: function (data) {
                $("#loadingHolder").hide();
                if(data.success){
                    alert("Floor plans added successfully!");
                    $("#floor_plan_uploader_close").click();
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });      

    $(document).on("click",".deleteFloorPlan", function(){ 
        if(confirm("Are you sure want to delete this image?")){
            let token = $('meta[name=csrf-token]').attr('content');
            var floorPlanName = $(this).attr('data-value');
            var property_id="{{isset($property->id) ? $property->id : '0'}}";
            $("#loadingHolder").show();
            $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },                          
                url: "{{url('floor-plan/delete')}}",
                type: 'POST',
                data:{_token:token,floorPlanName:floorPlanName,property_id:property_id},
                responseType:'json',
                success: function (data) {
                    $("#loadingHolder").hide();
                    $("#"+floorPlanName.replace('.','-')).hide();
                }
            });

        }
    });
    $(".addFloor").click(function(){
        $(".propertyFloors").append('<div class="row col-xl-12"><div class="col-xl-5"><input class="form-control form-control-solid form-control-lg" type="text" class="form-control" name="floorPlansNameNew[]" placeholder="{{ucfirst(__('site.title'))}}"><div class="fv-plugins-message-container"></div></div><div class="col-xl-5"><input class="form-control form-control-solid form-control-lg" 	type="file" class="form-control" name="floorPlansNew[]" accept=".pdf,.jpg,.jpeg,.png"><div class="fv-plugins-message-container"></div></div><div class="col-xl-2"><button type="button" class="btn btn-info removeFloor">{{__('site.remove')}}</button></div></div>');
    });

    $(document).on("click",".removeFloor", function(){ 
        event.preventDefault();
        $(this).parents('.row').remove();
        $(".propertyVar").append('<input type="hidden" name="delete_floor_plan_id[]" value="'+($(this).val())+'">');
    });
});        
</script>
@endpush