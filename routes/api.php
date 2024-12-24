<?php

use App\Http\Controllers\SteganographyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/encode-image', [SteganographyController::class, 'encodeImage']);
Route::post('/decode-image', [SteganographyController::class, 'decodeImage']);
