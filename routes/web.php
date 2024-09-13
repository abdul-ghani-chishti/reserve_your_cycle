<?php

use Illuminate\Support\Facades\Route;

//web routes
Route::get('/', function () {
    return view('welcome');
});

//admin routes
Route::get('/new_welcome', function () {
    return view('admin.new_welcome');
});
