@component('mail::message')
#  Hi, 

<p>You got a new lead.</p>

@if(!empty($data['project_name']))
Project Name : {{ $data['project_name'] }}
@endif

@component('mail::button', ['url' => route('admin.home').'?filter_status=2'])
 Let's verify it
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
