<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\MechanicRegisterController;
use App\Http\Controllers\Auth\UserRegisterController;
use App\Http\Controllers\MobileVerificationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register-choose', fn() => view('auth.register-choose'))->name('register_choose');
Route::get('/register-user', [UserRegisterController::class, 'showRegistrationForm'])->name('register_user');
Route::post('/register-user', [UserRegisterController::class, 'register']);
Route::get('/register-mechanic', [MechanicRegisterController::class, 'showRegistrationForm'])->name('register_mechanic');
Route::post('/register-mechanic', [MechanicRegisterController::class, 'register']);
Route::post('/mobile-verification', [MobileVerificationController::class, 'sendCode'])->name('mobile_verification.send_code');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

