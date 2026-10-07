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
        $request->authenticate();

        // ---- Si el usuario está desactivado, cerrarle la sesión y mostrarle la pantalla ----
        if (! $request->user()->activo) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('cuenta.desactivada');
        }

        $request->session()->regenerate();

        // ---- Redirección según el rol del usuario ----
        return match ($request->user()->role) {
            'administrador' => redirect()->intended(route('dashboard.administrador')),
            'empleado'       => redirect()->intended(route('dashboard.empleado')),
            default          => redirect()->intended(route('dashboard.cliente')),
        };
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