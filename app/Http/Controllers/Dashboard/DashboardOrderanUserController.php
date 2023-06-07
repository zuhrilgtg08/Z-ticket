<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Pesanan;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use PDF;
use App\Http\Controllers\Controller;

class DashboardOrderanUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listOrder = Keranjang::with(['hotel', 'tiket', 'pesanan', 'user'])
            ->where('status_pembayaran', '=', 'paid')
            ->where('user_id', '<>', 1)->latest()->get();

        return view('pages.admin.dataOrderanUsers.index', compact('listOrder'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        return view('pages.admin.dataOrderanUsers.detail', ['pesanan' => $pesanan]);
    }

    public function exportPdf()
    {
        $data = Keranjang::with(['pesanan', 'tiket', 'hotel'])->get();
        $pdf = PDF::loadView('report.dataAdminOrders', compact('data'));
        $pdf->setPaper('legal', 'landscape');
        return $pdf->download("Orders_Customers " . date('d-m-Y') . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
