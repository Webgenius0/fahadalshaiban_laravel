<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocalizationController extends Controller
{
    public function set($lang)
    {
        $availableLocales = ['en', 'ar'];

        if (in_array($lang, $availableLocales)) {
            App::setLocale($lang);
            Session::put('locale', $lang);
        }

        return redirect()->back();
    }
}

