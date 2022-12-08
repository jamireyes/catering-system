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

@push('scripts')
    <script>
        $(document).ready(function() {
           $('[name="password"] + .input-group-append i').click(function(){
                $('.noeye').toggle()
                $('.eye').toggle()

                var type = ($('[name="password"]').attr('type') == 'password') ? 'text' : 'password'
                $('[name="password"]').prop('type', type)
           })
        })
    </script>
@endpush