<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\MypageController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;


Route::get('/', [ItemController::class, 'index']);

Route::get('/item/{item_id}', [ItemController::class, 'show']);

Route::middleware(['auth', 'verified'])->group(function () {

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
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/mypage/profile');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', '認証メールを再送しました');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
