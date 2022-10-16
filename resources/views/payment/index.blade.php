@extends('layouts.app')

@section('content')

<div class="container g_pay_button">
    <h1>Pay with Google Pay</h1>
    <div id="payment-request-button">
        
    </div>
</div>

@endsection
<style>
    .g_pay_button {
        margin:10rem;
        padding:10rem;
    }
</style>
{{-- @push('scripts') --}}
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://js.stripe.com/v3/"></script>
    <script>
        $(document).ready(function() {

        window.publishkey = '{{config('services.stripe.publish')}}';
            
        const stripe = Stripe(window.publishkey, {
            apiVersion: '2020-08-27',
        });

        // 2. Create a payment request object
        var paymentRequest = stripe.paymentRequest({
            country: 'US',
            currency: 'usd',
            requestPayerName: true,
            requestPayerEmail: true,
            total: {
                label: 'Demo total',
                amount: 1999,
            },
        
        });

        // 3. Create a PaymentRequestButton element
        const elements = stripe.elements();
        const prButton = elements.create('paymentRequestButton', {
            paymentRequest: paymentRequest,
        });

        // Check the availability of the Payment Request API,
        // then mount the PaymentRequestButton
        paymentRequest.canMakePayment().then(function (result) {
            console.log(result);
            if (result) {
            prButton.mount('#payment-request-button');
            } else {
            document.getElementById('payment-request-button').style.display = 'none';
            console.log('Google Pay support not found. Check the pre-requisites above and ensure you are testing in a supported browser.');
            }
        });

        paymentRequest.on('paymentmethod', async (e) => {
            console.log("paymentMethod=>", e);
            const {error: backendError, clientSecret} = await fetch(
                '/create-payment-intent',
            {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    currency: 'usd',
                    paymentMethodType: 'card',
                }),
            }).then((r) => r.json());

            if (backendError) {
                console.log(backendError.message);
                e.complete('fail');
                return;
            }

            console.log(`Client secret returned.`);

            // Confirm the PaymentIntent without handling potential next actions (yet).
            let {error, paymentIntent} = await stripe.confirmCardPayment(
                    clientSecret,
                {
                    payment_method: e.paymentMethod.id,
                },
                {
                    handleActions: false,
                }
                );
                
                if (error) {
                    console.log(error.message);
                    e.complete('fail');
                    return;
                }
                
                e.complete('success');
                
                if (paymentIntent.status === 'requires_action') {
                    // Let Stripe.js handle the rest of the payment flow.
                    let {error, paymentIntent} = await stripe.confirmCardPayment(
                        clientSecret
                        );
                        if (error) {
                            // The payment failed -- ask your customer for a new payment method.
                            console.log(error.message);
                            return;
                        }
                    console.log(`Payment ${paymentIntent.status}: ${paymentIntent.id}`);
                }
                    
                console.log(`Payment ${paymentIntent.status}: ${paymentIntent.id}`);
            });
        });
    </script>
{{-- @endpush --}}