<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('paper') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('paper') }}/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    
    <title>{{ config('app.name') }}</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'name='viewport' />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    
    <link href="{{ asset('css/all.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body class="lock-page position-relative">
    <nav class="navbar navbar-expand-lg m-0 fixed-top">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar bar1"></span>
            <span class="navbar-toggler-bar bar2"></span>
            <span class="navbar-toggler-bar bar3"></span>
        </button>
        
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="{{ route('welcome') }}" class="nav-link"><img src="../assets/img/banner.png" height="30" alt="Logo"></a>
            </li>
        </ul>
        <div style="background-color:transparent;width:37px;"></div>
        <div class="collapse navbar-collapse justify-content-between" id="navigation">
            <ul class="navbar-nav navbar-center">
                <li class="nav-item">
                    <a href="{{ route('store.index') }}" class="nav-link">{{ __('Stores') }}</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('shop.index') }}" class="nav-link">{{ __('Packages') }}</a>
                </li>
                <li class="nav-item">
                    <a href="#about" class="nav-link">{{ __('About') }}</a>
                </li>
                <li class="nav-item">
                    <a href="#featured" class="nav-link">{{ __('Featured') }}</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="{{ route('checkout.index') }}" class="nav-link">
                        <i class="nc-icon nc-cart-simple"></i>
                    </a>
                </li>
                @guest
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">
                            <img src="{{ asset('assets') }}/img/svg/log-in.svg" alt="login">
                        </a>
                    </li>
                @endguest
                @auth
                    <li class="nav-item btn-rotate dropdown">
                        <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink2"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="nc-icon nc-single-02"></i>
                        </a>
                        <div class="dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink2">
                            <form class="dropdown-item" action="{{ route('logout') }}" id="formLogOut" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{ route('home') }}">{{ __('Dashboard') }}</a>
                                <a class="dropdown-item" onclick="document.getElementById('formLogOut').submit();">{{ __('Log out') }}</a>
                            </div>
                        </div>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>
    <div class="section-image" style="height:100vh;!important">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <div style="z-index:10;" data-aos="fade-up" data-aos-duration="1500" class="position-absolute w-100 h-100 d-flex justify-content-center align-items-center text-center">
                <div class="d-flex flex-column">
                    <div class="mb-5">
                        <img class="w-50" src="../assets/img/logo.png" alt="Logo">
                    </div>
                    <div>
                        <h5 class="text-light">Make Reservations Anytime!</h5>
                    </div>
                    <div>
                        <a href="{{ route('shop.index') }}" class="btn btn-warning">Reserve Now</a>
                    </div>
                </div>
            </div>
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img style="width: 100vw; height: 100vh; object-fit: cover;" src="../assets/img/bg-img-3.jpg" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img style="width: 100vw; height: 100vh; object-fit: cover;" src="../assets/img/bg-img-2.jpg" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img style="width: 100vw; height: 100vh; object-fit: cover;" src="../assets/img/catering-img-3.jpg" alt="Third slide">
                </div>
            </div>
            <a style="z-index: 10;" class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a style="z-index: 10;" class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        {{-- <div class="position-fixed" style="bottom:10px;right:10px;z-index:1020!important;">
            <a id="backToTop" href="#carouselExampleIndicators" class="btn" style="opacity: 0!important;">
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><line x1="12" y1="19" x2="12" y2="5"></line><polyline points="5 12 12 5 19 12"></polyline></svg>
            </a>
        </div> --}}
    </div>
    <section id="about" class="my-5 py-5" data-aos="fade-up">
        <div class="container">
            <div class="d-flex flex-column justify-content-center text-center">
                <h5 class="text-warning text-uppercase text-spacing-5">Serving you since 2022</h5>
                <h3 class="my-4">Welcome to Three Catering Services</h3>
            </div>
            <div class="row">
                <div class="col-md-4 text-center py-5">
                    <img src="{{ asset('assets') }}/img/about/circle.png" alt="circle" class="position-relative">
                    <img src="{{ asset('assets') }}/img/about/shape1.png" alt="shape1" class="position-absolute float-up" style="top:38%; left:50%; transform: translate(-50%, -50%);">
                    <h5 class="text-muted text-uppercase mt-3">Fast in Action</h5>
                </div>
                <div class="col-md-4 text-center py-5">
                    <img src="{{ asset('assets') }}/img/about/circle.png" alt="circle" class="position-relative">
                    <img src="{{ asset('assets') }}/img/about/shape2.png" alt="shape2" class="position-absolute float-up" style="top:38%; left:50%; transform: translate(-50%, -50%);">
                    <h5 class="text-muted text-uppercase mt-3">Budget Friendly</h5>
                </div>
                <div class="col-md-4 text-center py-5">
                    <img src="{{ asset('assets') }}/img/about/circle.png" alt="circle" class="position-relative">
                    <img src="{{ asset('assets') }}/img/about/shape3.png" alt="shape3" class="position-absolute float-up" style="top:38%; left:50%; transform: translate(-50%, -50%);">
                    <h5 class="text-muted text-uppercase mt-3">Premium Services</h5>
                </div>
            </div>
        </div>
    </section>
    <hr>
    <section id="featured" class="mb-5 py-5">
        <div class="container" data-aos="zoom-in">
            <div class="text-center pb-4">
                <h4 class="text-muted">Featured Packages</h4>
            </div>
            <div class="d-flex justify-content-between">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    {{-- <section id="feedback" class="py-5">
        <div class="text-center pb-4">
            <h4 class="text-muted">Customer Feedback</h4>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-3">
                <div class="d-flex justify-content-md-end justify-content-center">
                    <div class="card text-white bg-warning" style="width:7rem;height:7rem;">
                        <div class="card-body text-center p-0">
                            <div class="h-100 d-flex flex-column justify-content-center align-items-center">
                                <h2 class="m-0">4.9</h2>
                                <p class="m-0">out of 5</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-9">
                <div class="progress mb-2">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">121</div>
                </div>
                <div class="progress mb-2">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 80%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">23</div>
                </div>
                <div class="progress mb-2">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 60%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">10</div>
                </div>
                <div class="progress mb-2">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">5</div>
                </div>
                <div class="progress mb-2">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 20%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">1</div>
                </div>
            </div>
        </div>
    </section> --}}
    @include('layouts.footer')

    <script src="{{ asset('paper') }}/js/core/jquery.min.js"></script>
    <script src="{{ asset('paper') }}/js/core/popper.min.js"></script>
    <script src="{{ asset('paper') }}/js/core/bootstrap.min.js"></script>
    <script src="{{ asset('paper') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <script src="{{ asset('paper') }}/js/paper-dashboard.js" type="text/javascript"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        $(document).ready(() => {
            $('a').on('click', function(e) {
                if (this.hash !== "") {
                    e.preventDefault();
                    var hash = this.hash;

                    $('html, body').animate({
                        scrollTop: $(hash).offset().top - $('nav').outerHeight()
                    }, 800);
                    $('.navbar-toggler:not(.collapsed):visible').click()
                }
            });

            AOS.init({
                duration: 1500,
            });

            $('.navbar-toggler').click(() => {
                setTimeout(()=>{
                    if($('.navbar-toggler.collapsed').length != 0){
                        $('.navbar').attr('style', 'background-color: transparent!important;');
                    }else{
                        $('.navbar').attr('style', 'background-color: rgba(0, 0, 0, 0.5)!important;');
                    }
                }, 100)
            });

            $(window).scroll(() => {
                var scroll = $(window).scrollTop();
                if(scroll < 1){
                    if($(window).width() < 990){
                        $('.navbar').attr('style', 'background-color: rgba(0, 0, 0, 0.5)!important;');
                        $('#backToTop').attr('style', 'opacity: 1!important;background-color: rgba(0, 0, 0, 0.5)!important;');
                    }else{
                        $('.navbar').attr('style', 'background-color: transparent!important;');
                        $('#backToTop').attr('style', 'opacity: 0!important;');
                    }
                }else{
                    $('.navbar').attr('style', 'background-color: rgba(0, 0, 0, 0.5)!important;');
                    $('#backToTop').attr('style', 'opacity: 1!important;background-color: rgba(0, 0, 0, 0.5)!important;');
                }
            })
        })
    </script>
    <!-- Messenger Chat Plugin Code -->
    <div id="fb-root"></div>

    <!-- Your Chat Plugin code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "116671301300111");
      chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v15.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
</body>

</html>