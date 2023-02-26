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
 * @return mixed
 */
//function getFloatingButtonLogo()
//{
//    static $setting;
//    if (empty($setting)) {
//        $setting = AppConfiguration::all()->keyBy('key');
//    }
//
//    return $setting['floating_buttton_logo']->value;
//}

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
    }elseif(Auth::user()->hasRole('member')){
        return  'user/dashboard';
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
function checkCurrency($code)
{
    $composerFile = file_get_contents(public_path('currencymap.json'));

    $array = (array) json_decode($composerFile);


    if (isset($array[$code])) {
        return true;
    }

    return false;
//    $composerData = json_decode($composerFile, true);
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
function getAllPaymentStatus()
{
//    $paymentMethodToReturn = Cache::get('payment_method', null);

//    if (empty($paymentMethodToReturn)) {
    $paymentGateway = \App\Models\PaymentGateway::PAYMENT_METHOD;

    $selectedPaymentGateway = PaymentGateway::pluck('payment_gateway', 'payment_gateway_id',)->toArray();

    $paymentMethodToReturn = array_intersect($paymentGateway, $selectedPaymentGateway);

//        Cache::put('payment_method', $paymentMethodToReturn);
//    }
    return $paymentMethodToReturn;

}
function setStripeApiKey()
{
    Stripe::setApiKey(config('services.stripe.secret_key'));
}

function zeroDecimalCurrencies(): array
{
    return [
        'BIF', 'CLP', 'DJF', 'GNF', 'JPY', 'KMF', 'KRW', 'MGA', 'PYG', 'RWF', 'UGX', 'VND', 'VUV', 'XAF', 'XOF', 'XPF',
    ];
}

function getSettingValue()
{
    static $settingValues = [];

    if (empty($settingValues)) {
        $settingValues = Setting::pluck('value', 'key')->toArray();
    }

    return $settingValues;
}
