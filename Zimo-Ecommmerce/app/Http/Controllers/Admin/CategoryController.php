<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    //function for getting the list of  with their child
    function index()
    {
        $categories=Category::with('parent')->paginate(10);
//        dd($categories);

        return view('categories.index', compact('categories'));
    }

    public function destroy($id)
    {
        $category=Category::find($id);

        $category->delete($category);

        return response()->json(['success'=>true]);
    }
}
