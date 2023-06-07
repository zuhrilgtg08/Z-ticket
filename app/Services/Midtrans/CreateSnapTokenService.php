<?php 

namespace App\Services\Midtrans;
use Midtrans\Snap;
use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;

class CreateSnapTokenService extends Midtrans
{
    protected $pesanan;

    public function __construct($pesanan)
    {
        parent::__construct();
        $this->pesanan = $pesanan;
    }

    public function getSnapToken()
    {
        $cartsList = Keranjang::with(['tiket', 'pesanan'])
                        ->where('user_id', auth()->user()->id)
                        ->get();

        $array_item = [];

        foreach($cartsList as $data) {
            $array_item[] = [
                'id' => $this->pesanan->uuid,
                'price' => $data->tiket->harga,
                'quantity' => $data->quantity,
                'name' => $data->tiket->nama_tiket
            ];
        }

        $params = [
            'transaction_details' => [
                'order_id' => $this->pesanan->uuid,
                'gross_amount' => $this->pesanan->total_pembayaran,
            ],
            'item_details' => $array_item,
            'customer_details' => [
                'first_name' => Auth::user()->username,
                'email' => Auth::user()->email,
                'phone' => Auth::user()->phone,
            ]
        ];

        $snapToken = Snap::getSnapToken($params);
        return $snapToken;
    }
}