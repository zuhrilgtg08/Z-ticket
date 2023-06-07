<?php

namespace App\Http\Controllers\Pesanan;

use App\Models\Hotel;
use App\Models\Tiket;
use App\Models\Pesanan;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Midtrans\CreateSnapTokenService;

class PesananController extends Controller
{
    public function detailOrders($id) 
    {
        $cart_datas = keranjang::with(['tiket', 'hotel', 'pesanan'])->where('user_id', $id)
                        ->where('status_pembayaran', 'unpaid')->latest()->get();

        $totalHarga = 0;
        foreach ($cart_datas as $data) {
            $totalHarga += ($data->tiket->harga * $data->quantity);
        }

        return view('pages.customers.homeData.keranjang.detail', 
            compact('cart_datas', 'totalHarga')
        );
    }

    public function createOrders(Request $request)
    {
        $validateData = $request->validate([
            'total_pembayaran' => 'required|numeric',
            'payment_status' => 'string',
        ]);

        $pesanan = Pesanan::create($validateData);

        $dataKeranjang = Keranjang::with('pesanan')->where('user_id', Auth::user()->id)
            ->where('status_pembayaran', '=', 'unpaid')
            ->get();

        $data_pesanan = Pesanan::select(['id', 'payment_status', 'snap_token', 'total_pembayaran'])->get();
        
        foreach ($dataKeranjang as $data) {
            $data->tiket->update([
                'stok' => $data->tiket->stok - $data->quantity
            ]);

            $data->update(['status_pembayaran' => 'ordered']);

            foreach($data_pesanan as $value) {
                $data->update(['pesanan_id' => $value->id]);

                if (!empty($data->pesanan_id)) {
                    $midtrans = new CreateSnapTokenService($pesanan);
                    $snapToken = $midtrans->getSnapToken();
                    $value->update(['snap_token' => $snapToken]);
                }
            }
        }

        if ($pesanan) {
            return redirect()->route('order.pay')->with('success', 'Pesanan berhasil di tambahkan!');
        } else {
            return redirect()->route('order.pay')->with('danger', 'Pesanan gagal di tambahkan!');
        }
    }

    public function payOrders()
    {
        $dataPesanan = Keranjang::with(['tiket', 'pesanan', 'hotel'])
            ->where('user_id', Auth::user()->id)
            ->where('status_pembayaran', 'ordered')->get();

        $snapToken = null;
        $totalHarga = 0;

        foreach($dataPesanan as $data) {
            $snapToken = $data->pesanan->snap_token;
            $totalHarga += $data->tiket->harga * $data->quantity;
        }

        return view('pages.customers.pesanan.index', compact('snapToken', 'dataPesanan', 'totalHarga'));
    }
}
