<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SellController;

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

Route::get('/profile',[ProfileController::class,'edit'])->middleware('auth');

Route::post('/profile/update',[ProfileController::class,'update'])->middleware('auth');

Route::post('/logout', function () {
    auth()->logout();return redirect('/login');})->name('logout');

Route::get('/', [ItemController::class,'index']);

Route::get('/sell',[SellController::class, 'create']);
Route::post('sell',[SellController::class,'store']);