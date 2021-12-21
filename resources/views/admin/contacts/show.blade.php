@extends('admin.layouts.main')
@section('content')

	<hr />
<div class="container">
    
	

					<!--begin::Profile Overview-->
							<div class="d-flex flex-row">
							        
								<!--begin::Aside-->
									@include('admin.contacts.components.sidebar')
								<!--begin::Content-->
								<div class="flex-row-fluid ml-lg-8">
    
									<div class="example-preview">
													<ul class="nav nav-tabs" id="myTab" role="tablist">
														<li class="nav-item">
															<a class="nav-link active" id="activity-tab" data-toggle="tab" href="#activity">
																<span class="nav-icon">
																	<i class="flaticon2-chat-1"></i>
																</span>
																<span class="nav-text">{{__('site.activity')}}</span>
															</a>
														</li>
														<li class="nav-item">
															<a class="nav-link" id="notes-tab" data-toggle="tab" href="#notes" aria-controls="notes">
																<span class="nav-icon">
									<i class="fa fa-bell"></i>
																</span>
																<span class="nav-text">{{__('site.notes')}}</span>
															</a>
														</li>
														
														<li class="nav-item">
															<a class="nav-link" id="tasks-tab" data-toggle="tab" href="#tasks" aria-controls="tasks">
																<span class="nav-icon">
					<i class="fa fa-tasks"></i>
																</span>
																<span class="nav-text">{{__('site.tasks')}}</span>
															</a>
														</li>
														
				@foreach(contact_status() as $index => $contact_status)
				<li class="nav-item">
					<a class="nav-link" id="Log-{{$contact_status}}-tab"
					data-toggle="tab" href="#{{$contact_status}}-tab" aria-controls="{{$contact_status}}-tab">
						<span class="nav-icon">
						    @if( $index == 0)
                                 <i class="fas fa-phone-alt"></i>   
                            @elseif($index == 1)
                                <i class="fas fa-envelope"></i>
                            @elseif($index == 2)
                               <i class="far fa-handshake"></i> 
                            @else 
                                <i class="fab fa-whatsapp"></i>
                            @endif
    						
						</span>
						<span class="nav-text">{{__('site.'.$contact_status)}}</span>
					</a>
				</li>
				@endforeach
		</ul>
		
		<div class="tab-content mt-5" id="myTabContent">
			<div class="tab-pane fade active show" id="activity" role="tabpanel" aria-labelledby="home-tab">
				@include('admin.contacts.components.activities')
			</div>
			<div class="tab-pane fade" id="notes" role="tabpanel" aria-labelledby="notes-tab">
				@include('admin.contacts.components.notes')
			</div>
			<div class="tab-pane fade" id="tasks" role="tabpanel" aria-labelledby="tasks-tab">
				@include('admin.contacts.components.tasks')
			</div>
			@foreach(contact_status() as $contact_status)
			<div class="tab-pane fade" id="{{strtolower($contact_status)}}-tab" role="tabpanel"
			aria-labelledby="log-{{strtolower($contact_status)}}-tab">
				@include('admin.contacts.components.logs',['filter' => $contact_status])
			</div>
			@endforeach

		</div>
												</div>

								</div>
								<!--end::Content-->
							</div>
							<!--end::Profile Overview-->
						</div>



		@include('admin.layouts.models')
@endsection
@push('js')
<script src="{{asset('public/assets/js/pages/custom/profile/profile.js')}}"></script>
<script>

	function getCountryCities(country,city,changeCode = false)
	{
		let token = $('meta[name=csrf-token]').attr('content');
		let route = '{{route("admin.get.cities")}}';
		let cityEl = city;
		let selectID = city.data('selected') ? city.data('selected') : 0;
		
		$.ajax({
					type:'POST',
					url: route,
					data:{_token:token,country:country},
					responseType:'json',
					success: (res) => {
						if(res.status == 'success'){
								cityEl.html('');
								
								if(changeCode){
								    $('#show-coutry-code').val(res.countryCode);
								}
								
								cityEl.append(`<option value=''>select</option>`);
								res.rows.forEach(row => {
									cityEl.append(`<option	value="${row.id}"
									${selectID == row.id ? 'selected' : ''}
									 data-select2-id="${row.id}">
									${row.name}
									</option>`);
								});
						}else{
							console.log(`خطأ غير معروف ${res}`);
						}
					},
					error: function(res){
						console.log(`خطأ غير معروف ${res}`);
					}
				});
	}
	
	
	if($('#unit_country').val())
	{
	    getProjects($('#unit_country').val(),{{$contact->project_id}});
	}
	
	function getProjects(country,projectId = null)
	{
	    $('.related-to-project').css('display','none');
	    let token = $('meta[name=csrf-token]').attr('content');
		let route = '{{route("admin.get.projects")}}';
		let projectEl = $('.other-select');
        
     
        projectEl.attr('disabled',true);
       
        
		$.ajax({
			type:'POST',
			url: route,
			data:{_token:token,country:country},
			responseType:'json',
			success: (res) => {
				if(res.status == 'success'){
	            
	             projectEl.html('');
	             
	       	projectEl.append( `<option
                    data-text=""
                    value="" 
                    data-select2-id="">
                        select
                    </option>`);
			
			res.rows.forEach(row => {
				projectEl.append(`<option
                    id="project-value-${row.id}"
                    data-text="${row.name}"
                    ${row.id == projectId ? 'selected' : ''}
                    value="${row.id}" 
                    data-select2-id="${row.name}">
                        ${row.name}
                    </option>`);
                    
		    });
			    
		    projectEl.attr('disabled',false);
		    
				}else{
					console.log(`خطأ غير معروف ${res}`);
				}
			},
			error: function(res){
				console.log(`خطأ غير معروف ${res}`);
			}
		});
	};
	
	$( document ).ready(function (){
	   $('.prject-area').css('height','0');
	   $('.prject-area').css('opacity','0');
	});

	
	getCountryCities($('#countries').val(),$("#cities"),true);
	getCountryCities($('#unit_country').val(),$("#unit_city"));
    
    
    
	
	$('#countries').on('change', function (){
		getCountryCities($('#countries').val(),$("#cities"),true);
	});
	
	$('#unit_country').on('change', function (){
		getCountryCities($('#unit_country').val(),$("#unit_city"));
		getProjects($('#unit_country').val());
		$('.prject-area').css('height','auto');
		$('.prject-area').css('opacity','1');
	});

	$('#countries').on('change', function (){
		getCountryCities($('#countries').val());
	});

	$('.other-select').on('change',function (){
		let val = $('#project-value-'+$(this).val()).data('text');
	
		if(val == 'others' || val == 'أخري')
		{
			$('.related-to-project').css('display','block');
		}else{
			$('.related-to-project').css('display','none');
		}
	});

	function showTask(el)
	{
		let parent = el.parents('.form-group');
		if(el.prop('checked'))
		{
			parent.next('.task').css('display','block');
		}else{
			parent.next('.task').css('display','none');
		}
	}

	$('.show-task').on('click', function (){
		showTask($(this));
	});
		
		


	// show Task
	$(document).ready(function (){
		$('.show-task').each(function (el){
			if($(this).attr('checked'))
			{
				showTask($(this));
			}
		});
	});

</script>
@endpush
