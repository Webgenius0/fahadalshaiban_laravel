<?php

use App\Http\Controllers\Web\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Web\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Web\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Web\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Web\Auth\NewPasswordController;
use App\Http\Controllers\Web\Auth\OtpVerificationController;
use App\Http\Controllers\Web\Auth\PasswordController;
use App\Http\Controllers\Web\Auth\PasswordResetLinkController;
use App\Http\Controllers\Web\Auth\RegisteredUserController;
use App\Http\Controllers\Web\Auth\SocialController;
use App\Http\Controllers\Web\Auth\VerifyEmailController;
use App\Http\Middleware\OtpController;
use App\Models\Otp;
use Illuminate\Support\Facades\Route;

Route::middleware('authCheck')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::get('register/owner', [RegisteredUserController::class, 'createOwner'])->name('register.owner');   

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');

    // Social authentication routes
    Route::get('/social-login/{provider}/redirect', [SocialController::class, 'redirect'])->name('social-login.redirect');
    Route::get('/social-login/{provider}/callback', [SocialController::class, 'callback'])->name('social-login.callback');
});

Route::middleware('auth')->group(function () {
    /* Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify'); */


    Route::get('email/otp/show', [OtpVerificationController::class, 'index'])->name('email.otp.show');
    Route::post('email/otp/send', [OtpVerificationController::class, 'store'])->name('email.otp.send');
    Route::controller(OtpVerificationController::class)->group(function () {
        Route::get('page/update', 'updateProfile')->name('client.page.update');
        Route::put('page/update', 'update')->name('client.update');

        Route::get('owner/update', 'updateOwner')->name('owner.page.update');
        Route::put('owner/update', 'ownerUpdate')->name('owner.biodata.update');
    });

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
