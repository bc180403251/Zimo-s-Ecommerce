<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CommentController;
use \App\Http\Controllers\Api\CategoryController;


Route::get('products/list',[ProductController::class, 'productList']);

//Route::get('helo', function (){
//   dd('helo');
//});

Route::get('users/userInfo',[UserController::class, 'getUserInfo']);
Route::post('users/storeVisitor',[UserController::class, 'storeVisitor']);


// getting the reviews of the users

Route::get('users/reviews',[CommentController::class , 'comment']);

//getting the all parent categories
Route::get('categories/parents',[CategoryController::class, 'index']);
