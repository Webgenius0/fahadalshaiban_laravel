<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Enums\PageEnum;
use App\Enums\SectionEnum;
use App\Http\Controllers\Controller;
use App\Models\CMS;

class ContactUsController extends Controller
{
    public function index()
    {
        //cms start
        $query = CMS::where('page', PageEnum::HOME)->where('status', 'active');
        $cms = [];
        foreach (SectionEnum::HomePage() as $key => $section) {
            $cms[$key] = (clone $query)->where('section', $key)->latest()->take($section['item'])->{$section['type']}();
        }
        //cms end
        return view('frontend.layouts.contact-us', compact('cms'));
    }
}
