<?php
namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        $is_role = request()->input('is_role') ?? 'client';
        session()->put('is_role', $is_role);

        $supportedProviders = ['google'];
        if (!in_array($provider, $supportedProviders)) {
            return redirect()->route('login')->withErrors('Unsupported login provider.');
        }
        return Socialite::driver($provider)->redirect();

    }

    public function callback($provider)
    {
        
        try {
            $user = Socialite::driver($provider)->user();
            // Check if the user already exists
            $finduser = User::where('provider_id', $user->id)->orWhere('email', $user->email)->first();

            if ($finduser) {
                Auth::login($finduser);
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'provider_id' => $user->id,
                    'provider' => $provider,
                    'password' => Hash::make(Str::random(16))
                ]);

                $newUser->assignRole(session()->get('is_role'));
                Auth::login($newUser);
            }

            if (Auth::user()->hasRole('admin')) {
                return redirect()->intended(route('admin.dashboard', absolute: false))->with('t-success', 'Login Successfully');
            } elseif (Auth::user()->hasRole('owner')) {
                return redirect()->intended(route('owner.dashboard', absolute: false))->with('t-success', 'Login Successfully');
            } elseif (Auth::user()->hasRole('client')) {
                return redirect()->intended(route('dashboard', absolute: false))->with('t-success', 'Login Successfully');
            } else {
                return redirect()->intended(route('home', absolute: false))->with('t-error', 'Something went wrong. Please try again.');
            }
            
        } catch (Exception $e) {
            Log::error('Socialite callback error: ' . $e->getMessage());
            return redirect()->route('login')->withErrors('Unable to log in with ' . ucfirst($provider));
        }
    }

}

