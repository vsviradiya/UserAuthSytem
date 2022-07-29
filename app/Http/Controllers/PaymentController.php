<?php

namespace App\Http\Controllers;
use Stripe;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index() {
        return view('payment.index');
    }

    public function createPaymentIntent(Request $request) {
        dd($request->all());
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

        $paymentIntent = $stripe->paymentIntents->create([
            'amount' => 1999,
            'currency' => $request->currency,
            'payment_method_types' => [$request->paymentMethodType],
        ]);

        dd($paymentIntent);
        
    }
}
