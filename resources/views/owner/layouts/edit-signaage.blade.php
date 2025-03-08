@extends('owner.app', ['title' => 'Home'])

@push('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
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
            <h4 class="campaign-header-title">Edit Signage</h4>
            <p class="campaign-subtitle">
                Follow these steps to edit the signage
            </p>
        </div>
    </div>

    <div class="describe-campaign mt-4">
        <h5>Edit your campaign below</h5>
        <form action="{{ route('owner.signage.update', $signage->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="describe-campaign-input-wrapper-container gap-3 d-flex w-100 gap-3">
                <div class="describe-campaign-input-wrapper w-50 mr-5">
                    <label>Signage Title <span>*</span></label>
                    <input name="name" type="text" class="form-control" value="{{ old('name', $signage->name) }}" />
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="describe-campaign-input-wrapper w-50 mr-5">
                    <label>Category <span>*</span></label>
                    <select name="category_name" class="form-control" style="height: 75px; margin-right: 20px;">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->name }}" {{ old('category_name', $signage->category_name) == $category->name ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('category_name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="describe-campaign-input-wrapper">
                <label>Description <span>*</span></label>
                <textarea name="description">{{ old('description', $signage->description) }}</textarea>
                @error('description')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="d-flex align-items-start flex-wrap column-gap-4 w-100">
                <div class="describe-campaign-input-wrapper w-100">
                    <label>Average Daily Views<span>*</span></label>
                    <input name="avg_daily_views" type="number" placeholder="50k" min="0" value="{{ old('avg_daily_views', $signage->avg_daily_views) }}" />
                    @error('avg_daily_views')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="describe-campaign-input-wrapper w-100">
                    <label>Set Per Day Price<span>*</span></label>
                    <input name="per_day_price" type="number" placeholder="SR 5" min="0" value="{{ old('per_day_price', $signage->per_day_price) }}" />
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
                        <label style="margin-right: 1rem;">Height<span class="text-danger">*</span></label>
                        <input name="height" type="text" placeholder="600" class="w-100" value="{{ old('height', $signage->height) }}" required />
                        @error('height')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <label for="quantity">px</label>
                    </div>
                </div>
                <div class="height-width-space describe-campaign-input-wrapper w-100">
                    <div class="tm-input-wrapper d-flex align-items-center gap-1">
                        <label style="margin-right: 1rem;">Width<span class="text-danger">*</span></label>
                        <input name="width" type="text" placeholder="350" class="w-100" value="{{ old('width', $signage->width) }}" required />
                        @error('width')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <label for="quantity">px</label>
                    </div>
                </div>
            </div>

            <div>
                <label style="margin-right: 1rem;"><strong>Signage Actual Dimension</strong><span><strong class="text-danger">*</strong></span></label>
            </div>
            <div class="height-width-wrapper d-flex items-center justify-content-between w-100 gap-5">
                <div class="height-width-space describe-campaign-input-wrapper w-100">
                    <div class="tm-input-wrapper d-flex align-items-center gap-1">
                        <label style="margin-right: 1rem;">Height<span class="text-danger">*</span></label>
                        <input name="actual_height" type="text" placeholder="400" class="w-100" value="{{ old('actual_height', $signage->actual_height) }}" required />
                        @error('actual_height')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <label for="quantity">CM</label>
                    </div>
                </div>
                <div class="height-width-space describe-campaign-input-wrapper w-100">
                    <div class="tm-input-wrapper d-flex align-items-center gap-1">
                        <label style="margin-right: 1rem;">Width<span class="text-danger">*</span></label>
                        <input name="actual_width" type="text" placeholder="200" class="w-100" value="{{ old('actual_width', $signage->actual_width) }}" required />
                        @error('actual_width')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <label for="quantity">CM</label>
                    </div>
                </div>
            </div>

            <div class="height-width-wrapper d-flex justify-content-between w-100 gap-5">
                <label><strong>Set Exposure Time</strong><span class="text-danger">*</span></label>
                <select name="exposure_time" class="form-control" style="height: 55px; margin-right: 20px; width: 80%;">
                    <option value="5" {{ old('exposure_time', $signage->exposure_time) == 5 ? 'selected' : '' }}>5</option>
                    <option value="10" {{ old('exposure_time', $signage->exposure_time) == 10 ? 'selected' : '' }}>10</option>
                    <option value="15" {{ old('exposure_time', $signage->exposure_time) == 15 ? 'selected' : '' }}>15</option>
                    <option value="20" {{ old('exposure_time', $signage->exposure_time) == 20 ? 'selected' : '' }}>20</option>
                </select>
                @error('exposure_time')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <label for="quantity"><strong>Second</strong></label>

                <label><strong>Signage Location</strong><span>*</span></label>
                <select name="location" class="form-control" id="cities" style="height: 55px; margin-right: 20px; width: 100%;">
                    <!-- Dynamically populated cities -->
                </select>
            </div>

            <div class="describe-campaign-input-wrapper w-50 mr-5">
                <input name="lat" type="text" placeholder="latitude" id="latitude" value="{{ old('lat', $signage->lat) }}" hidden />
                @error('lat')
                <span class="text-danger">{{ $message }}</span>
                @enderror

                <input name="lan" type="text" placeholder="longitude" id="longitude" value="{{ old('lan', $signage->lan) }}" hidden />
                @error('lan')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- <div class="describe-campaign-input-wrapper-container gap-3 d-flex w-100 gap-3">
                <div>
                    <div id="info">Click on the map to see latitude, longitude, and address.</div>
                </div>
                <div class="describe-campaign-input-wrapper w-50 ml-5">
                    <input id="search-box" type="text" placeholder="Search for an address...">
                    <div id="map"></div>
                </div>
            </div> -->

            <div class="describe-campaign-input-wrapper-container gap-3 d-flex w-100 gap-3">
                <div>
                    <div id="info">
                        @if($signage->lat && $signage->lan)
                        Latitude: {{ $signage->lat }}<br>
                        Longitude: {{ $signage->lan }}<br>
                        Address: {{ $signage->location ?? 'No address found' }}
                        @else
                        Click on the map to see latitude, longitude, and address.
                        @endif
                    </div>
                </div>
                <div class="describe-campaign-input-wrapper w-50 ml-5">
                    <input id="search-box" type="text" placeholder="Search for an address..." />
                    <div id="map"></div>
                </div>
            </div>

            <!-- Hidden inputs for latitude and longitude -->
            <input name="lat" type="text" id="lat" value="{{ old('lat', $signage->lat) }}" hidden />
            <input name="lan" type="text" id="lan" value="{{ old('lan', $signage->lan) }}" hidden />

            <div class="describe-campaign-input-wrapper w-100">
                <label>Upload Signage Photo</label>
                <div class="upload-box">
                    <input name="image" type="file" id="file-input" />
                    <div class="upload-content">
                        @if($signage->image)
                        <!-- Display the existing image -->
                        <img src="{{ asset($signage->image) }}" alt="Signage Image" style="width: 100%;" id="uploaded-image-preview" />
                        @else
                        <!-- Show the upload icon and text if no image exists -->
                        <span class="upload-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M19 15V17C19 18.1046 18.1046 19 17 19H7C5.89543 19 5 18.1046 5 17V15M12 15L12 5M12 5L14 7M12 5L10 7" stroke="#344051" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                        <span class="upload-file-text">Upload file</span>
                        @endif
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-common w-100 mt-4">Update Signage</button>
        </form>
    </div>
