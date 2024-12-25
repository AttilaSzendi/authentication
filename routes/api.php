<?php

use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('login', LoginController::class)->name('login');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
