<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\MechanicRegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\UserRegisterController;
use App\Http\Controllers\MechanicController;
use App\Http\Controllers\MobileVerificationController;
use App\Http\Controllers\ReviewController;
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
Route::post('/mobile-verification', [MobileVerificationController::class, 'sendCode'])->name('mobile_verification.send_code');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register-choose', fn() => view('auth.register-choose'))->name('register_choose');
Route::get('/register-user', [UserRegisterController::class, 'showRegistrationForm'])->name('register_user');
Route::post('/register-user', [UserRegisterController::class, 'register']);
Route::get('/register-mechanic', [MechanicRegisterController::class, 'showRegistrationForm'])->name('register_mechanic');
Route::post('/register-mechanic', [MechanicRegisterController::class, 'register']);
Route::get('/reset-password', [ResetPasswordController::class, 'showResetForm'])->name('reset_password');
Route::post('/reset-password', [ResetPasswordController::class, 'reset']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/mechanics', [MechanicController::class, 'index'])->name('mechanics.index');
Route::get('/mechanics/{id}', [MechanicController::class, 'show'])->name('mechanics.show');

Route::middleware(['auth', 'isReviewAllowed'])->group(function () {
    Route::get('/mechanics/{id}/review', [ReviewController::class, 'showReviewForm'])->name('mechanics.review');
    Route::post('/mechanics/{id}/review', [ReviewController::class, 'review']);
});
