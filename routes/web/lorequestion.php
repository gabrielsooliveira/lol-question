<?php

use App\Http\Controllers\LoreQuestion\RoleplayController;
use Illuminate\Support\Facades\Route;

Route::prefix('lorequestion')->group(function () {
    Route::get('/roleplay', [RoleplayController::class, 'roleplay'])->name('lorequestion.roleplay');
    Route::post('/finish', [RoleplayController::class, 'finishGame'])->name('finishGame');
    Route::get('/start', [RoleplayController::class, 'startGame'])->name('startGame');
});

