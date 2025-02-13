@php
use App\Enums\PageEnum;
use App\Enums\SectionEnum;
@endphp

@extends('frontend.app', ['title' => 'Privacy Policy'])
@section('content')
<section class="banner-common">
    <div class="my-container">
        <div class="banner-common-header-title">
            <h2>{{__('privacy.herotitle')}}</h2>
        </div>
    </div>
</section>

<section class="policy">
    <div class="my-container">
        <h3 class="policy-title">{{__('privacy.herotitle')}}</h3>
        <div class="policy-wrapper">
            <div class="policy-item">
                <h4>{{__('privacy.title1')}}</h4>
                <p>
                {{__('privacy.description1')}}
                </p>
            </div>
            <div class="policy-item">
                <h4>{{__('privacy.title2')}}</h4>
                <p>
                {{__('privacy.description2')}}
                </p>
            </div>
            <div class="policy-item">
                <h4>{{__('privacy.title3')}}</h4>
                <p>
                {{__('privacy.description3')}}
                </p>
            </div>
            <div class="policy-item">
                <h4>​{{__('privacy.title4')}}</h4>
                <p>
                {{__('privacy.description4')}}
                </p>
                <ul>
                    <li>
                        To service providers who perform services on our behalf.
                    </li>
                    <li>To comply with legal obligations.</li>
                    <li>To protect our rights and property.</li>
                </ul>
            </div>
            <div class="policy-item">
                <h4>{{__('privacy.title5')}}</h4>
                <p>
                {{__('privacy.description5')}}
                </p>
            </div>
            <div class="policy-item">
                <h4>{{__('privacy.title6')}}</h4>
                <p>
                {{__('privacy.description6')}}
                </p>
            </div>
            <div class="policy-item">
                <h4>{{__('privacy.title7')}}</h4>
                <p>
                {{__('privacy.description7')}}
                </p>
            </div>
        </div>
    </div>
</section>
@endsection