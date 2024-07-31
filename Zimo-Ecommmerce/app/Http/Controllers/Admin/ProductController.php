<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ProductExport;
use App\Http\Controllers\Controller;
use App\Imports\ProductsImports;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;


class ProductController extends Controller
{
    //get the list of the products
    public function productList()
    {
        $products = Product::with('category')->orderBy('created_at', 'desc')->paginate(10);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories=Category::all();

        return view('products.create',compact('categories'));

    }

    public function store(Request $request)
    {
//        validate the request data
//        dd($request->all());
        $request->validate([
           'name'=>' required|String',
           'description'=> 'required|String' ,
           'Price'=> 'required|String',
            'imagUrl'=> 'required|url',
            'category_id'=>'required|exists:categories,id',
            'otherimgs'=> 'required'
        ]);
// find the category by its id


//        Create the Product using Model
       $product= new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->imagUrl = $request->input('imagUrl');
        $product->Price = $request->input('Price');
        $product->category_id = $request->input('category_id');
        $product->otherimgs= $request->input('otherimgs');
        $product->save();


        Session::flash('message','Product Added Successfully!');

        return response()->json(['Product'=>$product, 'message'=>'Product Added Successfully!']);


    }

    public function show($id)
    {
        $product=Product::find($id);

        return view('products.view', compact('product'));
    }

    public function destroy($id)
    {
        $product=Product::find($id);

        $product->delete($product);

        return response()->json(['success'=> true]);
    }

    public function edit($id)
    {
        $categories=Category::all();
        $product=Product::find($id);

        return view('products.update', compact('categories', 'product'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'string|max:255',
            'Price' => 'numeric|min:0',
            'description' => 'string',
            'category_id' => 'exists:categories,id',
            'imagUrl' => 'nullable|url', // Validate that imagUrl is a valid URL if provided
        ]);

        try {
            // Find the product by ID
            $product = Product::find($id);

            // Update the product with new values
            $product->name = $request->input('name');
            $product->description = $request->input('description');
            $product->imagUrl = $request->input('imagUrl');
            $product->Price = $request->input('Price');
            $product->category_id = $request->input('category_id');


            // Save the updated product
            $product->save();

            Session::flash('message','Product Updated Successfully!');

            return response()->json(['success' => true, 'message' => 'Product updated successfully!']);
        } catch (\Exception $e) {
            // Handle any errors that may have occurred
            return response()->json(['success' => false, 'message' => 'An error occurred while updating the product.',$e->getMessage()], 401);
        }
    }

//    function for exporting the data

public function exportProduct()
{
    return Excel::download(new ProductExport, 'products.xlsx');

}

//function importing the data from file

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);
//        dd($request->file('file'));

//        dd(Excel::import(new ProductsImports, $request->file('file')));
        Excel::import(new ProductsImports, $request->file('file'));

        return back()->with('success', 'Products imported successfully.');
    }


}
