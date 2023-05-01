	<div class="modal fade" id="document_uploader" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">You can upload multiple documents here.</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<form method="post" action="{{url('document/upload/store')}}" enctype="multipart/form-data" id="documentUploader">
							@csrf
                            <div class="row col-xl-12">
                                <div class="col-xl-4">
                                    <input class="form-control form-control-solid form-control-lg" 	type="file" class="form-control" id="documents" name="documents[]" accept=".xlsx,.xls,.doc, .docx,.ppt, .pptx,.txt,.pdf,.jpg,.jpeg,.png"  multiple>
                                    <div class="fv-plugins-message-container"></div>    
                                </div>
                            </div>
                            <div class="row col-xl-12">
                                <!-- <p class="loader" style="display:none">Request in-process. please wait.</p>    -->
                            </div>
                            <div class="row col-xl-12">

                                <div id="uploadedDocument">
                                    @if(Session::get('tempDocuments'))
                                        @foreach(Session::get('tempDocuments') as $document)
                                        <div class="col-xl-4" id='{{str_replace(".","-",$document)}}'>
                                            <!--begin::Wizard Step 1-->
                                            <div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">                                        
                                                <p>{{ $document }}
                                                    <a href="javascript:void(0)" class="checkbox deleteDocument" data-value="{{$document}}">Delete</a>
                                                    <a href="{{asset('public/uploads/temp/documents/'.$document) }}" target="_blank">View</a>
                                                </p>
                                            </div>
                                        </div>
                                        @endforeach 
                                    @endif
                                    @if(isset($property->documents) && count($property->documents) > 0)
                                        @foreach($property->documents as $document)
                                        <div class="col-xl-4" id='{{str_replace(".","-",$document->document_link)}}'>
                                            <!--begin::Wizard Step 1-->
                                            <div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
                                                <p>{{ $document->document_link }}
                                                    <a href="javascript:void(0)" class="checkbox deleteDocument" data-value="{{$document->document_link}}">Delete</a>
                                                    <a href="{{s3AssetUrl('uploads/property/'.$property->id.'/documents/'.$document->document_link) }}" target="_blank">View</a>
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
    $(document).on("change","#documents", function(){
        $("#documentUploader").submit();        
    });
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
                    $("#uploadedDocument").prepend(data.images);
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
});        
</script>
@endpush