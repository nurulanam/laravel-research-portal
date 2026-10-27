<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
|
| Login and registration are account type aware: the {type} segment must be
| either "researcher" or "participant". A researcher can only sign in or
| register through the researcher routes and a participant only through the
| participant routes — the controllers verify the role of the account.
|
*/

Route::middleware('guest')->group(function () {
    Route::get('register/{type}', [RegisteredUserController::class, 'create'])
                ->whereIn('type', RegisteredUserController::ACCOUNT_TYPES)
                ->name('register');

    Route::post('register/{type}', [RegisteredUserController::class, 'store'])
                ->whereIn('type', RegisteredUserController::ACCOUNT_TYPES);

    Route::get('login/{type}', [AuthenticatedSessionController::class, 'create'])
                ->whereIn('type', AuthenticatedSessionController::ACCOUNT_TYPES)
                ->name('login');

    Route::post('login/{type}', [AuthenticatedSessionController::class, 'store'])
                ->whereIn('type', AuthenticatedSessionController::ACCOUNT_TYPES);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
