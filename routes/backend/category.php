<?php

use App\Http\Controllers\Backend\CategoryController;
Route::group(
    [
        'prefix' => 'category',
        'middleware' => 'role:administrator|staff',
    ],
    function () {
        Route::get('/index', [CategoryController::class, 'index'])->name('category.list');
        Route::post('/create', [CategoryController::class, 'createCategory'])->name('category.post.create');
        Route::get('/update/{id}', [CategoryController::class, 'getUpdate'])->name('category.update');
        Route::post('/update', [CategoryController::class, 'update'])->name('category.post.update');
        Route::post('/delete', [CategoryController::class, 'deleteCategorys'])->name('category.post.delete');
    },
);
