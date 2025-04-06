<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Enums\PageEnum;
use App\Enums\SectionEnum;
use App\Events\NewMessage;
use App\Http\Controllers\Controller;
use App\Models\CMS;
use App\Models\Visit;

class HomeController extends Controller
{
    public function index()
    {

        // ✅ Count unique homepage view
        if (!session()->has('homepage_viewed')) {
            $visit = Visit::first();

            if ($visit) {
                $visit->increment('home_views');
            } else {
                Visit::create(['home_views' => 1]);
            }

            session()->put('homepage_viewed', true);
        }

        broadcast(new NewMessage('Hello World'))->toOthers();
        $cms = CMS::where('page', PageEnum::HOME)->where('status', 'active')->get();
        return view('frontend.layouts.index', compact('cms'));
    }
}
