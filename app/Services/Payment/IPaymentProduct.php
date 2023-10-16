<?php


namespace App\Services\Payment;


interface IPaymentProduct
{
    public function getAmount() : float;
    public function getCurrency() : string;
    public function addPayment(string $intent_id, string $email): void;
}
