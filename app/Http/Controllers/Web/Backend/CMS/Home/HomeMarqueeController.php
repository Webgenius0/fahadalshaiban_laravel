<?php

namespace App\Http\Controllers\Web\Backend\CMS\Home;

use App\Enums\PageEnum;
use App\Enums\SectionEnum;
use App\Http\Controllers\Controller;
use App\Models\CMS;
use Exception;
use Illuminate\Http\Request;

class HomeMarqueeController extends Controller
{

    public function index()
    {
        $marquee = CMS::where('page', PageEnum::HOME->value)->where('section', SectionEnum::HOME_MARQUEE->value)->first();
        return view('backend.layouts.cms.home.marquee', compact('marquee'));
    }
    public function update(Request $request)
    {
        $validatedData = request()->validate([
            'title'         => 'required|string|max:250'
        ]);
        
        try {
            $validatedData['page'] = PageEnum::HOME->value;
            $validatedData['section'] = SectionEnum::HOME_MARQUEE->value;

            if (CMS::where('page', $validatedData['page'])->where('section', $validatedData['section'])->exists()) {
                CMS::where('page', $validatedData['page'])->where('section', $validatedData['section'])->update($validatedData);
            } else {
                CMS::create($validatedData);
            }

            return redirect()->route('admin.cms.home.marquee')->with('success', 'Updated successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
