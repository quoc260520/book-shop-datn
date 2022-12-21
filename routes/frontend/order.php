<?php

use App\Http\Controllers\Frontend\OrderController; ;

Route::group(
    [
        'prefix' => 'order',
        'middleware' => 'role:administrator|staff|user',
    ],
    function () {
        Route::get('/list', [OrderController::class, 'list'])->name('order.list');
    },
);
