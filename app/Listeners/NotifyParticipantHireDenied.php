<?php

namespace App\Listeners;

use App\Events\ParticipantHireDenied;
use App\Notifications\ParticipantHireDeniedNotification;
use Illuminate\Support\Facades\Notification;

class NotifyParticipantHireDenied
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\ParticipantHireDenied  $event
     * @return void
     */
    public function handle(ParticipantHireDenied $event)
    {
        $projectName = $event->projectName;
        $researcher = $event->researcher;
        $participant = $event->participant;

        Notification::send($researcher, new ParticipantHireDeniedNotification($projectName, $participant));
    }
}
