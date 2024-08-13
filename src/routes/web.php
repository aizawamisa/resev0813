<?php

use App\Http\Controllers\ShopController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReservationController;
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

// Simple views
Route::view('/thanks', 'auth.thanks');
Route::view('/done', 'done')->name('done');

// Shop related routes
Route::controller(ShopController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/search', 'search')->name('search');
    Route::get('/detail/{shop_id}', 'detail')->name('shop.detail');
});

// Authenticated and verified user routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/logout', 'destroy');
        Route::get('/mypage', 'index');
    });

    // Reservation routes
    Route::prefix('reservation')->controller(ReservationController::class)->group(function () {
        Route::post('/store/{shop}', 'store')->name('reservation');
        Route::delete('/destroy/{reservation}', 'destroy')->name('reservation.destroy');
    });

    // Favorites
    Route::controller(FavoriteController::class)->group(function () {
        Route::post('/favorite/store/{shop}', 'store')->name('favorite');
        Route::delete('/favorite/destroy/{shop}', 'destroy')->name('unfavorite');
    });
});
