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
        Route::post('/create', [BookController::class, 'create'])->name('book.post.create');
        Route::get('/update/{id}', [BookController::class, 'getUpdate'])->name('book.get.update');
        Route::post('/update/{id}', [BookController::class, 'update'])->name('book.post.update');
        Route::post('/delete', [BookController::class, 'delete'])->name('book.post.delete');
    },
);
