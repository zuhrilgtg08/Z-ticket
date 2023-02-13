<?php

namespace App\Http\Controllers;
use App\Models\Hotel;
use App\Models\Tiket;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $hotels = Hotel::all();
        $tikets = Tiket::all();
        return view('pages.customers.shop', [
            'tikets' => $tikets,
            'hotels' => $hotels
        ]);
    }
}
