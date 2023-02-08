<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Review::create([
            'user_id' => 2,
            'tiket_id' => 2,
            'nilai_rating' => 3,
            'komentar' => 'Sangat mantap, dengan promonya'
        ]);
    }
}
