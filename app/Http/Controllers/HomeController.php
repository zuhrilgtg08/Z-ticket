<?php

namespace App\Http\Controllers;
use App\Models\Tiket;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $tikets = Tiket::all();
        return view('pages.customers.index', ['tikets' => $tikets]);
    }
}
