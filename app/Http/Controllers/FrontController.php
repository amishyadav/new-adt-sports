<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\PlayerRegistration;
use App\Models\Blog;
use App\Models\Setting;
use App\Models\TeamPlayer;
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
//        return redirect(route('front.register'));
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
        $input['position_type'] = ($input['position'] === 'Defender') ? $input['position_type'] : null;
        $user = User::create($input);
        $user->assignRole('player');

        if (isset($input['profile']) && !empty('profile')) {
            $user->addMedia($input['profile'])->toMediaCollection(User::PROFILE, config('app.media_disc'));
        }

        if (isset($input['aadhar_card_image']) && !empty('aadhar_card_image')) {
            $user->addMedia($input['aadhar_card_image'])->toMediaCollection(User::AADHAR_CARD, config('app.media_disc'));
        }

        Flash::success('Congrats, you are successfully registered to ADT Sports');

        return redirect(route('front.register'));
    }

    public function playerProfile()
    {
        $players = null;
        $user = getLogInUser();
        if (!empty($user->team)){
            $players = TeamPlayer::with('user')->where('team_id', $user->team->id)->get();
        }

        return view('player.profile',compact('user','players'));
    }

    public function blogs()
    {
        $blogs = Blog::paginate(8);

        return view('front.pages.blog',compact('blogs'));
    }

    public function blogDetail($slug,Blog $blog)
    {
        return view('front.pages.blog_detail',compact('blog'));
    }
}
