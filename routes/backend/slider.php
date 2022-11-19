<?php

use App\Http\Controllers\Backend\SliderController;
Route::group(
    [
        'prefix' => 'slider',
        'middleware' => 'role:administrator|staff',
    ],
    function () {
        Route::get('/index', [SliderController::class, 'index'])->name('slider.list');
        Route::post('/create', [SliderController::class, 'createSlider'])->name('slider.create');
        Route::get('/update/{id}', [SliderController::class, 'getUpdateSlider'])->name('slider.get.update');
        Route::post('/update', [SliderController::class, 'updateSlider'])->name('slider.post.update');
        Route::post('/delete', [SliderController::class, 'deleteSlider'])->name('slider.delete');
    },
);
