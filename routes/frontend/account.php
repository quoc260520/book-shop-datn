<?php

use App\Http\Controllers\Frontend\AccountController;

Route::group(
    [
        'prefix' => 'account',
        'middleware' => 'role:administrator|staff|user',
    ],
    function () {
        Route::get('/info/{id}', [AccountController::class, 'showInfo'])->name('account.info');
        Route::post('/update', [AccountController::class, 'updateAccount'])->name('account.update');
        Route::get('/change-password/{id}', [AccountController::class, 'getChangePassword'])->name('account.change-password');
        Route::post('/change-password', [AccountController::class, 'changePassword'])->name('account.post.change-password');
    },
);
