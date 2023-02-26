<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\PaymentGateway;
use App\Models\Specialization;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultPaymentGatewaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paymentGateways = [
            
            [
                'payment_gateway_id' => PaymentGateway::STRIPE,
                'payment_gateway'    => PaymentGateway::PAYMENT_METHOD[1],
            ],
            [
                'payment_gateway_id' => PaymentGateway::PAYPAL,
                'payment_gateway'    => PaymentGateway::PAYMENT_METHOD[2],
            ],
           
        ];

        foreach ($paymentGateways as $paymentGateway) {
            PaymentGateway::create($paymentGateway);
        }

    }
}
