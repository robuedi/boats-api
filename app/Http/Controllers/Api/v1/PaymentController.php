<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentCompleteRequest;
use App\Http\Requests\PaymentFailRequest;
use App\Http\Requests\PaymentInitiateRequest;
use App\Services\Payment\IPayment;
use App\Services\Payment\IPaymentProduct;

class PaymentController extends Controller
{
    public function __construct(private IPayment $payment_service){}

    public function initiatePayment(PaymentInitiateRequest $request, IPaymentProduct $payment_product)
    {
        //return the intent details
        $intent =  $this->payment_service->makeIntent($payment_product);

        //add the product payment to the DB
        $payment_product->addPayment($intent['intent_id'], $request->email);

        return response()->json($intent);
    }

    public function completePayment(PaymentCompleteRequest $request)
    {
        //complete payment
        $this->payment_service->complete($request->intent_id);
        return response()->json([]);
    }

    public function failPayment(PaymentFailRequest $request)
    {
        //fail payment
        $this->payment_service->fail($request->intent_id);
        return response()->json([]);
    }

}
