<?php

use App\Http\Controllers\RuneterraGuess\RuneterraGuessController;
use Illuminate\Support\Facades\Route;

Route::prefix('runeterraguess')->group(function () {
    Route::get('/', [RuneterraGuessController::class, 'index'])->name('runeterraguess.game');
    Route::post('/guess', [RuneterraGuessController::class, 'guess'])->name('runeterraguess.game.guess');
});
