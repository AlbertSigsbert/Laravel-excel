<?php

use App\Http\Controllers\OrderController;
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
    return view('welcome');
});

Route::get('/orders', [OrderController::class, 'index'])->name('orders');
Route::get('order/create', [OrderController::class, 'create'])->name('order.create');
// Route::get('/orders/{order}', [OrderController::class, 'show'] )->name('order.show]');
Route::get('/orders/{order}', [OrderController::class, 'edit'])->name('orders.edit');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::put('orders/{order}', [OrderController::class, 'update'])->name('orders.update');
Route::delete('orders/{order}', [OrderController::class, 'destroy'])->name('orders.delete');
Route::get('users/export/', 'OrderController@export')->name('orders.export');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
