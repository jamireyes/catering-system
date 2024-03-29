@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'profile'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-10 mx-auto">
                @if (session('status'))
                    <script type="text/javascript">
                        function message() {
                            Swal.fire({
                                icon: 'success',
                                text: "{{ session('status') }}",
                            });
                        }

                        window.onload = message
                    </script>
                @endif

                @if (session('password_status'))
                    <script type="text/javascript">
                        function message() {
                            Swal.fire({
                                icon: 'success',
                                text: "{{ session('password_status') }}",
                            });
                        }

                        window.onload = message
                    </script>
                @endif
            </div>
        </div>
        <div class="row justify-content-center">
            @if(Auth::user()->role != 'USER')
                <div class="col-md-4">
                    <div class="card card-user">
                        <div class="image"></div>
                        <div class="author mx-3">
                            @if(Auth::user()->image)
                            <div class="user-wrapper">
                                <div class="user-image">
                                    <img class="avatar border-gray bg-light" src="{{ Storage::disk('spaces')->url(Auth::user()->image) }}" alt="profile_image">
                                    <span>
                                        <svg viewBox="0 0 24 24" width="18" height="18" stroke="gray" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    </span>
                                </div>
                            </div>
                            @endif
                            <h5 class="text-primary mt-2">Welcome, {{ Auth::user()->name }}!</h5>
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
                            {{-- <span class="badge badge-pill badge-primary mb-4">{{ Auth::user()->role }}</span> --}}
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
                    </div>
                </div>
            @endif
            <div class="col-md-6">
                <div class="row">
                    <form class="update-profile col-md-12" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card py-2">
                            <div class="card-header">
                                <h5 class="text-center">{{ __('Edit Profile') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>{{ __('Name') }}</label>
                                    <input type="text" name="name" class="form-control" placeholder="Name" value="{{ auth()->user()->name }}" required>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>{{ __('Email') }}</label>
                                        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ auth()->user()->email }}" required>
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>{{ __('Phone Number') }}</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">+63</span>
                                            </div>
                                            <input type="number" name="phone_number" class="form-control" placeholder="Phone Number" value="{{ auth()->user()->phone_number }}" required>
                                            @if ($errors->has('phone_number'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('phone_number') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>{{ __('Address Line 1') }}</label>
                                    <input type="text" name="address_1" class="form-control" placeholder="Address Line 1" value="{{ auth()->user()->address_1 }}" required>
                                    @if ($errors->has('address_1'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('address_1') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>{{ __('Address Line 2') }}</label>
                                    <input type="text" name="address_2" class="form-control" placeholder="Address Line 2" value="{{ auth()->user()->address_2 }}" required>
                                    @if ($errors->has('address_2'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('address_2') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>{{ __('City') }}</label>
                                        <input type="text" name="city" class="form-control" placeholder="City" value="{{ auth()->user()->city }}" required>
                                        @if ($errors->has('city'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('city') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>{{ __('Province') }}</label>
                                        <input type="text" name="state" class="form-control" placeholder="Province" value="{{ auth()->user()->state }}" required>
                                        @if ($errors->has('state'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('state') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>{{ __('Zipcode') }}</label>
                                        <input type="number" name="zipcode" class="form-control" placeholder="Zipcode" value="{{ auth()->user()->zipcode }}" required>
                                        @if ($errors->has('zipcode'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('zipcode') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button type="button" class="btn btn-info">{{ __('Save') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form class="change-password col-md-12" action="{{ route('profile.password') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card py-2">
                            <div class="card-header text-center">
                                <h5>{{ __('Change Password') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <label class="col-md-3 col-form-label">{{ __('Old Password') }}</label>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="password" name="old_password" class="form-control" placeholder="Old password" required>
                                        </div>
                                        @if ($errors->has('old_password'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('old_password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-3 col-form-label">{{ __('New Password') }}</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="noeye">
                                                        <svg viewBox="0 0 24 24" width="15" height="15" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>
                                                    </i>
                                                    <i class="eye" style="display: none;">
                                                        <svg viewBox="0 0 24 24" width="15" height="15" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                                    </i>
                                                </span>
                                            </div>
                                        </div>
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-3 col-form-label">{{ __('Confirm Password') }}</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="noeye">
                                                        <svg viewBox="0 0 24 24" width="15" height="15" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>
                                                    </i>
                                                    <i class="eye" style="display: none;">
                                                        <svg viewBox="0 0 24 24" width="15" height="15" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                                    </i>
                                                </span>
                                            </div>
                                        </div>
                                        @if ($errors->has('password_confirmation'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button type="button" class="btn btn-info">{{ __('Submit') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    @if (Auth::user()->role == 'ADMIN')
                        <form class="send-invite col-md-12" action="{{ route('invite.generateInvite') }}" method="POST">
                            <div class="card py-2">
                                <div class="card-header">
                                    <h5 class="text-center">Invite Admin Registration</h5>
                                </div>
                                <div class="card-body">
                                    @csrf
                                    <div class="row">
                                        <label class="col-md-3 col-form-label">{{ __('Send Invitation') }}</label>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="email" name="email_invitation" class="form-control" placeholder="Enter Email Address" required>
                                                @if ($errors->has('email_invitation'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('email_invitation') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <button type="button" class="btn btn-info">{{ __('Send') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @if (Auth::user()->role != 'USER')
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
        })
    </script>
    @endif
    <script>
        $(document).ready(() => {   
            $('[name="password"] + .input-group-append i').click(function(){
                $('[name="password"] + .input-group-append .noeye').toggle()
                $('[name="password"] + .input-group-append .eye').toggle()

                var type = ($('[name="password"]').attr('type') == 'password') ? 'text' : 'password'
                $('[name="password"]').prop('type', type)
            })

            $('[name="password_confirmation"] + .input-group-append i').click(function(){
                $('[name="password_confirmation"] + .input-group-append .noeye').toggle()
                $('[name="password_confirmation"] + .input-group-append .eye').toggle()

                var type = ($('[name="password_confirmation"]').attr('type') == 'password') ? 'text' : 'password'
                $('[name="password_confirmation"]').prop('type', type)
            })

            $('.update-profile [type="button"]').click(function(e){
                e.preventDefault();

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Save'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        let timerInterval
                        Swal.fire({
                            title: 'Processing...',
                            html: 'Do not refresh the page. Thank you!',
                            timer: 1500,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading()
                                const b = Swal.getHtmlContainer().querySelector('b')
                                timerInterval = setInterval(() => {
                                b.textContent = Swal.getTimerLeft()
                                }, 100)
                            },
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        })

                        setTimeout(() => {
                            $('.update-profile').submit();
                        }, 1500);
                    }
                })
            })
            
            $('.change-password [type="button"]').click(function(e){
                e.preventDefault();

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Save Changes'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        let timerInterval
                        Swal.fire({
                            title: 'Processing...',
                            html: 'Do not refresh the page. Thank you!',
                            timer: 1500,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading()
                                const b = Swal.getHtmlContainer().querySelector('b')
                                timerInterval = setInterval(() => {
                                b.textContent = Swal.getTimerLeft()
                                }, 100)
                            },
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        })

                        setTimeout(() => {
                            $('.change-password').submit();
                        }, 1500);
                    }
                })
            })

            $('.send-invite [type="button"]').click(function(e){
                e.preventDefault();

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Send Invite'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        let timerInterval
                        Swal.fire({
                            title: 'Processing...',
                            html: 'Do not refresh the page. Thank you!',
                            timer: 1500,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading()
                                const b = Swal.getHtmlContainer().querySelector('b')
                                timerInterval = setInterval(() => {
                                b.textContent = Swal.getTimerLeft()
                                }, 100)
                            },
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        })

                        setTimeout(() => {
                            $('.send-invite').submit();
                        }, 1500);
                    }
                })
            })
        })
    </script>
@endpush