<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        \Log::info('Login attempt for admin:', $credentials);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            // Redirect ke dashboard admin, bukan langsung ke books
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->with('error', 'Email atau kata sandi salah.');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('admin.login'));
    }
}
