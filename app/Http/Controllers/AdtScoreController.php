<?php

namespace App\Http\Controllers;

use App\Models\AdtScore;
use App\Models\MatchBetweenTeams;
use App\Models\MatchScores;
use Illuminate\Http\Request;

class AdtScoreController extends Controller
{
    public function index()
    {
        $scores = MatchBetweenTeams::orderBy('id','desc')->get();

        return view('scoreboard.adt-form',compact('scores'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $score = MatchBetweenTeams::create($data);

        MatchScores::create(['match_between_team_id' => $score->id]);

       return redirect(route('adt-score.index'));
    }

    public function update(Request $request ,MatchBetweenTeams $matchBetweenTeams)
    {
        $data = $request->all();

        $score = $matchBetweenTeams->update($data);

        return redirect(route('adt-score.show',$matchBetweenTeams->id));
    }

    public function show(MatchBetweenTeams $matchBetweenTeams)
    {

        return view('scoreboard.score-controller',compact('matchBetweenTeams'));
    }

    public function live(MatchBetweenTeams $matchBetweenTeams)
    {

        return view('scoreboard.score-live',compact('matchBetweenTeams'));
    }

    public function liveScore(MatchBetweenTeams $matchBetweenTeams)
    {
        return response()->json($matchBetweenTeams);
    }

    public function destroy(MatchBetweenTeams $matchBetweenTeams)
    {
        $matchBetweenTeams->delete();

        return redirect(route('adt-score.index'));
    }

    public function scoreBoard(MatchScores $matchScores)
    {
        return view('scoreboard.adt_scorebaord',compact('matchScores'));
    }
}
