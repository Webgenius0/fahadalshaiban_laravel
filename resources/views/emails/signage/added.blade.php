@component('mail::message')
# New Signage Added

A new signage has been created by **{{ $signage->user->name ?? 'Unknown User' }}**.

**Name:** {{ $signage->name }}  
**Category:** {{ $signage->category_name }}  
**Location:** {{ $signage->location }}  
**Price/Day:** {{ $signage->per_day_price }}

<!-- @component('mail::button', ['url' => url('/signages/' . $signage->id)])
View Signage
@endcomponent -->

Thanks,  
{{$signage->user->name ?? 'Unknown User'}}
@endcomponent
