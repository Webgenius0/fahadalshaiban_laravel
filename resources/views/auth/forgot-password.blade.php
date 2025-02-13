@extends('auth.app')

@section('content')
<section class="authentication">
    <div class="authentication-box">
        <div class="authentication-box-header">
            <img src="{{ asset('frontend') }}/images/favicon.png" alt="logo" />
            <h4>Forgot Password</h4>
        </div>

        <form class="authentication-form" method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="input-wrapper-wrapper mb-4" >
                <div class="input-wrapper">
                    <label>Email Address</label>
                    <input type="email" placeholder="johndoe@email.com" name="email" />
                </div>
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button class="auth-submit-btn">Send Password Reset Link</button>
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