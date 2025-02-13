@php
$systemSetting = App\Models\Setting::first();
@endphp

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? '' }} | {{$systemSetting->system_name ?? env('APP_NAME')}}</title>
    <link rel="icon" type="image/png" href="default/logo.png" />

    @include('owner.partials.style')
</head>

<body>
    <div class="dashboard-layout-wrapper">
        <!-- Sidebar -->
        @include('owner.partials.aside')

        <!-- Overlay for Sidebar Toggle on Smaller Screens -->
        <div class="overlay" id="overlay"></div>

        <!-- Main Content -->
        <div class="main-content-wrapper" id="main-content">
            @include('client.partials.header')

            @yield('content')
        </div>
    </div>
    <!-- Modal -->
    @include('owner.partials.model')
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    @include('owner.partials.script')
</body>

</html>