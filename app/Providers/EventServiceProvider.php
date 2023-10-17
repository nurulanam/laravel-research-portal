<?php

namespace App\Providers;

use App\Events\ParticipantHireAccepted;
use App\Events\ParticipantRejected;
use App\Events\ProjectHired;
use App\Listeners\NotifyParticipantHireAccepted;
use App\Listeners\NotifyParticipantRejected;
use App\Models\Listeners\NotifyProjectHired;
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
        ProjectHired::class => [
            NotifyProjectHired::class,
        ],
        ParticipantRejected::class => [
            NotifyParticipantRejected::class,
        ],
        ParticipantHireAccepted::class => [
            NotifyParticipantHireAccepted::class,
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
