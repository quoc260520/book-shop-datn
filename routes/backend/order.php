<?php

use App\Http\Controllers\Backend\OrderController;
Route::group(
    [
        'prefix' => 'order',
        'middleware' => 'role:administrator|staff',
    ],
    function () {
        Route::get('/index', [OrderController::class, 'index'])->name('order.list');
        Route::get('/detail/{id}', [OrderController::class, 'getOrderById'])->name('order.detail');
        Route::post('/update', [OrderController::class, 'updateOrder'])->name('order.update');
        Route::post('/cancel', [OrderController::class, 'cancelOrder'])->name('order.cancel');
    },
);
