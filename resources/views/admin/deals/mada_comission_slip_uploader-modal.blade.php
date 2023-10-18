<style>
    .modal-header {
    background: #9fc538;
    border-radius: 4px 4px 0 0;
}
.modal .modal-header .modal-title {
    font-weight: 500;
    font-size: 1.3rem;
    color: #fff;
}
</style>
<!-- Modal -->
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Mada Comission Slip Documents</h5>
      </div>
      <div class="modal-body">
        @if(isset($deal->mada_comission_slip) && count($deal->mada_comission_slip) > 0)
            @foreach($deal->mada_comission_slip as $document)
            <div class="row col-xl-12">
                <p><a href="{{s3AssetUrl('uploads/deals/'.$deal->id.'/documents/'.$document->document_link) }}" target="_blank">{{ $document->document_link }}</a></p> 
            </div>
            @endforeach    
        @else
            <div class="row col-xl-12">
                <p>Not record found.</p> 
            </div>
        @endif
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

