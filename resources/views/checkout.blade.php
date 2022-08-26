@extends('layouts.app', [
    'class' => 'lock-page',
    'elementActive' => 'checkout-page',
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
                    <a href="{{ route('shop.index') }}" class="text-muted">Store</a>
                </li>
                <li class="breadcrumb-item">
                    <a class="text-muted">Checkout</a>
                </li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-12">
                <h2 class="mt-5">Checkout</h2>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <h5>Billing Address</h5>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Juan Dela Cruz" value="{{ Auth::user()->name }}" required>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-7">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="you@example.com" value="{{ Auth::user()->email }}" required>
                        <div class="invalid-feedback">
                            Please enter a valid email address
                        </div>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" class="form-control" name="phone_number" placeholder="0999 000 8888" value="+63{{ Auth::user()->phone_number }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="address_1">Address Line 1</label>
                    <input type="text" class="form-control" name="address_1" placeholder="1234 Main St" value="{{ Auth::user()->address_1 }}" required>
                </div>
                <div class="form-group">
                    <label for="address_2">Address Line 2 (Optional)</label>
                    <input type="text" class="form-control" name="address_2" placeholder="Apartment, studio, or floor" value="{{ Auth::user()->address_2 }}">
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="city">City</label>
                        <input type="text" class="form-control" name="city" value="{{ Auth::user()->city }}" required>
                        @if ($errors->has('city'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('city') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="state">Province</label>
                        <input type="text" class="form-control" name="state" value="{{ Auth::user()->state }}" required>
                        @if ($errors->has('state'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('state') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="zipcode">Zipcode</label>
                        <input type="text" class="form-control" name="zipcode" value="{{ Auth::user()->zipcode }}" required>
                        @if ($errors->has('zipcode'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('zipcode') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center my-5">
                    <a class="btn btn-outline-default" href="{{ route('cart') }}" role="button">
                        Back
                    </a>
                    <a id="place-order-btn" class="btn btn-success" href="#" role="button">
                        Place Order
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <h5>Your Order</h5>
                <div class="card border rounded">
                    <div class="card-body">
                        <div class="container text-center">
                            <h4 class="card-title text-warning">Package Name</h4>
                            <p>Catering Service Name</p>
                            <small class="mb-1">Menu</small>
                            <p class="font-italic font-weight-light">
                                Brownies, Nachos, Cheese Dips, Garlic Rice, Plain Rice, Mushroom Soup, Crab and Corn Soup, Chicken Soup, Celery Salad, Broccoli Salad, Sweet Potato Salad, Beef Mushroom, Beef Teriyaki, Pork Spareribs, Iced Tea, Blue Lemonade, House Blend Iced Tea
                            </p> 
                            <small class="mb-1">Inclusions</small>
                            <p class="font-italic font-weight-light">Sound System, Decorations, Crew</p>
                            <p>Good for 50 pax</p>
                            <h4>PHP 5000.00</h4>
                        </div>
                        <hr class="bg-warning">
                        <div class="row">
                            <div class="col-2 text-right">
                                <span class="nc-icon nc-pin-3"/>
                            </div>
                            <small class="col-10 text-left">2/F Zambrano Building Quezon Avenue, San Fernando, La Union</small>
                        </div>
                        <div class="row my-2">
                            <div class="col-2 text-right">
                                <span class="nc-icon nc-send"/>
                            </div>
                            <small class="col-10 text-left">0999 888 0000</small>
                        </div>
                    </div>
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