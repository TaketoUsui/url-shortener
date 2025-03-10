<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShortenController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::post('/create-url', [ShortenController::class, 'create'])->name('create-url');

Route::get('/{short_url}', [ShortenController::class, 'redirect'])->name('redirect');
