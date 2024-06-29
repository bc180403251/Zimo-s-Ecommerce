<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ProductControlller;

Route::get('/', [ProductControlller::class, 'index']);

Route::get('product/view/{id}',[ProductControlller::class, 'show'])->name('products.show');
Route::post('product/addToCart/{id}',[ProductControlller::class, 'addToCart'])->name('products.addToCart');
