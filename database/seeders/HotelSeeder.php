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
            'deskripsi_hotel' => '<div>Dui elit quis scelerisque conubia integer facilisis erat sit sociosqu. Fermentum cras pede nam suspendisse dolor pharetra. Vehicula egestas luctus mi efficitur ipsum. Sem tempor hendrerit congue id in. Tellus felis libero bibendum ridiculus consectetuer erat pulvinar nibh in. Molestie aenean inceptos tempor est eleifend turpis commodo lacus pulvinar ultrices auctor.</div>.',
            'excerpt' => 'Dui elit quis scelerisque conubia integer facilisi...'
        ]);
    }
}
