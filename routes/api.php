<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DrugController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\DrugCategoryController;
use App\Http\Controllers\Api\AdminController;
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

// Login - Admin
Route::post('admin/login', [AdminController::class, 'login']);

// Login and register - API user
Route::controller(UserController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});

// Logout - API user
Route::middleware('auth:sanctum')->post('logout', [UserController::class, 'logout']);

// Drugs - insecure endpoints
Route::get('drugs', [DrugController::class, 'index']);
Route::get('drugs/{id}', [DrugController::class, 'show']);
Route::post('drugs', [DrugController::class, 'store']);
Route::put('drugs/{id}', [DrugController::class, 'update']);
Route::delete('drugs/{id}', [DrugController::class, 'destroy']);

// Get drugs of a specific category
Route::get('drugs/category/{id}', [DrugController::class, 'indexByDrugCategory']);

// Drugs by user - secure endpoint
Route::middleware('auth:sanctum')->get('clients/{id}/drugs', [DrugController::class, 'index']);

// Clients (end-users) - secure endpoints (Both regular and premium API users)
Route::middleware('auth:sanctum')->group(function(){
    Route::get('clients', [ClientController::class, 'index']);
    Route::get('clients/{id}', [ClientController::class, 'show']);
    Route::post('clients', [ClientController::class, 'store']);
    Route::put('clients/{id}', [ClientController::class, 'update']);
    Route::delete('clients/{id}', [ClientController::class, 'destroy']);
});

// Clients based on specific params - Premium API users only
Route::middleware(['auth:sanctum', 'check.subscription'])->group(function(){
    Route::get('clients/gender/{gender}',[ClientController::class, 'index']);
    Route::get('clients/purchased/category/{drug_category}', [ClientController::class, 'index']);
    Route::get('clients/purchased/date/{purchase_date}', [ClientController::class, 'index']);
    Route::get('clients/last-login/latest', [ClientController::class, 'indexByLastLogin']);
});

// Drug categories
Route::get('drug-categories', [DrugCategoryController::class, 'index']);
Route::get('drug-categories/{id}', [DrugCategoryController::class, 'show']);
Route::post('drug-categories', [DrugCategoryController::class, 'store']);
Route::put('drug-categories/{id}', [DrugCategoryController::class, 'update']);
Route::delete('drug-categories/{id}', [DrugCategoryController::class, 'destroy']);
