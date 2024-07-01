<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

//use Illuminate\Support\Facades\Request;

class ProductController extends Controller
{
    //
    public function productList(Request $request) :JsonResponse
    {
        $categories=Category::all();

        $categoryName=$request->input('name');

        if($categoryName){

            $product=Category::with('products')->where('name', $categoryName)->get();
        }else{
            $product=Product::all();
        }



        $cart_count=Cart::all()->count();

//        dd($product);

        return response()->json(['products'=>$product, 'cart_count'=>$cart_count, 'categories'=>$categories]);
    }
}
