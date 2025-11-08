<?php

use App\Http\Controllers\AdtScoreController;
use App\Http\Controllers\HandBallController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

Route::get('/login', function () {
    return (!Auth::check()) ? view('auth.login') : Redirect::to(getDashboardURL());
})->name('login');

Route::get('/', function () {
    return \redirect(route('login')) ;
});

//Route::get('/',[FrontController::class,'home'])->name('front.index');
Route::get('/registration',[FrontController::class,'register'])->name('front.register');
Route::post('/registration',[FrontController::class,'registration'])->name('front.register.store');
Route::get('/blogs',[FrontController::class,'blogs'])->name('front.blogs');
Route::get('/blogs/{slug}/{blog}',[FrontController::class,'blogDetail'])->name('front.blog.detail');
Route::get('/contact-us',[FrontController::class,'contactUs'])->name('front.contact');
Route::post('/contact-us',[FrontController::class,'contactUsStore'])->name('front.contact.store');

Route::group([
    'prefix' => 'player', 'middleware' => ['auth', 'xss','role:player'],
], function () {
Route::get('/profile',[FrontController::class,'playerProfile'])->name('front.player.profile');
});

// Scoreboard
//Route::view('scoreboard','scoreboard.scoreboard')->name('scoreboard');
Route::get('score-form',[AdtScoreController::class,'index'])->name('adt-score.index');
Route::post('score-form',[AdtScoreController::class,'store'])->name('adt-score.store');
//Route::put('score-form/{matchBetweenTeams}',[AdtScoreController::class,'update'])->name('adt-score.update');
//Route::get('score-form/{matchBetweenTeams}',[AdtScoreController::class,'show'])->name('adt-score.show');
Route::get('score-form/{matchScores}/live',[AdtScoreController::class,'live'])->name('adt-score.live');
Route::get('score-form/{matchScores}/liveScore',[AdtScoreController::class,'liveScore'])->name('adt-score.liveScore');
Route::get('score-form/{matchBetweenTeams}/delete',[AdtScoreController::class,'destroy'])->name('adt-score.destroy');

Route::get('adt-scoreboard/{matchScores}/{teamA}-VS-{teamB}',[AdtScoreController::class,'scoreBoard'])->name('adt.score-board');
Route::post('adt-scoreboard/{matchScores}',[AdtScoreController::class,'scoreBoardStore'])->name('adt.score-board.store');

// Hand Ball
Route::get('handball-score-form',[HandBallController::class,'index'])->name('handball-adt-score.index');
Route::post('handball-score-form',[HandBallController::class,'store'])->name('handball-adt-score.store');
Route::get('handball-score-form/{matchScores}/live',[HandBallController::class,'live'])->name('handball-adt-score.live');
Route::get('handball-score-form/{matchBetweenTeams}/delete',[HandBallController::class,'destroy'])->name('handball-adt-score.destroy');
Route::get('handball-score-form/{matchScores}/liveScore',[HandBallController::class,'liveScore'])->name('handball-adt-score.liveScore');
Route::get('handball-scoreboard/{matchScores}/{teamA}-VS-{teamB}',[HandBallController::class,'scoreBoard'])->name('handball-adt.score-board');
