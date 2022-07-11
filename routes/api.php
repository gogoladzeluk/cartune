<?php

use App\Http\Controllers\MobileVerificationController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\TrackingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/mobile-verification/send', [MobileVerificationController::class, 'send'])->name('api.mobile_verification.send');
Route::post('/mobile-verification/check', [MobileVerificationController::class, 'check'])->name('api.mobile_verification.check');

Route::post('/requests', [RequestController::class, 'store'])->name('api.request.store');
Route::post('/tracking/{type}', [TrackingController::class, 'store'])->name('api.tracking.store');
