<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'nama_kategori' => 'Travel Essentials',
            'slug' => 'travel-essentials'
        ]);

        Category::create([
            'nama_kategori' => 'Kegiatan Santai',
            'slug' => 'kegiatan-santai'
        ]);

        Category::create([
            'nama_kategori' => 'Tempat Bermain',
            'slug' => 'tempat-bermain'
        ]);
        
        Category::create([
            'nama_kategori' => 'Wisata Kuliner',
            'slug' => 'wisata-kuliner'
        ]);
    }
}
