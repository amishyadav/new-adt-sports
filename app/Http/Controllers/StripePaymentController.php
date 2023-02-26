<?php

namespace App\Http\Controllers;

use App\Models\DepositTransaction;
use App\Models\PaymentGateway;
use App\Repositories\AddPaymentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;
use Stripe\Checkout\Session;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class StripePaymentController extends AppBaseController
{

    /**
     * @var AddPaymentRepository
     */
    private AddPaymentRepository $addPaymentRepository;

    /**
     * @param AddPaymentRepository $addPaymentRepository
     */
    public function __construct(AddPaymentRepository $addPaymentRepository)
    {
        $this->addPaymentRepository = $addPaymentRepository;
    }


    public function addPayment(Request $request)
    {
        
        $result =    $this->addPaymentRepository->manageStripeData(
            getLogInUserId(),
            [
                'amountToPay'  => $request['amount'],
            ]
        );

        return $this->sendResponse($result, 'Session created successfully.');
        
    }

    /**
     * @param Request $request
     *
     * @throws ApiErrorException
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function paymentSuccess(Request $request)
    {
     
        $sessionId = $request->get('session_id');
        if (empty($sessionId)) {
            throw new UnprocessableEntityHttpException('session_id required');
        }
        try {
            setStripeApiKey();
            $sessionData = Session::retrieve($request->session_id);
            if ($sessionData->currency != null && in_array($sessionData->currency,
                    zeroDecimalCurrencies())) {
                $paymentAmount = $sessionData->amount_total;
            } else {
                $paymentAmount = $sessionData->amount_total / 100;
            }

            $transaction = DepositTransaction::create([
                'transaction_id' => $sessionData->payment_intent,
                'type'           => PaymentGateway::STRIPE,
                'amount'         => $paymentAmount,
                'user_id'        => getLogInUserId(),
                'currency_id'    => getCurrencyId(),
                'status'         => DepositTransaction::SUCCESS,
                'meta'           => json_encode($sessionData),
            ]);
            
            DB::commit();
            
            Flash::success(__('messages.flash.app_payment_successful'));

            return redirect(route('user.deposit-transaction.index'));
            
        } catch (\Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function handleFailedPayment()
    {

        Flash::error(__('messages.flash.unable_to_process_payment'));

        return redirect(route('user.deposit-transaction.index'));
    }
    
}
