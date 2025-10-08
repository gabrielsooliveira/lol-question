<?php

use App\Http\Controllers\Page\PageController;
use App\Http\Controllers\User\TermsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/games', [PageController::class, 'menu'])->name('menu');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/partnes', [PageController::class, 'partnes'])->name('partnes');
Route::get('/privacy-policy', [PageController::class, 'privatePolicy'])->name('privacy.policy');
Route::get('/terms', [PageController::class, 'terms'])->name('terms');
Route::get('/lorequestion', [PageController::class, 'loreQuestion'])->name('lorequestion.index');
Route::post('/locale/{locale}', [PageController::class, 'translate'])->name('locale.change');

Route::post('/terms/accept', [TermsController::class, 'accept'])
    ->middleware('auth')
    ->name('terms.accept');
