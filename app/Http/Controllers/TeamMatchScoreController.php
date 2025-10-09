<?php

namespace App\Http\Controllers;

use App\Models\TeamMatch;
use App\Models\TeamMatchScore;
use Illuminate\Http\Request;

class TeamMatchScoreController extends Controller
{
    public function index($id)
    {

        $teamMatch = TeamMatch::with('team1','team2')->where('id', $id)->first();
//        dd($teamMatch);
        $scores = TeamMatchScore::with('teamMatch')->get();



        return view('score.scoreboard')->with(['score' => $scores, 'teamMatch' => $teamMatch]);
    }

    public function updateScore($id, Request $request)
    {
        $request->validate([
            'team1_score' => 'required|integer|min:0',
            'team2_score' => 'required|integer|min:0',
        ]);

        $match = TeamMatchScore::whereId($id)->first();
dd(empty($match));
        if (empty($match)) {
            TeamMatchScore::create([
                'team1_score' => $request->team1_score,
                'team2_score' => $request->team2_score,
                'team1_id' => $request->team1_id,
                'team2_id' => $request->team2_id,
                'user_id' => auth()->id() ?? null,
            ]);
        } else {
            $match->update([
                'team1_score' => $request->team1_score,
                'team2_score' => $request->team2_score,
                'user_id' => auth()->id() ?? null,
            ]);
        }



        return response()->json(['success' => true]);
    }
}
