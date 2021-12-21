@component('mail::message')
#  Hi Confirm Your Email And Manage Your Account

@component('mail::button', ['url' => route('setpassword',$data['hash'])])
 Let's Go
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
