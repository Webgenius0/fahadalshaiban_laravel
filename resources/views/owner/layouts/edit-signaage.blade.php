@extends('owner.app', ['title' => 'Home'])

@push('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
<style>
        #map { height: 500px; width: 100%; }
        #info { margin-top: 10px; font-size: 18px; }
        .loading { color: #666; font-style: italic; }
        #search-box { width: 100%; padding: 10px; font-size: 16px; margin-bottom: 10px; }
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

            <div class="describe-campaign-input-wrapper-container gap-3 d-flex w-100 gap-3">
                <div class="describe-campaign-input-wrapper w-50 pr-2">
                    <label>Height<span>*</span></label>
                    <input name="height" type="text" placeholder="638px" value="{{ old('height', $signage->height) }}" />
                    @error('height')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="describe-campaign-input-wrapper w-50 pl-2">
                    <label>Width<span>*</span></label>
                    <input name="width" type="text" placeholder="176px" value="{{ old('width', $signage->width) }}" />
                    @error('width')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

           <div class="describe-campaign-input-wrapper-container gap-3 d-flex w-100 gap-3" >
                <!-- Set Exposure Time -->
                <div class="describe-campaign-input-wrapper w-50 pl-2">
                    <label>Set Exposure Time<span>*</span></label>
                    <select name="exposure_time" class="form-control" style="height: 75px; margin-right: 20px; ">
                        <option value="5">SR 5</option>
                        <option value="10">SR 10</option>
                        <option value="15">SR 15</option>
                        <option value="20">SR 20</option>
                    </select>
                    @error('exposure_time')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Signage Location -->
                <div class="describe-campaign-input-wrapper w-50 pl-2">
                    <label>Signage Location<span>*</span></label>
                    <select name="location" class="form-control" id="cities" style="height: 75px; margin-right: 20px; ">
                        <!-- You will dynamically populate cities here -->
                    </select>
                    @error('location')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="describe-campaign-input-wrapper-container gap-3 d-flex w-100">
                <div class="describe-campaign-input-wrapper w-50 mr-5">
                    <label>Latitude <span>*</span></label>
                    <input name="lat" type="text" placeholder="latitude" value="{{ old('lat', $signage->lat) }}" />
                    @error('lat')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="describe-campaign-input-wrapper w-50 ml-5">
                    <label>Longitude <span>*</span></label>
                    <input name="lan" type="text" placeholder="longitude" value="{{ old('lan', $signage->lan) }}" />
                    @error('lan')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="describe-campaign-input-wrapper w-100">
                <label>Upload Signage Photo</label>
                <div class="upload-box">
                    <input name="image" type="file" id="file-input" data-default-file="{{asset($signage->image ?? 'no image')}}" />
                    <div class="upload-content">
                        <span class="upload-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M19 15V17C19 18.1046 18.1046 19 17 19H7C5.89543 19 5 18.1046 5 17V15M12 15L12 5M12 5L14 7M12 5L10 7" stroke="#344051" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round" data-default-file="" data-default-file="{{$signage->image ?? 'no image'}}" />
                            </svg>
                        </span>
                        <span class="upload-file-text">Upload file</span>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-common w-100 mt-4">Update Signage</button>
        </form>
    </div>
</div>
@endsection

@push('script')

<script src="{{asset('js/CitiesAjax.js')}}"></script>

<script>
    // File upload functionality
    let uploadedFile = null;
    $('#file-input').change(function(event) {
        $('.upload-content').html(`<img src="${URL.createObjectURL(event.target.files[0])}" alt="Upload" style="width: 100%;" />`);
        uploadedFile = event.target.files[0];
    });
</script>
@endpush
