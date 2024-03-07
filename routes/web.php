<?php

use App\Http\Controllers\VillageController;
use Illuminate\Support\Facades\Route;

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

Route::get('/api/desa', [VillageController::class, 'index']);
Route::post('/api/desa', [VillageController::class, 'store']);
Route::get('/api/desa/{id}', [VillageController::class, 'show']);
Route::put('/api/desa/{id}', [VillageController::class, 'update']);
Route::delete('/api/desa/{id}', [VillageController::class, 'destroy']);