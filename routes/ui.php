<?php

use Illuminate\Support\Facades\Route;
use UI\Http\Controllers\TranslationController;

Route::get('/translations/{locale}', [TranslationController::class, 'getTranslations']);

Route::fallback(function () {
    return view('application');
});
