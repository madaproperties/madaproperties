@component('mail::message')
#  Hi , 

<p>New property is added by {{ $data['agent'] }}.</p>

@component('mail::button', ['url' => route('admin.property.show',$data['id'])])
 Let's verify it
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
