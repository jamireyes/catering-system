@extends('layouts.app', [
    'class' => 'lock-page',
    'elementActive' => 'store-page',
    'backgroundImagePath' => ''
])

@section('content')
    <div class="container-fluid">
        <div class="overlay"></div>
        <div class="px-2 py-4">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('welcome') }}" class="text-muted">Home</a>
                            </li>
                            {{-- <li class="breadcrumb-item">
                                <a href="{{ route('shop.index') }}" class="text-muted">Store</a>
                            </li> --}}
                            <li class="breadcrumb-item">
                                <a class="text-dark">Packages</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="mt-0">Packages</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="filter-wrapper">
                                <div class="search-container-mobile">
                                    <div class="w-100">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="nc-icon nc-zoom-split"></i>
                                                </span>
                                            </div>
                                            <input type="search" class="search form-control">
                                        </div>
                                        <span class="search-box"></span>
                                    </div>
                                    <div>
                                        <button type="button" class="btn-light">
                                            <div class="d-flex align-items-center">
                                                <svg viewBox="0 0 24 24" width="15" height="15" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                                <div id="filter">
                                    <form id="filter-form" action="{{ route('shop.index') }}">
                                        <div class="occasion-filter filter-item">
                                            <p class="filter-header">
                                                <svg class="align-self-center mr-2" viewBox="0 0 24 24" height=".9rem" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polyline points="20 12 20 22 4 22 4 12"></polyline><rect x="2" y="7" width="20" height="5"></rect><line x1="12" y1="22" x2="12" y2="7"></line><path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"></path><path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"></path></svg>
                                                <span class="filter-label">{{ __('Occasions Filter') }}</span>
                                            </p>
                                            <div class="filter-body">
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
                                        </div>
                                        <hr class="m-0 p-0">
                                        <div class="filter-item">
                                            <p class="filter-header">
                                                <svg class="align-self-center mr-2" viewBox="0 0 24 24" height=".9rem" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
                                                <span class="filter-label">{{ __('Price Filter') }}</span>
                                            </p>
                                            <div class="filter-body">
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
                                                <div class="d-flex flex-column align-items-center mt-4">
                                                    <div id="price-filter" class="d-flex w-100">
                                                        <button id="low-high-btn" class="m-0 btn btn-block btn-outline-light @if(request()->get('order_by_price') == 'ASC') active @endif">
                                                            <div class="d-flex justify-content-center align-items-center">
                                                                <svg height="19" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><polyline fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="12" points="144 167.994 184 207.994 223.999 168"/><line x1="184" x2="184" y1="111.993" y2="207.993" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"/><line x1="48" x2="119.999" y1="127.994" y2="127.994" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"/><line x1="48" x2="183.999" y1="63.994" y2="63.994" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"/><line x1="48" x2="104" y1="191.994" y2="191.994" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"/></svg>
                                                            </div>
                                                        </button>
                                                        <button id="high-low-btn" class="m-0 btn btn-block btn-outline-light @if(request()->get('order_by_price') == 'DESC') active @endif">
                                                            <div class="d-flex justify-content-center align-items-center">
                                                                <svg height="19" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><polyline fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="12" points="144 87.994 184 47.994 223.999 87.987"/><line x1="184" x2="184" y1="143.994" y2="47.994" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"/><line x1="48" x2="119.999" y1="127.994" y2="127.994" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"/><line x1="48" x2="103.999" y1="63.994" y2="63.994" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"/><line x1="48" x2="183.999" y1="191.994" y2="191.994" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"/></svg>
                                                            </div>
                                                        </button>
                                                    </div>
                                                    <button type="submit" class="btn btn-info btn-block">Apply</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mb-2">
                                        <div>
                                            {{ $packages->links() }}
                                        </div>
                                        <div class="search-container">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="nc-icon nc-zoom-split"></i>
                                                    </span>
                                                </div>
                                                <input type="search" class="search form-control">
                                            </div>
                                            <span class="search-box"></span>
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

            function delay(callback, ms) {
                var timer = 0;
                return function() {
                    var context = this, args = arguments;
                    clearTimeout(timer);
                    timer = setTimeout(function () {
                        callback.apply(context, args);
                    }, ms || 0);
                };
            }

            $('.search').keyup(delay(function (e) {
                var query = $(this).val();

                if(query.length > 0){
                    $.ajax({
                        url: 'api/shop/search',
                        type: 'GET',
                        data: { 'search': query },
                        success: function(data) {
                            var temp = '';
                            for(let row of data){
                                temp += `<div class="search-item" aria-id="${row.id}" onclick="clickMe(${row.id})">${row.name}</div>`
                            }
                            $('.search-box').html(temp);
                        },
                    })
                }else{
                    setTimeout(() => {
                        $('.search-box').empty()
                    }, 200)
                }
            }, 500));


            $('.search-container-mobile .btn-light').click(function() {
                $('.overlay').toggle();
                $('.search-container-mobile + #filter').removeClass('animate__animated animate__fadeOutDownBig animate__faster');
                $('.search-container-mobile + #filter').addClass('animate__animated animate__fadeInUpBig animate__faster');
                $('.search-container-mobile + #filter').toggle();
            })

            $('.overlay').click(function() {
                $('.search-container-mobile + #filter').removeClass('animate__animated animate__fadeInUpBig animate__faster');
                $('.search-container-mobile + #filter').addClass('animate__animated animate__fadeOutDownBig animate__faster');
                
                setTimeout(function(){
                    $('.overlay').toggle();
                    $('.search-container-mobile + #filter').toggle();
                }, 500);
            })

            $('body').click(function(){
                $('.search').val('');
                $('.search').keyup();
            })
        })
    </script>
    <script>
        function clickMe(id) {
            window.location.assign(`/shop/${id}`)
        }
    </script>
@endpush