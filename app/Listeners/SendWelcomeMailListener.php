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
        //this will send a welcome mail to the user
        $data = $event->registered;
        Mail::to($data->email)->send(new WelcomeMail($data));
    }
}
