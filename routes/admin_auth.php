<?php


use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\ManageUserController;
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
        Route::get('about', [AdminDashboardController::class, 'about'])->name('dashboard.about');
    });

    Route::prefix('manage_user')->group(function (){
        Route::get('pending_account', [ManageUserController::class, 'pending_account'])->name('manage_user.pending_account');
        Route::get('pending_account_list', [ManageUserController::class, 'pending_account_list'])->name('manage_user.pending_account_list');
        Route::post('pending_account_show_docs', [ManageUserController::class, 'pending_account_show_docs'])->name('manage_user.pending_account_show_docs');
    });

});
