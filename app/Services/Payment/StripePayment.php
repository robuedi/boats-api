<?php

namespace App\Services\Payment;

use Exception;
use Illuminate\Support\Str;
use Stripe\Stripe as StripeGateway;
use Stripe\PaymentIntent;
use Stripe\StripeClient;
use Log;

class StripePayment implements IPayment
{
    public function __construct(protected string $secret_key){}

    public function makeIntent(IPaymentProduct $payment_product) : array
    {
        //set the private key
        StripeGateway::setApiKey($this->secret_key);

        //make intent
        try {
            $payment_intent = PaymentIntent::create([
                'amount' => $payment_product->getAmount(), // Multiply as & when required
                'currency' => $payment_product->getCurrency(),
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);

            // Save the $paymentIntent->id to identify this payment later
        } catch (Exception $e) {
             throw $e;
        }

        return [
            'token' => (string) Str::uuid(),
            'intent_id' =>  $payment_intent->id,
            'client_secret' =>  $payment_intent->client_secret
        ];
    }

    public function complete(string $intent_id) : void
    {
        $stripe = new StripeClient($this->secret_key);

        //update the DB payment
        $payment_detail = $stripe->paymentIntents->retrieve($intent_id);
        if(!$payment_detail){
            return;
        }

        PaymentProduct::updatePaymentStatus($intent_id, $payment_detail->status);
    }

    public function fail(string $intent_id) : void
    {
        PaymentProduct::updatePaymentStatus($intent_id, 'failed');
    }
}
