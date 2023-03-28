<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\PlayerRegistration;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laracasts\Flash\Flash;

class FrontController extends Controller
{
    public function home()
    {
        return redirect(route('front.register'));
        return view('front.pages.home');
    }

    public function register()
    {
        $setting = Setting::all()->pluck('value','key')->toArray();
        return view('front.pages.register',compact('setting'));
    }

    public function registration(PlayerRegistration $request): Application|RedirectResponse|Redirector
    {
        $input = $request->all();

        $input['email'] = setEmailLowerCase($input['email']);
        $input['password'] = Hash::make($input['password']);
        $input['unique_code'] = User::generatePlayerUniqueCode();
        $user = User::create($input);
        $user->assignRole('player');

        if (isset($input['profile']) && !empty('profile')) {
            $user->addMedia($input['profile'])->toMediaCollection(User::PROFILE, config('app.media_disc'));
        }

        if (isset($input['aadhar_card_image']) && !empty('aadhar_card_image')) {
            $user->addMedia($input['aadhar_card_image'])->toMediaCollection(User::AADHAR_CARD, config('app.media_disc'));
        }

        Flash::success('Congrats, your are successfully registered to ADT Sports');

        return redirect(route('front.register'));
    }
}
