@extends('layouts.app', [
    'class' => 'lock-page',
    'elementActive' => 'store-page',
    'backgroundImagePath' => ''
])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="mt-0">Packages</h4>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-3">
                    <div class="p-4 mb-4 border bg-white shadow-sm">
                        <p class="text-muted d-flex">
                            <svg class="align-self-center mr-2" viewBox="0 0 24 24" height=".9rem" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
                            {{ __('Price Filter') }}
                        </p>
                        <form id="filter-form" action="{{ route('shop.index') }}">
                            @csrf
                            <p>
                                <label for="price-range" class="text-muted">Range: </label>
                                <input type="text" id="price-range" data-max="{{ $max_price }}" data-min="{{ $min_price }}" data-filter-min="{{ $filter_min_price }}" data-filter-max="{{ $filter_max_price }}" readonly class="border-0 text-primary font-weight-bold">
                                <input type="hidden" name="filter_min_price" value="{{ $filter_min_price }}">
                                <input type="hidden" name="filter_max_price" value="{{ $filter_max_price }}">
                                <input type="hidden" name="order_by_price" value="{{ $priceOrderBy }}">
                            </p>
                            <div id="slider" class="mb-3"></div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-sm btn-info mb-0">Apply</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex flex-md-row flex-column justify-content-between align-items-center align-items-md-start">
                                <div id="price-filter" class="d-flex flex-row mb-2 shadow-sm">
                                    <button id="low-high-btn" class="m-0 btn btn-outline-light rounded-0 @if($priceOrderBy == 'ASC') active @endif">Low to High</button>
                                    <button id="high-low-btn" class="m-0 btn btn-outline-light rounded-0 @if($priceOrderBy == 'DESC') active @endif">High to Low</button>
                                </div>
                                <div class="mb-2">
                                    {{ $packages->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($packages as $package)
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card border rounded">
                                <div class="card-body">
                                    <div class="m-2">
                                        <div class="text-center">
                                            <h5 class="card-title text-warning">{{ $package->name }}</h5>
                                            <p class="text-xs">{{ $package->user }}</p>
                                        </div>
                                        <hr class="bg-warning">
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
                                        <div class="text-center mt-4 mb-3">
                                            <h5 id="package-price" class="mb-0">₱ {{ number_format($package->price, 2, '.', ',') }}</h5>
                                            <span>{{ $package->pax }} PAX</span>
                                        </div>
                                        <div class="text-center">
                                            <a href="{{ route('shop.show', ['shop' => $package->id]) }}" class="btn btn btn-warning">Order Now</a>
                                        </div>
                                        <hr class="bg-warning">
                                        <div id="package-info">
                                            <div class="row">
                                                <div class="col-2 text-right">
                                                    <span class="nc-icon nc-pin-3"/>
                                                </div>
                                                <small class="col-10 text-left">{{ $package->address }}</small>
                                            </div>
                                            <div class="row my-2">
                                                <div class="col-2 text-right">
                                                    <span class="nc-icon nc-send"/>
                                                </div>
                                                <small class="col-10 text-left">+63 {{ $package->phone }}</small>
                                            </div>
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

            $( "#price-range" ).val( "₱" + numberWithCommas(val_min) + " - ₱" + numberWithCommas(val_max) );

            // $('input[name="filter_min_price"]').val($('#price-range').data('filter_min'))
            // $('input[name="filter_max_price"]').val($('#price-range').data('filter_max'))

            function numberWithCommas(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            $('#high-low-btn').click(function(){
                $('[name="order_by_price"]').val('DESC')
                $('#filter-form').submit()
            })

            $('#low-high-btn').click(function(){
                $('[name="order_by_price"]').val('ASC')
                $('#filter-form').submit()
            })

        })
    </script>
@endpush