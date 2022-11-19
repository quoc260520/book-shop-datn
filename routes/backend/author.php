<?php

use App\Http\Controllers\Backend\AuthorController;
Route::group(
    [
        'prefix' => 'author',
        'middleware' => 'role:administrator|staff',
    ],
    function () {
        Route::get('/index', [AuthorController::class, 'index'])->name('author.list');
        Route::get('/create', [AuthorController::class, 'getCreate'])->name('author.create');
        Route::post('/create', [AuthorController::class, 'create'])->name('author.post.create');
        Route::get('/update/{id}', [AuthorController::class, 'getUpdate'])->name('author.get.update');
        Route::post('/update/{id}', [AuthorController::class, 'update'])->name('author.post.update');
        Route::post('/delete', [AuthorController::class, 'delete'])->name('author.post.delete');
    },
);
