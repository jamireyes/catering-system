@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'dashboard'
])

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="p-0 jumbotron bg-white shadow-sm rounded d-flex justify-content-center flex-column flex-md-row">
                        <div class="m-3 text-center">
                            <img src="{{ asset('assets/img/svg/happy_news.svg') }}" alt="welcome" style="height: 12rem;">
                        </div>
                        <div class="m-3 d-flex flex-column justify-content-between">
                            <div class="text-center text-md-left text-gray">
                                <h2 class="mb-2">Welcome, {{ Auth::user()->name }}!</h2>
                                <p class="lead">Check out our packages.</p>
                            </div>
                            <div class="text-center text-md-left">
                                <a class="btn btn-success btn-lg" href="/" role="button">Start Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-user">
                        <div class="image"></div>
                        <div class="author mx-3">
                            @if(Auth::user()->image)
                            <div class="user-wrapper">
                                <div class="user-image">
                                    <img class="avatar border-gray bg-light" src="{{asset('/storage/images/'.Auth::user()->image)}}" alt="profile_image">
                                    <span>
                                        <svg viewBox="0 0 24 24" width="18" height="18" stroke="gray" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    </span>
                                </div>
                            </div>
                            @endif
                            <h5 class="text-gray mt-2 text-lg">{{ Auth::user()->name }}</h5>
                            <form id="image-form" class="d-none" action="{{ route('profile.upload') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="d-flex align-items-center mb-3">
                                    <div class="input-file">
                                        <div class="py-1 pl-2">
                                            <input id="upload-btn" type="file" name="image" hidden>
                                            <label for="upload-btn" class="btn btn-sm btn-outline-default my-1">Select</label>
                                        </div>
                                        <div class="px-2">
                                            <span id="file-chosen" class="m-0">No file uploaded</span>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-info" value="Upload">
                                        <svg viewBox="0 0 24 24" width="15" height="15" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <hr class="my-0">
                        <div class="card-body py-3" style="min-height:auto!important;">
                            @if(Auth::user()->full_address != '    ')
                                <div class="row">
                                    <div class="col-2 text-right">
                                        <span class="nc-icon nc-pin-3"/>
                                    </div>
                                    <small class="col-10 text-left">{{ Auth::user()->full_address }}</small>
                                </div>
                            @endif
                            @if(Auth::user()->phone_number)
                                <div class="row my-2">
                                    <div class="col-2 text-right">
                                        <span class="nc-icon nc-send"/>
                                    </div>
                                    <small class="col-10 text-left">+63 {{ Auth::user()->phone_number }}</small>
                                </div>
                            @endif
                            @if(Auth::user()->email)
                                <div class="row">
                                    <div class="col-2 text-right">
                                        <span class="nc-icon nc-email-85"/>
                                    </div>
                                    <small class="col-10 text-left">{{ Auth::user()->email }}</small>
                                </div>
                            @endif
                        </div>
                        <hr>
                        <div class="row mx-3 mb-3">
                            @foreach ($orders as $order)
                                @if ($order->status == 'CONFIRMED')   
                                <div class="col-4 px-1">
                                    <div class="border rounded">
                                        <div class="text-center">
                                            <div class="pt-2">
                                                <i class="fa-solid fa-circle-check text-success text-xl"></i>
                                                <p class="text-gray m-0 ml-1">Confirmed</p>
                                            </div>
                                            <hr class="my-2">
                                            <p class="mb-1">{{ $order->count }}</p>
                                        </div>
                                    </div>
                                </div>
                                @elseif ($order->status == 'PENDING')
                                    <div class="col-4 px-1">
                                        <div class="border rounded">
                                            <div class="text-center">
                                                <div class="pt-2">
                                                    <i class="fa-solid fa-clock text-warning text-xl"></i>
                                                    <p class="text-gray m-0 ml-1">Pending</p>
                                                </div>
                                                <hr class="my-2">
                                                <p class="mb-1">{{ $order->count }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @elseif ($order->status == 'CANCELLED')
                                    <div class="col-4 px-1">
                                        <div class="border rounded">
                                            <div class="text-center">
                                                <div class="pt-2">
                                                    <i class="fa-solid fa-circle-xmark text-danger text-xl"></i>
                                                    <p class="text-gray m-0 ml-1">Cancelled</p>
                                                </div>
                                                <hr class="my-2">
                                                <p class="mb-1">{{ $order->count }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <p class="text-muted text-center">
                                <i class="fa-solid fa-heart text-danger"></i>
                                Favorites
                            </p>
                            <hr>
                            <div class="fav-wrapper">
                                @foreach ($favorites as $fav)
                                    <a href="{{ route('shop.show', ['shop' => $fav->package_id]) }}" class="fav-card" style="text-decoration: none;">
                                        <div class="card bg-light shadow-md mb-3">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <p class="m-0 text-gray">{{ $fav->name }}</p>
                                                        <small class="text-muted">{{ $fav->pax }} PAX</small>
                                                    </div>
                                                    <div class="text-right">
                                                        @if ($fav->discount)
                                                            <p class="m-0 text-muted">
                                                                <del>
                                                                    ₱ {{ number_format($fav->price, 2, '.', ',') }}
                                                                </del>
                                                            </p>
                                                            <p class="m-0 text-success">₱ {{ number_format(($fav->price * (1 - $fav->discount / 100)), 2, '.', ',') }}</p>
                                                        @else
                                                            <p class="m-0 text-gray">₱ {{ number_format(($fav->price * (1 - $fav->discount / 100)), 2, '.', ',') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="team-wrapper">
                        @foreach ($teams as $team)
                            <div class="team-card card">
                                <div class="card-header">
                                    <p class="text-muted text-center">
                                        <i class="fa-solid fa-user-tie text-info"></i>
                                        Team Members
                                    </p>
                                    <hr class="m-0 mb-3">
                                    <small class="text-muted text-center mb-2">{{ $team->package_name }} ({{ $team->pax }} PAX)</small>
                                    <div class="d-flex justify-content-between">
                                        <small class="text-muted mb-2">Order No: {{ $team->order_id }}</small>
                                        <small class="text-muted mb-2">Date: {{ Carbon\Carbon::parse($team->date)->toFormattedDateString() }}</small>
                                    </div>
                                </div>
                                <div class="card-body text-gray">
                                    <div class="table-responsive-sm">
                                        <table class="table table-borderless">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Role</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($members as $member)
                                                    @if ($team->team_id == $member->team_id)
                                                        <tr>
                                                            <td>{{ $member->name }}</td>
                                                            <td>{{ $member->role }}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(() => {

            const uploadBtn = document.getElementById('upload-btn');

            const fileChosen = document.getElementById('file-chosen');

            uploadBtn.addEventListener('change', function(){
                fileChosen.textContent = this.files[0].name
            })

            $('.user-image span').click(() => {
                $('#image-form').toggleClass('d-none');
            })    
            
            $('.fav-wrapper').perfectScrollbar();
            $('.team-wrapper').perfectScrollbar();
        })
    </script>
@endpush