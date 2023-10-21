<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ParticipantHireDenied
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $projectName;
    public $researcher;
    public $participant;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($projectName, $participantId, $researcherId)
    {
        $this->projectName = $projectName;
        $this->researcher = User::find($researcherId);
        $this->participant = User::find($participantId);
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
