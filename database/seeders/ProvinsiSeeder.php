<?php

namespace Database\Seeders;

use App\Models\Provinsi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            ["id" => 1, "nama_provinsi" => "Bali"],
            ["id" => 2, "nama_provinsi" => "Bangka Belitung"],
            ["id" => 3, "nama_provinsi" => "Banten"],
            ["id" => 4, "nama_provinsi" => "Bengkulu"],
            ["id" => 5, "nama_provinsi" => "DI Yogyakarta"],
            ["id" => 6, "nama_provinsi" => "DKI Jakarta"],
            ["id" => 7, "nama_provinsi" => "Gorontalo"],
            ["id" => 8, "nama_provinsi" => "Jambi"],
            ["id" => 9, "nama_provinsi" => "Jawa Barat"],
            ["id" => 10, "nama_provinsi" => "Jawa Tengah"],
            ["id" => 11, "nama_provinsi" => "Jawa Timur"],
            ["id" => 12, "nama_provinsi" => "Kalimantan Barat"],
            ["id" => 13, "nama_provinsi" => "Kalimantan Selatan"],
            ["id" => 14, "nama_provinsi" => "Kalimantan Tengah"],
            ["id" => 15, "nama_provinsi" => "Kalimantan Timur"],
            ["id" => 16, "nama_provinsi" => "Kalimantan Utara"],
            ["id" => 17, "nama_provinsi" => "Kepulauan Riau"],
            ["id" => 18, "nama_provinsi" => "Lampung"],
            ["id" => 19, "nama_provinsi" => "Maluku"],
            ["id" => 20, "nama_provinsi" => "Maluku Utara"],
            ["id" => 21, "nama_provinsi" => "Nanggroe Aceh Darussalam (NAD)"],
            ["id" => 22, "nama_provinsi" => "Nusa Tenggara Barat (NTB)"],
            ["id" => 23, "nama_provinsi" => "Nusa Tenggara Timur (NTT)"],
            ["id" => 24, "nama_provinsi" => "Papua"],
            ["id" => 25, "nama_provinsi" => "Papua Barat"],
            ["id" => 26, "nama_provinsi" => "Riau"],
            ["id" => 27, "nama_provinsi" => "Sulawesi Barat"],
            ["id" => 28, "nama_provinsi" => "Sulawesi Selatan"],
            ["id" => 29, "nama_provinsi" => "Sulawesi Tengah"],
            ["id" => 30, "nama_provinsi" => "Sulawesi Tenggara"],
            ["id" => 31, "nama_provinsi" => "Sulawesi Utara"],
            ["id" => 32, "nama_provinsi" => "Sumatera Barat"],
            ["id" => 33, "nama_provinsi" => "Sumatera Selatan"],
            ["id" => 34, "nama_provinsi" => "Sumatera Utara"]
        ];

        foreach ($datas as $data) {
            Provinsi::create($data);
        }
    }
}
