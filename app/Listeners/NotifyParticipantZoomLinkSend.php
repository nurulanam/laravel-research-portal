<?php

namespace App\Listeners;

use App\Events\ParticipantZoomLinkSend;
use App\Notifications\ParticipantZoomLinkSendNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class NotifyParticipantZoomLinkSend
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
     * @param  \App\Events\ParticipantZoomLinkSend  $event
     * @return void
     */
    public function handle(ParticipantZoomLinkSend $event)
    {
        $project_name = $event->response->project->study_title;
        $meeting_id = $event->meeting_id;
        $passcode = $event->passcode;
        $schedule_date = $event->schedule_date;

        Notification::send($event->response->user, new ParticipantZoomLinkSendNotification($project_name, $meeting_id, $passcode, $schedule_date));
    }
}
