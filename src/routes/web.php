<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\MypageController;


Route::get('/', [ItemController::class, 'index']);

Route::get('/item/{item_id}', [ItemController::class, 'show']);

Route::middleware('auth')->group(function () {

    Route::get('/sell', [ItemController::class, 'create']);

    Route::post('/sell', [ItemController::class, 'store']);

    Route::get('/mypage', [MypageController::class, 'index']);

    Route::get('/mypage/profile', [MypageController::class, 'edit']);

    Route::post('/mypage/profile', [MypageController::class, 'update']);

    Route::get('/purchase/{item_id}', [PurchaseController::class, 'index']);

    Route::post('/purchase/{item_id}', [PurchaseController::class, 'store']);

    Route::post('/item/{item_id}/like', [ItemController::class, 'like']);

    Route::post('/item/{item_id}/comment', [ItemController::class, 'comment']);

    Route::get('/purchase/address/{item_id}', [PurchaseController::class, 'editAddress']);

    Route::post('/purchase/address/{item_id}', [PurchaseController::class, 'updateAddress']);

});

