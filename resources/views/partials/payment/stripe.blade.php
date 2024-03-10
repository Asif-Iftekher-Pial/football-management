<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Bootstrap CSS-->
    <link href="{{ asset('admin_essentials/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

</head>
<body>
    <div class="container">
        <h1 class="text-center"> Payment Confirmation</h1>
        @if (Session::has('message'))
        <div class="alert alert-success">
            {{ Session::get('message') }}
            @php
                Session::forget('message')
            @endphp
        </div>
           
        @endif
        <div class="row">
            <h5></h5>
            <br>
            
            <div class="col-md-8">
                <div class="card text-start">
                    {{-- <img class="card-img-top" src="holder.js/100px180/" alt="Title" /> --}}
                    <div class="card-body">
                        <h4 class="card-title">Thank you for you payment.Enjoy our services</h4>
                        {{-- <h5>Price 10$</h5> --}}
                         {{-- <a class="btn btn-sm btn-success" href="{{ route('stripe.checkout',['price' => 10,'product' => 'Silver']) }}">Make Payment</a> --}}
                         <a href="{{ route('dashboard') }}" class="btn btn-sm btn-success">Home page</a>
                    </div>
                </div>
            </div>
           
            
        </div>
    </div>
    
</body>
</html>