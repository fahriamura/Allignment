<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Unable to login using ' . $provider . '. Please try again.');
        }
    
        $user = User::where([
            'provider' => $provider,
            'provider_id' => $socialUser->getId()
        ])->first();
    
        if (!$user) {
            $user = User::create([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'password' => bcrypt(Str::random(16)),
                'email_verified_at' => now(),
            ]);
        }
    
        Auth::login($user);
    
        // Cek jika user adalah admin
        if ($user->isAdmin) {
            return redirect()->route('admin.dashboard');
        }
    
        return redirect()->route('user.dashboard');
    }
    

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
    
            // Cek jika user adalah admin
            if ($user->isAdmin) {
                
                return redirect()->route('admin.dashboard');
            }
    
            return redirect()->route('user.dashboard');
        }
    
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    
        try {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);
    
            Auth::login($user);
    
            return redirect()->route('user.dashboard');
    
        } catch (\Exception $e) {
            // Log the error
            \Log::error('User Registration Failed', ['error' => $e->getMessage()]);
            // Redirect back with an error message
            return back()->with('error', 'User registration failed. Please try again.');
        }
    }    
}