<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryManagementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome'); 
});

Route::get('/api/inventory', action: [InventoryManagementController::class, 'index']);
Route::get('/api/inventory/product/{productId}', [InventoryManagementController::class, 'showByProduct']);
Route::post('/api/inventory', [InventoryManagementController::class, 'store']);
Route::put('/api/inventory/{id}', [InventoryManagementController::class, 'update']);
Route::delete('/api/inventory/{id}', [InventoryManagementController::class, 'destroy']);
