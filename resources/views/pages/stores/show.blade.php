@extends('layouts.app', [
    'class' => 'lock-page',
    'elementActive' => 'catering-page',
    'backgroundImagePath' => ''
])

@section('content')
    <div class="container-fluid">
        @foreach ($store as $s)
            <div class="py-4">
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('welcome') }}" class="text-muted">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('store.index') }}" class="text-muted">Stores</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a class="text-dark">{{ $s->name }}</a> 
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="card card-user">
                            <div class="card-body" style="min-height:0 !important;">
                                <div class="d-flex flex-column flex-lg-row align-items-center">
                                    @if($s->image)
                                        <img class="avatar" src="{{asset('/storage/images/'.$s->image)}}" alt="profile_image">
                                    @endif
                                    <div class="ml-3 text-gray">
                                        <h5 class="text-lg text-center text-lg-left">{{ $s->name }}</h5>
                                        <table>
                                            <tbody>
                                                @if($s->full_address != ' ')
                                                    <tr>
                                                        <td class="align-top pt-1 pr-3"><span class="nc-icon nc-pin-3"/></td>
                                                        <td class="align-middle"><small>{{ $s->full_address }}</small></td>
                                                    </tr>
                                                @endif
                                                @if($s->phone_number)
                                                    <tr>
                                                        <td class="align-top pt-1 pr-3"><span class="nc-icon nc-send"/></td>
                                                        <td class="align-middle"><small>+63 {{ $s->phone_number }}</small></td>
                                                    </tr>
                                                @endif
                                                @if($s->email)
                                                    <tr>
                                                        <td class="align-top pt-1 pr-3"><span class="nc-icon nc-email-85"/></td>
                                                        <td class="align-middle"><small>{{ $s->email }}</small></td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card customer-review">
                            <div class="card-body">
                                <h5 class="text-center text-lg">Customer Reviews</h5>
                                <div class="header-rating p-2">
                                    <div class="header-rating-wrapper">
                                        <div class="star-rating">
                                            <div class="stars-inner"></div>
                                        </div>
                                        <div class="overall-rating" data-avg="{{ $avg_rating }}"></div>
                                    </div>
                                </div>
                                <div class="progress-rating">
                                    @foreach ($ratings as $rating)
                                        @if($rating['rating'] == 5) 
                                            <div class="progress-wrapper">
                                                <p>5</p>
                                                <div class="progress">
                                                    <div class="rating_5 progress-bar" role="progressbar" data-id="{{ $rating['rating'] }}" data-url="{{ route('feedback.show', ['feedback' => $rating['rating']]) }}" aria-valuenow="{{ $rating['total_rating'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        @elseif($rating['rating'] == 4)
                                            <div class="progress-wrapper">
                                                <p>4</p>
                                                <div class="progress">
                                                    <div class="rating_4 progress-bar" role="progressbar" data-id="{{ $rating['rating'] }}" data-url="{{ route('feedback.show', ['feedback' => $rating['rating']]) }}" aria-valuenow="{{ $rating['total_rating'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        @elseif($rating['rating'] == 3)
                                            <div class="progress-wrapper">
                                                <p>3</p>
                                                <div class="progress">
                                                    <div class="rating_3 progress-bar" role="progressbar" data-id="{{ $rating['rating'] }}" data-url="{{ route('feedback.show', ['feedback' => $rating['rating']]) }}" aria-valuenow="{{ $rating['total_rating'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        @elseif($rating['rating'] == 2)
                                            <div class="progress-wrapper">
                                                <p>2</p>
                                                <div class="progress">
                                                    <div class="rating_2 progress-bar" role="progressbar" data-id="{{ $rating['rating'] }}" data-url="{{ route('feedback.show', ['feedback' => $rating['rating']]) }}" aria-valuenow="{{ $rating['total_rating'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        @elseif($rating['rating'] == 1)
                                            <div class="progress-wrapper">
                                                <p>1</p>
                                                <div class="progress">
                                                    <div class="rating_1 progress-bar" role="progressbar" data-id="{{ $rating['rating'] }}" data-url="{{ route('feedback.show', ['feedback' => $rating['rating']]) }}" aria-valuenow="{{ $rating['total_rating'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <hr>
                                <div class="feedback">
                                    <form action="{{ route('feedback.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $s->id }}">
                                        <div class="form-group">
                                            <label for="name">Name (Optional)</label>
                                            <input type="text" name="name" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="comment">Comment</label>
                                            <textarea class="form-control" name="comment" rows="3" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="comment">Rating</label>
                                            <div class="input-rating">
                                                <input type="radio" name="rating" value="5" id="5"><label for="5"><i class="fa-regular fa-star"></i></label>
                                                <input type="radio" name="rating" value="4" id="4"><label for="4"><i class="fa-regular fa-star"></i></label>
                                                <input type="radio" name="rating" value="3" id="3"><label for="3"><i class="fa-regular fa-star"></i></label>
                                                <input type="radio" name="rating" value="2" id="2"><label for="2"><i class="fa-regular fa-star"></i></label>
                                                <input type="radio" name="rating" value="1" id="1"><label for="1"><i class="fa-regular fa-star"></i></label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-default btn-block mt-4">Submit</button>
                                    </form>
                                    @include('components.alerts')
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="row">
                            @foreach ($packages as $package)
                                <div class="col-lg-4 col-md-6 col-sm-12">
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
              
            <div class="modal fade" id="rating-modal" tabindex="-1" role="dialog" aria-labelledby="rating-modal-label" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-lg" id="rating-modal-label"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{-- <div class="comments">
                                <p class="comment-name">Jami</p>
                                <div class="star-rating">
                                    <div class="stars-inner"></div><span class="comment-date"> - Dec 12, 2022</span>
                                </div>
                                <p class="comment-body mb-0">Excellent</p>
                            </div> --}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(() => {

            function ratings() {
                const rating_5 = $('.rating_5').attr('aria-valuenow')
                const rating_4 = $('.rating_4').attr('aria-valuenow')
                const rating_3 = $('.rating_3').attr('aria-valuenow')
                const rating_2 = $('.rating_2').attr('aria-valuenow')
                const rating_1 = $('.rating_1').attr('aria-valuenow')

                const total = parseInt(rating_5) + parseInt(rating_4) + parseInt(rating_3) + parseInt(rating_2) + parseInt(rating_1);

                $('.rating_5').css('width', ((rating_5 / total) * 100)+'%')
                $('.rating_4').css('width', ((rating_4 / total) * 100)+'%')
                $('.rating_3').css('width', ((rating_3 / total) * 100)+'%')
                $('.rating_2').css('width', ((rating_2 / total) * 100)+'%')
                $('.rating_1').css('width', ((rating_1 / total) * 100)+'%')
            }

            function avg_rating() {
                const avg_rating = $('.overall-rating').data('avg')
                const avg_rating_percentage = `${(avg_rating / 5) * 100}%`

                $('.overall-rating').html(`<p class="text-gray m-0 ml-2">${avg_rating} out of 5</p>`);
                $('.header-rating-wrapper .stars-inner').css('width', avg_rating_percentage)
            }

            $('.progress-bar[class*="rating"]').click(function(){
                const id = $(this).data('id')
                const route = $(this).data('url')
                var html = '';

                $.ajax({
                    url: route,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data)
                        $('#rating-modal').modal('toggle')
                        $('#rating-modal-label').empty()
                        $('#rating-modal .modal-body').empty()
                        $('#rating-modal-label').append(`${id} Star`)
                        for(let row of data) {
                            var tempRating = ((row.rating / 5) * 100) + '%'
                            var tempDate = (new Date(row.created_at)).toDateString()
                            $('#rating-modal .modal-body').append(`<div class="comments"><p class="comment-name">${row.name}<span class="comment-date"> - ${tempDate}</span></p><div class="star-rating"><div class="stars-inner" style="width:${tempRating}"></div></div><p class="comment-body mb-0">${row.comment}</p></div>`)
                        }
                    }
                })
            })
            // $('#rating-modal').modal('toggle')
            ratings()
            avg_rating()
        })
    </script>
@endpush