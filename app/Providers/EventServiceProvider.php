<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\RegistrationEvent;
use App\Events\OnLogin;
use App\Listeners\RegisterHospitalListener;
use App\Listeners\SendWelcomeMailListener;
use App\Listeners\OnLoginListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        RegistrationEvent::class => [
            RegisterHospitalListener::class,
            SendWelcomeMailListener::class,
        ],
        OnLogin::class => [
            OnLoginListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
