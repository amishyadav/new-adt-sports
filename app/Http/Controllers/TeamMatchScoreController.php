<?php

namespace App\Http\Controllers;

use App\Events\MatchStateUpdated;
use App\Models\TeamMatchScore;
use App\Support\MatchStateStore;
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
        event(new MatchStateUpdated($match->id));

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
        $matchState = $this->buildMatchStatePayload($id);

        return view('score.display-on-screen')->with(['score' => $scores, 'matchState' => $matchState]);
    }

    public function getTimerAndScore($id)
    {
        return response()->json($this->buildMatchStatePayload($id));
    }

    public function live($id)
    {
        $scores = TeamMatchScore::with('teamMatch.team1', 'teamMatch.team2')->where('id','=', $id)->first();

        return view('scoreboard.score-live',compact('scores'));
    }

    private function buildMatchStatePayload($id): array
    {
        $match = TeamMatchScore::with('teamMatch.team1', 'teamMatch.team2')->findOrFail($id);

        return MatchStateStore::buildPayload($match);
    }
}
