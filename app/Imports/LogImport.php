<?php

namespace App\Imports;

use App\Room;
use Maatwebsite\Excel\Concerns\ToModel;

class LogImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Room([
            'name' => $row ['1'],
            'room' => $row ['2'],
            'start' => $row ['3'],
            'end' => $row ['4'],
            'discount' => $row ['5'],
            'total_price' => $row ['6'],
        ]);
    }
}
