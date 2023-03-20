<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('base');

Route::prefix('books')->name('books-')->group(function () {
    Route::post('info', [BookController::class, 'info'])->name('info');
});
