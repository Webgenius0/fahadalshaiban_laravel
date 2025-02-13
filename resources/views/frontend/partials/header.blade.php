<header>
    <!-- navbar starts -->
    <nav class="navbar-desk">
        <div class="my-container">
            <div class="navbar-content-wrapper">
                <div class="navbar-logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('frontend') }}/images/logo.png" alt="logo" />
                    </a>
                </div>
                <div class="navbar-content">
                    <ul class="nav-items-wrapper">
                        <li><a href="{{ route('home') }}" class="nav-item-active">{{ __('menu.home') }}</a></li>
                        
                    </ul>
                    <div class="action-lang-wrapper">

                        <div class="btn-group" role="group">
                            <button type="button" class="btn tm-new-btn dropdown-toggle text-light" data-bs-toggle="dropdown" aria-expanded="false">{{session()->get('locale')=='ar'?'العربية':'English'}}</button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('lang', ['lang' => 'en']) }}">English</a></li>
                                <li><a class="dropdown-item" href="{{ route('lang', ['lang' => 'ar']) }}">{{__('menu.arabic')}}</a></li>
                            </ul>
                        </div>

                        <a href="{{ route('login') }}" class="btn-common">
                        {{ __('menu.startnewcampaign') }}
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M4 12L20 12M20 12L14 18M20 12L14 6"
                                    stroke="white"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </a>
                    </div>
                </div>
                <button class="menu-toggle" aria-label="Open menu">☰</button>
            </div>
        </div>
    </nav>
    <!-- navbar ends -->

    <!-- Mobile Sidebar -->
    <aside class="mobile-sidebar">
        <div class="d-flex align-items-center justify-content-between">
            <div class="mobile-nav-logo">
                <img src="{{ asset('frontend') }}/images/logo.png" alt="logo" />
            </div>
            <button class="sidebar-close" aria-label="Close menu">✕</button>
        </div>
        <ul class="mobile-nav-items">
            <li><a href="{{ route('home') }}">{{ __('menu.home') }}</a></li>
            <li><a href="{{ route('login') }}">Sign in</a></li>
        </ul>
    </aside>

    <!-- Overlay -->
    <div class="sidebar-overlay"></div>
</header>
