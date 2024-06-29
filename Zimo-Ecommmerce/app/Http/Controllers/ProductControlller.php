<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductControlller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get the  products

        $products=Product::all();
        $cart_count=Cart::all()->count();

//        dd($cart_count);

        return view('welcome', compact('products', 'cart_count'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // find the product
        $product =Product::find($id);

        return view('viewProduct',compact('product'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function addToCart($id)
    {
        $product=Product::find($id);

       $inCart=Cart::where('product_id',$product->id)->first();

       if(!$inCart){
           $cart=Cart::create([
               'product_id'=>$product->id,
               'quantity'=>1,
               'total_price'=>$product->Price,
           ]);
       }
       else{
           $inCart->quantity += 1;
           $inCart->total_price +=$product->Price;

           $inCart->save();
       }

       return redirect()->back()->with('success','Product Added to cart Successfully');

    }

    public function cartList()
    {
        

    }
}
