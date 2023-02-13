<?php

namespace Database\Seeders;
use App\Models\Hotel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Hotel::create([
            'kode_hotel' => 'KM00001',
            'nama_hotel' => 'Hotel Majapahit',
            'slug' => 'hotel-majapahit-1',
            'tiket_id' => 1,
            'image_hotel' => null,
            'harga_hotel' => 2000000,
            'deskripsi_hotel' => 'Hotel Majapahit ternyata sempat berganti nama beberapa kali. Sebelum dikenal sebagai Hotel Majapahit, hotel bersejarah di Kota Surabaya ini sempat disebut Hotel Oranje, Yamato, hingga Merdeka.',
            'excerpt' => 'Hotel Majapahit ternyata...'
        ]);
    }
}
