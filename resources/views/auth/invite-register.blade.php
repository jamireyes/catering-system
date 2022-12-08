@extends('layouts.app', [
    'class' => 'register-page',
    'backgroundImagePath' => ''
])

@section('content')
    <div class="content">
        <div class="card">
            <div class="p-4 w-100">
                <div>
                    <h4 >{{ __('Sign Up') }}</h4>
                    <p class="text-muted">Create an <span class="text-warning">administration</span> account!</p>
                </div>
                <form class="form" method="POST" action="">
                    @csrf
                    <input type="hidden" name="code" value="{{ request()->get('code') }}">
                    <div class="input-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="nc-icon nc-single-02"></i>
                            </span>
                        </div>
                        <input name="name" type="text" class="form-control" placeholder="Name" value="{{ old('name') }}" required autofocus>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="nc-icon nc-email-85"></i>
                            </span>
                        </div>
                        <input name="email" type="email" class="form-control" placeholder="Email" required value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="input-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="nc-icon nc-key-25"></i>
                            </span>
                        </div>
                        <input name="password" type="password" class="form-control" placeholder="Password" required>
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
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="nc-icon nc-key-25"></i>
                            </span>
                        </div>
                        <input name="password_confirmation" type="password" class="form-control" placeholder="Password confirmation" required>
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
                        @if ($errors->has('password_confirmation'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-check text-left">
                        <label class="form-check-label ml-0">
                            <input class="form-check-input" name="agree_terms_and_conditions" type="checkbox">
                            <span class="form-check-sign"></span>
                                {{ __('I agree to the') }}
                            <a href="#something">{{ __('terms and conditions') }}</a>.
                        </label>
                        @if ($errors->has('agree_terms_and_conditions'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('agree_terms_and_conditions') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-warning my-4">{{ __('Get Started') }}</button>
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
        })
    </script>
@endpush
