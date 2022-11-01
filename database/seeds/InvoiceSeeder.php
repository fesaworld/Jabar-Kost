<?php

use App\Invoice;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Invoice::create([
            'user_id' => 2,
            'room_id' => 1,
            'start' => date('Y-m-d'),
            'end' => date('Y-m-d'),
            'discount' => '0',
            'total_price' => '500000',
            'trf_image' => 'transfer.jpg',
            'status' => 'Berjalan',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
