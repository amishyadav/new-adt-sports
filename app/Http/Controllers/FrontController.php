<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlayerRegistration;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\HomeSlider;
use App\Models\RegisteredPlayer;
use App\Models\Setting;
use App\Models\Team;
use App\Models\TeamPlayer;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;
use Laracasts\Flash\Flash;

class FrontController extends Controller
{
    public function home()
    {
        $blogs = '';

        $latestBlog = Blog::latest()->first();
        if (!empty($latestBlog)){
            $blogs = Blog::all()->except($latestBlog->id);
        }

        $homeSliders = HomeSlider::all();

        return view('front.pages.home',compact('latestBlog','blogs','homeSliders'));
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
        $team = null;
        $teamPlayer = null;
        $captain = null;

        $user = User::with('teamPlayer')->where('id','=',getLogInUserId())
            ->first();

        if (!empty($user->teamPlayer)) {
            $team = Team::where('id', '=', $user->teamPlayer->team_id)->first();
            $teamPlayer = TeamPlayer::with('user')->where('team_id', '=', $user->teamPlayer->team_id)->get();
            $captain = RegisteredPlayer::with('user')->where('user_id',$teamPlayer[0]->add_by_user_id)->first();
        }

        return view('player.profile',compact('user','team','teamPlayer','captain'));
    }

    public function blogs()
    {
        $blogs = Blog::orderByDesc('id')->paginate(8);

        return view('front.pages.blog',compact('blogs'));
    }

    public function blogDetail($slug,Blog $blog)
    {
        return view('front.pages.blog_detail',compact('blog'));
    }

    public function contactUs()
    {
        return view('front.pages.contact');
    }

    public function contactUsStore(Request $request)
    {
        Contact::create($request->all());
        Flash::success('Contact/Queries send successfully.');

        return redirect(route('front.contact'));
    }
}
