<?php
use App\Http\Controllers\NotificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/notification', [NotificationController::class, 'index']);        // Get all notifications
    Route::post('/create/notification', [NotificationController::class, 'store']);       // Create new notification
    Route::get('/show/{id}', [NotificationController::class, 'show']);      // Get a specific notification
    Route::put('/update/{id}', [NotificationController::class, 'update']);    // Update a notification
    Route::delete('/delete/{id}', [NotificationController::class, 'destroy']);
    