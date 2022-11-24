@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'order'
])

@section('content')
    {{-- {{ dd(Session::has('error')) }} --}}
    <div class="content">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Order History</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <form action="{{ route('order.index') }}">
                    
                    <div class="bg-white rounded shadow-sm p-3 mb-3">
                        <div class="d-flex justify-content-center w-100">
                            <div class="mr-2 w-100">
                                <label class="text-muted text-xs">Start Date</label>
                                <div class="input-group-icon">
                                    <input type="text" id="from" name="start" class="form-control" autocomplete="off" required>
                                    <div class="input-icon" style="">
                                        <i class="nc-icon nc-calendar-60"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="w-100">
                                <label class="text-muted text-xs">End Date</label>
                                <div class="input-group-icon">
                                    <input type="text" id="to" name="end" class="form-control" autocomplete="off" required>
                                    <div class="input-icon" style="">
                                        <i class="nc-icon nc-calendar-60"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-sm btn-primary mb-0">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-12">
                        @if (request()->get('start') && request()->get('end'))  
                            @if (session('info'))
                                <div class="alert alert-warning alert-dismissible fade show text-secondary" role="alert">
                                    No results from 
                                    <strong>{{ \Carbon\Carbon::parse(request()->get('start'))->toFormattedDateString() }}</strong> 
                                    to 
                                    <strong>{{ \Carbon\Carbon::parse(request()->get('end'))->toFormattedDateString() }}</strong>.
                                    <button type="button" class="close text-secondary" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @else
                                <div class="text-muted d-flex align-items-center mb-3">
                                    <i class="nc-icon nc-alert-circle-i"></i>
                                    <p class="text-muted ml-2 mb-0">
                                        {{ $count }}
                                        Results from 
                                        <strong>{{ \Carbon\Carbon::parse(request()->get('start'))->toFormattedDateString() }}</strong> 
                                        to 
                                        <strong>{{ \Carbon\Carbon::parse(request()->get('end'))->toFormattedDateString() }}</strong>.
                                    </p>
                                </div>
                            @endif
                        @endif
                        @isset($count)
                            @if ($count && !request()->get('start') && !request()->get('end'))
                                <div class="text-muted d-flex align-items-center mb-3">
                                    <i class="nc-icon nc-alert-circle-i"></i>
                                    <p class="ml-2 mb-0" style="line-height:0!important;">Most Recent Transactions</p>
                                </div>
                            @endif
                        @endisset
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="order-container">                   
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
                                                        <td>{{ $order->c_address }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Contact:</td>
                                                        <td>{{ $order->c_contact }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Email:</td>
                                                        <td>{{ $order->c_email }}</td>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function () {
            var dateFormat = "mm/dd/yy";

            from = $("#from").datepicker({
                maxDate: new Date, 
                minDate: new Date(2007, 6, 12),
                changeMonth: true,
                numberOfMonths: 1
            }).on("change", function() {
                to.datepicker( "option", "minDate", getDate( this ) );
            });
            
            to = $( "#to" ).datepicker({
                maxDate: new Date, 
                minDate: new Date(2007, 6, 12),
                changeMonth: true,
                numberOfMonths: 1
            }).on("change", function() {
                from.datepicker( "option", "maxDate", getDate( this ) );
            });
        
            function getDate(element) {
                var date;
                try {
                    date = $.datepicker.parseDate(dateFormat, element.value);
                } catch(error) {
                    date = null;
                }
        
                return date;
            }
        });
    </script>
@endpush