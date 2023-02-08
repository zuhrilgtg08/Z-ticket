<?php

namespace Database\Seeders;

use App\Models\Tiket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TiketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tiket::create([
            'kode_tiket' => 'T0001',
            'nama_tiket' => 'Tiket Testing',
            'image' => null,
            'kota_id' => 444,
            'category_id' => 2,
            'provinsi_id' => 11,
            'stok' => 10,
            'harga' => 20000,
            'deskripsi_tiket' => '<div>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Autem quam odit nisi voluptatum enim soluta nobis</div>',
            'excerpt' => 'Lorem ipsum, dolor sit amet consectetur...',
        ]);
    }
}
