<?php

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

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home'); 
    

Route::get('/detail/{slug}', 'App\Http\Controllers\DetailController@index')->name('detail');

// Route::get('/checkout', 'App\Http\Controllers\CheckoutController@index')->name('checkout');

// Route::get('/checkout/success', 'App\Http\Controllers\CheckoutController@success')->name('checkout-success');

// memproses data dari checkout
Route::post('/checkout/{id}', 'App\Http\Controllers\CheckoutController@process')
    ->name('checkout-process')
    ->middleware(['auth', 'verified']);

// dimunculkan disini
Route::get('/checkout/{id}', 'App\Http\Controllers\CheckoutController@index')
    ->name('checkout')
    ->middleware(['auth', 'verified']);

// menambahkan username
Route::post('/checkout/create/{detail_id}', 'App\Http\Controllers\CheckoutController@create')
    ->name('checkout-create')
    ->middleware(['auth', 'verified']);

// menghapus data
Route::get('/checkout/remove/{detail_id}', 'App\Http\Controllers\CheckoutController@remove')
    ->name('checkout-remove')
    ->middleware(['auth', 'verified']);

// mengubah status dalam data card 
Route::get('/checkout/confirm/{id}', 'App\Http\Controllers\CheckoutController@success')
    ->name('checkout-success')
    ->middleware(['auth', 'verified']);

Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->group(function() {
        Route::get('/', 'App\Http\Controllers\Admin\DashboardController@index')
            ->name('dashboard');
        Route::resource('travel-package', 'App\Http\Controllers\Admin\TravelPackageController');
        Route::resource('gallery', 'App\Http\Controllers\Admin\GalleryController');
        Route::resource('transaction', 'App\Http\Controllers\Admin\TransactionController');
    });
    
Auth::routes(['verify' => true]);
