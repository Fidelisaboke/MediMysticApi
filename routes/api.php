<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DrugController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/* Processes */
// Login and register
Route::controller(UserController::class)->group(function(){
    Route::post('register/process', 'register');
    Route::post('login/process', 'login');
});

// Logout
Route::middleware('auth:api')->post('logout', 'UserController@logout');

// Drugs API - insecure endpoint
Route::get('drugs', [DrugController::class, 'index']);
Route::get('drugs/{id}', [DrugController::class, 'show']);
Route::post('drugs', [DrugController::class, 'store']);
Route::put('drugs/{id}', [DrugController::class, 'update']);
Route::delete('drugs/{id}', [DrugController::class, 'destroy']);

// Get drugs of a specific category
Route::get('drugs/category/{category}', [DrugController::class, 'index']);

// Users API - secure endpoint
Route::middleware('auth:api')->get('users', [UserController::class, 'index']);
Route::middleware('auth:api')->get('users/{id}', [UserController::class, 'show']);

// Getting users based on specific params
Route::middleware('auth:api')->get('users/gender/{gender}',[UserController::class, 'show']);
Route::middleware('auth:api')->get('users/purchased-drug/{drug_category}', [UserController::class, 'show']);
Route::middleware('auth:api')->get('users/purchased-drug/{purchase_date}', [UserController::class, 'show']);
Route::middleware('auth:api')->get('users/last-login/{last_login}', [UserController::class, 'show']);
