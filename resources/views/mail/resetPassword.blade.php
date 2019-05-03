@component('mail::message')
#One Clinic Portal
 
Hello.

You recieved this mail because we got a password reset request from you.

Please click the button below to reset your password or copy and paste the link attached in your browser.<br>

Plese note that the link expires after the first click.

@component('mail::button', ['url' => $url])
Verify Mail
@endcomponent

{{$url}}

Please if you did not make a passwordreset request, kindly contact our customer care channels<br>

Thanks,<br>
One Clinic Portal Team
@endcomponent
