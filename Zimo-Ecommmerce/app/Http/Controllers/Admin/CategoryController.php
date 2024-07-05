<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //function for getting the list of  with their child
    function index()
    {
        $categories=Category::with('parent')->paginate(10);
//        dd($categories);

        return view('categories.index', compact('categories'));
    }

//    create category

public function create(){
        $parentCategories=Category::whereNull('parent_id')->get();

        return view('categories.create', compact('parentCategories'));
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'parent_id' => 'nullable|exists:categories,id'
    ]);

   $category=new Category();
   $category->name= $request->input('name');
   $category->description= $request->input('description');
   $category->parent_id= $request->input('parent_id');
   $category->save();

    return response()->json(['category'=>$category, 'success'=> true]);
}

// view the Category

public function show($id)
{
    $category=Category::find($id);

    return view('categories.view', compact('category'));
}
// Update the Category

public function edit($id)
{
    $parentCategories=Category::whereNull('parent_id')->get();
    $category=Category::find($id);

    return view('categories.update', compact('category','parentCategories'));

}

public function Update(Request $request, $id)
{
   $validated= $request->validate([
        'name' => 'string|max:255',
        'description' => 'string',
        'parent_id' => 'nullable|exists:categories,id'
    ]);

    $category=Category::findOrFail($id);


    $category->update($validated);

    return response()->json(['success'=>' Category Updated Successfully']);


}

    public function destroy($id)
    {
        $category=Category::find($id);

        $category->delete($category);

        return response()->json(['success'=>true]);
    }
}
