<?php

use App\Http\Controllers\LoreQuestion\RoleplayController;
use App\Http\Controllers\Page\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/hub', [PageController::class, 'hub'])->name('hub');
Route::get('/lorequestion', [PageController::class, 'loreQuestionRoleplay'])->name('lorequestion.index');

Route::get('/lorequestion/roleplay', [RoleplayController::class, 'roleplay'])->name('lorequestion.roleplay');
Route::post('/lorequestion/submit', [RoleplayController::class, 'submitAnswer'])->name('submitAnswer');
Route::get('/lorequestion/start', [RoleplayController::class, 'startGame'])->name('startGame');
