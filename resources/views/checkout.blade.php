@extends('layouts.app', [
    'class' => 'lock-page',
    'elementActive' => 'checkout-page',
    'backgroundImagePath' => ''
])

@section('content')
    <div class="container">
        <div class="px-2 py-4">
            <div class="row mt-4 flex-column-reverse flex-sm-row">
                <div class="col-md-8">
                    <form action="{{ route('checkout.confirm') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- <input type="hidden" name="seller" value=""> --}}
                        <h5 class="text-lg">Checkout</h5>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Juan Dela Cruz" value="{{ Auth::user()->name }}" required readonly disabled>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-7">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="you@example.com" value="{{ Auth::user()->email }}" required readonly disabled>
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
                                    <input type="radio" id="payment_method_1" name="payment_method" class="custom-control-input" value="BANK" required>
                                    <label class="custom-control-label" for="payment_method_1">Bank</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="payment_method_2" name="payment_method" class="custom-control-input" value="PAYMAYA">
                                    <label class="custom-control-label" for="payment_method_2">Paymaya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="payment_method_3" name="payment_method" class="custom-control-input" value="GCASH">
                                    <label class="custom-control-label" for="payment_method_3">GCash</label>
                                </div>
                                @if ($errors->has('payment_method'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('payment_method') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col">
                                <label class="text-muted mb-3">Kindly send to the following payment information:</label>
                                <table class="table table-bordered mb-0">
                                    <tbody>
                                        <tr id="payment-method-bank" style="display: none;">
                                            <td class="py-1">Bank</td>
                                            <td class="py-1">006380431410</td>
                                            <td class="py-1">ARVELYN FERMANO</td>
                                        </tr>
                                        <tr id="payment-method-paymaya" style="display: none;">
                                            <td class="py-1">PayMaya</td>
                                            <td class="py-1">09762384404</td>
                                            <td class="py-1">PEEJAY SERRANO</td>
                                        </tr>
                                        <tr id="payment-method-gcash" style="display: none;">
                                            <td class="py-1">GCash</td>
                                            <td class="py-1">09120157345</td>
                                            <td class="py-1">ARVELYN FERMANO</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="form-row mt-3">
                            <div class="form-group col-md-6">
                                <label>Proof of Payment</label>
                                <div class="d-flex align-items-center mb-3 bg-white">
                                    <div class="input-file">
                                        <div class="pl-2" style="padding-top: 0.13rem !important; padding-bottom: 0.13rem !important;">
                                            <input id="upload-btn" type="file" name="payment_file" required>
                                            <label for="upload-btn" class="btn btn-sm btn-outline-default my-1 py-1">Select</label>
                                        </div>
                                        <div class="px-2">
                                            <span id="file-chosen" class="m-0">No file uploaded</span>
                                        </div>
                                    </div>
                                </div>
                                @if ($errors->has('payment_file'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('payment_file') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="reservation_date">Reservation Date</label>
                                <input type="date" class="form-control" name="reservation_date" required>
                                @if ($errors->has('reservation_date'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('reservation_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="note">Note</label>
                            <textarea name="note" class="form-control" cols="30" rows="10"></textarea>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center my-3">
                            @foreach (Cart::content() as $row)
                                @if($row->id == 'package')
                                    <a class="btn btn-outline-default" href="{{ route('shop.show', ['shop' => $row->options->id]) }}" role="button">Back</a>
                                @endif
                            @endforeach
                            <button type="submit" class="btn btn-success">Place Order</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-4 mb-3">
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
                                                    <tr>
                                                        <td class="pb-3">{{ __('Grand Total') }}</td>
                                                        <td class="pb-3">₱ {{ Cart::total() }}</td>
                                                    </tr>
                                                    <tr class="grand-total border-top">
                                                        <td class="pb-0 pt-3">{{ __('Amount Due') }}</td>
                                                        <td class="pb-0 pt-3">₱ {{ number_format((Cart::total(null,null,'') * 0.7), 2, ".", ",") }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <small class="text-muted">(30% Down Payment)</small>
                                                        </td>
                                                        <td></td>
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
        $('[name="payment_method"]').change(function(){
            const bank = $('#payment-method-bank')
            const gcash = $('#payment-method-gcash')
            const paymaya = $('#payment-method-paymaya')
            const check = $('input[name="payment_method"]:checked').val();

            if(check == 'GCASH'){
                gcash.show()
                bank.hide()
                paymaya.hide()
            }

            if(check == 'PAYMAYA'){
                paymaya.show()
                gcash.hide()
                bank.hide()
            }

            if(check == 'BANK'){
                bank.show()
                paymaya.hide()
                gcash.hide()
            }
        })  
    </script>
    <script>
        $(document).ready(() => {

            const uploadBtn = document.getElementById('upload-btn');

            const fileChosen = document.getElementById('file-chosen');

            uploadBtn.addEventListener('change', function(){
                fileChosen.textContent = this.files[0].name
            })   
            
            function setMinDate(){
                var today = new Date();
                
                var month = today.getMonth() + 1
                var day = today.getDate()
                var year = today.getFullYear()
                
                if(month < 10)
                    month = '0' + month.toString()
                if(day < 10)
                    day = '0' + day.toString()
                
                var maxDate = year + '-' + month + '-' + day;

                $('[name="reservation_date"]').attr('min', maxDate)
            }

            setMinDate()
        })
    </script>
@endpush