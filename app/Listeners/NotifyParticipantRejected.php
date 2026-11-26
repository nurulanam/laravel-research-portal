<?php

namespace App\Listeners;

use App\Events\ParticipantRejected;
use App\Notifications\ParticipantRejectedNotification;
use Illuminate\Support\Facades\Notification;

class NotifyParticipantRejected
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
     * @param  \App\Events\ParticipantRejected  $event
     * @return void
     */
    public function handle(ParticipantRejected $event)
    {
        $response = $event->response;
        $projectName = $response->project->study_title;

        Notification::send($response->user, new ParticipantRejectedNotification($projectName));
    }
}
