<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\DepositTransaction;
use App\Models\Notification;
use App\Models\Patient;
use App\Models\PaymentGateway;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Unicodeveloper\Paystack\Facades\Paystack;
use Flash;

class PaystackController extends Controller
{
    /**
     * @param  Request  $request
     *
     *
     * @return mixed
     */
    public function redirectToGateway(Request $request)
    {
        
        $user = getLogInUser();
        $amount = $request['payloadData'];
        $order = $request['payloadData'].'|'.$user->id.'|'.time();

        
            $request->request->add([
                "email"     => $user->email, // email of recipients
                "orderID"   => $order, // anything 
                "amount"    => 10000,
                "quantity"  => 3, // always 1   
                "currency"  => "ZAR",
                "reference" => Paystack::genTranxRef(),
                "metadata"  => json_encode(['order' => $order]), // this should be related data
            ]);

            return Paystack::getAuthorizationUrl()->redirectNow();
       
    }

    /**
     * @param  Request  $request
     *
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function handleGatewayCallback(Request $request)
    {
        $paymentDetails = Paystack::getPaymentData();
        $oderId = $paymentDetails['data']['metadata']['order'];

        list($amount,$loginUserId) = explode('|', $oderId);


        $transaction = DepositTransaction::create([
            'transaction_id' => $paymentDetails['data']['reference'],
            'type'           => PaymentGateway::PAYSTACK,
            'amount'         => $amount,
            'user_id'        => $loginUserId,
            'currency_id'    => getCurrencyId(),
            'status'         => DepositTransaction::SUCCESS,
            'meta'           => json_encode($paymentDetails['data']),
        ]);

        DB::commit();

        \Laracasts\Flash\Flash::success(__('messages.flash.app_payment_successful'));

        return redirect(route('user.deposit-transaction.index'));
        
    }
}
