<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TimerUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $mainTimer;
    public $thirtySecTimer;

    /**
     * Create a new event instance.
     */
    public function __construct($mainTimer, $thirtySecTimer)
    {
        $this->mainTimer = $mainTimer;
        $this->thirtySecTimer = $thirtySecTimer;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return string[]
     */
    public function broadcastOn()
    {
        return ['kabaddi-timer'];
    }

    public function broadcastAs()
    {
        return 'timer.updated';
    }
}
