@php
use App\Enums\PageEnum;
use App\Enums\SectionEnum;
@endphp

@extends('frontend.app', ['title' => 'Get Started'])
@section('content')
<section class="get-started">
    <div class="get-started-form-wrapper">
        <h3 class="form-title">Please Fill This Form to Get Started</h3>

        <form class="get-started-form">
            <div class="input-wrapper-large">
                <label>Company Name<span>*</span></label>
                <input type="text" placeholder="Apple.inc" />
            </div>
            <div class="input-wrapper-large">
                <label>Company Email<span>*</span></label>
                <input type="email" placeholder="adam_smith@Email.com" />
            </div>
            <div class="input-wrapper-large">
                <label>Your Password<span>*</span></label>
                <input type="password" placeholder="**********" />
            </div>
            <div class="input-wrapper-large">
                <label>Confirm Password<span>*</span></label>
                <input type="password" placeholder="**********" />
            </div>
            <div class="input-wrapper-large">
                <label>Phone Number<span>*</span></label>
                <input type="tel" placeholder="+898-2786223" />
            </div>
            <div class="input-wrapper-large">
                <label>Address<span>*</span></label>
                <input type="tel" placeholder="3/4 Street, 5 No House" />
            </div>
            <div class="input-wrapper-large">
                <label>VAT Number<span>*</span></label>
                <input type="number" placeholder="1223-1344131-12313" />
            </div>
            <div class="input-wrapper-large">
                <label>CR Document<span>*</span></label>
                <div class="upload-box">
                    <input type="file" id="file-input" />
                    <div class="upload-content">
                        <span class="upload-icon">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M19 15V17C19 18.1046 18.1046 19 17 19H7C5.89543 19 5 18.1046 5 17V15M12 15L12 5M12 5L14 7M12 5L10 7"
                                    stroke="#344051"
                                    stroke-width="1.67"
                                    stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </span>
                        <span class="upload-file-text">Upload file</span>
                    </div>
                </div>
            </div>

            <!-- if signage owner profile then  -->
            <div class="input-wrapper-large">
                <label>Advertising License Document<span>*</span></label>
                <div class="upload-box">
                    <input type="file" id="file-input" />
                    <div class="upload-content">
                        <span class="upload-icon">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M19 15V17C19 18.1046 18.1046 19 17 19H7C5.89543 19 5 18.1046 5 17V15M12 15L12 5M12 5L14 7M12 5L10 7"
                                    stroke="#344051"
                                    stroke-width="1.67"
                                    stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </span>
                        <span class="upload-file-text">Upload file</span>
                    </div>
                </div>
            </div>

            <div class="agree-to-policy">
                <input type="checkbox" id="get-started-checkbox" />
                <label for="get-started-checkbox">
                    <a href="./terms-and-conditions.html" class="agree">
                        I agree to terms & Policy
                    </a>
                </label>
            </div>

            <a href="./owner-dashboard-overview.html" class="auth-submit-btn">Submit</a>
        </form>
    </div>
</section>
@endsection