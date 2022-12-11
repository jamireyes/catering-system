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
                    <div class="col-lg-4">
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
                                            <i class="fa-solid fa-star checked"></i>
                                            <i class="fa-solid fa-star checked"></i>
                                            <i class="fa-solid fa-star checked"></i>
                                            <i class="fa-solid fa-star checked"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                        <div class="overall-rating">
                                            <p class="text-gray m-0 ml-2">4 out of 5</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress-rating">
                                    <div class="progress-wrapper">
                                        <p>5</p>
                                        <div class="progress">
                                            <div class="progress-bar w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="progress-wrapper">
                                        <p>4</p>
                                        <div class="progress">
                                            <div class="progress-bar w-75" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="progress-wrapper">
                                        <p>3</p>
                                        <div class="progress">
                                            <div class="progress-bar w-50" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="progress-wrapper">
                                        <p>2</p>
                                        <div class="progress">
                                            <div class="progress-bar w-25" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="progress-wrapper">
                                        <p>1</p>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
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
                                            <div class="star-rating input-rating">
                                                <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label>
                                                <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label>
                                                <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label>
                                                <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label>
                                                <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-default btn-block mt-4">Submit</button>
                                    </form>
                                    @include('components.alerts')
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
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
        @endforeach
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(() => {
            // $('.input-rating [type="radio"]').click(function(){

            // })
        })
    </script>
@endpush