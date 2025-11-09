<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirebaseNotificationController;

//Route::post('/save-fcm-token', [FirebaseNotificationController::class, 'saveToken']);
Route::post('/send-test-push', [FirebaseNotificationController::class, 'sendTest']);

