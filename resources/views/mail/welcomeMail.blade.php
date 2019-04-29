@component('mail::message')
#One Clinic Portal
 
Hi {{$data->name}}, Welcome to Cne Clinic Portal.

This is a Cloud Based Hospital and Clinic management software.

To start your free trial, kindly click the link below or copy and paste it in your browser

@component('mail::button', ['url' => 'http://127.0.0.1:8000'])
Verify Mail
@endcomponent

Thanks,<br>
One Clinic Portal Team
@endcomponent
