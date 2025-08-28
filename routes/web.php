<?php

use App\Http\Controllers\Game\GameController;
use App\Http\Controllers\Page\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index'])->name('home');

Route::get('/question', [GameController::class, 'index'])->name('lorequestion.index');

Route::get('/question/roleplay', [GameController::class, 'roleplay'])->name('lorequestion.roleplay');

// Mude a rota de submissão da resposta para POST
Route::post('/questions/submit', [GameController::class, 'submitAnswer'])->name('submitAnswer');

// A rota para buscar a pergunta pode permanecer GET
Route::get('/questions', [GameController::class, 'startGame'])->name('startGame');
