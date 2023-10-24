<?php

namespace App\Listeners;

use App\Events\ParticipantZoomLinkSend;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
        //
    }
}
