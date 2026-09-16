<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('confirm-sale', [ApiController::class, 'confirmSale']);
Route::post('update_qty', [ApiController::class, 'updateQty']);
Route::post('get-hold-products', [ApiController::class, 'getHoldProducts']);
Route::post('hold-insert',[ApiController::class, 'holdInsert']);
Route::post('get-category',[ApiController::class, 'getCategory']);
Route::post('get-all-products',[ApiController::class, 'getAllProducts']);
Route::post('getuserinfo', [ApiController::class, 'getUserInfo']);
Route::get('test', [ApiController::class, 'test']);
Route::post('getmodule', [ApiController::class, 'getModule']);
Route::post('login', [ApiController::class, 'login']);
