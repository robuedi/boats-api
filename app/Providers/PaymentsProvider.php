<?php


namespace App\Providers;

use App\Services\Payment\IPayment;
use App\Services\Payment\IPaymentProduct;
use App\Services\Payment\PaymentProduct;
use App\Services\Payment\StripePayment;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class PaymentsProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(IPayment::class, StripePayment::class);
        $this->app->bind(IPaymentProduct::class, PaymentProduct::class);

        $this->app->when(StripePayment::class)
            ->needs('$secret_key')
            ->give(function () {
                return env('STRIPE_SECRET_KEY');
            });


        $this->app->when(PaymentProduct::class)
            ->needs('$product_id')
            ->give(function () {
                return request()->product_id;
            });
    }

}
