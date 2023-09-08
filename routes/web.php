<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

 Route::get('/', function () {
      return view('products.index');
  });

Route::resource('products', ProductController::class);
Route::resource('sales', SaleController::class);
Route::get('/product/maxStock', [ProductController::class, 'maxStock'])->name('products.maxStock');
Route::get('/product/mostSold', [ProductController::class, 'mostSoldProduct'])->name('products.mostSold');



