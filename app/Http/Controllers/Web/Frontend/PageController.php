<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Enums\PageEnum;
use App\Http\Controllers\Controller;
use App\Models\CMS;

class PageController extends Controller
{
    public function termsAndConditions()
    {
        $cms = CMS::where('page', PageEnum::HOME)->where('status', 'active')->get();
        return view('frontend.layouts.terms-and-conditions', compact('cms'));
    }
    public function privacyPolicy()
    {
        $cms = CMS::where('page', PageEnum::HOME)->where('status', 'active')->get();
        return view('frontend.layouts.privacy-policy', compact('cms'));
    }
    public function refundPolicy()
    {
        $cms = CMS::where('page', PageEnum::HOME)->where('status', 'active')->get();
        return view('frontend.layouts.refund-policy', compact('cms'));
    }
    public function cookiePolicy()
    {
        $cms = CMS::where('page', PageEnum::HOME)->where('status', 'active')->get();
        return view('frontend.layouts.cookie-policy', compact('cms'));
    }
    public function proTips()
    {
        $cms = CMS::where('page', PageEnum::HOME)->where('status', 'active')->get();
        return view('frontend.layouts.pro-tips', compact('cms'));
    }
    public function joinAsSignageOwner()
    {
        $cms = CMS::where('page', PageEnum::HOME)->where('status', 'active')->get();
        return view('frontend.layouts.join-as-signage-owner', compact('cms'));
    }
}
