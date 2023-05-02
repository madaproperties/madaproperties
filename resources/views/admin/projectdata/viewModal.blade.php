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
.table-striped tbody tr:nth-of-type(even) {
    background-color: #f5ffe0;
}
.table-striped tbody tr:nth-of-type(odd) {
    background-color: #fff;
}
.table th, .table td {
    font-size: 13px;
    padding: 10px 10px;
}
.btn.btn-info {
    background: #9fc538;
    border: 1px solid #fff;
    color: #fff;
    border-radius: 15px;
}
.btn.btn-info:hover, .btn.btn-info:focus {
    background: #000 !important;
}
.table {
    border-radius: 15px;
    overflow: hidden;
    border: 2px solid #9fc538;
}
</style>
<!-- Modal -->
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Property Details</h5>
      </div>
      <div class="modal-body">
        @if($unit_name->status == 'Available')
        <div class="form-group">
          <table class="text-center table table-separate table-head-custom table-checkable table-striped">
            <tr>
              <td>Country</td>
              <td>{{$unit_name->country->name}}</td>
            </tr>
              <tr>
                <td>District</td>
                <td>{{$unit_name->district_name}}</td>
              </tr>
              <tr>
                <td>Project</td>
                <td>{{$unit_name->project ? $unit_name->project->name : 'N/A'}}</td>
              </tr>
              <tr>
                <td>Developer</td>
                <td>{{$unit_name->developer ? $unit_name->developer->name : 'N/A'}}</td>
              </tr>
              <tr>
                <td>Unit name</td>
                <td>{{$unit_name->unit_name}}</td>
              </tr>
              <tr>
                <td>Bedroom</td>
                <td>{{$unit_name->bedroom}}</td>
              </tr>
              <tr>
                <td>Floor No</td>
                <td>{{$unit_name->floor_no}}</td>
              </tr>
              <tr>
                <td>Area(BUA)</td>
                <td>{{$unit_name->area_bua}}</td>
              </tr>
              <tr>
                <td>Price</td>
                <td>{{$unit_name->price}}</td>
              </tr>
              @if($unit_name->down_payment)
              <tr>
                <td>Downpayment</td>
                <td>{{$unit_name->down_payment}}</td>
              </tr>
              @endif
            </table>
        </div>
        @elseif($unit_name->status == 'Sold out')
        <p class="sold"> Sorry the unit already sold </p>
        @else
        <p class="reserved"> Sorry the unit is reserved </p>
        @endif
      </div>
      
      <div class="modal-footer">
        @if($unit_name->status == 'Available')
        <a href="{{ route('projectPayment.checkoutPage',$unit_name->id) }}" class="btn btn-info btn-xs brochureinf" >Book Now</a>
        <a href="{{ route('project.brochure',$unit_name->id) }}" target="_blank"  class="btn btn-info btn-xs brochureinf  " >Download Offer</a>
        @endif
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
