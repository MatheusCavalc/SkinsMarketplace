<?php

use App\Models\Sale;
use App\Models\Skin;
use App\Models\User;
use App\Models\UserSkin;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    Auth::loginUsingId(2);
    $notifications = Sale::where('buyer_id', auth()->user()->id)->orWhere('seller_id', auth()->user()->id)->latest()->get();

    dd($notifications);
});
