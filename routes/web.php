<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\UserDashboardController;
use Illuminate\Support\Facades\Route;

//web routes
Route::get('/', function () {
    return view('welcome');
});


//Route::prefix('login')->name('login.')->group(function () {
//    Route::get('', [LoginController::class,'index'])->name('index');
//
//    Route::get('admin_login', [LoginController::class,'admin_login'])->name('admin_login');
//    Route::post('admin_login_request', [LoginController::class,'admin_login'])->name('admin_login_request');
//    //    dd('k');
//    Route::get('user_login', [LoginController::class,'user_login'])->name('user_login');
//    Route::post('user_login_request', [LoginController::class,'user_login_request'])->name('user_login_request');
//});
//
////admin routes
//Route::prefix('admin')->name('admin.')->group(function (){
//    Route::get('', [AdminDashboardController::class,'index'])->name('index');
//    Route::prefix('dashboard')->name('dashboard.')->group(function () {
//        Route::get('', [AdminDashboardController::class,'index'])->name('index');
//    });
//});
//
////user routes
//Route::prefix('user')->name('user.')->group(function (){
////    dd(6);
//    Route::get('', [UserDashboardController::class,'index'])->name('index');
//});
