<?php

namespace App\Http\Controllers;

use App\Models\TeamMatchScore;
use App\Models\Timer;
use Illuminate\Http\Request;

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
        $timer = Timer::where('team_match_id', $match->team_match_id)->first();
        $score = array_merge($match->toArray(), $timer->toArray());

        return response()->json($score);
    }

    public function live($id)
    {
        $scores = TeamMatchScore::with('teamMatch.team1', 'teamMatch.team2')->where('id','=', $id)->first();

        return view('scoreboard.score-live',compact('scores'));
    }
}
