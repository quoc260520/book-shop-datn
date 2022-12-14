<?php

use App\Http\Controllers\Frontend\BookController;

Route::group(
    [
        'prefix' => 'book',
        // 'middleware' => 'role:administrator|staff|user',
    ],
    function () {
        Route::get('/detail/{id}', [BookController::class, 'detail'])->name('book.detail');
        Route::post('/check-amount/{id}', [BookController::class, 'checkAmount'])->name('book.check-amount');
        Route::post('/comment/{id}', [BookController::class, 'comment'])->middleware('role:administrator|staff|user')->name('book.comment');


        // Route::post('/update', [AccountController::class, 'updateAccount'])->name('account.update');
        // Route::get('/change-password/{id}', [AccountController::class, 'getChangePassword'])->name('account.change-password');
        // Route::post('/change-password', [AccountController::class, 'changePassword'])->name('account.post.change-password');
    },
);
