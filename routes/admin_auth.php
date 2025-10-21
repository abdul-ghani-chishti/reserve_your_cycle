<?php


use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

// link: admin/login
Route::prefix('admin')->middleware('guest:admin')->group(function () {

    Route::get('register', [RegisteredUserController::class, 'create'])->name('admin.register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [LoginController::class, 'create'])->name('admin.login');
    Route::post('login', [LoginController::class, 'store']);


});

Route::prefix('admin')->middleware('auth:admin')->name('admin.')->group(function () {

    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');

    Route::prefix('dashboard')->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('pending_account', [AdminDashboardController::class, 'pending_account'])->name('dashboard.pending_account');
        Route::get('about', [AdminDashboardController::class, 'about'])->name('dashboard.about');
    });

});
