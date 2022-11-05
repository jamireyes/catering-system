@extends('layouts.app', [
    'class' => 'login-page',
    'backgroundImagePath' => ''
])

@section('content')
    <div class="content">
        <div class="card">
            <div class="p-4 w-100">
                <form class="form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div>
                        <div>
                            <h4>{{ __('Login') }}</h4>
                            <p class="text-muted">Don't have an account? <a href="{{ route('register') }}">Sign up now!</a></p>
                        </div>
                        <div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="nc-icon nc-single-02"></i>
                                    </span>
                                </div>
                                <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" type="email" name="email" value="{{ old('email') }}" required autofocus>
                                
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="nc-icon nc-key-25"></i>
                                    </span>
                                </div>
                                <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Password') }}" type="password" required>
                                
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <div class="form-group">
                                    <div class="form-check">
                                            <label class="form-check-label">
                                            <input class="form-check-input" name="remember" type="checkbox" value="" {{ old('remember') ? 'checked' : '' }}>
                                            <span class="form-check-sign"></span>
                                            {{ __('Remember me') }}
                                        </label>
                                    </div>
                                </div>
                                <p>
                                    <a href="{{ route('password.request') }}">{{ __('Forgot password?') }}</a>
                                </p>
                            </div>
                        </div>

                        <div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-info mb-3">{{ __('Sign in') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection