	<div class="modal fade" id="national_address_uploader" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">You can upload multiple national address documents here.</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
                <form method="post" action="{{route('admin.deal-document-upload')}}" enctype="multipart/form-data" class="national_address">
				@csrf
                    <input type="hidden" name="deal_id" value="{{isset($deal->id) ? $deal->id : ''}}">
                    <input type="hidden" name="file_type" value="national_address">
                    <div class="modal-body">
                        <div class="form-group nationalAddressPropertyDocuments">
                            @php($j=1)
                            @if(isset($deal->national_address) && count($deal->national_address) > 0)
                                @foreach($deal->national_address as $document)
                                <div class="nationalAddressPropertyDelete">
                                    <div class="row col-xl-12">
                                        <div class="col-xl-4 nationalAddressPropertyVar">
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
                                            <button type="button" class="btn btn-info removeNationalAddressDocument" value="{{$document->id}}">{{__('site.remove')}}</button>
                                        </div>
                                        <div class="col-xl-2">
                                            <button type="button" class="btn btn-info addNationalAddress">{{__('site.add_more')}}</button>
                                        </div>
                                        @else
                                        <div class="col-xl-2">
                                            <button type="button" class="btn btn-info removeNationalAddressDocument" value="{{$document->id}}">{{__('site.remove')}}</button>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @php($j++)
                                @endforeach    
                            @endif
                            @if(!isset($deal->national_address) || (isset($deal->national_address) && count($deal->national_address) == 0))
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
                                        <button type="button" class="btn btn-info addNationalAddress">{{__('site.add_more')}}</button>
                                    </div>
                                </div>
                            @endif

                            <input type="hidden" id="has_national_address" value="">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{__('site.save')}}</button>
                        <button data-dismiss="modal" form="add-task-form" id="national_address_close"  class="btn btn-secondary">{{__('site.close')}}</button>
                    </div>                
                </form>   
			</div>
		</div>
	</div>
    @push('js')
<script type="text/javascript">
$(document).ready(function(){
    $("form.national_address").submit(function(e) {
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
                    $("#has_national_address").val(1);
                    alert("Documents updated successfully!");
                    $("#national_address_close").click();
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });      

    $(".addNationalAddress").click(function(){
        $(".nationalAddressPropertyDocuments").append('<div class="row col-xl-12"><div class="col-xl-4"><input class="form-control form-control-solid form-control-lg" type="text" class="form-control" name="documentsNameNew[]" placeholder="{{ucfirst(__('site.title'))}}"><div class="fv-plugins-message-container"></div></div><div class="col-xl-4"><input class="form-control form-control-solid form-control-lg" 	type="file" class="form-control" name="documentsNew[]" accept=".xlsx,.xls,.doc, .docx,.ppt, .pptx,.txt,.pdf,.jpg,.jpeg,.png"><div class="fv-plugins-message-container"></div></div><div class="col-xl-2"><button type="button" class="btn btn-info removeNationalAddressDocument">{{__('site.remove')}}</button></div></div>');
    });

    $(document).on("click",".removeNationalAddressDocument", function(){ 
        event.preventDefault();
        $(this).parents('.row').remove();
        $(".nationalAddressPropertyDelete").append('<input type="hidden" name="delete_document_id[]" value="'+($(this).val())+'">');
    });
});        
</script>
@endpush