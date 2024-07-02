<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;


Route::get('products/list',[ProductController::class, 'productList']);

//Route::get('helo', function (){
//   dd('helo');
//});

Route::get('users/userInfo',[UserController::class, 'getUserInfo']);
Route::post('users/storeVisitor',[UserController::class, 'storeVisitor']);
