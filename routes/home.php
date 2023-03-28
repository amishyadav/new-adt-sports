<?php

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
