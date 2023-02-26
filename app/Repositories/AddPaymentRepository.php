<?php

namespace App\Repositories;

use App\Models\DepositTransaction;
use App\Models\Category;
use App\Models\PaymentGateway;
use App\Models\Subscription;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;
use Stripe\Checkout\Session;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;


/**
 * Class CategoryRepository
 */
class AddPaymentRepository extends BaseRepository
{
    public $fieldSearchable = [
        'name',
    ];

    /**
     * @inheritDoc
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * @inheritDoc
     */
    public function model()
    {
        return Category::class;
    }


    public function manageStripeData($userId, $data): array
    {

        $amountToPay = $data['amountToPay'] * 100;
        
        setStripeApiKey();
        $session = Session::create([
            'payment_method_types' => ['card'],
            'customer_email'       => Auth::user()->email,
            'line_items'           => [
                [
                    'price_data' => [
                        'product_data' => [
                            'name'        => getLogInUser()->full_name,
                        ],
                        'unit_amount'  => (int)$amountToPay,
                        'currency'     => getCurrencyCode(),
                    ],
                    'quantity'   => 1,
                ],
            ],
//            'metadata'             => [
//                'payment_type'  => PaymentGateway::STRIPE,
//                'amount'        => $amountToPay,
//                'plan_currency' => 'usd',
//            ],
            'mode'                 => 'payment',
            'success_url'          => url('user/payment-success').'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'           => url('user/failed-payment?error=payment_cancelled'),
        ]);

        $result = [
            'sessionId' => $session['id'],
        ];

        return $result;
    }

//    public function paymentUpdate($request)
//    {
//        $sessionId = $request->get('session_id');
//        if (empty($sessionId)) {
//            throw new UnprocessableEntityHttpException('session_id required');
//        }
//        try {
//
//            setStripeApiKey();
//            $stripe = new \Stripe\StripeClient(
//                config('services.stripe.secret_key')
//            );
//            $sessionData = $stripe->checkout->sessions->retrieve(
//                $request->session_id,
//                []
//            );
//            if ($sessionData->metadata->plan_currency != null && in_array($sessionData->metadata->plan_currency,
//                    zeroDecimalCurrencies())) {
//                $paymentAmount = $sessionData->amount_total;
//            } else {
//                $paymentAmount = $sessionData->amount_total / 100;
//            }
//
//            $transaction = AddPaymentTransaction::create([
//                'transaction_id' => $request->session_id,
//                'type'           => $sessionData->metadata->payment_type,
//                'amount'         => $paymentAmount,
//                'user_id'        => getLogInUserId(),
//                'currency_id' => getCurrencyId(),
//                'status'         => AddPaymentTransaction::SUCCESS,
//                'meta'           => json_encode($sessionData),
//            ]);
//
//          
//
//            DB::commit();
//
//
//            Flash::success(__('messages.placeholder.purchased_plan'));
//
//            return view('add_payment.payment.paymentSuccess');
// 
//
//            
//
//        } catch (\Exception $e) {
//            DB::rollBack();
//            throw new UnprocessableEntityHttpException($e->getMessage());
//        }
//    }

}
