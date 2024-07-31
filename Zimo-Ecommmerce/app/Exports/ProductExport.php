<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::join('categories', 'products.category_id', '=', 'categories.id')
        ->select('products.id', 'products.name','products.description','products.imagUrl','products.otherimgs', 'products.price', 'categories.name as category_name', 'products.created_at', 'products.updated_at')
        ->get();
    }

    public function headings():array
    {
        return [
            'ID',
            'Name',
            'Description',
            'Main Image',
            'Other Images',
            'Price',
            'Category',
            'Created_at',
            'Updated_at'
        ];

    }
}
