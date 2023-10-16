<?php


namespace App\Services\Payment;


interface IPaymentProduct
{
    public function getAmount() : float;
    public function getCurrency() : string;

}
