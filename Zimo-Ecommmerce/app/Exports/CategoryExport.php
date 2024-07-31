<?php

namespace App\Exports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CategoryExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Category::all();
    }

    public function headings():array
    {
        return [
            'ID',
            'Name',
            'Description',
            'Image',
            'Created_at',
            'Updated_at',
            'parent_id'
        ];

    }
}
