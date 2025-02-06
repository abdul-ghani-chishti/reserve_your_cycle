<?php


use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('guest:admin')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('admin.register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [LoginController::class, 'create'])->name('admin.login');
    Route::post('login', [LoginController::class, 'store']);
});

Route::prefix('admin')->middleware('auth:admin')->group(function () {

    Route::post('logout', [LoginController::class, 'destroy'])->name('admin.logout');
    Route::get('/dashboard',function (){
     return view('admin.dashboard');
    })->name('admin.dashboard');

//    Route::prefix('dashboard')->name('dashboard.')->group(function () {
//        Route::get('', [AdminDashboardController::class, 'index'])->name('index');
//    });

//    Route::get('/dashboard', function () {
//        return view('admin.dashboard');
//    })->name('admin.dashboard');
});
