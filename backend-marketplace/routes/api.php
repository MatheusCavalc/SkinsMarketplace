<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\User\SkinController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/verify-token', [AuthController::class, 'verify'])->middleware('auth:sanctum');

Route::get('home', [HomeController::class, 'home']);

Route::get('/search/{search}', [HomeController::class, 'search']);

Route::get('/user/skins', [UserController::class, 'skins'])->middleware('auth:sanctum');
Route::get('/user/skins/sale', [UserController::class, 'skinsForSale'])->middleware('auth:sanctum');
Route::get('/user/sale', [UserController::class, 'sale'])->middleware('auth:sanctum');
Route::get('/user/buy', [UserController::class, 'buy'])->middleware('auth:sanctum');
Route::get('/user/notifications', [UserController::class, 'notifications'])->middleware('auth:sanctum');

Route::apiResource('skin', SkinController::class)->middleware('auth:sanctum');

Route::post('/checkout', [CheckoutController::class, 'checkout'])->middleware('auth:sanctum');
