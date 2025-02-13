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
    <form action="{{route('owner.signage.update', $signage->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!-- The action route might be different if you're editing an existing signage -->
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
                <select name="category_name" class="form-control">
                @foreach ($categories as $category)
                    <option value="{{ $category->name }}" 
                        {{ old('category_name', $signage->category_name) == $category->name ? 'selected' : '' }}>
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

        <div class="d-flex align-items-start flex-wrap column-gap-4 w-100">
            <div class="describe-campaign-input-wrapper w-100">
                <label>Display size<span>*</span></label>
                <input name="display_size" type="text" placeholder="638px x 176px" value="{{ old('display_size', $signage->display_size) }}" />
                @error('display_size')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="describe-campaign-input-wrapper w-100">
                <label>Set Exposure time per minute<span>*</span></label>
                <input name="exposure_time" type="text" placeholder="0:08" value="{{ old('exposure_time', $signage->exposure_time) }}" />
                @error('exposure_time')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="d-flex align-items-start flex-wrap column-gap-4 w-100">
            <div class="describe-campaign-input-wrapper w-100">
                <label>On Going Ad<span>*</span></label>
                <input name="on_going_ad" type="number" placeholder="10" min="0" value="{{ old('on_going_ad', $signage->on_going_ad) }}" />
                @error('on_going_ad')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="describe-campaign-input-wrapper w-100">
                <label>Space Left for Ad<span>*</span></label>
                <input name="space_left_for_ad" type="number" placeholder="5" min="0" value="{{ old('space_left_for_ad', $signage->space_left_for_ad) }}" />
                @error('space_left_for_ad')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="describe-campaign-input-wrapper w-100">
            <label>Signage Location<span>*</span></label>
            <!-- <input name="location" type="text" placeholder="Dammam" value="{{ old('location', $signage->location) }}" /> -->
            <select name="location" class="form-control" id="cities">
            @error('location')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Lat and lan -->
        <div class="describe-campaign-input-wrapper-container gap-3 d-flex w-100">
            <div class="describe-campaign-input-wrapper w-50 mr-5">
                <label>Latitude <span>*</span></label>
                <input name="lat" type="text" value="{{ old('lat', $signage->lat) }}" />
                @error('lat')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="describe-campaign-input-wrapper w-50 ml-5">
                <label>Longitude <span>*</span></label>
                <input name="lan" type="text" value="{{ old('lan', $signage->lan) }}" />
                @error('lan')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>


        <div class="describe-campaign-input-wrapper w-100">
            <label>Upload Signage Photo</label>
            <div class="upload-box">
                <input name="image" type="file" id="file-input" name="image" data-default-file="{{ asset($signage->image) }}" alt="billboard -image"/>
                <div class="upload-content">
                    <span class="upload-icon">
                        <!-- Your upload icon here -->
                    </span>
                    <span class="upload-file-text">Upload file</span>
                </div>
            </div>
        </div>

       
        <button type="submit" class="btn-common w-100 mt-4">Update</button>
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

</script>
@endpush