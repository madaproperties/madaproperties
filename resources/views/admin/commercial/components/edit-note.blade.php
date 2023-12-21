<!-- Add Note Modal-->
<div class="modal fade" id="edit-note-{{$note->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('site.edit note')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-custom">
               <!--begin::Form-->
                 <form id="edit-note-form-{{$note->id}}" action="{{route('admin.commercial_note.update',$note->id)}}" method="POST">
                   @csrf
                   @method('PUT')

                   <input type="hidden" value="{{$commercial->id}}" name="commercial_id">

                   <div class="form-group">
                     <label class="d-block">{{__('site.description')}}</label>
                     <textarea  name="description" id="note-description-edit-{{$note->id}}">{{$note->description}}</textarea>
                   </div>

                  <div class="card-footer">
                   <button type="submit" form="edit-note-form-{{$note->id}}" class="btn btn-primary mr-2">{{__('site.save')}}</button>
                   <button type="reset" form="edit-note-form-{{$note->id}}" data-dismiss="modal" class="btn btn-secondary">{{__('site.cancel')}}</button>
                  </div>
                 </form>
                 <!--end::Form-->
                </div>

            </div>
        </div>
    </div>
</div>
<!--- Eit Note Model -->
@push('js')
<script defer>
var id = `#note-description-edit-`+{{$note->id}};
var KTCkeditor = function () {
    // Private functions
    var demos = function () {
        ClassicEditor
      .create( document.querySelector(id) )
      .then( editor => {

      } )
      .catch( error => {
        console.error( error );
      } );


    }

    return {
        // public functions
        init: function() {
            demos();
        }
    };
}();

KTCkeditor.init();

</script>
@endpush
