<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\NewspaperController;
use Illuminate\Support\Facades\Route;

// Public Newspaper Routes
Route::get('/', [NewspaperController::class, 'index'])->name('newspaper.index');
Route::get('/article/{id}', [NewspaperController::class, 'showArticle'])->name('newspaper.article');
Route::post('/tribute/submit', [NewspaperController::class, 'submitTribute'])->name('newspaper.tribute.submit');
Route::get('/print-edition', [NewspaperController::class, 'printKeepsake'])->name('newspaper.print');

// Admin Newsroom CMS Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::post('/login', [AdminController::class, 'login'])->name('login');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    Route::post('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');
    
    // Articles CRUD
    Route::post('/articles', [AdminController::class, 'storeArticle'])->name('articles.store');
    Route::put('/articles/{id}', [AdminController::class, 'updateArticle'])->name('articles.update');
    Route::delete('/articles/{id}', [AdminController::class, 'deleteArticle'])->name('articles.delete');

    // Crossword & Tributes
    Route::put('/crossword/{id}', [AdminController::class, 'updateCrossword'])->name('crossword.update');
    Route::put('/tributes/{id}', [AdminController::class, 'updateTribute'])->name('tributes.update');
    Route::post('/tributes/{id}/toggle', [AdminController::class, 'toggleTribute'])->name('tributes.toggle');
    Route::delete('/tributes/{id}', [AdminController::class, 'deleteTribute'])->name('tributes.delete');
});
