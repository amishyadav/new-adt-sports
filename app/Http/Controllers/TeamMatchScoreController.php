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
        dd($teamMatch);
        $scores = TeamMatchScore::with('teamMatch')->get();

        return view('score.scoreboard')->with(['score' => $scores, 'teamMatch' => $teamMatch]);
    }
}
