@php
use App\Enums\PageEnum;
use App\Enums\SectionEnum;
@endphp

@extends('frontend.app', ['title' => 'Terms & Conditions'])
@section('content')
<main>
    <section class="banner-common">
        <div class="my-container">
            <div class="banner-common-header-title">
                <h2>{{__('terms.herotitle')}}</h2>
            </div>
        </div>
    </section>

    <section class="policy">
        <div class="my-container">
            <h3 class="policy-title">{{__('terms.herotitle')}}</h3>
            <div class="policy-wrapper">
                <div class="policy-item">
                    <h4> {{__('terms.title1')}}</h4>
                    <p>
                    {{__('terms.description1')}}
                    </p>
                </div>
                <div class="policy-item">
                    <h4>{{__('terms.title2')}}</h4>
                    <p>
                    {{__('terms.description2')}}
                    </p>
                </div>
                <div class="policy-item">
                    <h4>​{{__('terms.title3')}}</h4>
                    <p>
                    {{__('terms.description3')}}
                    </p>
                </div>
                <div class="policy-item">
                    <h4>{{__('terms.title4')}}</h4>
                    <p>
                    {{__('terms.description4')}}
                    </p>
                </div>
                <div class="policy-item">
                    <h4>​{{__('terms.title5')}}</h4>
                    <p>
                    {{__('terms.description5')}}
                    </p>
                </div>
                <div class="policy-item">
                    <h4>{{__('terms.title6')}}</h4>
                    <p>
                    {{__('terms.description6')}}
                    </p>
                </div>
                <div class="policy-item">
                    <h4>{{__('terms.title7')}}</h4>
                    <p>
                    {{__('terms.description7')}}
                    </p>
                </div>
                <div class="policy-item">
                    <h4>{{__('terms.title8')}}</h4>
                    <p>
                    {{__('terms.description8')}}
                    </p>
                </div>
                <div class="policy-item">
                    <h4>{{__('terms.title9')}}</h4>
                    <p>
                    {{__('terms.description9')}}
                    </p>
                </div>
                <div class="policy-item">
                    <h4>{{__('terms.title10')}}</h4>
                    <p>
                    {{__('terms.description10')}}
                    </p>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection