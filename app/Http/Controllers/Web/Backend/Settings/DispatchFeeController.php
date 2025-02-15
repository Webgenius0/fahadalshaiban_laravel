<?php

namespace App\Http\Controllers\Web\Backend\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
class DispatchFeeController extends Controller
{
    public function index()
    {
        $fees= [
            'dispatch_fee' => env('DISPATCH_FEE', 0)
        ];
        return view('backend.layouts.settings.despatch_fee' , compact('fees'));
    }

     /**
     * Update Dispatch fee settings.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse {
        $request->validate([
            'dispatch_fee' => 'nullable|string'
        ]);

        try {
            $envContent = File::get(base_path('.env'));
            $lineBreak  = "\n";
            $envContent = preg_replace([
                '/DESPATCH_FEE=(.*)\s*/'
            ], [
                'DESPATCH_FEE=' . $request->dispatch_fee . $lineBreak
            ], $envContent);

            File::put(base_path('.env'), $envContent);

            return back()->with('t-success', 'Updated successfully');
        } catch (Exception) {
            return back()->with('t-error', 'Failed to update');
        }
    }
}
