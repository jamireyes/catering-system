@extends('layouts.app', [
    'class' => 'lock-page',
    'elementActive' => 'checkout-page',
    'backgroundImagePath' => ''
])

@section('content')
    <div class="container">
        <div class="px-2 py-4">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('welcome') }}" class="text-muted">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('shop.index') }}" class="text-muted">Store</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-dark">Checkout</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-8">
                    <h5>Checkout</h5>
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
                            <input type="text" class="form-control" name="phone_number" placeholder="0999 000 8888" value="0{{ Auth::user()->phone_number }}" required>
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
                        <a class="btn btn-outline-default" href="{{ route('shop.index') }}" role="button">Back</a>
                        <a class="btn btn-success" href="{{ route('checkout.confirm') }}" role="button">Place Order</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5>Package Information</h5>
                    <div class="card border rounded">
                        <div class="card-body">                         
                            <div class="m-2">
                                <div class="text-center">
                                    @foreach (Cart::content() as $row)
                                        @if($row->id == 'package')
                                            <h5 class="card-title">{{ $row->name }}</h5>
                                            <p class="mb-1">{{ $row->options->user }}</p>
                                            <small class="mb-0 text-muted">({{ $row->options->pax }} PAX)</small>
                                        @endif
                                    @endforeach
                                </div>
                                <hr>
                                <div>
                                    @foreach ($categories as $c)
                                        <p class="text-xs">{{ $c->name }}</p>
                                        @foreach (Cart::content() as $row)
                                            @if ($row->id != 'package' && $row->options->category == $c->name)
                                                <p class="ml-3 text-xs font-italic font-weight-light">{{ $row->name }}<small class="mb-1 text-muted"> x {{ $row->qty }}</small></p>                                                         
                                            @endif
                                        @endforeach
                                    @endforeach
    
                                    @foreach (Cart::content() as $row)
                                        @if($row->id == 'package' && $row->options->inclusion != NULL)
                                            <p class="text-xs">{{ __('Inclusions') }}</p>
                                            <p class="ml-3 text-xs font-italic font-weight-light">{{ $row->options->inclusion }}</p>                                     
                                        @endif
                                    @endforeach
                                </div>
                                <hr>
                                <div>
                                    @foreach (Cart::content() as $row)
                                        @if($row->id == 'package')
                                            <table class="product-summary">
                                                <tbody>
                                                    <tr>
                                                        <td>{{ __('Subtotal') }}</td>
                                                        <td>₱ {{ number_format($row->subtotal, 2, '.', ',') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ __('Discount') }}</td>
                                                        <td>
                                                            @if ($row->discount)
                                                                ₱ {{ number_format($row->discount, 2, '.', ',') }}
                                                            @else
                                                                --
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr class="grand-total">
                                                        <td>{{ __('Grand Total') }}</td>
                                                        <td>₱ {{ number_format($row->price, 2, '.', ',') }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection