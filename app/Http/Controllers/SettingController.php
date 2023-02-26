<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\PaymentGateway;
use App\Models\Setting;
use App\Repositories\SettingRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class SettingController extends AppBaseController
{

    /**
     * @var SettingRepository
     */
    private SettingRepository $settingRepository;

    /**
     * @param SettingRepository $settingRepository
     */
    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }


    public function index(): Application|Factory|View
    {
        $setting = Setting::all()->pluck('value', 'key');
        $paymentGateways = PaymentGateway::PAYMENT_METHOD;
        $selectedPaymentGateways = PaymentGateway::pluck('payment_gateway')->toArray();
        return view('settings.index', compact('setting','paymentGateways','selectedPaymentGateways'));
    }

    public function update(Request $request): Application|RedirectResponse|Redirector
    {
        $paymentGateways = $request->payment_gateway;
        if(!empty($paymentGateways))
        {
            PaymentGateway::query()->delete();
        }
        if (isset($paymentGateways)){
            foreach ($paymentGateways as $paymentGateway){
                PaymentGateway::updateOrCreate(['payment_gateway_id' => $paymentGateway],
                    [
                        'payment_gateway' => PaymentGateway::PAYMENT_METHOD[$paymentGateway],
                    ]);
            }
        }
        $input = $request->all();
        if ($request->show_captcha == Null) {
            $input['show_captcha'] = '0';
        } else {
            $this->validate($request, [
                'site_key' => 'required',
                'secret_key' => 'required',
            ]);
        }
        $id = Auth::id();
        $this->settingRepository->update($input, $id);
        Flash::success('Setting updated successfully.');

        return redirect(route('settings.index'));
    }

    public function clearCache(): RedirectResponse
    {
        Artisan::call('cache:clear');
        Flash::success('Application Cache Cleared !');

        return redirect()->back();
    }
}
