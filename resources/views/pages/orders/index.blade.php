@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'order'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Order History</li>
                    </ol>
                </nav>
                @include('components.alerts')
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 mx-auto">
                <form action="{{ route('order.index') }}">
                    @csrf
                    <div class="bg-white border rounded shadow-sm p-3 mb-5">
                        <div class="d-flex justify-content-center w-100">
                            <div class="mr-2 w-100">
                                <label for="">Start Date</label>
                                <div class="input-group-icon">
                                    <input type="text" id="from" name="start" class="form-control" required>
                                    <div class="input-icon" style="">
                                        <i class="nc-icon nc-calendar-60"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="w-100">
                                <label for="">End Date</label>
                                <div class="input-group-icon">
                                    <input type="text" id="to" name="end" class="form-control" required>
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
        </div>
        <div class="row">
            @isset($orders)
                @foreach ($orders as $order)
                <div class="col-md-5 mx-auto">
                    <div class="card border rounded">
                        <div class="card-body">                         
                            <div class="m-2">
                                <small class="text-muted">Date: {{ $order->order_date }}</small>
                                <div class="text-center">
                                    <h5 class="card-title">{{ $order->package_name }}</h5>
                                    <p class="mb-1">{{ $order->company }}</p>
                                    <small class="mb-0 text-muted">({{ $order->pax }} PAX)</small>
                                </div>
                                <hr>
                                <div>
                                    @foreach ($categories as $c)
                                        <p class="text-xs">{{ $c->name }}</p>
                                        @foreach ($items as $item)
                                            @if ($item->category == $c->name)
                                                <p class="ml-3 text-xs font-italic font-weight-light">{{ $item->name }}<small class="mb-1 text-muted"> x {{ $item->qty }}</small></p>
                                            @endif
                                        @endforeach
                                    @endforeach
                                                                    
                                    @if ($order->inclusion != NULL)    
                                        <p class="text-xs">{{ __('Inclusions') }}</p>
                                        <p class="ml-3 text-xs font-italic font-weight-light">{{ $order->inclusion }}</p> 
                                    @endif
                                </div>
                                <div>
                                    <table class="table table-sm">
                                        <tbody>
                                            <tr>
                                                <td class="text-left">{{ __('Grand Total') }}</td>
                                                <td class="text-right">₱ {{ number_format($order->price, 2, '.', ',') }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endisset
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