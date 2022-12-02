<?php

use App\Http\Controllers\Backend\AccountController;

Route::group(
    [
        'prefix' => 'account',
        'middleware' => 'role:administrator',
    ],
    function () {
        Route::get('/index', [AccountController::class, 'index'])->name('account.list');
        Route::get('/create', [AccountController::class, 'getCreate'])->name('account.create');
        Route::post('/create', [AccountController::class, 'create'])->name('account.post.create');
        Route::get('/update/{id}', [AccountController::class, 'getUpdate'])->name('account.update');
        Route::post('/update', [AccountController::class, 'update'])->name('account.post.update');
        Route::post('/delete', [AccountController::class, 'deleteAccounts'])->name('account.post.delete');
    },
);
