<?php


namespace App\Services\Payment;


interface IPayment
{
    public function makeIntent(IPaymentProduct $payment_product) : array;
    public function complete(string $client_secret) : void;
    public function fail(string $intent_id) : void;

}
