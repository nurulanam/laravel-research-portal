<?php

namespace App\Listeners;

use App\Events\ParticipantHired;
use App\Notifications\ParticipantHiredNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;

class NotifyParticipantHired
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
     * @param  \App\Events\ParticipantHired  $event
     * @return void
     */
    public function handle(ParticipantHired $event)
    {
        $response = $event->response;
        $projectName = $response->project->study_title;

        Notification::send($response->user, new ParticipantHiredNotification($projectName));
    }
}
