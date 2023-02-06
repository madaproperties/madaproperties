	<div class="modal fade" id="image_uploader" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">You can upload multiple images here.</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<form method="post" action="{{url('secondary/upload/store')}}" enctype="multipart/form-data" id="fileuploader">
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
	
@endpush