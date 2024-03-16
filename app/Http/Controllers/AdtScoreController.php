<?php

namespace App\Http\Controllers;

use App\Models\AdtScore;
use Illuminate\Http\Request;

class AdtScoreController extends Controller
{
    public function index()
    {
        $scores = AdtScore::orderBy('id','desc')->get();

        return view('scoreboard.adt-form',compact('scores'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $score = AdtScore::create($data);

       return redirect(route('adt-score.show',$score->id));
    }

    public function update(Request $request ,AdtScore $adtScore)
    {
        $data = $request->all();

        $score = $adtScore->update($data);

        return redirect(route('adt-score.show',$adtScore->id));
    }

    public function show(AdtScore $adtScore)
    {

        return view('scoreboard.score-controller',compact('adtScore'));
    }

    public function live(AdtScore $adtScore)
    {

        return view('scoreboard.score-live',compact('adtScore'));
    }

    public function liveScore(AdtScore $adtScore)
    {
        return response()->json($adtScore);
    }

    public function destroy(AdtScore $adtScore)
    {
        $adtScore->delete();

        return redirect(route('adt-score.index'));
    }

    public function scoreBoard()
    {
        return view('scoreboard.adt_scorebaord');
    }
}
