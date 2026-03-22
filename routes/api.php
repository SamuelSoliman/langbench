<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TranslationController;

Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});

Route::post('/translate', [TranslationController::class, 'translate']);
