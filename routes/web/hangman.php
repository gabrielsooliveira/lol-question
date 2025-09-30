<?php

use App\Http\Controllers\Hangman\HangmanController;
use Illuminate\Support\Facades\Route;

Route::prefix('hangman')->group(function () {
    Route::get('/', [HangmanController::class, 'index'])->name('hangman.index');
    Route::post('/guess', [HangmanController::class, 'guess'])->name('hangman.guess');
    Route::post('/reset', [HangmanController::class, 'reset'])->name('hangman.reset');
});
