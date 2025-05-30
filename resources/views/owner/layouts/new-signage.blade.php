@extends('owner.app', ['title' => 'Home'])
@push('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"> -->
<style>
    #map {
        height: 500px;
        width: 100%;
    }

    #info {
        margin-top: 10px;
        font-size: 18px;
    }

    .loading {
        color: #666;
        font-style: italic;
    }

    #search-box {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        margin-bottom: 10px;
    }


    .height-width-space select {
        border-radius: 12px;
        background: #f2f2f2;
        padding: 28px 42px;
        border: 1px solid transparent !important;
        outline: none;
        color: #4d4d4d;
        font-size: 16px;
        transition: border-color 0.4s, background-color 0.4s;

    }

    .height-width-space .form-select:focus {
        border-color: #34b26f !important;
        background-color: #ffffff !important;
        box-shadow: none;
    }

    @media screen and (max-width: 768px) {
        .height-width-wrapper {
            flex-direction: column;
            gap: 0 !important;
        }

    }
</style>
@endpush
@section('content')
<div class="main-content">
    <div class="campaign-header">
        <div>
            <h4 class="campaign-header-title">Add New Signage</h4>
            <p class="campaign-subtitle">
                Follow this Steps to Add New Signage
            </p>
        </div>
    </div>
    <div class="describe-campaign mt-4">
        <h5>Describe your campaign below</h5>
        <form action="{{ route('owner.signage.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="describe-campaign-input-wrapper-container gap-3 d-flex w-100 gap-3">
                <div class="describe-campaign-input-wrapper w-50 mr-5">
                    <label>Signage Title <span>*</span></label>
                    <input name="name" type="text" class="form-control" placeholder="Enter your campaign name" required />
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="describe-campaign-input-wrapper w-50 mr-5">
                    <label>Category <span>*</span></label>
                    <select name="category_name" class="form-control" style="height: 75px; margin-right: 20px; ">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->name }}" required>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="describe-campaign-input-wrapper">
                <label>Description <span>*</span></label>
                <textarea name="description" placeholder="Descrive your campaign to help us better understand your needs" required></textarea>
                @error('description')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="d-flex align-items-start flex-wrap column-gap-4 w-100">
                <div class="describe-campaign-input-wrapper w-100">
                    <label>Estimated Views<span class="billboard-card-info-icon">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12C23 12 19 20 12 20C5 20 1 12 1 12Z"
                                    stroke="#4D4D4D"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z"
                                    stroke="#4D4D4D"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </span></label>
                    <input name="avg_daily_views" type="number" placeholder="5000" min="0" required />
                    @error('avg_daily_views')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="describe-campaign-input-wrapper w-100">
                    <label>Price Per Day<span class="billboard-card-info-icon"><img src="{{ asset('currency/realcurrency.png') }}" alt="" style="width: 15px; height: 15px;"></span></label>
                    <input name="per_day_price" type="number" placeholder="5" min="0" required />
                    @error('per_day_price')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div>
                <label style="margin-right: 1rem;"><strong>Signage Artwork Dimension</strong><span><strong class="text-danger">*</strong></span></label>
            </div>
            <div class="height-width-wrapper d-flex items-center justify-content-between w-100 gap-5">

                <div class="height-width-space describe-campaign-input-wrapper w-100">
                    <div class="tm-input-wrapper d-flex align-items-center gap-1">
                        <!-- update here with margin right -->
                        <label style="margin-right: 1rem;">Height<span class="text-danger">*</span></label>
                        <input name="height" type="text" placeholder="600" class="w-100" required />
                        @error('height')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <label for="quantity">px</label>
                    </div>
                </div>
                <div class="height-width-space describe-campaign-input-wrapper w-100">
                    <div class="tm-input-wrapper d-flex align-items-center gap-1">
                        <!-- update here with margin right -->
                        <label style="margin-right: 1rem;">Width<span class="text-danger">*</span></label>
                        <input name="width" type="text" placeholder="350" class="w-100" required />
                        @error('width')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <label for="quantity">px</label>
                    </div>

                </div>
            </div>


            <!-- Actuall Arthwork Dimension -->

            <div>
                <label style="margin-right: 1rem;"><strong>Signage Actual Dimension</strong><span><strong class="text-danger">*</strong></span></label>
            </div>
            <div class="height-width-wrapper d-flex items-center justify-content-between w-100 gap-5">

                <div class="height-width-space describe-campaign-input-wrapper w-100">
                    <div class="tm-input-wrapper d-flex align-items-center gap-1">
                        <!-- update here with margin right -->
                        <label style="margin-right: 1rem;">Height<span class="text-danger">*</span></label>
                        <input name="actual_height" type="text" placeholder="400" class="w-100" required />
                        @error('width')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <label for="quantity">CM</label>
                    </div>
                </div>
                <div class="height-width-space describe-campaign-input-wrapper w-100">
                    <div class="tm-input-wrapper d-flex align-items-center gap-1">
                        <!-- update here with margin right -->
                        <label style="margin-right: 1rem;">Width<span class="text-danger">*</span></label>
                        <input name="actual_width" type="text" placeholder="200" class="w-100" required />
                        @error('width')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <label for="quantity">CM</label>
                    </div>

                </div>
            </div>



            <div class="height-width-wrapper d-flex justify-content-between w-100 gap-5">
                <!-- <div class="height-width-space describe-campaign-input-wrapper w-100"> -->
                <label><strong>Exposure Time</strong><span class="billboard-card-info-icon">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none">
                            <path
                                d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                stroke="#4D4D4D"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M12 6V12L16 14"
                                stroke="#4D4D4D"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg></label>
                <!-- <div class="tm-input-wrapper d-flex align-items-center gap-1"> -->
                <select name="exposure_time" class="form-control " style="height: 55px; margin-right: 20px; width: 80%;  ">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                </select>
                @error('exposure_time')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <label for="quantity"><strong>Second</strong></label>
                <!-- </div> -->

                <!-- </div> -->
                <!-- <div class="height-width-space describe-campaign-input-wrapper w-100"> -->
                <label><strong>Siganage Location</strong><span class="billboard-card-info-icon">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none">
                            <path
                                d="M12 2C8.13 2 5 5.13 5 8.5C5 11.85 12 21 12 21C12 21 19 11.85 19 8.5C19 5.13 15.87 2 12 2ZM12 11C10.34 11 9 9.66 9 8C9 6.34 10.34 5 12 5C13.66 5 15 6.34 15 8C15 9.66 13.66 11 12 11Z"
                                stroke="#4D4D4D"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </span>
                </label>

                <select name="location" class="form-control" id="cities" style="height: 55px; margin-right: 20px; width: 100%;  ">

                </select>
                <!-- </div> -->
            </div>

            <!-- <div class="describe-campaign-input-wrapper-container gap-3 d-flex w-100 gap-3"> -->
            <div class="describe-campaign-input-wrapper w-50 mr-5">
                <!-- <label>Latitude <span>*</span></label> -->
                <input name="lat" type="text" placeholder="latitude" id="latitude" hidden />
                @error('lat')
                <span class="text-danger">{{ $message }}</span>
                @enderror

                <!-- <label>Longitude <span>*</span></label> -->
                <input name="lan" type="text" placeholder="longitude" value="{{ old('lan') }}" id="longitude" hidden />
                @error('lat')
                <span class="text-danger">{{ $message }}</span>
                @enderror

            </div>
            <div class="describe-campaign-input-wrapper-container gap-3 d-flex w-100 gap-3">
                <div>
                    <div id="info">Click on the map to see latitude, longitude, and address.</div>
                </div>
                <div class="describe-campaign-input-wrapper w-50 ml-5">
                    <input id="search-box" type="text" placeholder="Search for an address...">
                    <div id="map"></div>

                </div>
            </div>

            <div class="describe-campaign-input-wrapper w-100">
                <label>Upload Signage Photo</label>
                <div class="upload-box">
                    <input name="image" type="file" id="file-input" required />
                    <div class="upload-content">
                        <span class="upload-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M19 15V17C19 18.1046 18.1046 19 17 19H7C5.89543 19 5 18.1046 5 17V15M12 15L12 5M12 5L14 7M12 5L10 7" stroke="#344051" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                        <span class="upload-file-text">Upload files</span>
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center gap-4 flex-wrap">
                <label class="custom-checkbox-label">
                    <input type="checkbox" name="terms_and_conditions" id="terms-and-condition" required checked />
                    <span class="custom-checkbox-checkmark"></span>
                    <a href="{{ route('terms.conditions') }}" class="agree">Terms & Conditions</a>
                </label>
                @error('terms_and_condition')
                <span class="text-danger">{{ $message }}</span>
                @enderror

                <label class="custom-checkbox-label">
                    <input type="checkbox" name="privacy_policy" id="privacy-policy" required checked />
                    <span class="custom-checkbox-checkmark"></span>
                    <a href="{{ route('privacy.policy') }}" class="agree">Privacy Policy</a>
                </label>
                @error('privacy_policy')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-common w-100 mt-4">Submit For Approval</button>
        </form>
    </div>

