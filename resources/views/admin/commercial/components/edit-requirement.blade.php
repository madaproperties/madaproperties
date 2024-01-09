<!-- Add Task Modal-->
<div class="modal fade {{ isset($showClass) ? 'show' : ''}}" id="edit-requirement-{{$requirement->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('site.edit requirement')}} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-custom">
                  <!--begin::Form-->
                  <form id="edit-requirement-form-{{$requirement->id}}" action="{{route('admin.requirements.update',$requirement->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-6 col-sm-12">
                          <label>{{__('site.contact_person_name')}}</label>
                          <select name="contact_id" class="form-control" >
                            <option value="">{{__('site.select option')}}</option>
                            @if($commercial->contact_persons)
                              @foreach($commercial->contact_persons as $contact_person) 
                              <option {{$requirement->contact_id == $contact_person->id ? 'selected' : ''}} value="{{$contact_person->id}}">{{$contact_person->name}}</option>
                              @endforeach
                            @endif
                          </select>
                        
                        </div>
                        <div class="col-md-6 col-sm-12">
                          <label>{{__('site.city')}}</label>
                          <select name="city_id" class="form-control" >
                          @foreach($cities as $city)
                          <option {{$requirement->city_id == $city->id ? 'selected' : ''}} value="{{$city->id}}">{{$city->name_en}}</option>
                          @endforeach
                          </select>

                        </div>
                      </div>
                      <hr />
                      <input type="hidden" value="{{$requirement->commercial_id}}" name="commercial_id">
                      <div class="row">
                        <div class="col-md-6 col-sm-12">
                          <label>{{__('site.zone')}}</label>
                          <select name="zone_id" class="form-control" id="zone_id_edit_{{$requirement->id}}" onchange="getDistrict(this.value,{{$requirement->id}})">
                          <option value="">{{__('site.select option')}}</option>
                          @foreach($zones as $zone)
                          <option {{$requirement->zone_id == $zone->id ? 'selected' : ''}} value="{{$zone->id}}">{{$zone->zone_name}}</option>
                          @endforeach
                          </select>
                        
                        </div>
                        <div class="col-md-6 col-sm-12">
                          <label>{{__('site.district')}}</label>
                          @php
                          $districts="";
                          if($requirement->zone_id){
                            $districts = \App\Districts::where('zone_id',$requirement->zone_id)->get();
                          }
                          @endphp

                          <select name="district_id" class="form-control" id="district_id_edit_{{$requirement->id}}" >
                          @if($districts)
                          @foreach($districts as $district)
                          <option {{$requirement->district_id == $district->id ? 'selected' : ''}} value="{{$district->id}}">{{$district->name}}</option>
                          @endforeach
                          @endif
                          </select>
                        
                        </div>
                      </div>
                      <hr />
                      <div class="row">
                        <div class="col-md-6 col-sm-12">
                          <label>{{__('site.street info')}}</label>
                          <input type="text" name="street_info" class="form-control" value="{{$requirement->street_info}}" >
                        </div>
                        
                        <div class="col-md-6 col-sm-12">
                          <label>{{__('site.expanding_date')}}</label>
                          <select name="expanding_date" class="form-control" >
                          {!! selectOptions(__('config.expanding_date'),$requirement->expanding_date) !!}
                          </select>
                        </div>
                      </div>
                      <hr />
                      <div class="row">
                        <div class="col-md-6 col-sm-12">
                          <label>{{__('site.expanding year')}}</label>
                          <select name="expanding_year" class="form-control" id="expanding_year">
                          <option value="">{{__('site.choose')}}</option>
                          {!! selectOptions($expanding_years,$requirement->expanding_year) !!}
                          </select>
                        </div>
                        
                        <div class="col-md-3 col-sm-12">
                          <label>{{__('site.target_size_from')}}</label>
                          <select name="target_size_from" class="form-control target_size_from{{$requirement->id}}">
                          {!! selectOptions(__('config.target_size_from'),$requirement->target_size_from) !!}
                          </select>
                        </div>
                        <div class="col-md-3 col-sm-12">
                          <label>{{__('site.target_size_to')}}</label>
                          <select name="target_size_to" class="form-control target_size_to{{$requirement->id}}">
                          {!! selectOptions(__('config.target_size_to'),$requirement->target_size_to) !!}
                          </select>
                        </div>
                        
                      </div>
                      <hr />
                      	<!-- added by fazal on 09-01-23 -->
                      <div class="form-group">
                        <label for="requirement-status">{{__('site.type')}}</label>
                        <select name="commercial_type" class="form-control" required>
                          {!! selectOptions(__('config.commercial_types'),$requirement->commercial_type) !!} 
                           
                        </select>
                      </div>
                      <hr />
                      <!-- end -->

                      <div class="form-group">
                        <label for="requirement-status">{{__('site.status')}}</label>
                        <select name="status" class="form-control" required>
                          <option value="">{{__('site.select option')}}</option>
                          {!! selectOptions(__('config.requirement_status'),$requirement->status) !!}
                        </select>
                      </div>
                      <div class="form-group">
                        <label>{{__('site.description')}}</label>
                        <textarea name="description" class="form-control">{{$requirement->description}}</textarea>
                      </div>
 
                    </div>
                    <div class="card-footer">
                      <button type="submit" form="edit-requirement-form-{{$requirement->id}}" class="btn btn-primary mr-2">{{__('site.save')}}</button>
                      <button type="reset" form="edit-requirement-form-{{$requirement->id}}" data-dismiss="modal" class="btn btn-secondary">{{__('site.cancel')}}</button>
                    </div>
                  </form>
                  <!--end::Form-->

                </div>
            </div>
        </div>
    </div>
</div>
<!--- Eit Information Model -->
@push('js')
<script defer>
var id = `#requirement-description-edit-`+{{$requirement->id}};
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

$(document).ready(function(){
  $(".target_size_from"+{{$requirement->id}}).change(function(){
    let from_val = parseInt($(this).val());
    let end_val = 1000;
    let to_html="";

    if(from_val == 0){
      from_val = 50
      to_html += "<option value='"+from_val+"'>"+from_val+"</option>";
      from_val = 100
      to_html += "<option value='"+from_val+"'>"+from_val+"</option>";

    }else if(from_val == 50){
      from_val = 100
      to_html += "<option value='"+from_val+"'>"+from_val+"</option>";
    }

    for(var i=(from_val+100); i<=end_val; i += 100){
      to_html += "<option value='"+i+"'>"+i+"</option>";
    }

    $(".target_size_to"+{{$requirement->id}}).html(to_html);

  });
});


</script>
@endpush
