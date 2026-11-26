<?php

namespace App\Events;

use App\Models\backend\ProjectHasResponse;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ParticipantInvited
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $response;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($projectId, $id)
    {
        $this->response = ProjectHasResponse::where('project_id', '=', $projectId)->where('user_id', '=', $id)->first();
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
