<?php

namespace App\Imports;

use App\Models\Dci;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class DciImport implements ToModel,WithStartRow
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
        if($row[0]!==null){
            return new Dci([
                'name'=>$row[0]
            ]);
        }
       
    }
}
