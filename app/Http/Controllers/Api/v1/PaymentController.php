<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentInitiateRequest;
use App\Services\Payment\IPayment;
use App\Services\Payment\IPaymentProduct;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct(private IPayment $payment_service){}

    public function initiatePayment(PaymentInitiateRequest $request, IPaymentProduct $payment_product)
    {
        //return the intent details
        return $this->payment_service->makeIntent($payment_product);
    }

    public function completePayment(Request $request)
    {
        $this->payment_service->complete($request->intent_id);
    }

    public function failPayment(Request $request)
    {
        $this->payment_service->fail($request->intent_id);
    }

}
