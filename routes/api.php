<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TranslationController;
use App\Http\Controllers\AuthController;

Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});

Route::post('/translate', [TranslationController::class, 'translate']);
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
