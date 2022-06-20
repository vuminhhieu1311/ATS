<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function login($provider)
    {
        $provider = strtolower($provider);

        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function callback(Request $request, $provider)
    {
        $provider = strtolower($provider);
        $user = Socialite::driver($provider)->stateless()->user();

        $createdUser = User::firstOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->name,
                'password' => Hash::make(Str::random(24)),
            ]
        );

        Auth::login($createdUser, true);
        $request->session()->regenerate();

        return redirect(env('SPA_URL') . '/auth/callback');
    }
}
