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
    
    <link href="{{ asset('paper') }}/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('paper') }}/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
    <link href="{{ asset('assets') }}/css/custom.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body class="welcome-page position-relative">
    <nav class="navbar navbar-expand-lg py-4 m-0 fixed-top">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </button>
            <div class="navbar-wrapper">
                <a href="{{ route('welcome') }}"><img src="../assets/img/banner.png" height="40" alt="Logo"></a>
            </div>
            
            <div style="background-color:transparent;width:37px;"></div>
            <div class="collapse navbar-collapse justify-content-between" id="navigation">
                <ul id="nav-left" class="navbar-nav">
                    <li class="nav-item">
                        <a href="{{ route('store') }}" class="nav-link">{{ __('Store') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="#about" class="nav-link">{{ __('About') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="#featured" class="nav-link">{{ __('Featured') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="#feedback" class="nav-link">{{ __('Feedback') }}</a>
                    </li>
                </ul>
                <ul id="nav-right" class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="{{ route('cart') }}" class="nav-link">{{ __('Cart') }}</a>
                    </li>
                    @guest
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">
                                {{ __('Login') }}
                            </a>
                        </li>
                    @endguest
                    @auth
                        <li class="nav-item btn-rotate dropdown">
                            <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink2"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ __('Account') }}
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
        </div>
    </nav>

    <div class="full-page section-image" style="height:100vh;!important">
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
                        <button class="btn btn-warning" onclick="alert('hello')">Reserve Now</button>
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

        <div class="container">
            {{-- About section --}}
            <section id="about" class="my-5 py-5" data-aos="fade-up">
                <div class="d-flex flex-column justify-content-center text-center">
                    <h5 class="text-warning text-uppercase text-spacing-5">Serving you since 2022</h5>
                    <h1 class="my-4">Welcome to Three Catering Services</h1>
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
                        <h5 class="text-muted text-uppercase mt-3">Budget Frienly</h5>
                    </div>
                    <div class="col-md-4 text-center py-5">
                        <img src="{{ asset('assets') }}/img/about/circle.png" alt="circle" class="position-relative">
                        <img src="{{ asset('assets') }}/img/about/shape3.png" alt="shape3" class="position-absolute float-up" style="top:38%; left:50%; transform: translate(-50%, -50%);">
                        <h5 class="text-muted text-uppercase mt-3">Premium Services</h5>
                    </div>
                </div>
            </section>
            
            <hr>

            {{-- Featured section --}}
            <section id="featured" class="mb-5 py-5" data-aos="fade-up">
                <div class="text-center pb-4">
                    <h4 class="text-muted">Featured Packges</h4>
                </div>
                <div class="d-flex justify-content-between text-center">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="card text-white bg-dark rounded m-3">
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
                        <div class="col-lg-4 col-md-6">
                            <div class="card text-white bg-dark rounded m-3">
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
                        <div class="col-lg-4 col-md-6">
                            <div class="card text-white bg-dark rounded m-3">
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
            </section>
            
            <hr>

            {{-- Feedback section --}}
            <section id="feedback" class="py-5" data-aos="fade-up">
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
            </section>
        </div>
        <div class="position-fixed" style="bottom:10px;right:10px;z-index:1020!important;">
            <a id="backToTop" href="#carouselExampleIndicators" class="btn" style="opacity: 0!important;">
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><line x1="12" y1="19" x2="12" y2="5"></line><polyline points="5 12 12 5 19 12"></polyline></svg>
            </a>
        </div>
    </div>

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
</body>

</html>