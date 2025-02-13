<?php

namespace App\Http\Controllers\Web\Owner;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tutorial;

class PageController extends Controller
{
    public function tutorials()
    {
        $tutorials = Tutorial::where('section', 'owner')->get();
        return view('owner.layouts.tutorial', compact('tutorials'));
    }
    public function signage()
    {
        $categories= Category::all();
        return view('owner.layouts.new-signage', compact('categories'));
    }
    public function incomeStatement()
    {
        return view('owner.layouts.income-statement');
    }

    public function profile()
    {
        return view('owner.layouts.profile');
    }
}