<?php

use App\Http\Controllers\Backend\PublisherController;

Route::group(
    [
        'prefix' => 'publisher',
        'middleware' => 'role:administrator|staff',
    ],
    function () {
        Route::get('/index', [PublisherController::class, 'index'])->name('publisher.list');
        Route::get('/create', [PublisherController::class, 'getCreate'])->name('publisher.create');
        Route::post('/create', [PublisherController::class, 'create'])->name('publisher.post.create');
        Route::get('/update/{id}', [PublisherController::class, 'getUpdate'])->name('publisher.update');
        Route::post('/update', [PublisherController::class, 'update'])->name('publisher.post.update');
        Route::post('/delete', [PublisherController::class, 'deletePublishers'])->name('publisher.post.delete');
    },
);
