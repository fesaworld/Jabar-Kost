<?php

use App\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Room::create([
            'name' => 'Kamar Premium',
            'price' => '500000',
            'stok' => '1',
            'detail' => 'Kamar ini tipe terendah',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        Room::create([
            'name' => 'Kamar Pertalite',
            'price' => '750000',
            'stok' => '2',
            'detail' => 'Kamar ini tipe menengah',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        Room::create([
            'name' => 'Kamar Pertamax',
            'price' => '1000000',
            'stok' => '2',
            'detail' => 'Kamar ini tipe tertinggi',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        Room::create([
            'name' => 'Kamar Turbo',
            'price' => '1500000',
            'stok' => '2',
            'detail' => 'Kamar ini tipe sultan',
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
