<?php

namespace App\Http\Controllers;

use App\Models\Timer;
use Illuminate\Http\Request;

class TimerController extends Controller
{
    public function get($id)
    {
        $timer = Timer::findOrFail($id);
        return response()->json($timer);
    }

    public function update(Request $request, $id)
    {
        $timer = Timer::findOrFail($id);
        $timer->update([
            'main_timer_seconds' => $request->main_timer_seconds,
            'raid_timer_seconds' => $request->raid_timer_seconds,
            'active_side' => $request->active_side,
        ]);

        return response()->json(['success' => true]);
    }
}
