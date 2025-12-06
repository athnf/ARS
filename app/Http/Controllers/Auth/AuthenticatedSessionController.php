<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Otentikasi bawaan Breeze (login check)
        $request->authenticate();

        // Regenerate session untuk keamanan
        $request->session()->regenerate();

        // Ambil user yang baru login
        $user = Auth::user();

        // REDIRECT BERDASARKAN ROLE
        if ($user->role === 'admin') {
            // ADMIN → dashboard admin
            return redirect()->intended(
                route('admin.dashboard', absolute: false)
            );
        }

        // USER BIASA → dashboard user
        return redirect()->intended(
            route('user.dashboard', absolute: false)
        );
    }

    /**
     * Logout user.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
