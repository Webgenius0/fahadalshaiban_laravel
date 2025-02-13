@php
use App\Enums\PageEnum;
use App\Enums\SectionEnum;
@endphp

@extends('frontend.app', ['title' => 'Refund Policy'])
@section('content')
<section class="banner-common">
    <div class="my-container">
        <div class="banner-common-header-title">
            <h2>{{__('refund.title')}}</h2>
        </div>
    </div>
</section>

<section class="policy">
    <div class="my-container">
        <h3 class="policy-title">{{__('refund.title')}}</h3>
        <div class="policy-wrapper">
            <div class="policy-item">
                <h4>{{__('refund.title1')}}</h4>
                <p>
                {{__('refund.description1')}}
                </p>
            </div>
            <div class="policy-item">
                <h4>{{__('refund.title2')}}</h4>
                <p>
                {{__('refund.description2')}}
                </p>
            </div>
            <div class="policy-item">
                <h4>{{__('refund.title3')}}</h4>
                <p>
                {{__('refund.description3')}}
                </p>
            </div>
            <div class="policy-item">
                <h4>{{__('refund.title4')}}</h4>
                <p>
                {{__('refund.description4')}}
                </p>
            </div>
            <div class="policy-item">
                <h4>{{__('refund.title5')}}</h4>
                <p>
                {{__('refund.description5')}}
                </p>
            </div>
        </div>
    </div>
</section>
@endsection