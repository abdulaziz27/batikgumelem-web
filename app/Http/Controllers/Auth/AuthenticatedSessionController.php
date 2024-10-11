<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Filament\Facades\Filament;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
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
        $request->authenticate();

        $request->session()->regenerate();

        // Hapus session URL intended yang tersimpan
        $request->session()->forget('url.intended');

        // Cek apakah user memiliki role 'admin'
        if ($request->user()->hasRole('admin')) {
            // Jika admin, redirect ke halaman /admin
            return redirect(Filament::getUrl());
        }

        // Cek apakah user memiliki role 'admin'
        if ($request->user()->hasRole('author')) {
            // Jika admin, redirect ke halaman /admin
            return redirect(Filament::getUrl());
        }

        // Jika bukan admin, redirect ke halaman utama /
        return redirect()->intended('/');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
