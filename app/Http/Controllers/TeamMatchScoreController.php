<?php

namespace App\Http\Controllers;

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

        $match->update([
            'team1_score' => $request->team1_score,
            'team2_score' => $request->team2_score,
            'user_id' => auth()->id() ?? null,
        ]);

        return response()->json(['success' => true]);
    }
}
