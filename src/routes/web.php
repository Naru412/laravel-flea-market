<?php

use Illuminate\Support\Facades\Route;
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
*/


// 商品一覧・詳細
Route::get('/', [ItemController::class, 'index']);

Route::get('/item/{item}', [ItemController::class, 'show']);



// 認証必須（ログイン済み）
Route::middleware('auth')->group(function () {

    // いいね・コメント
    Route::post('/like/{item}', [LikeController::class, 'toggle']);
    Route::post('/comment/{item}', [CommentController::class, 'store']);

    // マイページ
    Route::get('/mypage', [ProfileController::class, 'show']);

    // プロフィール編集・更新
    Route::get('/mypage/profile', [ProfileController::class, 'edit']);
    Route::post('/mypage/profile', [ProfileController::class, 'update']);

    // 商品出品
    Route::get('/sell', [SellController::class, 'create']);
    Route::post('/sell', [SellController::class, 'store']);

    // 商品購入
    Route::get('/purchase/{item}', [PurchaseController::class, 'create']);
    Route::post('/purchase/{item}', [PurchaseController::class, 'store']);

    // 住所変更
    Route::get('/purchase/address/{item}', [PurchaseController::class, 'editAddress']);
    Route::post('/purchase/address/{item}', [PurchaseController::class, 'updateAddress']);

    // 購入完了
    Route::get('/purchase/success/{item}', [PurchaseController::class, 'success']);
});



// ログアウト
Route::post('/logout', function () {
    auth()->logout();
    return redirect('/login');
})->name('logout');