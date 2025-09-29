<?php

use App\Http\Controllers\Page\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/menu', [PageController::class, 'menu'])->name('menu');
Route::get('/privacy-policy', [PageController::class, 'privatePolicy'])->name('privacy.policy');
Route::get('/lorequestion', [PageController::class, 'loreQuestion'])->name('lorequestion.index');
Route::post('/locale/{locale}', [PageController::class, 'translate'])->name('locale.change');
