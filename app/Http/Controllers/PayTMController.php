<?php

namespace App\Http\Controllers;

//use App\Http\Requests\CreatePaytmDetailRequest;
//use App\Models\Appointment;
//use App\Models\Doctor;
//use App\Models\Notification;
//use App\Models\Patient;
//use App\Models\Transaction;
use App\Http\Requests\CreatePaytmDetailRequest;
use App\Models\DepositTransaction;
use App\Models\PaymentGateway;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Log;
use JetBrains\PhpStorm\NoReturn;
use Laracasts\Flash\Flash;

//use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Anand\LaravelPaytmWallet\Facades\PaytmWallet;

/**
 * Class PayTMController
 */
class PayTMController extends AppBaseController
{

    
    
    // display a form for payment
    public function initiate(Request $request)
    {
        $amount = $request['payloadData'];
  
        return view('payments.paytm.index',compact('amount'));
    }

    /**
     * @param  CreatePaytmDetailRequest  $request
     *
     * @return mixed
     */
    public function payment(CreatePaytmDetailRequest $request)
    {
        $input = $request->all();
        
        $payment = PaytmWallet::with('receive');
        $loginUserId = getLogInUser() ? getLogInUserId() : '';

        $payment->prepare([
            'order'         => $input['amount'].'|'.$loginUserId.'|'.time(), // 1 should be your any data id
            'user'          => getLogInUserId(), // any user id
            'mobile_number' => $input['mobile'],
            'email'         => $input['email'], // your user email address
            'amount'        => $input['amount'], // amount will be paid in INR.
            'callback_url'  => route('paytm.callback') // callback URL
        ]);
        Log::info('payment getaway sending');
        return $payment->receive();  // initiate a new payment
    }

    /**
     * Obtain the payment information.
     *
     * @return Object
     */
      public function paymentCallback()
    {
        Log::info('payment getaway started');
        $transaction = PaytmWallet::with('receive');
        $response = $transaction->response();
        $order_id = $transaction->getOrderId(); // return a order id
        $transaction->getTransactionId(); // return a transaction id
        list($amount,$loginUserId) = explode('|', $order_id);

        Log::info('payment getaway');
        // update the db data as per result from api call
        if ($transaction->isSuccessful()) {
            Log::info('payment getaway Success');


            DepositTransaction::create([
                'user_id'        => $loginUserId,
                'transaction_id' => $response['TXNID'],
                'amount'         => $amount,
                'currency_id'    => getCurrencyId(),
                'type'           => PaymentGateway::PAYTM,
                'status'         => DepositTransaction::SUCCESS,
                'meta'           => json_encode($response),
            ]);

            
            Flash::success(__('messages.flash.app_payment_successful'));
            
            Auth::loginUsingId($loginUserId);
            
            return redirect(route('user.deposit-transaction.index'));

        } else if ($transaction->isFailed()) {

            Flash::error(__('messages.flash.unable_to_process_payment'));

            return redirect(route('user.deposit-transaction.index'));

        } else {
            if ($transaction->isOpen()) {
                Log::info('Open');
            }
        }
//        $transaction->getResponseMessage(); //Get Response Message If Available
    }

    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function failed()
    {
        Flash::error(__('messages.flash.unable_to_process_payment'));

        return redirect(route('user.deposit-transaction.index'));
    }
}
