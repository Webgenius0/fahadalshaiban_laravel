<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Enums\PageEnum;
use App\Enums\SectionEnum;
use App\Events\NewMessage;
use App\Http\Controllers\Controller;
use App\Models\CMS;

class HomeController extends Controller
{
    public function index()
    {
        broadcast(new NewMessage('Hello World'))->toOthers();
        $cms = CMS::where('page', PageEnum::HOME)->where('status', 'active')->get();
        return view('frontend.layouts.index', compact('cms'));
    }
}
