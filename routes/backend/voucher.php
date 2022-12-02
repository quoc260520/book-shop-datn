<?php

use App\Http\Controllers\Backend\VoucherController;
Route::group(
    [
        'prefix' => 'voucher',
        'middleware' => 'role:administrator|staff',
    ],
    function () {
        Route::get('/index', [VoucherController::class, 'index'])->name('voucher.list');
        Route::get('/create', [VoucherController::class, 'getCreate'])->name('voucher.create');
        Route::post('/create', [VoucherController::class, 'create'])->name('voucher.post.create');
        Route::get('/update/{id}', [VoucherController::class, 'getUpdate'])->name('voucher.update');
        Route::post('/update', [VoucherController::class, 'update'])->name('voucher.post.update');
        Route::post('/delete', [VoucherController::class, 'deleteVouchers'])->name('voucher.delete');
    },
);
