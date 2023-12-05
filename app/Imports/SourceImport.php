<?php

namespace App\Imports;

use App\Models\Source;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SourceImport implements ToModel , WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function startRow(): int
    {
        return 2; 
    }
    public function model(array $row)
    {
        if ($row[0] !== null && $row[1] !== null && $row[2] !== null && $row[3] !== null && $row[4] !== null) {
            return new Source([
                'continent' => $row[0],
                'country' => $row[1],
                'sigle' => $row[2],
                'agence' => $row[3],
                'website' => $row[4],
            ]);
    }
}
}
