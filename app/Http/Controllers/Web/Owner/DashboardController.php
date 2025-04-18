<?php

namespace App\Http\Controllers\Web\Owner;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Signage;
use Illuminate\Support\Str;
use Exception;

class DashboardController extends Controller
{
    public function index()
    {
        $signages = Signage::where('user_id', auth('web')
        ->user()->id)
        ->orderBy('created_at', 'desc')
        ->where('status', 'active')
        ->paginate(9);
        return view('owner.layouts.dashboard', compact('signages'));
    }

   
}
