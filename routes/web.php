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
Route::get('/orders/create', [OrderController::class,'create'])->name('orders.create');
//Route::post('/orders', 'OrderController@store')->name('orders.store');
Route::post('/orders', [OrderController::class,'store'])->name('orders.store');