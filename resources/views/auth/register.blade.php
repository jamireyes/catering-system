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
                    <p class="text-muted">Have an account? <a href="{{ route('login') }}">Login here!</a></p>
                </div>
                <form class="form" method="POST" action="{{ route('register') }}">
                    @csrf
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
                        @if ($errors->has('password_confirmation'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="nc-icon nc-badge"></i>
                            </span>
                        </div>
                        <select name="role" class="form-control" required>
                            <option value="USER">USER</option>
                            <option value="SELLER">SELLER</option>
                            <option value="ADMIN">ADMIN</option>
                        </select>
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
                        <button type="submit" class="btn btn-info my-4">{{ __('Get Started') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div> 
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            
        });
    </script>
@endpush
