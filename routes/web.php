<?php

use App\Http\Controllers\Backend\Auth\AccountController;
use App\Http\Controllers\Frontend\CartController;
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

Route::get('/search', [IndexController::class, 'search'])->name('search');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

Route::get('/add-cart/{id}', [CartController::class, 'addToCart'])->name('add-cart');
Route::post('/update-cart/{id}', [CartController::class, 'updateCart'])->name('update-cart');
Route::delete('/delete-cart/{id}', [CartController::class, 'deleteCart'])->name('delete-cart');
Route::post ('/check-payment', [CartController::class, 'checkPayment'])->name('check-payment');
Route::post ('/apply-voucher', [CartController::class, 'applyVoucher'])->name('apply-voucher');
Route::post ('/payment', [CartController::class, 'payment'])->name('payment');
Route::post ('/apply-payment', [CartController::class, 'applyPayment'])->name('apply-payment');

Route::post('/login', [LoginController::class, 'login'])->name('post.login');

Route::post('/register', [AccountController::class, 'register'])->name('register');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/cart', [CartController::class, 'index'])->name('cart');

Route::get('/forgot-password', [AccountController::class, 'forgotPassword'])->name('forgotPassword');

Route::post('/forgot-password', [AccountController::class, 'sendMailForgotPassword'])->name('forgotPassword');

Route::get('/reset-password', [AccountController::class, 'resetPassword'])->name('resetPassword');

Route::get('auth/google', [LoginController::class, 'googleLogin'])->name('google.login');

Route::get('auth/google/callback', [LoginController::class, 'callback'])->name('google.callback');

Route::get('/drive/callback', [LoginController::class, 'driveCallback'])->name('drive.callback');


Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    include_route_files(__DIR__ . '/backend/');
});

Route::group(['namespace' => 'Frontend'], function () {
    include_route_files(__DIR__ . '/frontend/');
});
