<?php

namespace App\Events;

use App\Models\TeamMatchScore;
use App\Support\MatchStateStore;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MatchStateUpdated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public int $scoreId, public ?array $payload = null)
    {
    }

    public function broadcastOn(): Channel
    {
        return new Channel('match-state.' . $this->scoreId);
    }

    public function broadcastAs(): string
    {
        return 'match.state.updated';
    }

    public function broadcastWith(): array
    {
        if ($this->payload !== null) {
            return $this->payload;
        }

        $match = TeamMatchScore::with('teamMatch.team1', 'teamMatch.team2')->findOrFail($this->scoreId);

        return MatchStateStore::buildPayload($match);
    }
}
