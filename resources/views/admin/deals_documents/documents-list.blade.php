@push('css')
    
       <style>
h4.panel-title{
  background-color:#9fc538;
}
h4.panel-title>a{
  color:#fff;
}
.panel-title>a, .panel-title>a:active{
	display:block;
	padding:15px;
  color:#fff;
  font-size:16px;
  font-weight:bold;
	text-transform:uppercase;
	letter-spacing:1px;
  word-spacing:3px;
	text-decoration:none;
}
.panel-heading  a:before {
   font-family: 'Glyphicons Halflings';
   content: "\e114";
   float: right;
   transition: all 0.5s;
}
.panel-heading.active a:before {
	-webkit-transform: rotate(180deg);
	-moz-transform: rotate(180deg);
	transform: rotate(180deg);
} 

    </style>
@endpush
@extends('admin.layouts.main')
@section('content')

  <!--begin::Content-->
  <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
      <div class="d-flex flex-column-fluid">
       <div class="container">
        <div class="row">
          @php($i=0)
<div class="col sm-12 md-12 center-block">
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  @if(isset($deal->documents) && count($deal->documents) > 0)
    <div class="panel panel-default">
    <div class="panel-heading active" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        Documents ({{count($deal->documents)}} file)
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      @foreach($deal->documents as $document)
      @php($i++)
      <div class="panel-body">
        <p><a href="{{s3AssetUrl('uploads/deals/'.$deal->id.'/documents/'.$document->document_link) }}" donwload target="_blank">{{ $document->document_link }}</a></p> 
      </div>
      @endforeach
    </div>
  </div>
  @endif


  @if(isset($deal->national_address) && count($deal->national_address) > 0)
  
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingTwo">
        <h4 class="panel-title">
          <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          National Address ({{count($deal->national_address)}} file)
          </a>
        </h4>
      </div>
      <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
        @foreach($deal->national_address as $document)
        @php($i++)
          <div class="panel-body">
          <p><a href="{{s3AssetUrl('uploads/deals/'.$deal->id.'/documents/'.$document->document_link) }}" donwload target="_blank">{{ $document->document_link }}</a></p> 
          </div>
        @endforeach
      </div>
    </div>
  @endif


  @if(isset($deal->mada_comission_slip) && count($deal->mada_comission_slip) > 0)
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingThree">
        <h4 class="panel-title">
          <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Mada Comission Slip ({{count($deal->mada_comission_slip)}} file)
          </a>
        </h4>
      </div>
      <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
        @foreach($deal->mada_comission_slip as $document)
        @php($i++)
        <div class="panel-body">
        <p><a href="{{s3AssetUrl('uploads/deals/'.$deal->id.'/documents/'.$document->document_link) }}" donwload target="_blank">{{ $document->document_link }}</a></p> 
        </div>
        @endforeach
      </div>
    </div>
  @endif

  @if(isset($deal->down_payments) && count($deal->down_payments) > 0)
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingFour">
        <h4 class="panel-title">
          <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
          Down Payments ({{count($deal->down_payments)}} file)
          </a>
        </h4>
      </div>
      <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
        @foreach($deal->down_payments as $document)
        @php($i++)
        <div class="panel-body">
        <p><a href="{{s3AssetUrl('uploads/deals/'.$deal->id.'/documents/'.$document->document_link) }}" donwload target="_blank">{{ $document->document_link }}</a></p> 
        </div>
        @endforeach
      </div>
    </div>
  @endif
  @if(isset($deal->signed_contract) && count($deal->signed_contract) > 0)
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingFive">
        <h4 class="panel-title">
          <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
          Signed Contract ({{count($deal->signed_contract)}} file)
          </a>
        </h4>
      </div>
      <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
        @foreach($deal->signed_contract as $document)
        @php($i++)
        <div class="panel-body">
        <p><a href="{{s3AssetUrl('uploads/deals/'.$deal->id.'/documents/'.$document->document_link) }}" donwload target="_blank">{{ $document->document_link }}</a></p> 
        </div>
        @endforeach
      </div>
    </div>
  @endif

</div>
</div>


          @if($i == 0)
            <div class="col-xs-12 col-sm-12 col-lg-12">
                <div class="card" style="text-align:center" >
                  <p>No documents uploaded for this deal.</p> 
                  <a href="{{url()->previous()}}">Go back</a>
                </div>
            </div>
          @endif
        </div>
       </div>
    </div>
    <!--end::Entry-->
  </div>
  </div>
  <!--end::Content-->

@endsection
@push('js')
<script src="{{ asset('public/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('public/assets/js/pages/crud/datatables/basic/scrollable.js') }}"></script>
@endpush
