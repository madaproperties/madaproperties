	<div class="modal fade" id="document_uploader" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">You can upload multiple documents here.</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
                <form method="post" action="{{url('document/upload/store')}}" enctype="multipart/form-data" id="documentUploader">
				@csrf
                    <div class="modal-body">
                        <div class="form-group propertyDocuments">
                            @php($j=1)
                            @if(isset($property->documents) && count($property->documents) > 0)
                                @foreach($property->documents as $document)
                                <div class="row col-xl-12">
                                    <div class="col-xl-5 propertyVar">
                                        <input type="hidden" name="document_id[]" value="{{$document->id}}">
                                        <input class="form-control form-control-solid form-control-lg" value="{{$document->name}}" type="text" class="form-control" name="documentsName[]" placeholder="{{ucfirst(__('site.title'))}}">
                                        <div class="fv-plugins-message-container"></div>    
                                    </div>
                                    <div class="col-xl-5">
                                        <input class="form-control form-control-solid form-control-lg" 	type="file" class="form-control" name="documents[]" accept=".xlsx,.xls,.doc, .docx,.ppt, .pptx,.txt,.pdf,.jpg,.jpeg,.png">
                                        <div class="fv-plugins-message-container"></div>   
                                        <p><a href="{{s3AssetUrl('uploads/property/'.$property->id.'/documents/'.$document->document_link) }}" target="_blank">{{ $document->document_link }}</a></p> 
                                    </div>
                                    @if($j==1)
                                    <div class="col-xl-2">
                                        <button type="button" class="btn btn-info addDocument">{{__('site.add_more')}}</button>
                                    </div>
                                    @else
                                    <div class="col-xl-2">
                                        <button type="button" class="btn btn-info removeDocument" value="{{$document->id}}">{{__('site.remove')}}</button>
                                    </div>
                                    @endif
                                </div>
                                @php($j++)
                                @endforeach    
                            @endif
                            @if(!isset($property->documents) || (isset($property->documents) && count($property->documents) == 0))
                                <div class="row col-xl-12">
                                    <div class="col-xl-5">
                                        <input class="form-control form-control-solid form-control-lg" type="text" class="form-control" name="documentsNameNew[]" placeholder="{{ucfirst(__('site.title'))}}">
                                        <div class="fv-plugins-message-container"></div>    
                                    </div>
                                    <div class="col-xl-5">
                                        <input class="form-control form-control-solid form-control-lg" 	type="file" class="form-control" name="documentsNew[]" accept=".xlsx,.xls,.doc, .docx,.ppt, .pptx,.txt,.pdf,.jpg,.jpeg,.png">
                                        <div class="fv-plugins-message-container"></div>    
                                    </div>
                                    <div class="col-xl-2">
                                        <button type="button" class="btn btn-info addDocument">{{__('site.add_more')}}</button>
                                    </div>
                                </div>
                            @endif

                            <input type="hidden" name="property_id" value="{{isset($property->id) ? $property->id : '0'}}">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{__('site.save')}}</button>
                        <button data-dismiss="modal" form="add-task-form" id="document_uploader_close"  class="btn btn-secondary">{{__('site.close')}}</button>
                    </div>                
                </form>   
			</div>
		</div>
	</div>
@push('js')
<script type="text/javascript">
$(document).ready(function(){
    $("form#documentUploader").submit(function(e) {
        e.preventDefault();    
        var formData = new FormData(this);
        $(".loader").show();
        $.ajax({
            headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },                    
            url: "{{url('document/upload/store')}}",
            type: 'POST',
            data: formData,
            success: function (data) {
                $("#loadingHolder").hide();
                if(data.success){
                    alert("Documents added successfully!");
                    $("#document_uploader_close").click();
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });      

    $(document).on("click",".deleteDocument", function(){ 
        if(confirm("Are you sure want to delete this document?")){
            let token = $('meta[name=csrf-token]').attr('content');
            var documentName = $(this).attr('data-value');
            var property_id="{{isset($property->id) ? $property->id : '0'}}";
            $("#loadingHolder").show();
            $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },                          
                url: "{{url('document/delete')}}",
                type: 'POST',
                data:{_token:token,documentName:documentName,property_id:property_id},
                responseType:'json',
                success: function (data) {
                    $("#loadingHolder").hide();
                    $("#"+documentName.replace('.','-')).hide();
                }
            });

        }
    });
    $(".addDocument").click(function(){
        $(".propertyDocuments").append('<div class="row col-xl-12"><div class="col-xl-5"><input class="form-control form-control-solid form-control-lg" type="text" class="form-control" name="documentsNameNew[]" placeholder="{{ucfirst(__('site.title'))}}"><div class="fv-plugins-message-container"></div></div><div class="col-xl-5"><input class="form-control form-control-solid form-control-lg" 	type="file" class="form-control" name="documentsNew[]" accept=".xlsx,.xls,.doc, .docx,.ppt, .pptx,.txt,.pdf,.jpg,.jpeg,.png"><div class="fv-plugins-message-container"></div></div><div class="col-xl-2"><button type="button" class="btn btn-info removeDocument">{{__('site.remove')}}</button></div></div>');
    });

    $(document).on("click",".removeDocument", function(){ 
        event.preventDefault();
        $(this).parents('.row').remove();
        $(".propertyVar").append('<input type="hidden" name="delete_document_id[]" value="'+($(this).val())+'">');
    });
});        
</script>
@endpush