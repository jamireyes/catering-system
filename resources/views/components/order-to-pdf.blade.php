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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        @page { 
            margin: 0px; 
        }

        body {
            box-sizing: border-box;
            font-size: 14px;
            text-align: left;
            font-weight: 400;
            line-height: 1.5;
            padding: 1rem;
            font-family: 'Poppins', sans-serif;
            margin: 0;
        }

        .card {
            background-color: white;
            border-radius: 0.6rem;
            padding: 2rem;
            color: #6c757d;
        }

        h3, h4, h5, h6, p {
            margin-top: 0;
        }

        .order-header h3 {
            margin: 0;
        }

        hr {
            margin-top: 1rem;
            margin-bottom: 1rem;
            border: 0;
            border-top: 1px solid rgba(0,0,0,.1);
        }

        .ml-3 {
            margin-left: 1rem!important;
        }

        .mb-2 {
            margin-bottom: 0.5rem!important;
        }

        .text-xs {
            font-size: 0.75rem;
            line-height: 1rem;
        }

        .text-muted {
            color: #6c757d!important;
        }

        .d-flex {
            display: flex;
        }

        .justify-content-between {
            justify-content: space-between;
        }

        .flex-column {
            flex-direction: column;
        }

        .text-right {
            text-align: right;
        }

        .order-cater-info p {
            margin-bottom: .3rem;
        }

        .order-header tr td {
            vertical-align: text-top;
            padding-right: 0;
            padding-top: 0;
            padding-bottom: 0;
            padding-left: 0;
        }

        .order-cater-info tr td:first-child {
            vertical-align: text-top;
            padding-right: 2.5rem;
            padding-top: 0;
            padding-bottom: 0;
            padding-left: 0;
        }   

        .order-package {
            padding: 1rem;
            border: 1px solid #e9ecef;
            border-radius: 0.6rem;
            background-color: #f7f7f9;
        }

        .order-details h6{
            text-transform: none;
        }

        .order-summary table{
            width: 100%;
        }

        .order-summary table td:last-child{
            text-align: right;
        }

        .order-summary .grand-total {
            color: #28a745;
        }   

        .curreny-symbol {
            font-family: DejaVu Sans !important;
        }
    </style>
</head>
<body>

    @isset($orders)
        @foreach ($orders as $order)
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="order-header">
                        <table style="width: 100%;">
                            <tr>
                                <td>
                                    <h3>{{ $order->package_name }} ({{ $order->pax }} pax)</h3>
                                </td>
                                <td align="right">
                                    <small class="text-muted"><strong>Date:</strong> {{ $order->order_date }}</small>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td align="right">
                                    <small class="text-muted"><strong>Order No.:</strong> {{ $order->order_id }}</small>
                                </td>
                            </tr>
                        </table>
                        <div class="order-cater-info">
                            <h4>{{ $order->c_name }}</h4>
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
                                        <td>0{{ substr($order->c_contact, 0, 3) . " " . substr($order->c_contact, 3, 3) . " " . substr($order->c_contact, 6) }}</td>
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
                        <table style="width:100%">
                            <tr>
                                <td width="50%" style="padding-right: .5rem;">
                                    <div class="order-package">
                                        @foreach ($categories as $c)
                                            <p class="mb-2 text-xs">{{ $c->name }}</p>
                                            @foreach ($items as $item)
                                                @if ($item->category == $c->name)
                                                    <p class="ml-3 mb-2 text-xs font-weight-light">{{ $item->name }} <small class="mb-1 text-muted"> x {{ $item->qty }}</small></p>
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
                                                    <td><span class="curreny-symbol">&#8369;</span> {{ number_format($order->subtotal, 2, '.', ',') }}</td>
                                                </tr>
                                                <tr>
                                                    @if ($order->discount)
                                                        <td>Discount</td>
                                                        <td>- {{ number_format($order->discount, 2, '.', ',') }}</td>
                                                    @else
                                                        <td>Discount</td>
                                                        <td>--</td>
                                                    @endif
                                                </tr>
                                                <tr class="grand-total">
                                                    <td>Grand Total</td>
                                                    <td><span class="curreny-symbol">&#8369;</span> {{ number_format(($order->subtotal - $order->discount), 2, '.', ',') }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </td>
                                <td width="50%" style="vertical-align: top; padding-left: .5rem;">
                                    <div class="order-details">
                                        <h4>Customer Information</h4>
                                        <small>Customer</small>
                                        <p>{{ $order->u_name }}</p>
            
                                        <small>Address</small>
                                        <p>{{ $order->u_address }}</p>
            
                                        <small>Contact</small>
                                        <p>0{{ substr($order->u_contact, 0, 3) . " " . substr($order->u_contact, 3, 3) . " " . substr($order->u_contact, 6) }}</p>
            
                                        <small>Email</small>
                                        <p>{{ $order->u_email }}</p>
                                    </div>
                                </td>
                            </tr>
                        </table>                       
                    </div>
                </div>
            </div>
        @endforeach
    @endisset
</body>
</html>