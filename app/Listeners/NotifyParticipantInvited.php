<?php

namespace App\Listeners;

use App\Events\ParticipantInvited;
use App\Notifications\ParticipantInvitedNotification;
use Illuminate\Support\Facades\Notification;

class NotifyParticipantInvited
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
     * @param  \App\Events\ParticipantInvited  $event
     * @return void
     */
    public function handle(ParticipantInvited $event)
    {
        $response = $event->response;
        $projectName = $response->project->study_title;

        Notification::send($response->user, new ParticipantInvitedNotification($projectName));
    }
}
