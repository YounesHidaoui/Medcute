<?php

namespace App\Imports;

use App\Models\Source;
use Maatwebsite\Excel\Concerns\ToModel;

class SourceImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Source([
            'continent'=>$row[0],
            'country'=>$row[1],
            'sigle'=>$row[2],
            'agence'=>$row[3],
            'website'=>$row[4],
            
        ]);
    }
}
