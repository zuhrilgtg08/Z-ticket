<?php

namespace App\Http\Controllers;
use App\Models\Tiket;
use App\Models\Category;
use App\Models\Kota;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $tikets = Tiket::latest()->get();

        $init = null;
        if (request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $init = ' category: ' . $category->nama_kategori;
        }

        if (request('kota')) {
            $kota = Kota::firstWhere('kota', request('kota'));
            $init = ' kota: ' . $kota->nama_kota;
        }

        if (request('provinsi')) {
            $provinsi = Provinsi::firstWhere('provinsi', request('provinsi'));
            $init = ' Provinsi: ' . $provinsi->nama_provinsi;
        }

        return view('pages.customers.index', [
            "tikets" => $tikets,
            "init" => $init,
            "data" => Tiket::latest()->filter(request(['cari', 'category', 'kota', 'provinsi']))->paginate(6)->withQueryString(),
        ]);
    }
}
