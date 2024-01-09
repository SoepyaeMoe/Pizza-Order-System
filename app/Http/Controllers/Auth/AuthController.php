<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('auth.login');
    }
    public function registerPage()
    {
        return view('auth.register');

    }
    public function authenticated()
    {
        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin.home');
        }
        if (Auth::user()->role == 'user') {
            if (Auth::user()->oauth_type == 'google') {
                Auth::logout();
                return redirect()->route('login_page')->with('error', 'Stop! Bad request.');
            }
            return redirect()->route('home');
        }
        return back()->withErrors(['fail' => 'Something wroung.'])->withInput();
    }
}
