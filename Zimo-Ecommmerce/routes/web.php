<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ProductControlller;
use \App\Http\Controllers\Admin\ProductController;
use \App\Http\Controllers\Admin\CategoryController;

Route::get('/', [ProductControlller::class, 'index']);

Route::get('view-all',[ProductControlller::class ,'allProducts']);

Route::get('product/view/{id}',[ProductControlller::class, 'show'])->name('products.show');
Route::post('product/addToCart/{id}',[ProductControlller::class, 'addToCart'])->name('products.addToCart');
Route::get('product/cartItems',[ProductControlller::class, 'cartList'])->name('cart.list');

Route::post('product/cartItem/increment/{id}',[ProductControlller::class ,'incrementQuantity'])->name('increment');
Route::post('product/cartItem/decrement/{id}',[ProductControlller::class, 'decrementQuantity'])->name('decrement');
Route::get('products/getSearch',[ProductControlller::class, 'search'])->name('search');
Route::get('products/search',[ProductControlller::class, 'ajaxSearch'])->name('ajax.search');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
//  Products Curds
    Route::get('products',[ProductController::class, 'productList'])->name('products.index');
    Route::get('products/create',[ProductController::class, 'create'])->name('products.create');
    Route::post('product/create', [ProductController::class, 'store'])->name('products.store');
    Route::get('products/show/{id}',[ProductController::class, 'show'])->name('products.show');
    Route::delete('products/delete/{id}',[ProductController::class, 'destroy'])->name('products.delete');
    Route::get('products/update/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::patch('products/update/{id}', [ProductController::class ,'update'])->name('products.update');

//    Category cruds
    Route::get('categories',[CategoryController::class, 'index'])->name('categories.index');
    Route::delete('categories/delete/{id}', [CategoryController::class, 'destroy'])->name('categories.delete');
    Route::get('categories/create',[CategoryController::class, 'create'])->name('categories.create');
    Route::post('categories/create',[CategoryController::class, 'store'])->name('categories.store');
    Route::get('categories/show/{id}',[CategoryController::class, 'show'])->name('categories.view');
    Route::get('categories/update/{id}',[CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('categories/update/{id}', [CategoryController::class ,'Update'])->name('categories.update');
});
