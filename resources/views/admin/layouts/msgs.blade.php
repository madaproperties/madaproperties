@push('css')
  <link href="{{asset('public/css/jquery.toast.css')}}" rel="stylesheet" />
@endpush
@push('js')
<script src="{{asset('public/js/jquery.toast.js')}}"></script>
<!--- hundel messges --->
@if($errors->any())
  @foreach($errors->all() as $e)
  <script>
  $.toast({
      text : "{{$e}}",
      allowToastClose:true,
      hideAfter: 10000,
      position:'top-right',
      bgColor:'#ff0000'
  })
  </script>
  @endforeach
@endif

@if(session()->has('success'))
  <script>
  $.toast({
      text : "{!! session()->get('success') !!}",
      allowToastClose:true,
      hideAfter: 10000,
      position:'top-right',
      bgColor:'green'
  })
  </script>
@endif

@if(session()->has('error'))
  <script>
  $.toast({
      text : "{{ session()->get('error') }}",
      allowToastClose:true,
      hideAfter: 10000,
      position:'top-right',
      bgColor:'#ff0000'
  })
  </script>
@endif


@if(session()->has('danger'))
  <script>
  $.toast({
      text : "{{ session()->get('danger') }}",
      allowToastClose:true,
      hideAfter: 10000,
      position:'top-right',
      bgColor:'#ff0000'
  })
  </script>
@endif



  @if(session()->has('erorrs'))
  <script>
  $.toast({
      text : "{{ session()->get('error') }}",
      allowToastClose:true,
      hideAfter: 10000,
      position:'top-right',
      bgColor:'#ff0000'
  })
  </script>
  @endif


  @if(session()->has('custom_errors'))
    @foreach(session()->get('custom_errors') as $e)
    <script>
    $.toast({
        text : "{{$e}}",
        allowToastClose:true,
        hideAfter: 10000,
        position:'top-right',
        bgColor:'#ff0000'
    })
    </script>
    @endforeach
  @endif
@endpush