</div>
@endsection

@push('script')
<script src="{{asset('js/CitiesAjax.js')}}"></script>
<!-- toster scrippt -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script> -->
<script>
    //file upload
    let uploadedFile = null;
    $('#file-input').change(function(event) {
        $('.upload-content').html(`<img src="${URL.createObjectURL(event.target.files[0])}" alt="Upload" style="width: 100%;" />`);
        uploadedFile = event.target.files[0];
        $('#uploaded-image-preview').val(uploadedFile.name);

    });
</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY')}}&libraries=places&callback=initMap" async defer></script>
<script>
    let map, marker, infoWindow, geocoder;

    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            zoom: 5,
            center: {
                lat: 26.4206828,
                lng: 50.0887943
            } // Default to Dhaka, Bangladesh
        });

        marker = new google.maps.Marker({
            map: map,
            title: "Click a location"
        });

        infoWindow = new google.maps.InfoWindow();
        geocoder = new google.maps.Geocoder();

        // Handle click event on map
        map.addListener("click", function(event) {
            let lat = event.latLng.lat();
            let lng = event.latLng.lng();
            updateInfo(lat, lng, "Loading address...");
            marker.setPosition(event.latLng);
            reverseGeocode(lat, lng);
        });

        // Address Search
        const searchBox = new google.maps.places.SearchBox(document.getElementById("search-box"));
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(document.getElementById("search-box"));

        searchBox.addListener("places_changed", function() {
            let places = searchBox.getPlaces();
            if (places.length === 0) return;

            let place = places[0];
            if (!place.geometry) return;

            let lat = place.geometry.location.lat();
            let lng = place.geometry.location.lng();

            map.setCenter(place.geometry.location);
            marker.setPosition(place.geometry.location);
            updateInfo(lat, lng, place.formatted_address || "No address found");
        });
    }

    function reverseGeocode(lat, lng) {
        geocoder.geocode({
            location: {
                lat,
                lng
            }
        }, function(results, status) {
            if (status === "OK" && results[0]) {
                updateInfo(lat, lng, results[0].formatted_address);
            } else {
                updateInfo(lat, lng, "No address found for this location");
            }
        });
    }

    function updateInfo(lat, lng, address) {
        document.getElementById("latitude").value = lat;
        document.getElementById("longitude").value = lng;
        document.getElementById("info").innerHTML = `Latitude: ${lat}<br>Longitude: ${lng}<br>Address: ${address}`;
        infoWindow.setContent(`<p><strong>Latitude:</strong> ${lat}<br><strong>Longitude:</strong> ${lng}<br><strong>Address:</strong> ${address}</p>`);
        infoWindow.open(map, marker);
    }
</script>
@endpush