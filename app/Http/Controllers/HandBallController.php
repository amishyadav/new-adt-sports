<?php

namespace App\Http\Controllers;

use App\Models\MatchBetweenTeams;
use App\Models\MatchScores;
use Illuminate\Http\Request;

class HandBallController extends Controller
{
    public function index()
    {
        $scores = MatchBetweenTeams::orderBy('id','desc')->get();

        return view('handball.adt-form',compact('scores'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $score = MatchBetweenTeams::create($data);

        MatchScores::create(['match_between_team_id' => $score->id]);

        return redirect(route('adt-score.index'));
    }

    public function live(MatchScores $matchScores)
    {

        return view('handball.score-live',compact('matchScores'));
    }

    public function liveScore(MatchScores $matchScores)
    {
        return response()->json($matchScores);
    }

    public function destroy(MatchBetweenTeams $matchBetweenTeams)
    {
        $matchBetweenTeams->delete();

        return redirect(route('adt-score.index'));
    }

    public function scoreBoard(MatchScores $matchScores)
    {
        return view('handball.adt_scorebaord',compact('matchScores'));
    }
}
