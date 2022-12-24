<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('paper') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('paper') }}/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>{{ config('app.name') }}</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'name='viewport' />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            padding: 1rem;
            background-color: #f4f3ef;
        }

        .card {
            background-color: white;
            border-radius: 0.6rem;
            padding: 2rem;
        }

        h5 {
            margin-top: 0;
        }
    </style>
</head>
<body>

    @isset($orders)
        @foreach ($orders as $order)
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <div class="order-header">
                        <div class="d-flex justify-content-between">
                            <h5>{{ $order->package_name }} ({{ $order->pax }} pax)</h5>
                            <div class="d-flex flex-column text-right">
                                <small class="text-muted"><strong>Date:</strong> {{ $order->order_date }}</small>
                                <small class="text-muted"><strong>Order No.:</strong> {{ $order->order_id }}</small>
                            </div>
                        </div>
                        <div class="order-cater-info">
                            <p class="font-weight-bold">{{ $order->c_name }}</p>
                            <table>
                                <tr>
                                    <td>Address:</td>
                                    @if($order->c_address)
                                        <td>{{ $order->c_address }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Contact:</td>
                                    @if($order->c_contact)
                                        <td>0{{ $order->c_contact }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    @if($order->c_email)
                                        <td>{{ $order->c_email }}</td>
                                    @endif
                                </tr>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="order-body">
                        <div class="order-package">
                            @foreach ($categories as $c)
                                <p class="mb-2 text-xs">{{ $c->name }}</p>
                                @foreach ($items as $item)
                                    @if ($item->category == $c->name)
                                        <p class="ml-3 mb-2 text-xs font-weight-light">{{ $item->name }}<small class="mb-1 text-muted"> x {{ $item->qty }}</small></p>
                                    @endif
                                @endforeach
                            @endforeach
                                                            
                            @if ($order->inclusion != NULL)    
                                <p class="mb-2 text-xs">{{ __('Inclusions') }}</p>
                                <p class="ml-3 mb-2 text-xs font-weight-light">{{ $order->inclusion }}</p> 
                            @endif
                            <hr>
                            <div class="order-summary">
                                <table>
                                    <tr>
                                        <td>Subtotal</td>
                                        <td>₱ {{ number_format($order->subtotal, 2, '.', ',') }}</td>
                                    </tr>
                                    <tr>
                                        @if ($order->discount)
                                            <td>Discount ({{ $order->discount }}% OFF)</td>
                                            <td>- {{ number_format($order->discount, 2, '.', ',') }}</td>
                                        @else
                                            <td>Discount</td>
                                            <td>--</td>
                                        @endif
                                    </tr>
                                    <tr class="grand-total">
                                        <td>Grand Total</td>
                                        <td>₱ {{ number_format(($order->subtotal - $order->discount), 2, '.', ',') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="order-details">
                            <h6>Customer Information</h6>
                            <small>Customer</small>
                            <p>{{ $order->u_name }}</p>

                            <small>Address</small>
                            <p>{{ $order->u_address }}</p>

                            <small>Phone Number</small>
                            <p>{{ $order->u_contact }}</p>

                            <small>Email Address</small>
                            <p>{{ $order->u_email }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endisset
</body>
</html>