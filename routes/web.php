<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PriceRequestController;


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
    return view('welcome');
});

/* Orders Routes */
Route::get('/orders', [OrderController::class, 'index'])->name('orders');
Route::get('order/create', [OrderController::class, 'create'])->name('order.create');
// Route::get('/orders/{order}', [OrderController::class, 'show'] )->name('order.show]');
Route::get('/orders/{order}', [OrderController::class, 'edit'])->name('orders.edit');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::put('orders/{order}', [OrderController::class, 'update'])->name('orders.update');
Route::delete('orders/{order}', [OrderController::class, 'destroy'])->name('orders.delete');
Route::get('orders/export/', 'OrderController@export')->name('orders.export');
Route::get('orders/{order}/done/', 'OrderController@done')->name('orders.done');


/* price Requests routes */
Route::get('/price-requests', [PriceRequestController::class, 'index'])->name('price-requests.index');
Route::get('/price-requests/create', [PriceRequestController::class, 'create'])->name('price-requests.create');
Route::post('/price-requests', [PriceRequestController::class, 'store'])->name('price-requests.store');
Route::get('/price-requests/{priceRequest}', [PriceRequestController::class, 'edit'])->name('price-requests.edit');
Route::put('/price-requests/{priceRequest}', [PriceRequestController::class, 'update'])->name('price-requests.update');
Route::delete('/price-requests/{priceRequest}', [PriceRequestController::class, 'destroy'])->name('price-requests.delete');
Route::get('/export', [PriceRequestController::class, 'export'])->name('price-requests.export');




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
