<?php

use App\Http\Controllers\Backend\BookController;
Route::group(
    [
        'prefix' => 'book',
        'middleware' => 'role:administrator|staff',
    ],
    function () {
        Route::get('/index', [BookController::class, 'index'])->name('book.list');
        Route::get('/create', [BookController::class, 'getCreate'])->name('book.create');
    },
);
