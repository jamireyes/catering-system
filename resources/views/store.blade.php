@extends('layouts.app', [
    'class' => 'lock-page',
    'elementActive' => 'store-page',
    'backgroundImagePath' => ''
])

@section('content')
    <div class="container-fluid">
        <div class="px-2 py-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="mt-0">Packages</h4>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-2">
                            <div class="mb-4 border bg-white" style="border-radius: 0.6rem !important; border:0!important; box-shadow: 0 .125rem .25rem rgba(0,0,0,.075)!important;">
                                <form id="filter-form" action="{{ route('shop.index') }}">
                                    <div class="p-4">
                                        <p class="text-muted d-flex">
                                            <svg class="align-self-center mr-2" viewBox="0 0 24 24" height=".9rem" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
                                            {{ __('Price Filter') }}
                                        </p>
                                        <div class="form-group">
                                            <label for="price-range" class="text-muted text-xs">Range: </label>
                                            <input type="text" id="price-range" readonly class="border-0 text-primary font-weight-bold text-xs bg-transparent"
                                                data-max="{{ $max_price }}" 
                                                data-min="{{ $min_price }}" 
                                                data-filter-min="{{ request()->get('filter_min_price') }}" 
                                                data-filter-max="{{ request()->get('filter_max_price') }}">

                                            <input type="hidden" name="filter_min_price" value="{{ request()->get('filter_min_price') }}">
                                            <input type="hidden" name="filter_max_price" value="{{ request()->get('filter_max_price') }}">
                                            <input type="hidden" name="order_by_price" value="{{ request()->get('order_by_price') }}">
                                            <input type="hidden" name="filter_occasion" value="{{ request()->get('filter_occasion') }}">
                                            <div id="slider" class="my-3"></div>
                                            <div class="d-flex justify-content-end align-items-center mt-4">
                                                <button type="submit" class="btn btn-sm btn-info my-0">Apply</button>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="m-0 p-0">
                                    <div class="occasion-filter">
                                        <p class="text-muted d-flex">
                                            <svg class="align-self-center mr-2" viewBox="0 0 24 24" height=".9rem" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polyline points="20 12 20 22 4 22 4 12"></polyline><rect x="2" y="7" width="20" height="5"></rect><line x1="12" y1="22" x2="12" y2="7"></line><path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"></path><path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"></path></svg>
                                            {{ __('Occasions Filter') }}
                                        </p>
                                        
                                        <div class="list-group">
                                            @foreach ($occasions as $o_filter)
                                                @if ($o_filter->id == request()->get('filter_occasion'))
                                                    <button type="button" class="list-group-item list-group-item-action active" data-val="{{ $o_filter->id }}">
                                                        {{ $o_filter->name }}
                                                    </button>
                                                @else
                                                    <button type="button" class="list-group-item list-group-item-action" data-val="{{ $o_filter->id }}">
                                                        {{ $o_filter->name }}
                                                    </button>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mb-2">
                                        <div id="price-filter" class="desktop d-flex flex-row mb-3">
                                            <button id="low-high-btn" class="m-0 btn btn-outline-light @if(request()->get('order_by_price') == 'ASC') active @endif">Low to High</button>
                                            <button id="high-low-btn" class="m-0 btn btn-outline-light @if(request()->get('order_by_price') == 'DESC') active @endif">High to Low</button>
                                        </div>
                                        <div>
                                            {{ $packages->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @foreach ($packages as $package)
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="package card border rounded">
                                        <div class="card-body">
                                            <div class="m-2">
                                                <div class="text-center">
                                                    <h5 class="card-title">{{ $package->name }}</h5>
                                                    <p class="text-xs">{{ $package->user }}</p>
                                                </div>
                                                <hr>
                                                <div id="package-menu">
                                                    <div id="package-items">
                                                        @foreach ($categoryRules as $cr)
                                                            @if ($cr->package_id == $package->id)
                                                            <p class="mb-0 text-xs">{{ $cr->category_name }}</p>
                                                            <small class="mb-1 text-muted">(Max {{ $cr->quantity }} item/s)</small>
                                                            <p class="ml-3 text-xs font-italic font-weight-light">
                                                                @foreach ($items as $item)
                                                                    @if ($item->category_id == $cr->category_id)
                                                                        {{ $item->name }},
                                                                    @endif
                                                                @endforeach
                                                                etc
                                                            </p>
                                                            @endif
                                                        @endforeach
                                                        @if($package->inclusion)
                                                            <p class="mb-0 text-xs">{{ __('Inclusions') }}</p>
                                                            <p class="ml-3 text-xs font-italic font-weight-light">{{ $package->inclusion }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="m-0 d-flex flex-column justify-content-center align-items-center" style="height:5rem;">
                                                    @if ($package->discount)
                                                        <p class="text-muted mb-0"><del>₱ {{ $package->price }}</del></p>
                                                        <h5 id="package-price" class="mb-0">₱ {{ number_format(($package->price * (1 - $package->discount / 100)), 2, '.', ',') }}</h5>
                                                    @else
                                                        <h5 id="package-price" class="mb-0">₱ {{ number_format($package->price, 2, '.', ',') }}</h5>
                                                    @endif
                                                    <span>{{ $package->pax }} PAX</span>
                                                </div>
                                                <div class="text-center">
                                                    <a href="{{ route('shop.show', ['shop' => $package->id]) }}" class="btn btn btn-warning">PURCHASE</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-center justify-content-md-end">
                                        {{ $packages->links() }}
                                    </div>
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
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $(document).ready(() => {
            $('#category-filter button').click(function(){
                $('#category-filter button.active').removeClass('active');
                $(this).addClass('active')
            })

            $('#price-filter button').click(function(){
                $('#price-filter button.active').removeClass('active');
                $(this).addClass('active')
            })

            var min_price = Math.floor($('#price-range').data('min'))
            var max_price = Math.floor($('#price-range').data('max'))
            
            var val_min = ($('#price-range').data('filter-min').length === 0) ? min_price : Math.floor($('#price-range').data('filter-min'))
            var val_max = ($('#price-range').data('filter-max').length === 0) ? max_price : Math.floor($('#price-range').data('filter-max'))
            
            $("#slider").slider({
                range: true,
                min: min_price,
                max: max_price,
                step: 1000,
                values: [ val_min, val_max ],
                slide: function( event, ui ) {
                    $("#price-range").val( "₱" + numberWithCommas(ui.values[0]) + " - ₱" + numberWithCommas(ui.values[1]) );
                    $('input[name="filter_min_price"]').val(ui.values[0])
                    $('input[name="filter_max_price"]').val(ui.values[1])
                }
            });

            $("#price-range").val( "₱" + numberWithCommas(val_min) + " - ₱" + numberWithCommas(val_max) );

            function numberWithCommas(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            $('#high-low-btn').click(function() {
                $('[name="order_by_price"]').val('DESC')
                $('#filter-form').submit()
            })

            $('#low-high-btn').click(function() {
                $('[name="order_by_price"]').val('ASC')
                $('#filter-form').submit()
            })

            $('.occasion-filter button').click(function() {
                const filter =  $('[name="filter_occasion"]');

                $(this).hasClass('active') ? filter.val('') : filter.val($(this).data('val'));
            
                $('#filter-form').submit()
            })

            $('.occasion-filter p').click(function() {
                $(this).toggleClass('show')
                $('.occasion-filter .list-group').toggleClass('d-block')
            })
        })
    </script>
@endpush