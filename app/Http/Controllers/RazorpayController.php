<?php

namespace App\Http\Controllers;


use App\Models\DepositTransaction;
use App\Models\PaymentGateway;
use Auth;
use Dflydev\DotAccessData\Data;
use Doctrine\DBAL\Cache\ArrayResult;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Laracasts\Flash\Flash;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Razorpay\Api\Api;

class RazorpayController extends AppBaseController
{
    public function onBoard(Request $request): JsonResponse
    {
        
        $amount = $request['payloadData'];
     
        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
        $orderData = [
            'receipt'  => 1,
            'amount'   => $amount * 100, // 100 = 1 rupees
            'currency' => getCurrencyCode(),
            //           
        ];

        $razorpayOrder = $api->order->create($orderData);
        $data['id'] = $razorpayOrder->id;
        $data['amount'] = $amount;

        return $this->sendResponse($data, __('messages.flash.order_create'));
    }

    public function paymentSuccess(Request $request)
    {

        $input = $request->all();

        Log::info('RazorPay Payment Successfully');
        Log::info($input);
        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
        if (count($input) && !empty($input['razorpay_payment_id'])) {
            try {
                $payment = $api->payment->fetch($input['razorpay_payment_id']);
                $generatedSignature = hash_hmac('sha256', $payment['order_id']."|".$input['razorpay_payment_id'],
                    config('services.razorpay.secret'));
                if ($generatedSignature != $input['razorpay_signature']) {

                    return redirect()->back();
                }
                // Create Transaction Here


                $Transaction = DepositTransaction::create([
                    'user_id'        => getLogInUserId(),
                    'currency_id'    => getCurrencyId(),
                    'transaction_id' => $payment->id,
                    'amount'         => $payment->amount / 100,
                    'type'           => PaymentGateway::RAZORPAY,
                    'meta'           => json_encode($payment->toArray()),
                    'status'         => DepositTransaction::SUCCESS,
                ]);

                Flash::success(__('messages.flash.app_payment_successful'));

                return redirect(route('user.deposit-transaction.index'));

            } catch (Exception $e) {

                return false;
            }
        }

        return redirect()->back();
    }

    public function paymentFailed(Request $request): Application|RedirectResponse|Redirector
    {
        Flash::error(__('messages.flash.unable_to_process_payment'));
        return redirect(route('user.deposit-transaction.index'));
    }

    public function paymentSuccessWebHook(Request $request): bool
    {
        $input = $request->all();
        Log::info('webHook Razorpay');
        Log::info($input);
        if (isset($input['event']) && $input['event'] == 'payment.captured' && isset($input['payload']['payment']['entity'])) {
            $payment = $input['payload']['payment']['entity'];
            // success response
        }

        return false;
    }
}
