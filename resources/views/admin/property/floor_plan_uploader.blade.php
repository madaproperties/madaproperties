	<div class="modal fade" id="floor_plan_uploader" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">You can upload multiple images here.</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<form method="post" action="{{url('floor-plan/upload/store')}}" enctype="multipart/form-data" id="floorPlanUploader">
							@csrf
                            <div class="row col-xl-12">
                                <div class="col-xl-4">
                                    <input class="form-control form-control-solid form-control-lg" 	type="file" class="form-control" id="floor_plan" name="floor_plan[]" accept="image/png, image/gif, image/jpeg, image/jpg"  multiple>
                                    <div class="fv-plugins-message-container"></div>    
                                </div>
                            </div>
                            <div class="row col-xl-12">
                                <!-- <p class="loader" style="display:none">Request in-process. please wait.</p>    -->
                            </div>
                            <div class="row col-xl-12">

                                <div id="uploadedFloorPlan">
                                    @if(Session::get('tempFloorPlan'))
                                        @foreach(Session::get('tempFloorPlan') as $document)
                                        <div class="col-xl-4" id='{{str_replace(".","-",$document)}}'>
                                            <!--begin::Wizard Step 1-->
                                            <div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">                                        
                                                <p>
                                                    <a href="javascript:void(0)" class="checkbox deleteFloorPlan" data-value="{{$document}}">Delete</a>
                                                    <img src="{{asset('public/uploads/temp/floor_plan/'.$document) }}" target="_blank"  style="height: 130px;">
                                                </p>
                                            </div>
                                        </div>
                                        @endforeach 
                                    @endif
                                    @if(isset($property->floorPlans) && count($property->floorPlans) > 0)
                                        @foreach($property->floorPlans as $document)
                                        <div class="col-xl-4" id='{{str_replace(".","-",$document->document_link)}}'>
                                            <!--begin::Wizard Step 1-->
                                            <div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
                                                <p>
                                                    <a href="javascript:void(0)" class="checkbox deleteFloorPlan" data-value="{{$document->document_link}}">Delete</a>
                                                    <img src="{{s3AssetUrl('uploads/property/'.$property->id.'/floor_plan/'.$document->document_link) }}" target="_blank"  style="height: 130px;">
                                                </p>
                                            </div> 
                                        </div>   
                                        @endforeach    
                                    @endif
                                </div>
                                   
                            </div>
                            <input type="hidden" name="property_id" value="{{isset($property->id) ? $property->id : '0'}}">
						                            
						</form>   
					</div>
				</div>
                <div class="card-footer">
                    <button data-dismiss="modal" form="add-task-form"  class="btn btn-secondary">{{__('site.close')}}</button>
                </div>                
			</div>
		</div>
	</div>
@push('js')
<script type="text/javascript">
$(document).ready(function(){
    $(document).on("change","#floor_plan", function(){
        $("#floorPlanUploader").submit();        
    });
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
                    $("#uploadedFloorPlan").prepend(data.images);
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
});        
</script>
@endpush