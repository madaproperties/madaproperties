<style type="text/css">	
#uploadedImage img:hover, #uploadedImage img:focus, #uploadedImage img:active {
    cursor: move;
}

</style>



    <div class="modal fade" id="image_uploader" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">You can upload multiple images here. The maximum allowed file size is 2 MB</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<form method="post" action="{{url('image/upload/store')}}" enctype="multipart/form-data" id="fileuploader">
							@csrf
                            <div class="row col-xl-12">
                                <div class="col-xl-4">
                                    <input class="form-control form-control-solid form-control-lg" 	type="file" class="form-control" id="photos" name="photos[]" accept="image/png, image/gif, image/jpeg, image/jpg"  multiple>
                                    <div class="fv-plugins-message-container"></div>    
                                </div>
                            </div>
                            <div class="row col-xl-12">
                                <!-- <p class="loader" style="display:none">Request in-process. please wait.</p>    -->
                            </div>
                            <div class="row col-xl-12">

                                <div id="uploadedImage">
                                    @if(Session::get('tempImages'))
                                        @foreach(Session::get('tempImages') as $image)
                                        <div class="col-xl-4" style="float:left" id='{{str_replace(".","-",$image)}}'>
                                            <!--begin::Wizard Step 1-->
                                            <div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">                                        
                                                <img src="{{asset('public/uploads/temp/images/'.$image) }}"  style="width:215px;height:147px" >
                                            </div>
                                            <a href="javascript:void(0)" class="checkbox deleteImage" data-value="{{$image}}">Delete</a>
                                            <a href="{{asset('public/uploads/temp/images/'.$image) }}" target="_blank">View</a>
                                        </div>
                                        @endforeach 
                                    @endif
                                    @if(isset($property->images) && count($property->images) > 0)
                                    <ul class="reorder-gallery">
                                        @foreach($property->images as $image)
                                       
                                        <div class="col-xl-4" style="float:left" id='{{str_replace(".","-",$image->images_link)}}'>
                                            <!--begin::Wizard Step 1-->
                                            <div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
                                                <img src="{{s3AssetUrl('uploads/property/'.$property->id.'/images/'.$image->images_link) }}" id="{{$image->id}}" style="width:215px;height:147px" >
                                            </div> 
                                            <a href="javascript:void(0)" class="checkbox deleteImage" data-value="{{$image->images_link}}">Delete</a>
                                            <a href="{{s3AssetUrl('uploads/property/'.$property->id.'/images/'.$image->images_link) }}" target="_blank">View</a>
                                            <input type="hidden" name="property_id" id="property_id" value="{{$image->property_id}}">
                                        </div>
                                         

                                        @endforeach   
                                        </ul> 
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
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script type="text/javascript">
    $(document).ready(function(){
        $(document).on("change","#photos", function(){
            $("#fileuploader").submit();        
        });
        $("form#fileuploader").submit(function(e) {
            e.preventDefault();    
            var formData = new FormData(this);
            $(".loader").show();
            $.ajax({
                headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },                    
                url: "{{url('image/upload/store')}}",
                type: 'POST',
                data: formData,
                success: function (data) {
                    $("#loadingHolder").hide();
                    if(data.success){
                        $("#uploadedImage").prepend(data.images);
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });      

        $(document).on("click",".deleteImage", function(){ 
            if(confirm("Are you sure want to delete this image?")){
                let token = $('meta[name=csrf-token]').attr('content');
                var imageName = $(this).attr('data-value');
                var property_id="{{isset($property->id) ? $property->id : '0'}}";
                $("#loadingHolder").show();
                $.ajax({
                    headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },                          
                    url: "{{url('image/delete')}}",
                    type: 'POST',
                    data:{_token:token,imageName:imageName,property_id:property_id},
					responseType:'json',
                    success: function (data) {
                        $("#loadingHolder").hide();
                        $("#"+imageName.replace('.','-')).hide();
                    }
                });

            }
        });

     function getImages(){
        $.ajax({
            headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },                    
            url: "{{url('image/get-project-image')}}",
            type: 'GET',
            success: function (data) {
                if(data.success){
                    $("#uploadedImage").append(data.images);
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    }




        // 

    $("ul.reorder-gallery").sortable({      
        update: function( event, ui ) {
            updateOrder();
        }
    });  

function updateOrder() {    
    var item_order = new Array();
    $('ul.reorder-gallery img').each(function() {
        item_order.push($(this).attr("id"));
    });
   var ids = item_order;
    
    $.ajax({
      url: "{{url('property.imgreorder')}}",
                    type: "POST",
                    data: {
                        ids: ids,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
        success: function(data){ 
            alert(data);
        //location.reload();           
        }
    });
}
   
        // 






    });


    function getImages(){
        $.ajax({
            headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },                    
            url: "{{url('image/get-project-image')}}",
            type: 'GET',
            success: function (data) {
                if(data.success){
                    $("#uploadedImage").append(data.images);
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    }





</script>
@endpush