<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ParticipantZoomLinkSend
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $response;
    public $meeting_id;
    public $passcode;
    public $schedule_date;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($response, $meeting_id, $passcode, $schedule_date)
    {
        $this->response = $response;
        $this->meeting_id = $meeting_id;
        $this->passcode = $passcode;
        $this->schedule_date = $schedule_date;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
