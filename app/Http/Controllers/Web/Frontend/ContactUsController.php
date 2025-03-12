<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Enums\PageEnum;
use App\Enums\SectionEnum;
use App\Http\Controllers\Controller;
use App\Models\CMS;
use App\Models\Contactus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ContactUsController extends Controller
{
    public function index()
    {
        //cms start
        $query = CMS::where('page', PageEnum::HOME)->where('status', 'active');
        $cms= $query->get();
        // foreach (SectionEnum::HomePage() as $key => $section) {
        //     $cms[$key] = (clone $query)->where('section', $key)->latest()->take($section['item'])->{$section['type']}();
        // }
        //cms end
        return view('frontend.layouts.contact-us', compact('cms'));
    }

    // store contact us
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:15',
        'message' => 'nullable|string|max:500',
    ]);

    // Save to the database
    ContactUs::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'phone' => $validated['phone'],
        'message' => $validated['message'],
    ]);

    return redirect()->back()->with('success', 'Message sent successfully!');
}
}
