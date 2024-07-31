<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CategoryExport;
use App\Http\Controllers\Controller;
use App\Imports\CategoryImport;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class CategoryController extends Controller
{
    //function for getting the list of  with their child
    function index()
    {
        $categories=Category::with('parent')->orderBy('created_at', 'desc')->paginate(10);
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
            'parent_id' => 'nullable|exists:categories,id',
            'imgUrl' => 'required|string'
        ]);

        $category = new Category();
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->parent_id = $request->input('parent_id');
        $category->imgUrl = $request->input('imgUrl'); // Assuming the Category model has an 'image_url' field
        $category->save();

        return response()->json(['category' => $category, 'success' => true]);
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

    public function exportCategories()
    {
        return Excel::download(new CategoryExport , 'Categories.xlsx');
    }

    public function importCategory(Request $request)
    {
        $request->validate([
             'file' => 'required|mimes:xlsx,csv',
        ]);
//        dd($request->file('file'));

        Excel::import(new CategoryImport, $request->file('file'));

        Session::flash('message','Categories Imported');
        return back();
    }
}
