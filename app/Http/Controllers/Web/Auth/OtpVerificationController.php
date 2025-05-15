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
use App\Helpers\Helper;



class OtpVerificationController extends Controller
{
    public function index()
    {

        $user = auth()->user();

        $otp =  Otp::where('user_id', $user->id)->delete();
        if ($user->otp) {
            $otp = $user->otp;
            if (Carbon::parse($otp->created_at)->addMinutes(10) < Carbon::now()) {
                $otp->delete();
            } else {
                return view('auth.otp', ['code' => $otp->code]);
            }
        }

        $code = rand(100000, 999999);
        $otp =  Otp::create([
            'code' => $code,
            'user_id' => $user->id
        ]);

    
         Mail::to($user->email)->send(new OtpMail($otp->code));
     
        return view('auth.otp');
    }

    public function updateProfile()
    {
        return view('client.layouts.biodata');
    }

    public function updateOwner()
    {
        return view('owner.layouts.owner-biodata');
    }

    // owner page update after otp verification
    public function ownerUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            // 'email' => 'nullable|email',        
            'phone' => 'nullable',
            'address' => 'nullable',
            'vat_no' => 'nullable',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif',
           
        ]);

        // Get the currently authenticated user
        $user = auth()->user();
        if (!$user) {
            return redirect()->back()->with('t-error', 'User not found.');
        }

        $avatar = $request->file('avatar');
            if ($avatar) {
                // Delete existing avatar if it exists
                if ($user->avatar && file_exists(public_path($user->avatar))) {
                    Helper::fileDelete(public_path($user->avatar));
                }


                $imageName = time() . '.' . $avatar->getClientOriginalExtension();
                $imagePath = Helper::fileUpload($avatar, 'client/profile', $imageName);


                if ($imagePath === null) {
                    throw new \Exception('Failed to upload image.');
                }


                $user->avatar = $imagePath;
            }
        // Update user details
        $user->name = $request->name;
        // $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->vat_no = $request->vat_no;
        // $user->avatar = $request->avatar;

        $user->save();
        
        return redirect()->route('owner.dashboard')->with('t-success', 'Profile updated successfully.');
    }

    // client page update after otp verification

    public function update(Request $request)
    {
        
        $request->validate([
            'name' => 'required',              
            'phone' => 'nullable',
            'address' => 'nullable',
            'vat_no' => 'nullable',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif',
           
        ]);
        // Get the currently authenticated user
        $user = auth()->user();
        if (!$user) {
            return redirect()->back()->with('t-error', 'User not found.');
        }

        $avatar = $request->file('avatar');
            if ($avatar) {
                // Delete existing avatar if it exists
                if ($user->avatar && file_exists(public_path($user->avatar))) {
                    Helper::fileDelete(public_path($user->avatar));
                }

                $imageName = time() . '.' . $avatar->getClientOriginalExtension();
                $imagePath = Helper::fileUpload($avatar, 'client/profile', $imageName);

                if ($imagePath === null) {
                    throw new \Exception('Failed to upload image.');
                }

                $user->avatar = $imagePath;
            }
        // Update user details
        $user->name = $request->name;     
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->vat_no = $request->vat_no;
        $user->save();
        
        return redirect()->route('dashboard')->with('t-success', 'Profile updated successfully.');

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
            return redirect()->intended(route('owner.page.update', absolute: false))->with('t-success', 'Login Successfully');
        } elseif (Auth::user()->hasRole('client')) {
            return redirect()->intended(route('client.page.update', absolute: false))->with('t-success', 'Login Successfully');
        } else {
            return redirect()->intended(route('home', absolute: false))->with('t-error', 'Something went wrong. Please try again.');
        }
    }
}
// client.page.update
// owner.dashboard