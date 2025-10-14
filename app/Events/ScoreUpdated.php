<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ScoreUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $matchId;
    public $scoreData;

    /**
     * Create a new event instance.
     */
    public function __construct($matchId, $scoreData)
    {
        $this->matchId = $matchId;
        $this->scoreData = $scoreData;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel
     */
    public function broadcastOn(): Channel
    {
        return new Channel('match-'.$this->matchId);
    }
}