</div>
@endsection

@push('script')
<script src="{{ asset('js/CitiesAjax.js') }}"></script>
<script>
    // File upload functionality
    let uploadedFile = null;
    $('#file-input').change(function(event) {
        $('.upload-content').html(`<img src="${URL.createObjectURL(event.target.files[0])}" alt="Upload" style="width: 100%;" />`);
        uploadedFile = event.target.files[0];
    });
</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initMap" async defer></script>
<script>
    let map, marker, infoWindow, geocoder;

    function initMap() {
        // Default coordinates (fallback if no existing coordinates)
        const defaultLat = 26.4206828; // Default latitude (e.g., Riyadh)
        const defaultLng = 50.0887943; // Default longitude (e.g., Riyadh)

        // Use existing coordinates if available
        const initialLat = {{ $signage->lat ?? defaultLat }};
        const initialLng = {{ $signage->lan ?? defaultLng }};

        // Initialize the map
        map = new google.maps.Map(document.getElementById("map"), {
            zoom: 12,
            center: { lat: initialLat, lng: initialLng },
        });

        // Initialize the marker
        marker = new google.maps.Marker({
            map: map,
            position: { lat: initialLat, lng: initialLng },
            title: "Signage Location",
        });

        // Initialize the info window
        infoWindow = new google.maps.InfoWindow();
        geocoder = new google.maps.Geocoder();

        // If existing coordinates are available, reverse geocode to get the address
        if (initialLat !== defaultLat && initialLng !== defaultLng) {
            reverseGeocode(initialLat, initialLng);
        }

        // Handle click event on the map
        map.addListener("click", function(event) {
            const lat = event.latLng.lat();
            const lng = event.latLng.lng();
            updateInfo(lat, lng, "Loading address...");
            marker.setPosition(event.latLng);
            reverseGeocode(lat, lng);
        });

        // Address Search
        const searchBox = new google.maps.places.SearchBox(document.getElementById("search-box"));
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(document.getElementById("search-box"));

        searchBox.addListener("places_changed", function() {
            const places = searchBox.getPlaces();
            if (places.length === 0) return;

            const place = places[0];
            if (!place.geometry) return;

            const lat = place.geometry.location.lat();
            const lng = place.geometry.location.lng();

            map.setCenter(place.geometry.location);
            marker.setPosition(place.geometry.location);
            updateInfo(lat, lng, place.formatted_address || "No address found");
        });
    }

    // Reverse geocode to get the address from coordinates
    function reverseGeocode(lat, lng) {
        geocoder.geocode({ location: { lat, lng } }, function(results, status) {
            if (status === "OK" && results[0]) {
                updateInfo(lat, lng, results[0].formatted_address);
            } else {
                updateInfo(lat, lng, "No address found for this location");
            }
        });
    }

    // Update the info display and hidden inputs
    function updateInfo(lat, lng, address) {
    console.log("Updating latitude:", lat); // Debug log
    console.log("Updating longitude:", lng); // Debug log

    document.getElementById("lat").value = lat;
    document.getElementById("lan").value = lng;
    document.getElementById("info").innerHTML = `Latitude: ${lat}<br>Longitude: ${lng}<br>Address: ${address}`;
    infoWindow.setContent(`<p><strong>Latitude:</strong> ${lat}<br><strong>Longitude:</strong> ${lng}<br><strong>Address:</strong> ${address}</p>`);
    infoWindow.open(map, marker);
}
</script>
@endpush