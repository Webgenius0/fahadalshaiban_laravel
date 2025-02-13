@extends('auth.app')

@section('content')
<section class="authentication">
    <div class="authentication-box">
        <div class="authentication-box-header">
            <img src="{{ asset('frontend') }}/images/favicon.png" alt="logo" />
            <h4>Create an account</h4>
        </div>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf
            <div class="input-wrapper-wrapper">
                <div class="input-wrapper">
                    <label>Email Address</label>
                    <input type="email" value="{{ old('email') }}" placeholder="johndoe@email.com" name="email" />
                </div>
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <div>
                    <div class="label-password">
                        <label>Password</label>
                    </div>
                    <div class="input-password-wrapper">
                        <input type="password" value="{{ old('password') }}" placeholder="*****" name="password" />
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="25"
                            height="24"
                            viewBox="0 0 25 24"
                            fill="none">
                            <path
                                d="M2.5 12C2.5 12 5.5 5 12.5 5C19.5 5 22.5 12 22.5 12C22.5 12 19.5 19 12.5 19C5.5 19 2.5 12 2.5 12Z"
                                stroke="#999DA3"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M12.5 15C14.1569 15 15.5 13.6569 15.5 12C15.5 10.3431 14.1569 9 12.5 9C10.8431 9 9.5 10.3431 9.5 12C9.5 13.6569 10.8431 15 12.5 15Z"
                                stroke="#999DA3"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                </div>
                @error('password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <div>
                    <div class="label-password">
                        <label>Confirm Password</label>
                    </div>
                    <div class="input-password-wrapper">
                        <input type="password" value="{{ old('password_confirmation') }}" placeholder="*****" name="password_confirmation" />
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="25"
                            height="24"
                            viewBox="0 0 25 24"
                            fill="none">
                            <path
                                d="M2.5 12C2.5 12 5.5 5 12.5 5C19.5 5 22.5 12 22.5 12C22.5 12 19.5 19 12.5 19C5.5 19 2.5 12 2.5 12Z"
                                stroke="#999DA3"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M12.5 15C14.1569 15 15.5 13.6569 15.5 12C15.5 10.3431 14.1569 9 12.5 9C10.8431 9 9.5 10.3431 9.5 12C9.5 13.6569 10.8431 15 12.5 15Z"
                                stroke="#999DA3"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                </div>
                @error('confirm_password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <p class="agree-to-terms">
                By continuing, You agree to our
                <a href="{{ route('terms.conditions') }}">terms of service</a>
            </p>

            <button type="submit" class="auth-submit-btn">Register</button>
        </form>

        <div class="divider">
            <div class="divider-line"></div>
            <span>or sign in with</span>
            <div class="divider-line"></div>
        </div>

        <button class="social-login-btn">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="25"
                height="24"
                viewBox="0 0 25 24"
                fill="none">
                <mask
                    id="mask0_515_133"
                    style="mask-type: luminance"
                    maskUnits="userSpaceOnUse"
                    x="0"
                    y="0"
                    width="25"
                    height="24">
                    <path
                        d="M24.0568 9.81819H12.875V14.4546H19.3114C18.7114 17.4 16.2023 19.0909 12.875 19.0909C8.94773 19.0909 5.78409 15.9273 5.78409 12C5.78409 8.07273 8.94773 4.90909 12.875 4.90909C14.5659 4.90909 16.0932 5.50909 17.2932 6.49091L20.7841 3C18.6568 1.14545 15.9296 0 12.875 0C6.22046 0 0.875 5.34546 0.875 12C0.875 18.6546 6.22046 24 12.875 24C18.875 24 24.3296 19.6364 24.3296 12C24.3296 11.2909 24.2205 10.5273 24.0568 9.81819Z"
                        fill="white" />
                </mask>
                <g mask="url(#mask0_515_133)">
                    <path
                        d="M-0.21582 19.091V4.90918L9.05691 12.0001L-0.21582 19.091Z"
                        fill="#FBBC05" />
                </g>
                <mask
                    id="mask1_515_133"
                    style="mask-type: luminance"
                    maskUnits="userSpaceOnUse"
                    x="0"
                    y="0"
                    width="25"
                    height="24">
                    <path
                        d="M24.0568 9.81819H12.875V14.4546H19.3114C18.7114 17.4 16.2023 19.0909 12.875 19.0909C8.94773 19.0909 5.78409 15.9273 5.78409 12C5.78409 8.07273 8.94773 4.90909 12.875 4.90909C14.5659 4.90909 16.0932 5.50909 17.2932 6.49091L20.7841 3C18.6568 1.14545 15.9296 0 12.875 0C6.22046 0 0.875 5.34546 0.875 12C0.875 18.6546 6.22046 24 12.875 24C18.875 24 24.3296 19.6364 24.3296 12C24.3296 11.2909 24.2205 10.5273 24.0568 9.81819Z"
                        fill="white" />
                </mask>
                <g mask="url(#mask1_515_133)">
                    <path
                        d="M-0.21582 4.90918L9.05691 12.0001L12.8751 8.67282L25.966 6.54555V-1.09082H-0.21582V4.90918Z"
                        fill="#E73D1C" />
                </g>
                <mask
                    id="mask2_515_133"
                    style="mask-type: luminance"
                    maskUnits="userSpaceOnUse"
                    x="0"
                    y="0"
                    width="25"
                    height="24">
                    <path
                        d="M24.0568 9.81819H12.875V14.4546H19.3114C18.7114 17.4 16.2023 19.0909 12.875 19.0909C8.94773 19.0909 5.78409 15.9273 5.78409 12C5.78409 8.07273 8.94773 4.90909 12.875 4.90909C14.5659 4.90909 16.0932 5.50909 17.2932 6.49091L20.7841 3C18.6568 1.14545 15.9296 0 12.875 0C6.22046 0 0.875 5.34546 0.875 12C0.875 18.6546 6.22046 24 12.875 24C18.875 24 24.3296 19.6364 24.3296 12C24.3296 11.2909 24.2205 10.5273 24.0568 9.81819Z"
                        fill="white" />
                </mask>
                <g mask="url(#mask2_515_133)">
                    <path
                        d="M-0.21582 19.091L16.1478 6.54555L20.4569 7.091L25.966 -1.09082V25.091H-0.21582V19.091Z"
                        fill="#34A853" />
                </g>
                <mask
                    id="mask3_515_133"
                    style="mask-type: luminance"
                    maskUnits="userSpaceOnUse"
                    x="0"
                    y="0"
                    width="25"
                    height="24">
                    <path
                        d="M24.0568 9.81819H12.875V14.4546H19.3114C18.7114 17.4 16.2023 19.0909 12.875 19.0909C8.94773 19.0909 5.78409 15.9273 5.78409 12C5.78409 8.07273 8.94773 4.90909 12.875 4.90909C14.5659 4.90909 16.0932 5.50909 17.2932 6.49091L20.7841 3C18.6568 1.14545 15.9296 0 12.875 0C6.22046 0 0.875 5.34546 0.875 12C0.875 18.6546 6.22046 24 12.875 24C18.875 24 24.3296 19.6364 24.3296 12C24.3296 11.2909 24.2205 10.5273 24.0568 9.81819Z"
                        fill="white" />
                </mask>
                <g mask="url(#mask3_515_133)">
                    <path
                        d="M25.9659 25.091L9.05682 12.0001L6.875 10.3637L25.9659 4.90918V25.091Z"
                        fill="#4285F4" />
                </g>
            </svg>
            Continue with Google
        </button>

        <div class="auth-navigate">
            <p>
                Already have an account? <a href="{{ route('login') }}">Sign in here</a>
            </p>
        </div>
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