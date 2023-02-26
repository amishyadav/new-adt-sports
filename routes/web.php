<?php

use App\Http\Controllers\AllMatchesController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CookieController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FaqsController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\LeagueController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SocialIconController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Rap2hpoutre\LaravelLogViewer\LogViewerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[FrontController::class,'home'])->name('front.index');

Route::get('/login', function () {
    return (!Auth::check()) ? view('auth.login') : Redirect::to(getDashboardURL());
})->name('login');

//Change Language
Route::post('update-language', [UserController::class, 'updateLanguage'])->name('change-language');

Route::group([
    'prefix' => 'admin', 'middleware' => ['auth', 'xss', 'setLanguage'],
], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('categories', CategoryController::class);
    Route::put('categories/{category}/status',
        [CategoryController::class, 'changeStatus'])->name('categories.change.status');
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::Post('settings', [SettingController::class, 'update'])->name('settings.update');

    Route::get('cookie', [CookieController::class, 'index'])->name('cookie-index');
    Route::post('cookie', [CookieController::class, 'update'])->name('cookie-update');

    Route::resource('leagues', LeagueController::class);
    Route::put('leagues/{league}/status',
        [LeagueController::class, 'changeLeagueStatus'])->name('leagues.change.status');
    Route::resource('all-matches', AllMatchesController::class);
    Route::put('matches/{match}/status', [AllMatchesController::class, 'changeStatus'])->name('matches.change.status');
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    //Change Profile
    Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('profile.setting');
    Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('update.profile.setting');

    //Change password
    Route::put('/change-user-password', [UserController::class, 'changePassword'])->name('user.changePassword');

    //Change Theme
    Route::get('update-dark-mode', [UserController::class, 'updateDarkMode'])->name('update-dark-mode');

    //Clear cache
    Route::get('clear-cache', [SettingController::class, 'clearCache'])->name('clear-cache');

    //Impersonate
    Route::get('impersonate/{id}', [UserController::class, 'impersonate'])->name('impersonate');
    Route::get('impersonate-leave',[UserController::class, 'impersonateLeave'])->name('impersonate.leave');


    Route::resource('blog', BlogController::class);

    Route::resource('faqs', FaqsController::class);
    Route::put('faqs/{faq}/status', [FaqsController::class, 'changeStatus'])->name('faqs.change-status');

    Route::resource('partner', PartnerController::class);

    Route::resource('social-icon', SocialIconController::class);

    // Logs Route
    Route::get('logs', [LogViewerController::class, 'index']);

    Route::view('scoreboard','scoreboard.scoreboard');
});
require __DIR__.'/auth.php';
//require __DIR__.'/user.php';
