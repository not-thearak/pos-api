<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('getuserinfo', [ApiController::class, 'getUserInfo']);
Route::get('test', [ApiController::class, 'test']);
Route::post('getmodule', [ApiController::class, 'getModule']);
Route::post('login', [ApiController::class, 'login']);
