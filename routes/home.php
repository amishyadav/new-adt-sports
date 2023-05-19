<?php

use App\Http\Controllers\AdtScoreController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

Route::get('/login', function () {
    return (!Auth::check()) ? view('auth.login') : Redirect::to(getDashboardURL());
})->name('login');

Route::get('/',[FrontController::class,'home'])->name('front.index');
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
Route::post('/team',[TeamController::class,'store'])->name('front.team.store');
Route::post('/add-player',[TeamController::class,'addPlayer'])->name('front.team.player');
});

// Scoreboard
Route::view('scoreboard','scoreboard.scoreboard')->name('scoreboard');
Route::get('score-form',[AdtScoreController::class,'index'])->name('adt-score.index');
Route::post('score-form',[AdtScoreController::class,'store'])->name('adt-score.store');
Route::put('score-form/{adtScore}',[AdtScoreController::class,'update'])->name('adt-score.update');
Route::get('score-form/{adtScore}',[AdtScoreController::class,'show'])->name('adt-score.show');
Route::get('score-form/{adtScore}/live',[AdtScoreController::class,'live'])->name('adt-score.live');
Route::get('score-form/{adtScore}/liveScore',[AdtScoreController::class,'liveScore'])->name('adt-score.liveScore');
Route::get('score-form/{adtScore}/delete',[AdtScoreController::class,'destroy'])->name('adt-score.destroy');
