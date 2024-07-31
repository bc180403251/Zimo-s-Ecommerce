<?php

namespace App\Exports;

use App\Models\Banner;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BannerExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Banner::all();
    }
    public function headings():array
    {
        return [
            'ID',
            'Name',
            'Details',
            'status',
            'Image',
            'Created_at',
            'Updated_at',
        ];

    }
}
