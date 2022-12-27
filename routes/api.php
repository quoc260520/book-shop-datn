<?php

use App\Http\Controllers\Backend\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('export', [BookController::class, 'exportBook']);
Route::post('import', [BookController::class, 'importBook']);
Route::post('upload_data_rcm', [BookController::class, 'uploadFileRecomment']);

