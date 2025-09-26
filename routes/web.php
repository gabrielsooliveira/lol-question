<?php

use App\Http\Controllers\Hangman\HangmanController;
use App\Http\Controllers\LoreQuestion\RoleplayController;
use App\Http\Controllers\Page\PageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/menu', [PageController::class, 'menu'])->name('menu');

Route::get('/lorequestion', [PageController::class, 'loreQuestion'])->name('lorequestion.index');
Route::get('/lorequestion/roleplay', [RoleplayController::class, 'roleplay'])->name('lorequestion.roleplay');
Route::post('/lorequestion/finish', [RoleplayController::class, 'finishGame'])->name('finishGame');
Route::get('/lorequestion/start', [RoleplayController::class, 'startGame'])->name('startGame');

Route::get('/hangman', [HangmanController::class, 'index'])->name('hangman.index');
Route::post('/hangman/guess', [HangmanController::class, 'guess'])->name('hangman.guess');
Route::post('/hangman/restart', [HangmanController::class, 'restart'])->name('hangman.restart');

Route::post('/locale/{locale}', function ($locale) {
    $available = ['en', 'pt'];

    if (in_array($locale, $available)) {
        Session::put('locale', $locale);
    }

    return back();
})->name('locale.change');

Route::get('/privacy-policy', function () {
    return inertia('PrivacyPolicy');
})->name('privacy.policy');
