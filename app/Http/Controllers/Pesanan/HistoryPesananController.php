<?php

namespace App\Http\Controllers\Pesanan;

use App\Http\Controllers\Controller;
use APP\Models\Keranjang;
use PDF;

class HistoryPesananController extends Controller
{
    public function list($id)
    {
        $listHistory = Keranjang::with(['pesanan', 'tiket', 'hotel'])
                                ->where('user_id', $id)->where('status_pembayaran', 'paid')
                                ->get();

        $name = null;
        $email = null;
        $phone = null;
        $total = 0;

        foreach ($listHistory as $item) {
            $name = $item->user->username;
            $email = $item->user->email;
            $phone = $item->user->phone;
            $total += ($item->tiket->harga * $item->quantity);
        }

        return view('pages.customers.pesanan.history', 
            compact('listHistory', 'name', 'email', 'phone', 'total'));
    }

    public function print($id)
    {
        $datas = Keranjang::with(['pesanan', 'tiket', 'hotel'])->where('user_id', $id)->get();
        $total = 0;
        foreach ($datas as $item) {
            $total += ($item->tiket->harga * $item->quantity);
        }
        $pdf = PDF::loadView('report.historyCustomers', compact('datas', 'total'));
        return $pdf->stream();
    }
}
