<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script> --}}
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> --}}
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" > --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"  />
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('gpay') }}">{{ __('GOOGLE PAY')}}</a>
                        </li>
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="https://js.stripe.com/v3/"></script>
    <script type="text/javascript">

        $(document).ready(function(){

            $(function () {
                var table = $('.user_datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('home') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'name', name: 'name'},
                        {data: 'email', name: 'email'},
                        {data: 'subscriptionday', name: 'subscriptionday'},
                        {data: 'unique_id', name: 'unique_id'},
                        {
                        "data": null,
                        "searchable": false,
                        "orderable": false,
                        "width": "2%",
                            "render": function(row) {
                                // return "<button type='button'id ='" + row.id + "' nam='" + row.name + "' mail='" + row.email + "'class='edit btn border-0 btn-light'><i class='fas fa-edit'></i></button>";
                                return "<a href='edit/" + row.id + "' id ='" + row.id + "' nam='" + row.name + "' mail='" + row.email + "'class='edit btn border-0 btn-light'><i class='fas fa-edit'></i></a>"
                            },
                        },

                        {
                        "data": null,
                        "searchable": false,
                        "orderable": false,
                        "width": "2%",
                            "render": function (row) {
                                return "<button type='button' id ='" + row.id + "' class='remove btn border-0 btn-light' style='color:red;'><i class='remove fas fa-trash'></i></button>";
                            },
                        },
                    ]
                });
            });
             
            var delid;
            $(".user_datatable tbody").on("click", ".remove", function () {
                delid = $(this).attr("id");
                if(delid !=undefined) {
                    if (confirm("Delete user?") == true) {
                        var id = delid;
                        $.ajaxSetup({
                            headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type:"POST",
                            url: "{{ url('del_user') }}",
                            data: { id: id },
                            dataType: 'json',
                            success: function(res){
                                $('.user_datatable').DataTable().ajax.reload(false);
                            }
                        });
                    }    
                }
            });

        });
        

        window.publishkey = '{{config('services.stripe.publish')}}';

        const stripe = Stripe(window.publishkey, {
            apiVersion: '2020-08-27',
        });

        // 2. Create a payment request object
        var paymentRequest = stripe.paymentRequest({
            country: 'IN',
            currency: 'inr',
            total: {
                label: 'Demo total',
                amount: 1999,
            },
            requestPayerName: true,
            requestPayerEmail: true,
        });

        // 3. Create a PaymentRequestButton element
        const elements = stripe.elements();
        const prButton = elements.create('paymentRequestButton', {
            paymentRequest: paymentRequest,
        });

        // Check the availability of the Payment Request API,
        // then mount the PaymentRequestButton
        paymentRequest.canMakePayment().then(function (result) {
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
    </script>
</body>
</html>
