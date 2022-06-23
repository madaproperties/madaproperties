@push('css')
<link href="https://cdn.jsdelivr.net/combine/npm/fullcalendar@5.7.2/main.min.css,npm/fullcalendar@5.7.2/main.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.7.2/main.min.css" rel="stylesheet" type="text/css" />
@endpush
@push('js')
<script src="https://cdn.jsdelivr.net/combine/npm/fullcalendar@5.7.2/locales-all.min.js,npm/fullcalendar@5.7.2"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.7.2/locales-all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.7.2/main.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      eventDidMount: function(data) {
        let event = data.event;
        let eventID = event.id;
        let eventTitlte = event.title;
        
        
        data.el.setAttribute("data-toggle", 'modal');
        data.el.setAttribute("data-route",   `{{route('admin.getlog')}}` );
        data.el.setAttribute("data-id",   eventID );
         data.el.setAttribute("data-type",   eventTitlte );
        
        let editTitle = eventTitlte == 'task' ? 'task' : 'log';
        data.el.setAttribute('data-target',`#edit-${editTitle}-${eventID}`);
        data.el.classList.add('fullcalendar-event');
      },
      initialView: 'dayGridMonth',
      // events: [
      //   @foreach($rows as $row){
      //     id:{{$row['id']}},
      //     title: "{{$row['type']}}",
      //     start: "{{$row['date']}}",
      //   },
      //   @endforeach
      // ]
      events: '{{route("admin.calendar")}}'
    });
    calendar.render();
  });
  // fullcalendar-event append the id
  $(document).ready(function (){
    $('.fullcalendar-event').each((index,el) => {
      const tilte = el.querySelector('.fc-event-title');
      const title = tilte.textContent;
  
    });
  });
  
  
  $(document).on('click','.fc-event', function (){
       let route = $(this).data('route');
       let id = $(this).data('id');
        let token = $('meta[name=csrf-token]').attr('content');
        let type = $(this).data('type');
     
       $.ajax({
			type:'POST',
			url: route,
			dataType : "html",
			data:{_token:token,id:id,type:type},
			responseType:'json',
			success: (res) => {
			    
		        if(!$('#edit-task-'+id).length && !$('#edit-log-'+id).length)
			   {
			     
		         $('body').prepend(res);
		         
			   }
		         
		         if (type == 'meeting')
        		    {
    		         $('#edit-log-'+id).modal('show');
        		        
        		    }else{
    		          $('#edit-task-'+id).modal('show');
        		        
        		    }
                $(".datepicker-input" ).datepicker();
                $(".timepicker-input" ).timepicker();
		         
		         renderDescriptionTextarea(id); 
		       
			    
			    
			   
			},
			error: function(res){
				console.log(`خطأ غير معروف ${res}`);
			}
		}); // end ajax
	
	
  });
  
  
  function renderDescriptionTextarea(id)
  {
       var idEl = `#task-description-edit-`+id;
    
        if(!$(idEl).length)
        {
            idEl = `#log-description-`+id;
        }
        
    
        var KTCkeditor = function () {
            // Private functions
            var demos = function () {
                ClassicEditor
              .create( document.querySelector(idEl) )
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
  }
</script>
@endpush
@extends('admin.layouts.main')
@section('content')
<div class="subheader py-2 py-lg-6 subheader-transparent" id="kt_subheader">
	<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">

	</div>
</div>
<div class="container " id="#parent">

		<!--begin::Example-->
		<!--begin::Card-->
    <div class="card card-custom">
			<div class="card-body">
				<div id='calendar'></div>
			</div>
		</div>
		<!--end::Card-->
    <div style="padding:40px;background:#eee"></div>
		<!--end::Example-->
	</div>


  


@endsection
