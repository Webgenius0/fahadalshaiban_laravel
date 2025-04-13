<?php
namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\Otp;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class OtpVerificationController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        Otp::where('user_id', $user->id)->delete();
        if ($user->otp) {
            $otp = $user->otp;
            if (Carbon::parse($otp->created_at)->addMinutes(10) < Carbon::now()) {
                $otp->delete();
            } else {
                return view('auth.otp', ['code' => $otp->code]);
            }
        }

        $code = rand(100000, 999999);
        Otp::create([
            'code' => $code,
            'user_id' => $user->id
        ]);
        Mail::to($user->email)->send(new OtpMail($code));
        return view('auth.otp');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|array|min:6',
        ]);

        $user = auth('web')->user();
        $otp = Otp::where('user_id', $user->id)->first();

        if (!$otp) {
            return back()->with('t-error', 'OTP not found.');
        }

        if ($otp->code != implode('', $request->code)) {
            return back()->with('t-error', 'Invalid OTP.');
        }

        if (Carbon::parse($otp->created_at)->addMinutes(5) < Carbon::now()) {
            $otp->delete();
            return back()->with('t-error', 'OTP has expired.');
        }

        $user->email_verified_at = Carbon::now();
        $user->save();
        $otp->delete();

        if (Auth::user()->hasRole('admin')) {
            return redirect()->intended(route('admin.dashboard', absolute: false))->with('t-success', 'Login Successfully');
        } elseif (Auth::user()->hasRole('owner')) {
            return redirect()->intended(route('owner.dashboard', absolute: false))->with('t-success', 'Login Successfully');
        } elseif (Auth::user()->hasRole('client')) {
            return redirect()->intended(route('dashboard', absolute: false))->with('t-success', 'Login Successfully');
        } else {
            return redirect()->intended(route('home', absolute: false))->with('t-error', 'Something went wrong. Please try again.');
        }
        
    }


}

