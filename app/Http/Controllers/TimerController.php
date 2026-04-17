<?php

namespace App\Http\Controllers;

use App\Events\MatchStateUpdated;
use App\Models\TeamMatchScore;
use App\Support\MatchStateStore;
use Illuminate\Http\Request;

class TimerController extends Controller
{
    public function get($id)
    {
        return response()->json(MatchStateStore::getTimerState((int) $id));
    }

    public function update(Request $request, $id)
    {
        $score = TeamMatchScore::with('teamMatch.team1', 'teamMatch.team2')->findOrFail($id);
        $timerState = MatchStateStore::putTimerState(
            (int) $id,
            [
                'main_timer_seconds' => (int) $request->main_timer_seconds,
                'raid_timer_seconds' => (int) $request->raid_timer_seconds,
                'active_side' => $request->active_side,
                'main_running' => filter_var($request->main_running, FILTER_VALIDATE_BOOLEAN),
                'raid_running' => filter_var($request->raid_running, FILTER_VALIDATE_BOOLEAN),
                'synced_at_ms' => (int) round(microtime(true) * 1000),
            ]
        );
        event(new MatchStateUpdated((int) $id, MatchStateStore::buildPayload($score, $timerState)));

        return response()->json(['success' => true]);
    }
}
