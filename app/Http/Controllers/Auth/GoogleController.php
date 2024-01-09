<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }
    public function googleCallback()
    {
        $google_user = Socialite::driver('google')->stateless()->user();
        $userExisted = User::where('oauth_id', $google_user->id)->where('oauth_type', 'google')->first();
        if ($userExisted) {
            Auth::login($userExisted);
            return redirect()->route('home');
        }
        $user = User::create([
            'name' => $google_user->name,
            'email' => $google_user->email,
            'password' => Hash::make($google_user->id),
            'oauth_id' => $google_user->id,
            'oauth_type' => 'google',
        ]);
        return redirect()->route('home');
    }
}
