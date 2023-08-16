<?php

namespace App\Models\Listeners;

use App\Events\ProjectHired;
use App\Mail\ProjectHiredMail;
use App\Notifications\ProjectHiredNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;

class NotifyProjectHired
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
     * @param  \App\Events\ProjectHired  $event
     * @return void
     */
    public function handle(ProjectHired $event)
    {
        $response = $event->response;
        $projectName = $response->project->study_title;

        Notification::send($response->user, new ProjectHiredNotification($projectName));
    }
}
