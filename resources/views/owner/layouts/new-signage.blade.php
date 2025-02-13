@extends('owner.app', ['title' => 'Home'])
@push('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

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
                <input name="name" type="text" class="form-control" placeholder="Get 70% OFF Discount from Shashh" />
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="describe-campaign-input-wrapper w-50 mr-5">
                <label>Category <span>*</span></label>
                <select name="category_name" class="form-control">
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="describe-campaign-input-wrapper">
            <label>Description <span>*</span></label>
            <textarea name="description"></textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="d-flex align-items-start flex-wrap column-gap-4 w-100">
            <div class="describe-campaign-input-wrapper w-100">
                <label>Average Daily Views<span>*</span></label>
                <input name="avg_daily_views" type="number" placeholder="50k" min="0" />
                @error('avg_daily_views')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="describe-campaign-input-wrapper w-100">
                <label>Set Per Day Price<span>*</span></label>
                <input name="per_day_price" type="number" placeholder="SR 5" min="0" />
                @error('per_day_price')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="d-flex align-items-start flex-wrap column-gap-4 w-100">
            <div class="describe-campaign-input-wrapper w-100">
                <label>Display size<span>*</span></label>
                <input name="display_size" type="text" placeholder="638px x 176px" />
                @error('display_size')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="describe-campaign-input-wrapper w-100">
                <label>Set Exposure time per minute<span>*</span></label>
                <input name="exposure_time" type="text" placeholder="0:08" />
                @error('exposure_time')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="d-flex align-items-start flex-wrap column-gap-4 w-100">
            <div class="describe-campaign-input-wrapper w-100">
                <label>On Going Ad<span>*</span></label>
                <input name="on_going_ad" type="number" placeholder="10" min="0" />
                @error('on_going_ad')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="describe-campaign-input-wrapper w-100">
                <label>Space Left for Ad<span>*</span></label>
                <input name="space_left_for_ad" type="number" placeholder="5" min="0" />
                @error('space_left_for_ad')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="describe-campaign-input-wrapper w-100">
            <label>Signage Location<span>*</span></label>
            <!-- <input name="location" type="text" placeholder="Dammam" /> -->
            <select name="location" class="form-control" id="cities">
                   
                </select>
            @error('location')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="describe-campaign-input-wrapper-container gap-3 d-flex w-100">
            <div class="describe-campaign-input-wrapper w-50 mr-5">
                <label>Latitude <span>*</span></label>
                <input name="lat" type="text" placeholder="latitude" />
                @error('lat')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="describe-campaign-input-wrapper w-50 ml-5">
                <label>Longitude <span>*</span></label>
                <input name="lan" type="text" placeholder="longitude" />
                @error('lan')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="describe-campaign-input-wrapper w-100">
            <label>Upload Signage Photo</label>
            <div class="upload-box">
                <input name="image" type="file" id="file-input" />
                <div class="upload-content">
                    <span class="upload-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M19 15V17C19 18.1046 18.1046 19 17 19H7C5.89543 19 5 18.1046 5 17V15M12 15L12 5M12 5L14 7M12 5L10 7" stroke="#344051" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                    <span class="upload-file-text">Upload file</span>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    @if(Session::has('success'))
  toastr.options = {
    "closeButton": true,
    "progressBar": true
  }
  toastr.success("{{ Session::get('success') }}");
@endif

@if(Session::has('info'))
  toastr.options = {
    "closeButton": true,
    "progressBar": true
  }
  toastr.info("{{ Session('info') }}");
@endif

@if(Session::has('warning'))
  toastr.options = {
    "closeButton": true,
    "progressBar": true
  }
  toastr.warning("{{ Session('warning') }}");
@endif

@if(Session::has('error'))
  toastr.options = {
    "closeButton": true,
    "progressBar": true
  }
  toastr.error("{{ Session('error') }}");
@endif

//file upload
let uploadedFile = null;
$('#file-input').change(function(event) {
    $('.upload-content').html(`<img src="${URL.createObjectURL(event.target.files[0])}" alt="Upload" style="width: 100%;" />`);
    uploadedFile = event.target.files[0]; 
    $('#uploaded-image-preview').val(uploadedFile.name);
   
});
  </script>
@endpush