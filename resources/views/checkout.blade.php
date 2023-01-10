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
                    <form action="{{ route('checkout.confirm') }}" method="POST">
                        @csrf
                        <h5 class="text-lg">Checkout</h5>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Juan Dela Cruz" value="{{ Auth::user()->name }}" required readonly>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-7">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="you@example.com" value="{{ Auth::user()->email }}" required readonly>
                                <div class="invalid-feedback">
                                    Please enter a valid email address
                                </div>
                            </div>
                            <div class="form-group col-md-5">
                                <label>{{ __('Phone Number') }}</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white">+63</span>
                                    </div>
                                    <input type="text" class="form-control" name="phone_number" placeholder="9990008888" value="{{ Auth::user()->phone_number }}" required>
                                    @if ($errors->has('phone_number'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('phone_number') }}</strong>
                                        </span>
                                    @endif
                                </div>
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
                        
                        <div class="form-row mt-3">
                            <div class="form-group col-md-4">
                                <label>Payment Method</label>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="payment_method_1" name="payment_method" class="custom-control-input" value="bank">
                                    <label class="custom-control-label" for="payment_method_1">Bank</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="payment_method_2" name="payment_method" class="custom-control-input" value="paymaya">
                                    <label class="custom-control-label" for="payment_method_2">Paymaya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="payment_method_3" name="payment_method" class="custom-control-input" value="gcash">
                                    <label class="custom-control-label" for="payment_method_3">GCash</label>
                                </div>
                            </div>
                            <div class="form-group col">
                                <label>Proof of Payment</label>
                                <div class="d-flex align-items-center mb-3 bg-white">
                                    <div class="input-file">
                                        <div class="py-1 pl-2">
                                            <input id="upload-btn" type="file" name="payment_file" hidden>
                                            <label for="upload-btn" class="btn btn-sm btn-outline-default my-1">Select</label>
                                        </div>
                                        <div class="px-2">
                                            <span id="file-chosen" class="m-0">No file uploaded</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center my-5">
                            @foreach (Cart::content() as $row)
                                @if($row->id == 'package')
                                    <a class="btn btn-outline-default" href="{{ route('shop.show', ['shop' => $row->options->id]) }}" role="button">Back</a>
                                @endif
                            @endforeach
                            <button type="submit" class="btn btn-success">Place Order</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-4">
                    <h5 class="text-lg">Order Summary</h5>
                    <div class="card">
                        <div class="card-body">
                            <form class="form-group" action="{{ route('voucher.redeem') }}" method="POST">
                                @csrf
                                <label>Redeem Voucher</label>
                                <div class="d-flex">
                                    <input type="text" class="form-control" name="voucher">
                                    <button type="submit" class="btn btn-sm btn-primary ml-2 m-0">Apply</button>
                                </div>
                                @if (session('coupon_success'))  
                                    <small class="text-success">{{ session('coupon_success') }}</small>
                                @endif
                                @if(session('coupon_error'))
                                    <small class="text-danger">{{ session('coupon_error') }}</small>
                                @endif
                            </form>
                        </div>
                    </div>
                    <div class="card border rounded">
                        <div class="card-body">                         
                            <div class="m-2">
                                <div class="text-center">
                                    @foreach (Cart::content() as $row)
                                        @if($row->id == 'package')
                                            <h5 class="card-title text-lg">{{ $row->name }}</h5>
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
                                                        <td>₱ {{ Cart::initial() }}</td>
                                                    </tr>
                                                    {{-- <tr>
                                                        <td>{{ __('Tax') }}</td>
                                                        <td>₱ {{ Cart::tax() }}</td>
                                                    </tr> --}}
                                                    <tr>
                                                        <td>{{ __('Discount') }} </td>
                                                        <td>
                                                            @if ($row->discount)
                                                                - {{ Cart::discount() }}
                                                            @else
                                                                --
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr class="grand-total">
                                                        <td>{{ __('Grand Total') }}</td>
                                                        <td>₱ {{ Cart::total() }}</td>
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

@push('scripts')
    <script>
        $(document).ready(() => {

            const uploadBtn = document.getElementById('upload-btn');

            const fileChosen = document.getElementById('file-chosen');

            uploadBtn.addEventListener('change', function(){
                fileChosen.textContent = this.files[0].name
            })           
        })
    </script>
@endpush