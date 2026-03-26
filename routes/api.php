<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TranslationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TextController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\SavedWordController;

Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});

Route::post('/translate', [TranslationController::class, 'translate']);
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('texts', TextController::class);
    Route::apiResource('quizzes', QuizController::class);
    Route::apiResource('saved-words', SavedWordController::class);
});
