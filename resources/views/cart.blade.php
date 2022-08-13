@extends('layouts.app', [
    'class' => 'lock-page',
    'elementActive' => 'cart-page',
    'backgroundImagePath' => ''
])

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb" class="mt-5 ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('welcome') }}" class="text-muted">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('cart') }}" class="text-muted">Cart</a>
                </li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-12">
                <h2 class="mt-5">Shopping Cart</h2>
                <hr>
                <div class="p-5 d-flex justify-content-center align-items-center">
                    <div>
                        <p class="text-muted">No items in the Cart :(</p>
                        <a href="{{ route('store') }}" class="btn btn-outline-default">Go to Store</a>
                    </div>
                </div>
                <div class="p-3 rounded d-flex justify-content-end" style="background-color:#e9ecef;">
                    <div class="text-right text-muted mr-5">
                        Subtotal
                        <br>
                        Discount
                        <br>
                        <span class="h5 font-weight-bold text-dark">Grand Total</span>
                    </div>
                    <div class="text-right text-muted">
                        <span id="cart-subtotal">$100.00</span>
                        <br>
                        <span id="cart-discount">0</span>
                        <br>
                        <span id="cart-total" class="h5 font-weight-bold text-dark">$100.00</span>
                    </div>
                </div>
                <div class="d-flex justify-content-between pt-5">
                    <a href="{{ route('store') }}" class="btn btn-outline-default">Back</a>
                    <a href="{{ route('checkout.index') }}" class="btn btn-primary">Proceed to Checkout</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(() => {
            
        })
    </script>
@endpush