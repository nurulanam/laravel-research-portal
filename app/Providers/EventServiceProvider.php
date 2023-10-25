<?php

namespace App\Providers;

use App\Events\ParticipantHireAccepted;
use App\Events\ParticipantHireDenied;
use App\Events\ParticipantInvited;
use App\Events\ParticipantRejected;
use App\Events\ParticipantZoomLinkSend;
use App\Events\ParticipantHired;
use App\Listeners\NotifyParticipantHireAccepted;
use App\Listeners\NotifyParticipantHireDenied;
use App\Listeners\NotifyParticipantInvited;
use App\Listeners\NotifyParticipantRejected;
use App\Listeners\NotifyParticipantZoomLinkSend;
use App\Models\Listeners\NotifyParticipantHired;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ParticipantHired::class => [
            NotifyParticipantHired::class,
        ],
        ParticipantRejected::class => [
            NotifyParticipantRejected::class,
        ],
        ParticipantHireAccepted::class => [
            NotifyParticipantHireAccepted::class,
        ],
        ParticipantHireDenied::class => [
            NotifyParticipantHireDenied::class,
        ],
        ParticipantZoomLinkSend::class => [
            NotifyParticipantZoomLinkSend::class,
        ],
        ParticipantInvited::class => [
            NotifyParticipantInvited::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
