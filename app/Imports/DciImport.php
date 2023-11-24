<?php

namespace App\Imports;

use App\Models\Dci;
use Maatwebsite\Excel\Concerns\ToModel;

class DciImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Dci([
            'name'=>$row[0]
        ]);
    }
}
