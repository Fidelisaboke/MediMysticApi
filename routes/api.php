<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DrugController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\UserController;

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

Route::middleware('auth:sanctum')->get('/client', function (Request $request) {
    return $request->client();
});

/* Processes */
// Login and register - API user
Route::controller(UserController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});

// Logout
Route::middleware('auth:sanctum')->post('logout', [ClientController::class, 'logout']);

// Drugs - insecure endpoints
Route::get('drugs', [DrugController::class, 'index']);
Route::get('drugs/{id}', [DrugController::class, 'show']);
Route::post('drugs', [DrugController::class, 'store']);
Route::put('drugs/{id}', [DrugController::class, 'update']);
Route::delete('drugs/{id}', [DrugController::class, 'destroy']);

// Get drugs of a specific category
Route::get('drugs/category/{category}', [DrugController::class, 'index']);

// Drugs by user - secure endpoint
Route::middleware('auth:api')->get('clients/{id}/drugs', [DrugController::class, 'index']);

// Clients (end-users) - secure endpoints
Route::middleware('auth:sanctum')->group(function(){
    Route::get('clients', [ClientController::class, 'index']);
    Route::get('clients/{id}', [ClientController::class, 'show']);
    Route::post('clients', [ClientController::class, 'show']);
    Route::put('clients/{id}', [ClientController::class, 'update']);
    Route::delete('clients/{id}', [ClientController::class, 'destroy']);
    
    // Clients based on specific params
    Route::get('clients/gender/{gender}',[ClientController::class, 'index']);
    Route::get('clients/purchased/category/{drug_category}', [ClientController::class, 'index']);
    Route::get('clients/purchased/date/{purchase_date}', [ClientController::class, 'index']);
    Route::get('clients/last-login/{last_login}', [ClientController::class, 'index']);
});