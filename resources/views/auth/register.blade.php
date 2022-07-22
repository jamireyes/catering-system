@extends('layouts.app', [
    'class' => 'register-page',
    'backgroundImagePath' => ''
])

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-5 ml-auto">
                    <div class="info-area info-horizontal mt-5">
                        <div class="icon icon-primary">
                            <i class="nc-icon nc-tv-2"></i>
                        </div>
                        <div class="description">
                            <h5 class="info-title">{{ __('Marketing') }}</h5>
                            <p class="description">
                                {{ __('We\'ve created the marketing campaign of the website. It was a very interesting collaboration.') }}
                            </p>
                        </div>
                    </div>
                    <div class="info-area info-horizontal">
                        <div class="icon icon-primary">
                            <i class="nc-icon nc-html5"></i>
                        </div>
                        <div class="description">
                            <h5 class="info-title">{{ __('Fully Coded in HTML5') }}</h5>
                            <p class="description">
                                {{ __('We\'ve developed the website with HTML5 and CSS3. The client has access to the code using GitHub.') }}
                            </p>
                        </div>
                    </div>
                    <div class="info-area info-horizontal">
                        <div class="icon icon-info">
                            <i class="nc-icon nc-atom"></i>
                        </div>
                        <div class="description">
                            <h5 class="info-title">{{ __('Built Audience') }}</h5>
                            <p class="description">
                                {{ __('There is also a Fully Customizable CMS Admin Dashboard for this product.') }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mr-auto">
                    <div class="card card-signup text-center">
                        <div class="card-header ">
                            <h4 class="card-title">{{ __('Register') }}</h4>
                            <div class="social">
                                <button class="btn btn-icon btn-round btn-twitter">
                                    <i class="fa fa-twitter"></i>
                                </button>
                                <button class="btn btn-icon btn-round btn-dribbble">
                                    <i class="fa fa-dribbble"></i>
                                </button>
                                <button class="btn btn-icon btn-round btn-facebook">
                                    <i class="fa fa-facebook-f"></i>
                                </button>
                                <p class="card-description">{{ __('or be classical') }}</p>
                            </div>
                        </div>
                        <div class="card-body ">
                            <form class="form" method="POST" action="{{ route('register') }}">
                                @csrf
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="step1-tab" data-toggle="tab" href="#step1" role="tab" aria-controls="step1" aria-selected="true">Step 1</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="step2-tab" data-toggle="tab" href="#step2" role="tab" aria-controls="step2" aria-selected="false">Step 2</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="step3-tab" data-toggle="tab" href="#step3" role="tab" aria-controls="step3" aria-selected="false">Step 3</a>
                                    </li>
                                </ul>
                                <div class="tab-content pt-4" id="myTabContent">
                                    <div class="tab-pane fade show active" id="step1" role="tabpanel" aria-labelledby="step1">
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
                                    </div>
                                    <div class="tab-pane fade" id="step2" role="tabpanel" aria-labelledby="step2">
                                        <div class="input-group{{ $errors->has('address_1') ? ' has-danger' : '' }}">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    {{-- <i class="nc-icon nc-single-02"></i> --}}
                                                </span>
                                            </div>
                                            <input name="address_1" type="text" class="form-control" placeholder="Address" value="{{ old('address_1') }}" required autofocus>
                                            @if ($errors->has('address_1'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('address_1') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="step3" role="tabpanel" aria-labelledby="step3">...</div>
                                </div>
                                <div class="card-footer my-0 pl-0 pt-0">
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
                                    <button type="submit" class="btn btn-info btn-round mt-4">{{ __('Get Started') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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
