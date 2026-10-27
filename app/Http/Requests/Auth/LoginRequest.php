<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email', 'exists:users'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials for the given account
     * type. Accounts are only signed in when they hold the matching role.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(?string $accountType = null): void
    {
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        if (! $this->accountHasAccess($accountType)) {
            // The credentials are valid but belong to the other account type,
            // so the session must not be kept.
            Auth::guard('web')->logout();

            $this->session()->invalidate();
            $this->session()->regenerateToken();

            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => $this->wrongAccountTypeMessage($accountType),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Determine if the authenticated user may use the given account type.
     */
    protected function accountHasAccess(?string $accountType): bool
    {
        if ($accountType === null) {
            return true;
        }

        /** @var User|null $user */
        $user = Auth::user();

        if ($user === null) {
            return false;
        }

        // Accounts without any role yet are allowed in so the rest of the
        // application stays usable; they simply have no dashboard access.
        if ($user->roles()->doesntExist()) {
            return true;
        }

        return $user->hasRole($accountType);
    }

    /**
     * Build the validation message shown when an account tries to sign in
     * through the wrong login form.
     */
    protected function wrongAccountTypeMessage(?string $accountType): string
    {
        $otherType = $accountType === 'researcher' ? 'participant' : 'researcher';

        return "These credentials do not belong to a {$accountType} account. Please use the {$otherType} login instead.";
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower((string) $this->input('email')).'|'.$this->ip());
    }
}
