@php
use App\Enums\PageEnum;
use App\Enums\SectionEnum;
use App\Models\CMS;
use App\Models\Tutorial;
use App\Models\Setting;
$cms = CMS::where('page', PageEnum::AUTH)->where('section', SectionEnum::BG)->first();
$settings = Setting::first();
$tutorial= Tutorial::where('page', PageEnum::LOGIN_TUTORIAL)->first();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1 , maximum-scale=1" />
    <title>Login | Shashh</title>

    <!-- ==== All Css Links ==== -->
    <link rel="icon" type="image/png" href="{{ asset('frontend') }}/images/favicon.png" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/plugins/bootstrap.min.css" />

    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/plugins/nice-select.min.css" />
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/plugins/all.min.css" />
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/plugins/fontawesome.min.css" />

    <!-- All custom CSS Links -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/common.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/responsive.css" />
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/style.css" />
</head>

<body>
    <main>
        @yield('content')
    </main>
    <!-- Modal -->
    <div
        class="modal fade"
        id="videoModal"
        tabindex="-1"
        aria-labelledby="videoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-hightlight" id="exampleModalLabel">
                        Login Steps
                    </h1>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  
                    <div class="responsive-video-wrapper">
                        <video id="videoIframe" controls>
                            <source src="{{ asset( $tutorial->video ?? 'n/a') }}" type="video/mp4" />
                            Your browser does not support the video tag.
                        </video>
                    </div>
                
                </div>
            </div>
        </div>
    </div>

    <!-- ==== All Js Links ==== -->
    <script src="{{ asset('frontend') }}/js/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('frontend') }}/js/plugins.js"></script>
    <script src="{{ asset('frontend') }}/js/main.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const modal = document.getElementById("videoModal");
            const video = document.getElementById("videoIframe");

            // Listen for Bootstrap modal hidden event
            modal.addEventListener("hidden.bs.modal", function() {
                if (video) {
                    video.pause(); // Pause the video
                    video.currentTime = 0; // Optionally reset the video to the beginning
                }
            });
        });
    </script>
</body>

</html>