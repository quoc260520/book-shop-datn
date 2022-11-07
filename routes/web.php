<?php

use App\Http\Controllers\Backend\Auth\AccountController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return redirect()-> route('index');
});

Route::get('/index', [IndexController::class, 'index'])->name('index');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('post.login');

Route::post('/register', [AccountController::class, 'register'])->name('register');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [AccountController::class, 'forgotPassword'])->name('forgotPassword');

Route::post('/forgot-password', [AccountController::class, 'sendMailForgotPassword'])->name('forgotPassword');

Route::get('/reset-password', [AccountController::class, 'resetPassword'])->name('resetPassword');

Route::get('auth/google', [LoginController::class, 'googleLogin'])->name('google.login');

Route::get('auth/google/callback', [LoginController::class, 'callback'])->name('google.callback');

Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    include_route_files(__DIR__ . '/backend/');
});
