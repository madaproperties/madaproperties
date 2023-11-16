	<div class="modal fade" id="signed_contract_uploader" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">You can upload multiple signed contract documents here.</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
                <form method="post" action="{{route('admin.deal-document-upload')}}" enctype="multipart/form-data" class="signedContractUploader">
				@csrf
                    <input type="hidden" name="deal_id" value="{{isset($deal->id) ? $deal->id : ''}}">
                    <input type="hidden" name="file_type" value="signed_contract">
                    <div class="modal-body">
                        <div class="form-group signedContractPropertyDocuments">
                            @php($j=1)
                            @if(isset($deal->signed_contract) && count($deal->signed_contract) > 0)
                                @foreach($deal->signed_contract as $document)
                                <div class="signedContractPropertyDelete">
                                    <div class="row col-xl-12">
                                        <div class="col-xl-4 signedContractPropertyVar">
                                            <input type="hidden" name="document_id[]" value="{{$document->id}}">
                                            <input class="form-control form-control-solid form-control-lg" value="{{$document->name}}" type="text" class="form-control" name="documentsName[]" placeholder="{{ucfirst(__('site.title'))}}">
                                            <div class="fv-plugins-message-container"></div>    
                                        </div>
                                        <div class="col-xl-4">
                                            <input class="form-control form-control-solid form-control-lg" 	type="file" class="form-control" name="documents[]" accept=".xlsx,.xls,.doc, .docx,.ppt, .pptx,.txt,.pdf,.jpg,.jpeg,.png">
                                            <div class="fv-plugins-message-container"></div>   
                                            <p><a href="{{s3AssetUrl('uploads/deals/'.$deal->id.'/documents/'.$document->document_link) }}" target="_blank">{{ $document->document_link }}</a></p> 
                                        </div>
                                        @if($j==1)
                                        <div class="col-xl-2">
                                            <button type="button" class="btn btn-info removeSignedContractDocument" value="{{$document->id}}">{{__('site.remove')}}</button>
                                        </div>
                                        <div class="col-xl-2">
                                            <button type="button" class="btn btn-info addSignedContract">{{__('site.add_more')}}</button>
                                        </div>
                                        @else
                                        <div class="col-xl-2">
                                            <button type="button" class="btn btn-info removeSignedContractDocument" value="{{$document->id}}">{{__('site.remove')}}</button>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @php($j++)
                                @endforeach    
                            @endif
                            @if(!isset($deal->signed_contract) || (isset($deal->signed_contract) && count($deal->signed_contract) == 0))
                                <div class="row col-xl-12">
                                    <div class="col-xl-4">
                                        <input class="form-control form-control-solid form-control-lg" type="text" class="form-control" name="documentsNameNew[]" placeholder="{{ucfirst(__('site.title'))}}">
                                        <div class="fv-plugins-message-container"></div>    
                                    </div>
                                    <div class="col-xl-4">
                                        <input class="form-control form-control-solid form-control-lg" 	type="file" class="form-control" name="documentsNew[]" accept=".xlsx,.xls,.doc, .docx,.ppt, .pptx,.txt,.pdf,.jpg,.jpeg,.png">
                                        <div class="fv-plugins-message-container"></div>    
                                    </div>
                                    <div class="col-xl-2">
                                        <button type="button" class="btn btn-info addSignedContract">{{__('site.add_more')}}</button>
                                    </div>
                                </div>
                            @endif

                            <input type="hidden" id="has_signed_contract" value="">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{__('site.save')}}</button>
                        <button data-dismiss="modal" form="add-task-form" id="signed_contract_close"  class="btn btn-secondary">{{__('site.close')}}</button>
                    </div>                
                </form>   
			</div>
		</div>
	</div>
    @push('js')
<script type="text/javascript">
$(document).ready(function(){
    $("form.signedContractUploader").submit(function(e) {
        e.preventDefault();    
        var formData = new FormData(this);
        $("#loadingHolder").show();
        $.ajax({
            headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },                    
            url: "{{route('admin.deal-document-upload')}}",
            type: 'POST',
            data: formData,
            success: function (data) {
                $("#loadingHolder").hide();
                if(data.success){
                    $("#has_signed_contract").val(1);
                    alert("Documents updated successfully!");
                    $("#signed_contract_close").click();
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });      

    $(".addsignedContract").click(function(){
        $(".signedContractPropertyDocuments").append('<div class="row col-xl-12"><div class="col-xl-4"><input class="form-control form-control-solid form-control-lg" type="text" class="form-control" name="documentsNameNew[]" placeholder="{{ucfirst(__('site.title'))}}"><div class="fv-plugins-message-container"></div></div><div class="col-xl-4"><input class="form-control form-control-solid form-control-lg" 	type="file" class="form-control" name="documentsNew[]" accept=".xlsx,.xls,.doc, .docx,.ppt, .pptx,.txt,.pdf,.jpg,.jpeg,.png"><div class="fv-plugins-message-container"></div></div><div class="col-xl-2"><button type="button" class="btn btn-info removeSignedContractDocument">{{__('site.remove')}}</button></div></div>');
    });

    $(document).on("click",".removeSignedContractDocument", function(){ 
        event.preventDefault();
        $(this).parents('.row').remove();
        $(".signedContractPropertyDelete").append('<input type="hidden" name="delete_document_id[]" value="'+($(this).val())+'">');
    });
});        
</script>
@endpush