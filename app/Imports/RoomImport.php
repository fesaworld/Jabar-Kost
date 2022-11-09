<?php

namespace App\Imports;

use App\Room;
use Maatwebsite\Excel\Concerns\ToModel;

class RoomImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Room([
            'name' => $row['1'],
            'price' => $row ['2'],
            'stok' =>$row['3'],
            'detail' => $row ['4'],
        ]);
    }
}
