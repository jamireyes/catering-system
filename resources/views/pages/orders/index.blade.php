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
            <div class="col-md-12 mx-auto">
                <form action="{{ route('order.index') }}">
                    <div class="bg-white rounded shadow-sm p-3 mb-3">
                        <div class="d-flex justify-content-center">
                            <div class="mx-1">
                                <label class="text-muted text-xs">Start Date</label>
                                <div class="input-group-icon">
                                    <input type="text" id="from" name="start" class="form-control" autocomplete="off" required>
                                    <div class="input-icon" style="">
                                        <i class="nc-icon nc-calendar-60"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="mx-1">
                                <label class="text-muted text-xs">End Date</label>
                                <div class="input-group-icon">
                                    <input type="text" id="to" name="end" class="form-control" autocomplete="off" required>
                                    <div class="input-icon" style="">
                                        <i class="nc-icon nc-calendar-60"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-end">
                                <button type="reset" class="btn btn-default mb-0" style="padding-top: 0.42rem; padding-bottom: 0.42rem;">Clear</button>
                                <button type="submit" class="btn btn-primary mb-0" style="padding-top: 0.42rem; padding-bottom: 0.42rem;">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="card">
                    <div class="card-body">
                        @if (request()->get('start') && request()->get('end'))  
                            @if (session('info'))
                                <div class="alert alert-warning fade show text-secondary" role="alert">
                                    <div class="text-muted d-flex align-items-center" style="line-height: 1.15 !important;">
                                        <i class="nc-icon nc-alert-circle-i"></i>
                                        <p class="text-muted ml-2 mb-0">
                                            No results from 
                                            <strong>{{ \Carbon\Carbon::parse(request()->get('start'))->toFormattedDateString() }}</strong> 
                                            to 
                                            <strong>{{ \Carbon\Carbon::parse(request()->get('end'))->toFormattedDateString() }}</strong>.
                                        </p>
                                    </div>
                                </div>
                            @else
                                <div class="text-muted d-flex align-items-center mb-3" style="line-height: 1.15 !important;">
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
                                    <p class="ml-2 mb-0" style="line-height:0!important;">10 Most Recent Transactions</p>
                                </div>
                            @endif
                        @endisset
                        <div class="table-responsive-sm">
                            @if (Auth::user()->role == 'SELLER' || Auth::user()->role == 'ADMIN')
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th>Status</th>
                                        <th>Order #</th>
                                        <th>Customer</th>
                                        <th>Contact #</th>
                                        <th>Address</th>
                                        <th>Email</th>
                                        <th>Reservation Date</th>
                                        <th>Order Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($orders)
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td class="text-center">
                                                    @if ($order->status == 'CONFIRMED')
                                                        <span class="badge badge-pill badge-success p-2">
                                                            {{ $order->status }}
                                                        </span>
                                                    @elseif ($order->status == 'PENDING')
                                                        <span class="badge badge-pill badge-warning p-2">
                                                            {{ $order->status }}
                                                        </span>
                                                    @elseif ($order->status == 'CANCELLED')
                                                        <span class="badge badge-pill badge-danger p-2">
                                                            {{ $order->status }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="text-center">{{ $order->order_id }}</td>
                                                <td>{{ $order->u_name }}</td>
                                                @if ($order->u_contact != NULL)
                                                    <td>0{{ $order->u_contact }}</td>
                                                @else
                                                    <td>N/A</td>
                                                @endif
                                                @if ($order->u_address != NULL)
                                                    <td>{{ $order->u_address }}</td>
                                                @else
                                                    <td>N/A</td>
                                                @endif
                                                @if ($order->u_email != NULL)
                                                    <td>{{ $order->u_email }}</td>
                                                @else
                                                    <td>N/A</td>
                                                @endif
                                                <td class="text-center">{{ $order->reservation_date }}</td>
                                                <td class="text-center">
                                                    {{ $order->order_date }}
                                                </td>
                                                <td class="text-center">
                                                    <a class="view-btn" href="{{ route('order.show', ['order' => $order->order_id]) }}">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endisset
                                </tbody>
                            </table>
                            @elseif (Auth::user()->role == 'USER')
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Status</th>
                                            <th>Order #</th>
                                            <th>Catering Service</th>
                                            <th>Reservation Date</th>
                                            <th>Order Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @isset($orders)
                                            @foreach ($orders as $order)
                                                <tr>
                                                    <td class="text-center">
                                                        @if ($order->status == 'CONFIRMED')
                                                            <span class="badge badge-pill badge-success p-2">
                                                                {{ $order->status }}
                                                            </span>
                                                        @elseif ($order->status == 'PENDING')
                                                            <span class="badge badge-pill badge-warning p-2">
                                                                {{ $order->status }}
                                                            </span>
                                                        @elseif ($order->status == 'CANCELLED')
                                                            <span class="badge badge-pill badge-danger p-2">
                                                                {{ $order->status }}
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">{{ $order->order_id }}</td>
                                                    <td>{{ $order->c_name }}</td>
                                                    <td class="text-center">{{ $order->reservation_date }}</td>
                                                    <td class="text-center">{{ $order->order_date }}</td>
                                                    <td class="text-center">
                                                        <a class="view-btn" href="{{ route('order.show', ['order' => $order->order_id]) }}">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endisset
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('.order-container').perfectScrollbar();

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