<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TaskFinished implements  ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $task_id;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($task_id)
    {
        $this->task_id = $task_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('my_task_channel');
    }
}
