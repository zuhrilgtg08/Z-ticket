<?php

namespace App\Http\Controllers\Pesanan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HistoryPesananController extends Controller
{
    public function list()
    {
        return view('pages.customers.pesanan.history');
    }

    public function print()
    {

    }
}
