<?php

use App\Models\PaymentGateway;
use App\Models\Setting;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\HigherOrderBuilderProxy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Stripe\Stripe;

/**
 *
 * @return Authenticatable|null
 */
function getLogInUser()
{
    return Auth::user();
}

/**
 * @return mixed
 */
function getAppName()
{
    static $settings;

    if (empty($settings)) {
        $settings = Setting::all()->pluck('value', 'key');
    }

    return (!empty($settings['app_name'])) ? $settings['app_name'] : config('app.name');

}
//function getStates($countryId)
//{
//    return State::where('country_id', $countryId)->toBase()->pluck('name', 'id')->toArray();
//}

/**
 * @return mixed
 */
function getAppLogo()
{
    static $setting;
    if (empty($setting)) {
        $setting = Setting::all()->keyBy('key');
    }

    return $setting['logo']->value;
}

/**
 * @return mixed
 */
function getFaviconLogo()
{
    static $setting;
    if (empty($setting)) {
        $setting = Setting::all()->keyBy('key');
    }

    return $setting['favicon']->value;
}

/**
 *
 * @return int
 */
function getLogInUserId()
{
    return Auth::user()->id;
}

/**
 * @return string
 */
function getDashboardURL()
{

    if(Auth::user()->hasRole('admin')){
        return 'admin/dashboard';
    }elseif(Auth::user()->hasRole('player')){
        return 'player/profile/';
    }

    return RouteServiceProvider::HOME;
}

/**
 * @param $email
 * @return string
 */
function setEmailLowerCase($email)
{
    return strtolower($email);
}

function version()
{
    if(config('app.is_version') == 'true') {
        $composerFile = file_get_contents('../composer.json');
        $composerData = json_decode($composerFile, true);
        $currentVersion = $composerData['version'];

    return 'v'.$currentVersion;
    }
}

function getBadgeColor($index): string
{
    $colors = [
        'primary',
        'danger',
        'success',
        'info',
        'warning',
        'dark',
    ];

    $index = $index % 6;
    if (Auth::user()->dark_mode) {
        array_splice($colors, 5, 1);
        array_push($colors, 'bg-white');
    }

    return $colors[$index];
}



/**
 *
 * @return string
 */
function checkLanguageSession()
{
    if (Session::has('languageName')) {
        return Session::get('languageName');
    } else {
        $user = getLogInUser();
        if ($user != null) {

            return $user->language;
        }
    }

    return 'en';
}

function getSettingValue()
{
    static $settingValues = [];

    if (empty($settingValues)) {
        $settingValues = Setting::pluck('value', 'key')->toArray();
    }

    return $settingValues;
}

function getSettingValueByKey($key)
{
    $settingValues = Setting::where('key',$key)->first();

    return $settingValues->value;
}

function getRegisteredPlayerPermission()
{
    $value = false;
    $auth = Auth::user();

    $user = $auth->load('registeredPlayer');

    if ($user->registeredPlayer->isNotEmpty()){
        if($user->registeredPlayer[0]->status === \App\Models\RegisteredPlayer::ACTIVE)
        {
            $value = true;
        }
    }

    return $value;
}

function getTeamPlayerPermission()
{
    $auth = Auth::user();

    $user = $auth->load('teamPlayer');

    return !empty($user->teamPlayer) ? true : false;
}
