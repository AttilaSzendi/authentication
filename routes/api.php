<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RealEstateIndexController;
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', LoginController::class)->name('login')->middleware('guest');
Route::get('logout', LogoutController::class)->name('logout')->middleware('auth:sanctum');
Route::post('register', RegisterController::class)->name('register');
Route::get('real-estates', RealEstateIndexController::class)->name('realEstate.index');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
