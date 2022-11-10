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
            'detail' => 'Kamar ini tipe Terendah',
            'image' => 'kos-1.jpg',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        Room::create([
            'name' => 'Kamar Pertalite',
            'price' => '750000',
            'stok' => '2',
            'detail' => 'Kamar ini tipe Menengah',
            'image' => 'kos-1.jpg',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        Room::create([
            'name' => 'Kamar Pertamax',
            'price' => '1000000',
            'stok' => '2',
            'detail' => 'Kamar ini tipe Tertinggi',
            'image' => 'kos-1.jpg',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        Room::create([
            'name' => 'Kamar Turbo',
            'price' => '1500000',
            'stok' => '2',
            'detail' => 'Kamar ini tipe Sultan',
            'image' => 'kos-1.jpg',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        Room::create([
            'name' => 'Kamar Racing',
            'price' => '2000000',
            'stok' => '2',
            'detail' => 'Kamar ini tipe King',
            'image' => 'kos-1.jpg',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        Room::create([
            'name' => 'Kamar Avtur',
            'price' => '2500000',
            'stok' => '2',
            'detail' => 'Kamar ini tipe Legend',
            'image' => 'kos-1.jpg',
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
