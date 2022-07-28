@extends('layouts.app', [
    'class' => 'lock-page',
    'elementActive' => 'lock-page',
    'backgroundImagePath' => ''
])

@section('content')
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <div style="z-index:10;" class="position-absolute w-100 h-100 d-flex justify-content-center align-items-center text-center">
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
@endsection

@push('scripts')
    <script>
        $(document).ready(() => {
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
                if(scroll < 10){
                    if($(window).width() < 990){
                        $('.navbar').attr('style', 'background-color: rgba(0, 0, 0, 0.5)!important;');
                    }else{
                        $('.navbar').attr('style', 'background-color: transparent!important;');
                    }
                } else{
                    $('.navbar').attr('style', 'background-color: rgba(0, 0, 0, 0.5)!important;');
                }
            })
        })
    </script>
@endpush