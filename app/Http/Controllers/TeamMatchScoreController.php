<?php

namespace App\Http\Controllers;

use App\Models\TeamMatch;
use App\Models\TeamMatchScore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use SebastianBergmann\Timer\Timer;

class TeamMatchScoreController extends Controller
{
    public function index($id)
    {
        $scores = TeamMatchScore::with('teamMatch.team1', 'teamMatch.team2')->where('id','=', $id)->first();

        return view('score.scoreboard')->with(['score' => $scores]);
    }

    public function updateScore($id, Request $request)
    {
        $request->validate([
            'team1_score' => 'required|integer|min:0',
            'team2_score' => 'required|integer|min:0',
        ]);

        $match = TeamMatchScore::whereId($id)->first();

        $match->update($request->all());

        return response()->json(['success' => true]);
    }

    public function timer($id)
    {
        $scores = TeamMatchScore::with('teamMatch.team1', 'teamMatch.team2')->where('id','=', $id)->first();

        return view('score.timer')->with(['score' => $scores]);
    }

    public function mainScreen($id)
    {
        $scores = TeamMatchScore::with('teamMatch.team1', 'teamMatch.team2')->where('id','=', $id)->first();

        return view('score.display-on-screen')->with(['score' => $scores]);
    }

    public function getTimerAndScore($id)
    {
        $match = TeamMatchScore::with('teamMatch.team1', 'teamMatch.team2')->findOrFail($id);
        return response()->json($match);
    }

    public function updateTimers(Request $request, $id)
    {
        $match = TeamMatchScore::findOrFail($id);

        if ($request->has('main_timer_seconds')) $match->main_timer_seconds = $request->main_timer_seconds;
//        if ($request->has('raid_timer_seconds_left')) $match->raid_timer_seconds_left = $request->raid_timer_seconds_left;
//        if ($request->has('raid_timer_seconds_right')) $match->raid_timer_seconds_right = $request->raid_timer_seconds_right;
        if ($request->has('raid_timer_seconds')) $match->raid_timer_seconds = $request->raid_timer_seconds;

        $match->save();

        return response()->json(['success' => true]);
    }

}
