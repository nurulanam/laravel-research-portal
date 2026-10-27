<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * The account types that may be registered through these routes.
     *
     * @var array<int, string>
     */
    public const ACCOUNT_TYPES = ['researcher', 'participant'];

    /**
     * Display the registration view for the requested account type.
     */
    public function create(string $type): View
    {
        return view("auth.{$type}-register", ['accountType' => $type]);
    }

    /**
     * Handle an incoming registration request.
     *
     * The account type is taken from the route, so a submission to
     * /register/researcher always creates a researcher and a submission to
     * /register/participant always creates a participant. A posted "role"
     * value that does not match the route is rejected.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, string $type)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'role' => ['nullable', Rule::in([$type])],
        ], [
            'role.in' => "You are registering as a {$type}, so the selected account type must be {$type}.",
        ]);

        $user = DB::transaction(function () use ($request, $type) {
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $user->assignRole($type);

            return $user;
        });

        event(new Registered($user));

        Auth::login($user);

        return redirect('/dashboard');
    }
}
