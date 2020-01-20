<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\RegistrationEvent;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;

class SendWelcomeMailListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     //
    // }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        try {

            //this will send a welcome mail to the user
            $data = $event->registered;
            $url = config("app.url") . '/register/confirm/' . $event->registered->email . '/' . $event->registered->remember_token;
            Mail::to($data->email)->send(new WelcomeMail($data, $url));

        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
