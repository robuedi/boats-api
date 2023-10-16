<?php


namespace App\Services\Payment;

use App\Models\Boat;
use App\Models\Payment;

class PaymentProduct implements IPaymentProduct
{
    private Boat $boat;

    public function __construct(int $product_id)
    {
        $this->boat = Boat::findOrFail($product_id);
    }

    public function getAmount(): float
    {
        return $this->boat->price;
    }

    public function getCurrency(): string
    {
        return 'GBP';
    }

    public function addPayment(string $intent_id): void
    {
        Payment::create([
            'email' => 'test',
            'status' => 'pending',
            'boat_id' => $this->boat->id,
            'intent_id' => $intent_id,
            'price' => $this->boat->price,
            'currency' => $this->getCurrency()
        ]);
    }

    static function updatePaymentStatus(string $intent_id, string $status): void
    {
        //update the status of the payment
        $payment = Payment::where('intent_id', $intent_id)->first();
        if($payment)
        {
            $payment->status = $status;
            $payment->update();
        }

        //check if trully success
        if(!in_array($status, ['requires_payment_method', 'success']))
        {
            return;
        }

        $sold_boat = Boat::find($payment->boat_id);
        if($sold_boat)
        {
            $sold_boat->sold = 1;
            $sold_boat->update();
        }
    }
}

