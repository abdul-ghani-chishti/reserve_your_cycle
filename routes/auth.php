<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\CycleBookingController;
use App\Http\Controllers\Auth\CycleInfoController;
use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

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
});

// users -> 1 having by cycle/ 0 not having by-cycle, auth is for user (1/0)
Route::middleware('auth')->group(function () {

    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
    });

    Route::prefix('cycle_info')->name('cycle_info.')->group(function () {
        Route::post('add_cycle_modal_form', [CycleInfoController::class, 'add_cycle_modal_form'])->name('add_cycle_modal_form');
        Route::get('deactivate_cycle', [CycleInfoController::class, 'deactivate_cycle'])->name('deactivate_cycle');
        Route::get('activate_cycle', [CycleInfoController::class, 'activate_cycle'])->name('activate_cycle');
        Route::get('show_cycle_details/{date}', [CycleInfoController::class, 'show_cycle_details'])->name('show_cycle_details');
        Route::get('show_cycle_details_hours/{cycle_id}/{available_date}', [CycleInfoController::class, 'show_cycle_details_hours'])->name('show_cycle_details_hours');
        Route::post('reserve_available_hours_form', [CycleInfoController::class, 'reserve_available_hours_form'])->name('reserve_available_hours_form');
    });


    Route::prefix('booking')->name('booking.')->group(function () {
        Route::get('user_reservation', [CycleBookingController::class, 'user_reservation'])->name('user_reservation'); // user reservation history
        Route::get('user_reservation_list', [CycleBookingController::class, 'user_reservation_list'])->name('user_reservation_list'); // user reservation history
        Route::post('cancel_booking', [CycleBookingController::class, 'cancel_booking'])->name('cancel_booking'); // user reservation history
    });


    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

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
