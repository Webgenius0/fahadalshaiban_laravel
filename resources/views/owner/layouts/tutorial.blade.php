@extends('owner.app', ['title' => 'Tutorials'])
@section('content')
<div class="main-content">
    <div class="campaign-header">
        <div>
            <h4 class="campaign-header-title">Tutorials</h4>
        </div>
    </div>

    <div class="tutorial-container">
    @forelse ($tutorials as $tutorial)
        <div class="w-100">
           
            <h2 class="campaign-header-title">{{ $tutorial->title ?? '' }}</h2>

            <div class="video-container">
                <!-- Video element -->
                <video id="videoPlayer-{{$tutorial->id}}" class="video-player" width="100%" height="100%" controls >
                    <source src="{{ asset( $tutorial->video ?? 'n/a') }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>

               
            </div>

            
        </div>
        @empty
            <h2 class="campaign-header-title">No Tutorial Found</h2>
            @endforelse
    </div>
</div>
@endsection

@push('script')
<script>

</script>
@endpush