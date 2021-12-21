@extends('admin.layouts.main')
@section('content')

	<!--begin::Content-->
	<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
		<!--begin::Entry-->
		<div class="d-flex flex-column-fluid">
		   <div class="container">
				 <!--begin::Card-->
					<div class="card card-custom gutter-b">
						<div class="card-header flex-wrap border-0 pt-6 pb-0">
							<div class="card-title">
								<h3 class="card-label">{{ __('site.overview') }}
							</div>
						</div>


						<div class="card-body">
							<!--begin: Datatable-->
								<div class="row">
									<div class="col-lg-12">
										<!--begin::Card-->
										<canvas height="200vh" id="line-chart" width="400" height="400"></canvas>
										<!--end::Card-->
									</div>

								</div>
							<!--end: Datatable-->
						</div>
					</div>
					<!--end::Card-->
       </div>
		</div>
		<!--end::Entry-->
	</div>
	<!--end::Content-->

@endsection
@push('js')
<script src="{{ asset('public/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('public/assets/js/pages/crud/datatables/basic/scrollable.js') }}"></script>
<!--begin::Page Scripts(used by this page)-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.1/chart.min.js" integrity="sha512-5vwN8yor2fFT9pgPS9p9R7AszYaNn0LkQElTXIsZFCL7ucT8zDCAqlQXDdaqgA1mZP47hdvztBMsIoFxq/FyyQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>


let colors = ['#00ffa1','red','blue'];
let i = 0;

new Chart(document.getElementById("line-chart"), {
  type: 'line',
  data: {
    labels: {!! $created_at_dats !!},
    datasets: [
   		@foreach($sources as $soruce => $data )
	    {
	        data: [
		     	{{implode(',',$data->data)}}
		     ]
	        ,
	        label: "{{$soruce}}",
	        borderColor: colors[i++],
	        fill: false
	      },
	    @endforeach
    ]
  },
  options: {
    title: {
      display: true,
      text: 'World population per region (in millions)'
    }
  }
});

</script>
@endpush
