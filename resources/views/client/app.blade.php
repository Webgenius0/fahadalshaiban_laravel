@php
$systemSetting = App\Models\Setting::first();
@endphp

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>{{ $title ?? '' }} | {{$systemSetting->system_name ?? env('APP_NAME')}}</title>

  @include('client.partials.style')
</head>

<body>
  <div class="dashboard-layout-wrapper">
    <!-- Sidebar -->
    @include('client.partials.aside')

    <!-- Overlay for Sidebar Toggle on Smaller Screens -->
    <div class="overlay" id="overlay"></div>

    <!-- Main Content -->
    <div class="main-content-wrapper" id="main-content">
      @include('client.partials.header')

      @yield('content')
    </div>

  </div>
  @include('client.partials.footer')
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
  </form>
  @include('client.partials.script')
</body>

</html>