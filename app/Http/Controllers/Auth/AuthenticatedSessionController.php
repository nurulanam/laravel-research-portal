<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * The account types that may sign in through these routes.
     *
     * @var array<int, string>
     */
    public const ACCOUNT_TYPES = ['researcher', 'participant'];

    /**
     * Display the login view for the requested account type.
     */
    public function create(string $type): View
    {
        return view("auth.{$type}-login", ['accountType' => $type]);
    }

    /**
     * Handle an incoming authentication request.
     *
     * The credentials are only accepted when the account actually holds the
     * role of the route being used, so a participant cannot sign in through
     * the researcher login (and vice versa).
     */
    public function store(LoginRequest $request, string $type)
    {
        $request->authenticate($type);

        $request->session()->regenerate();

        return redirect()->intended('/dashboard');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
