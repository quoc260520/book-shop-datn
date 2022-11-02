<?php

use App\Http\Controllers\Backend\DashboardController ;
Route::group([
    'middleware' => 'role:administrator|staff'
], function () { 
    Route::get('/dashboard',[DashboardController::class, 'index'])
        ->name('dashboard');
});