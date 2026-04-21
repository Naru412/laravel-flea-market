<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\CommentController;


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

Route::get('/item/{item}', [ItemController::class, 'show']);

Route::post('/like/{item}', [LikeController::class, 'toggle'])->middleware('auth');

Route::get('/purchase/{item}', [PurchaseController::class, 'create'])->middleware('auth');

Route::post('/comment/{item}', [CommentController::class, 'store'])->middleware('auth');

Route::post('/purchase/{item}', [PurchaseController::class, 'store']);

Route::get('/purchase/address/{item}', [PurchaseController::class, 'editAddress']);
Route::post('/purchase/address/{item}', [PurchaseController::class, 'updateAddress']);
Route::get('/purchase/success/{item}', [PurchaseController::class, 'success']);