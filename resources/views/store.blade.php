@extends('layouts.app', [
    'class' => 'lock-page',
    'elementActive' => 'store-page',
    'backgroundImagePath' => ''
])

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb" class="mt-5 ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('welcome') }}" class="text-muted">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('cart') }}" class="text-muted">Store</a>
                </li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-12">
                <h2 class="my-5">All Packages</h2>
                <div class="row">
                    <div class="col-md-3">
                        <p class="font-weight-bold">Category:</p>
                        <ul id="category-filter" class="list-group">
                            <button type="button" class="list-group-item list-group-item-action active">All</button>
                            <button type="button" class="list-group-item list-group-item-action">Weddings</button>
                            <button type="button" class="list-group-item list-group-item-action">Graduations</button>
                            <button type="button" class="list-group-item list-group-item-action">Birthdays</button>
                            <button type="button" class="list-group-item list-group-item-action">Others</button>
                        </ul>
                        <p class="font-weight-bold mt-5">Price:</p>
                        <ul id="price-filter" class="list-group">
                            <button type="button" class="list-group-item list-group-item-action active">Highest to Lowest</button>
                            <button type="button" class="list-group-item list-group-item-action">Lowest to Highest</button>
                        </ul>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="card border rounded m-3">
                                    <div class="card-body">
                                        <div class="container text-center">
                                            <h4 class="card-title text-warning">Package Name</h4>
                                            <p>Catering Service Name</p>
                                            <small class="mb-1">Menu</small>
                                            <p class="font-italic font-weight-light">
                                                Brownies, Nachos, Cheese Dips, Garlic Rice, Plain Rice, Mushroom Soup, Crab and Corn Soup, Chicken Soup, Celery Salad, Broccoli Salad, Sweet Potato Salad, Beef Mushroom, Beef Teriyaki, Pork Spareribs, Iced Tea, Blue Lemonade, House Blend Iced Tea
                                            </p> 
                                            <small class="mb-1">Inclusions</small>
                                            <p class="font-italic font-weight-light">Sound System, Decorations, Crew</p>
                                            <p>Good for 50 pax</p>
                                            <h4>PHP 5000.00</h4>
                                        </div>
                                        <div class="text-center">
                                            <button class="btn btn-round btn-warning">Order Now</button>
                                        </div>
                                        <hr class="bg-warning">
                                        <div class="row">
                                            <div class="col-2 text-right">
                                                <span class="nc-icon nc-pin-3"/>
                                            </div>
                                            <small class="col-10 text-left">2/F Zambrano Building Quezon Avenue, San Fernando, La Union</small>
                                        </div>
                                        <div class="row my-2">
                                            <div class="col-2 text-right">
                                                <span class="nc-icon nc-send"/>
                                            </div>
                                            <small class="col-10 text-left">0999 888 0000</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="card border rounded m-3">
                                    <div class="card-body">
                                        <div class="container text-center">
                                            <h4 class="card-title text-warning">Package Name</h4>
                                            <p>Catering Service Name</p>
                                            <small class="mb-1">Menu</small>
                                            <p class="font-italic font-weight-light">
                                                Brownies, Nachos, Cheese Dips, Garlic Rice, Plain Rice, Mushroom Soup, Crab and Corn Soup, Chicken Soup, Celery Salad, Broccoli Salad, Sweet Potato Salad, Beef Mushroom, Beef Teriyaki, Pork Spareribs, Iced Tea, Blue Lemonade, House Blend Iced Tea
                                            </p> 
                                            <small class="mb-1">Inclusions</small>
                                            <p class="font-italic font-weight-light">Sound System, Decorations, Crew</p>
                                            <p>Good for 50 pax</p>
                                            <h4>PHP 5000.00</h4>
                                        </div>
                                        <div class="text-center">
                                            <button class="btn btn-round btn-warning">Order Now</button>
                                        </div>
                                        <hr class="bg-warning">
                                        <div class="row">
                                            <div class="col-2 text-right">
                                                <span class="nc-icon nc-pin-3"/>
                                            </div>
                                            <small class="col-10 text-left">2/F Zambrano Building Quezon Avenue, San Fernando, La Union</small>
                                        </div>
                                        <div class="row my-2">
                                            <div class="col-2 text-right">
                                                <span class="nc-icon nc-send"/>
                                            </div>
                                            <small class="col-10 text-left">0999 888 0000</small>
                                        </div>
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
        })
    </script>
@endpush