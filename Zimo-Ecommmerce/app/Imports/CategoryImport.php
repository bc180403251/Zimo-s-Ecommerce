<?php

namespace App\Imports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CategoryImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
//        dd($row);
        $parentId = $row['parent_id'] ?? null;
        if ($parentId !== null && !Category::where('id', $parentId)->exists()) {
            $parentId = null;
        }
        return new Category([
            //
            'name' => $row['name'],
            'description' => $row['description'],
            'imgUrl' => $row['image'] ?? null,
            'created_at' => $row['created_at'],
            'updated_at' => $row['updated_at'],
            'parent_id' => $parentId // Make sure your column name is 'category_id'
        ]);
    }
}
