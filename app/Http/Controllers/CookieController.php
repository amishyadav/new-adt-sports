<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCookieRequest;
use App\Models\Setting;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class CookieController extends Controller
{
    /**
     *
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $settingData = Setting::pluck('value', 'key')->toArray();

        return view('cookies.index', compact('settingData'));
    }

    /**
     *
     *
     * @return Application|Factory|View
     */
    public function update(Request $request)
    {
        $input = $request->all();
        $input['cookie_is'] = isset($input['cookie_is']) ? 1 : 0;
        foreach ($input as $key => $value) {
            $cookieData = Setting::where('key', $key)->first();
            if (!$cookieData) {
                continue;
            }
            $cookieData->update(['value' => $value]);
        }
        Flash::success('Cookie Updated Successfully.');
        return redirect(route('cookie-index'));
    }
}
