@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'order'
])

@section('content')
    <div class="content">
        @isset($orders)
            @foreach ($orders as $order)
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('order.index') }}">Order History</a></li>
                            <li class="breadcrumb-item active">Order No. {{ $order->order_id }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-12 mx-auto">
                    <div class="card shadow-lg">
                        <div class="card-body p-4">
                            <div class="order-header">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h5 class="mb-1">{{ $order->package_name }} ({{ $order->pax }} pax)</h5>
                                        @if($order->status == 'CONFIRMED')
                                            <span class="badge badge-pill badge-success">{{ $order->status }}</span>
                                        @elseif($order->status == 'CANCELLED')
                                            <span class="badge badge-pill badge-danger">{{ $order->status }}</span>
                                        @elseif($order->status == 'PENDING')
                                            <span class="badge badge-pill badge-warning">{{ $order->status }}</span>
                                        @endif
                                    </div>
                                    <div class="d-flex flex-column text-right">
                                        <div class="d-flex flex-md-row flex-column justify-content-end mb-2 mt-1">
                                            @if (Auth::user()->role != 'USER')
                                                <form class="form-inline" action="{{ route('order.update', ['order' => $order->order_id]) }}" method="POST">
                                                    @method('PUT')
                                                    @csrf           
                                                    <div class="input-group mb-0">
                                                        <select class="custom-select custom-select-sm" name="status">
                                                            <option value="CONFIRMED" @if ($order->status == 'CONFIRMED') selected @endif>CONFIRMED</option>
                                                            <option value="PENDING" @if ($order->status == 'PENDING') selected @endif>PENDING</option>
                                                            <option value="CANCELLED" @if ($order->status == 'CANCELLED') selected @endif>CANCELLED</option>
                                                        </select>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-sm btn-icon btn-info m-0" title="Update"><i class="fa-solid fa-rotate-right"></i></button>
                                                        </div>
                                                    </div>
                                                </form>
                                            @endif

                                            <div class="dropdown">
                                                <button style="height: 1.875rem; width: 2.5rem;" class="btn btn-sm btn-info dropdown-toggle ml-1 m-0 px-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Options">
                                                    <i class="fa-solid fa-gear"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                    <form action="{{ route('order.downloadPayment', ['order' => $order->order_id]) }}" method="GET">
                                                        <button type="submit" class="dropdown-item">
                                                            <div class="d-flex align-items-center">
                                                                <svg viewBox="0 0 24 24" width="15" height="15" stroke="currentColor" stroke-width="2.7" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                                                <div class="ml-1">Proof of Payment</div>
                                                            </div>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('order.exportToPDF') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="download" value="pdf">
                                                        <input type="hidden" name="id" value="{{ $order->order_id }}">
                                                        <button type="submit" class="dropdown-item" >
                                                            <div class="d-flex align-items-center">
                                                                <svg viewBox="0 0 24 24" width="15" height="15" stroke="currentColor" stroke-width="2.7" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                                                <div class="ml-1">Export</div>
                                                            </div>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <small class="text-muted"><strong>Date:</strong> {{ $order->order_date }}</small>
                                        <small class="text-muted"><strong>Order No.:</strong> {{ $order->order_id }}</small>
                                    </div>
                                </div>
                                <div class="order-cater-info">
                                    <p class="font-weight-bold">{{ $order->c_name }}</p>
                                    <table>
                                        <tr>
                                            <td>Address:</td>
                                            <td>
                                                @if ($order->c_address)
                                                    {{ $order->c_address }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Contact:</td>
                                            <td>
                                                @if ($order->c_contact)
                                                    0{{ substr($order->c_contact, 0, 3) . " " . substr($order->c_contact, 3, 3) . " " . substr($order->c_contact, 6) }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Email:</td>
                                            <td>
                                                @if ($order->c_email)
                                                    {{ $order->c_email }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <hr>
                            <div class="order-body">
                                <div class="order-package">
                                    @foreach ($categories as $c)
                                        @if ($order->package_id == $c->package_id)
                                            <p class="mb-2 text-xs">{{ $c->name }}</p>
                                            @foreach ($items as $item)
                                            @if ($item->order_id == $order->order_id)
                                                @if ($item->category == $c->name)
                                                    <p class="ml-3 mb-2 text-xs font-weight-light">{{ $item->name }}<small class="mb-1 text-muted"> x {{ $item->qty }}</small></p>
                                                @endif
                                            @endif
                                            @endforeach
                                        @endif
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
                                                    <td>Discount</td>
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
                                    <p>
                                        @if ($order->u_name)
                                            {{ $order->u_name }}
                                        @else
                                            N/A
                                        @endif
                                    </p>

                                    <small>Address</small>
                                    <p>   
                                        @if ($order->u_address)
                                            {{ $order->u_address }}
                                        @else
                                            N/A
                                        @endif
                                    </p>

                                    <small>Contact</small>
                                    <p>
                                        @if ($order->u_contact)
                                            0{{ substr($order->u_contact, 0, 3) . " " . substr($order->u_contact, 3, 3) . " " . substr($order->u_contact, 6) }}
                                        @else
                                            N/A
                                        @endif
                                    </p>

                                    <small>Email</small>
                                    <p>
                                        @if ($order->u_email)
                                            {{ $order->u_email }}
                                        @else
                                            N/A
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @endisset
    </div>
@endsection
