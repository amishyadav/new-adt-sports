<?php

namespace App\Http\Controllers;

use App\Events\ScoreUpdated;
use App\Models\TeamMatch;
use App\Models\TeamMatchScore;
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

        broadcast(new ScoreUpdated($id, [
            'team1_score' => $request->team1_score,
            'team2_score' => $request->team2_score,
        ]));

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
}
