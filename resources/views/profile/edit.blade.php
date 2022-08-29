@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'profile'
])

@section('content')
    <div class="content">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @if (session('password_status'))
            <div class="alert alert-success" role="alert">
                {{ session('password_status') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-4">
                <div class="card card-user">
                    <div class="image">
                        <img src="{{ asset('assets/img/catering-img-2.jpg') }}" alt="...">
                    </div>
                    <div class="author">
                        <img class="avatar border-gray bg-light" src="{{ asset('assets/img/user.png') }}" alt="...">
                        <h5 class="text-primary mt-2">Welcome, {{ Auth::user()->name }}!</h5>
                        <span class="badge badge-pill badge-primary mb-4">{{ Auth::user()->role }}</span>
                    </div>
                    <hr>
                    <div class="card-body" style="min-height:auto!important;">
                        <div class="row">
                            <div class="col-2 text-right">
                                <span class="nc-icon nc-pin-3"/>
                            </div>
                            <small class="col-10 text-left">{{ Auth::user()->full_address }}</small>
                        </div>
                        <div class="row my-2">
                            <div class="col-2 text-right">
                                <span class="nc-icon nc-send"/>
                            </div>
                            <small class="col-10 text-left">+63 {{ Auth::user()->phone_number }}</small>
                        </div>
                        <div class="row">
                            <div class="col-2 text-right">
                                <span class="nc-icon nc-email-85"/>
                            </div>
                            <small class="col-10 text-left">{{ Auth::user()->email }}</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <form class="col-md-12" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card py-2">
                        <div class="card-header">
                            <h5 class="title text-center">{{ __('Edit Profile') }}</h5>
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
                                    <input type="text" name="phone_number" class="form-control" placeholder="Phone Number" value="0{{ auth()->user()->phone_number }}" required>
                                    @if ($errors->has('phone_number'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('phone_number') }}</strong>
                                        </span>
                                    @endif
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
                                    <input type="text" name="zipcode" class="form-control" placeholder="Zipcode" value="{{ auth()->user()->zipcode }}" required>
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
                                    <button type="submit" class="btn btn-info">{{ __('Save Changes') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <form class="col-md-12" action="{{ route('profile.password') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card py-2 text-center">
                        <div class="card-header">
                            <h5 class="title">{{ __('Change Password') }}</h5>
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
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('Password Confirmation') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="Password Confirmation" required>
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
                                    <button type="submit" class="btn btn-info">{{ __('Save Changes') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection