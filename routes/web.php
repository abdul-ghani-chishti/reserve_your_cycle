<?php

use Illuminate\Support\Facades\Route;

//web routes
Route::get('/', function () {
    return view('welcome');
});

//admin routes
Route::get('/admin', function () {
    return view('admin.new_welcome');
});

//user
Route::get('/user', function () {
    return view('user.new_user_welcome');
});
