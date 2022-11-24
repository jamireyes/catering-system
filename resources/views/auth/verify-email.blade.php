@extends('layouts.app', [
    'class' => 'lock-page',
    'backgroundImagePath' => ''
])

@section('content')
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card p-4">
                <div class="card-header">
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        {{-- <i class="nc-icon nc-alert-circle-i" style="font-size: 1.8rem;"></i> --}}
                        <img src="{{ asset('assets') }}/img/svg/undraw_mail_sent.svg" alt="Mail Sent" class="mb-4" style="height:4rem;">
                        <h5 class="mt-2 ml-2">{{ __('Email Verification') }}</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <p>
                            {{ __('Before proceeding, please check your email for a verification link. If you cannot find the verification email, please check the Junk/Spam folder.') }}
                        </p>
                        <p>
                            {{ __('If you did not receive the email, you may resend a verification link by clicking the button below.') }}
                        </p>
                    </div>
                    <form class="text-center" method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-info">{{ __('Resend Verification Email') }}</button>
                    </form>
                </div>
            </div>
            @if (session('message'))
                <div class="alert alert-success" role="alert">
                    {{ session('message') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
