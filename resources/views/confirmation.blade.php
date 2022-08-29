@extends('layouts.app', [
    'class' => 'lock-page',
    'elementActive' => '',
    'backgroundImagePath' => ''
])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 mt-5 mx-auto">
                <div class="card rounded-0">
                    <div class="card-body">
                        <div class="d-flex flex-column justify-content-center align-items-center text-center py-5">
                            <img src="{{ asset('assets') }}/img/svg/order_confirmed.svg" alt="Order Confirmed" style="height: 17rem;">
                            <h1 class="mt-5">Thank you!</h1>
                            <h5 class="mt-0">Your order has been placed.<br>Please check the order details in your email<br>({{ Auth::user()->email }}).</h5>
                            <a href="{{ route('welcome') }}" class="btn btn-large btn-success mt-5">Go to Homepage</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection