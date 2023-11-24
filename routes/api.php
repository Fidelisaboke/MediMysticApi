<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DrugController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Drugs API
Route::get('drugs', [DrugController::class, 'index']);
Route::get('drugs/{id}', [DrugController::class, 'show']);
Route::post('drugs', [DrugController::class, 'store']);
Route::put('drugs/{id}', [DrugController::class, 'update']);
Route::delete('drugs/{id}', [DrugController::class, 'destroy']);
