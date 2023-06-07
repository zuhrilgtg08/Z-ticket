<?php

namespace App\Http\Controllers\Pesanan;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use App\Models\Pesanan;
use App\Services\Midtrans\CallbackService;
use Illuminate\Http\Request;

class PaymentCallbackController extends Controller
{
    public function receive()
    {
        $callback = new CallbackService;

        if($callback->isSignatureKeyVerified()) {
            $notification = $callback->getNotification();
            $pesanan = $callback->getPesanan();

            if($callback->isSuccess()) {
                Pesanan::where('id', '=', $pesanan->id)
                        ->update([
                            'payment_status' => 2
                        ]);
                
                Keranjang::where('pesanan_id', '=', $pesanan->id)
                            ->update([
                                'status_pembayaran' => 'paid'
                            ]);
            }

            if($callback->isExpire()) {
                Pesanan::where('id', '=', $pesanan->id)
                        ->update([
                            'payment_status' => 3
                        ]);

                $carts = Keranjang::with(['tiket'])->where('pesanan_id', '=', $pesanan->id)->get();

                foreach($carts as $item) {
                    $item->tiket->update([
                        'stok' => $item->tiket->stok + $item->quantity,
                    ]);
                }
            }

            if ($callback->isCancelled()) {
                Pesanan::where('id', $pesanan->id)
                    ->update([
                        'payment_status' => 4,
                    ]);

                $carts = Keranjang::with(['tiket'])->where('pesanan_id', '=', $pesanan->id)->get();

                foreach ($carts as $item) {
                    $item->tiket->update([
                        'stok' => $item->tiket->stok + $item->quantity,
                    ]);
                }
            }

            return response()
                    ->json([
                        'success' => true,
                        'message' => 'Notification successfully processed',
                    ]);
        } else {
            return response()
                ->json([
                    'error' => true,
                    'message' => 'Signature key not verified',
                ], 403);
        }
    }
}
