<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShortenController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/show/{short_url}', [ShortenController::class, 'show'])->name('show');

Route::post('/create-url', [ShortenController::class, 'create'])->name('create-url');

Route::get('/getQRCode/{short_url}', [ShortenController::class, 'getQRCode'])->name('getQRCode');

Route::get('/{short_url}', [ShortenController::class, 'redirect'])->name('redirect');
