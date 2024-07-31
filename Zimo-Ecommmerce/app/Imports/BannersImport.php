<?php

namespace App\Imports;

use App\Models\Banner;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BannersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Banner([
            'name'=> $row['name'],
            'details'=> $row['details'],
            'status'=>  $row['status'] === 1 ? true : false,
            'imgUrl'=> $row['image']?? null
        ]);
    }
}
