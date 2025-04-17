<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/suppliers', [SupplierController::class, 'index']);
Route::post('/suppliers/creat', [SupplierController::class, 'store']);
Route::get('/suppliers/{id}', [SupplierController::class, 'show']);
Route::put('/suppliers/{id}/update', [SupplierController::class, 'update']);
Route::delete('/suppliers/{id}/delete', [SupplierController::class, 'destroy']);
