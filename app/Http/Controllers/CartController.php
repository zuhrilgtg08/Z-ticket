<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Keranjang::where('user_id', '=', Auth::user()->id)
                            ->where('status_pembayaran', '=', 'unpaid')
                            ->get();
        $totalPayment = 0;
        foreach($carts as $data) {
            if($data->quantity >= $data->tiket->stok) {
                $totalPayment += $data->tiket->stok * $data->tiket->harga;
            } else {
                $totalPayment += $data->quantity * $data->tiket->harga;
            }
        }

        return view('pages.customers.homeData.keranjang.index', compact('carts', 'totalPayment'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'tiket_id' => 'required',
        ]);

        $keranjangs = Keranjang::with('tiket')->where('tiket_id', $request->tiket_id)->get();

        foreach ($keranjangs as $data) {
            if($data->quantity > $data->tiket->stok) {
                $data['quantity'] = $data->quantity;
                return redirect('/cart')->with('danger', 'Anda memesan melebihi batas stok yang tersedia!');
            } else {
                $data->quantity;
            }
        }

        $oneItem = Keranjang::where('tiket_id', $request->tiket_id)
                             ->where('user_id', Auth::user()->id)
                             ->where('status_pembayaran', '<>', 'paid')->first();
        
        $items = Keranjang::where('tiket_id', '=', $request->tiket_id)
                            ->where('user_id', Auth::user()->id)->get();

        if($oneItem) {
            if($request->quantity + $items[0]->quantity > $items[0]->tiket->stok)
                return redirect('/cart')->with('danger', 'Anda memesan melebihi batas stok yang tersedia!');

            if($request->quantity) {
                $oneItem->update(['quantity' => $oneItem->quantity + $request->quantity]);
            } else {
                $oneItem->update(['quantity' => $oneItem->quantity + 1]);
            }

            $validate['user_id'] = Auth::user()->id;
            $validate['status_pembayaran'] = 'unpaid';
        } else {
            foreach($items as $item) {
                if($item->tiket_id) {
                    $validate['user_id'] = Auth::user()->id;
                    $validate['quantity'] = $request->quantity;
                    $validate['status_pembayaran'] = 'unpaid';
                    $validate['hotel_id'] = 0;
                    $validate['pesanan_id'] = 0;
                }
            }

            $validate['user_id'] = Auth::user()->id;
            $validate['quantity'] = $request->quantity;
            $validate['status_pembayaran'] = 'unpaid';
            $validate['hotel_id'] = 0;
            $validate['pesanan_id'] = 0;

            Keranjang::create($validate);
        }

        return redirect('/cart')->with('success', 'Tiket has been added to the list cart!');
    }

    public function update(Request $request, $id)
    {
        $datas = [
            'quantity' => $request->quantity,
            'hotel_id' => $request->hotel_id
        ];

        if ($datas['quantity'] <= 0) {
            Keranjang::findOrFail($id)->delete();
            return redirect()->route('cart.index')->with('danger', 'Your Order has been deleted!');
        } 
        
        if($request->quantity && $request->hotel_id == null) {
            Keranjang::findOrFail($id)->update([
                'quantity' => $request->quantity,
                'hotel_id' => 0
            ]);

            return redirect()->route('cart.index')->with('success', 'Quantity Cart has been updated!');
        }

        if ($request->hotel_id && $request->quantity) {
            Keranjang::findOrFail($id)->update([
                'hotel_id' => $request->hotel_id,
                'quantity' => $request->quantity
            ]);

            return redirect()->route('cart.index')->with('success', 'Cart List has been updated!');
        }
    }

    public function destroy($id)
    {
        Keranjang::findOrFail($id)->delete();
        return redirect()->route('cart.index')->with('danger', 'Your List cart has been deleted!');
    }
}
