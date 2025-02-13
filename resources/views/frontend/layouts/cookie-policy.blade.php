@php
use App\Enums\PageEnum;
use App\Enums\SectionEnum;
@endphp

@extends('frontend.app', ['title' => 'Home'])
@section('content')
<section class="banner-common">
    <div class="my-container">
        <div class="banner-common-header-title">
            <h2>{{__('coocki.title')}}</h2>
        </div>
    </div>
</section>

<section class="policy">
    <div class="my-container">
        <h3 class="policy-title">{{__('coocki.title')}}</h3>
        <div class="policy-wrapper">
            <div class="policy-item">
                <h4>{{__('coocki.title1')}}</h4>
                <p>
                {{__('coocki.description1')}}
                </p>
            </div>
            <div class="policy-item">
                <h4>{{__('coocki.title2')}}</h4>
                <p>
                {{__('coocki.description2')}}
                </p>
            </div>
            <div class="policy-item">
                <h4>{{__('coocki.title3')}}</h4>
                <p>We use cookies to:</p>
                <ul>
                    <li>
                    {{__('coocki.description3')}}
                    </li>
                    <li>Remember your preferences and settings.</li>
                    <li>Analyze traffic and usage patterns on the App.</li>
                </ul>
            </div>
            <div class="policy-item">
                <h4>{{__('coocki.title4')}}</h4>
                <p>
                {{__('coocki.description4')}}
                </p>
            </div>
            <div class="policy-item">
                <h4>{{__('coocki.title5')}}</h4>
                <p>
                {{__('coocki.description5')}}
                </p>
            </div>
        </div>
    </div>
</section>
@endsection