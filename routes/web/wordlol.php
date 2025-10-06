<?php

use App\Http\Controllers\WordLoL\WordLoLController;
use Illuminate\Support\Facades\Route;

Route::prefix('wordlol')->group(function () {
    Route::get('/', [WordLoLController::class, 'index'])->name('wordlol.game');
    Route::post('/guess', [WordLoLController::class, 'guess'])->name('wordlol.game.guess');
});
