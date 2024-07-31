<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use mysql_xdevapi\Collection;

class ProductsImports implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

//        dd($row['category_id']);
        $category = Category::where('name', $row['category'])->first();
//        dd($category->id);

        return new Product([
            'name' => $row['name'],
            'description' => $row['description'],
            'imagUrl' => $row['main_image'],
            'otherimgs' => $row['other_images'],
            'price' => $row['price'],
            'category_id' => $category->id,  // Make sure your column name is 'category_id'
            'created_at' => $row['created_at'],
            'updated_at' => $row['updated_at'],
        ]);


    }
//    public function rules(): array
//    {
//        return [
//
//            '*.name' => 'required|string',
//            '*.description' => 'required|string',
//            '*.imagUrl' => 'required|string',
//            '*.otherimgs' => 'required|string',
//            '*.category' => 'required|string',
//            '*.Price' => 'required|numeric',
//            '*.created_at' => 'required|date',
//            '*.updated_at' => 'required|date',
//        ];
//    }
}
