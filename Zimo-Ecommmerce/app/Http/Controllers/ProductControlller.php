<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        $cart_count=Cart::all()->count();

        return view('viewProduct',compact('product','cart_count'));

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

       if($inCart)
       {
           $inCart->quantity += 1;
           $inCart->total_price +=$product->Price;

           $inCart->save();

//           session::flash('success','Product added to Cart');
           return response()->json(['success'=> true]);
       }
      elseif (!$inCart)
       {
           Cart::create([
               'product_id'=>$product->id,
               'quantity'=>1,
               'total_price'=>$product->Price,
           ]);

//           session::flash('success','Product added to Cart');
           return response()->json(['success'=>true]);
       }else{
//           session::flash('success','Product failed to  added to Cart');
           return response()->json(['success'=>false]);
       }




    }

    public function cartList()
    {
        $cartItem=Cart::with('product')->get();
        $cart_count=Cart::all()->count();

//        dd($cartItem);


        return view('cartList',compact('cartItem','cart_count'));

    }

    public function incrementQuantity($id){

        $cartItem=Cart::with('product')->find($id);
        $cartItem->quantity +=1;
        $cartItem->total_price +=$cartItem->product->Price;
        $cartItem->save();

        return redirect()->route('cart.list');
    }

    public  function decrementQuantity($id)
    {
        $cartItem=Cart::with('product')->find($id);

        if($cartItem->quantity > 1){
            $cartItem->quantity -= 1;
            $cartItem->total_price= $cartItem->quantity *  $cartItem->product->Price;
            $cartItem->save();

        }else{
            $cartItem->delete();
        }

        return redirect()->route('cart.list');

    }
}
