<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\SignInController;
use App\Http\Controllers\RegisterController;

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

/* VIEWS */
// Homepage
Route::view('home', 'home');

// Register and Sign-in
Route::view('register', 'register');
Route::view('sign-in', 'sign_in');

// User dashboard
Route::view('user-dashboard', 'user_dashboard');

/* PROCESS */
Route::post('sign-in/process', [SignInController::class, 'signIn']);
Route::post('register/process', [RegisterController::class, 'register']);