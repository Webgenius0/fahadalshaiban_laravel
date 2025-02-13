@extends('auth.app')

@section('content')
<section class="authentication">
    <div class="authentication-box">
        <div class="authentication-box-header">
            <img src="{{ asset('frontend') }}/images/favicon.png" alt="logo" />
            <h4>Verify Your Phone Number</h4>
        </div>

        <div class="verify-divider-line"></div>
        <h5 class="notify-alert">
            A verification code has been sent to @peatix.com
        </h5>
        <p class="remaining-time-text">
            Please check your inbox and enter the verification code below to
            verify your email address. The code will expire in <span>4:59</span>
        </p>

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <div class="code-container">
                <input type="tel" maxlength="1" class="code-input" />
                <input type="tel" maxlength="1" class="code-input" />
                <input type="tel" maxlength="1" class="code-input" />
                <input type="tel" maxlength="1" class="code-input" />
                <input type="tel" maxlength="1" class="code-input" />
                <input type="tel" maxlength="1" class="code-input" />
            </div>
            <a href="{{ route('page.started.form') }}" class="verify-button text-center">Verify</a>
        </form>

        <!-- home-tutorials -->
        <div class="home-tutorials-wrapper">
            <a href="{{ route('home') }}">Home</a>
            <div data-bs-toggle="modal" data-bs-target="#videoModal">
                Tutorials
            </div>
        </div>
        <!-- home-tutorials -->
    </div>
    <div class="greeting-box">
        <div class="greeting-content">
            <h2>Welcome</h2>
            <p>New Here? Create a account to start a new campaign?</p>
        </div>
    </div>
</section>
@endsection
