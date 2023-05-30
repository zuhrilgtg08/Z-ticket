<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Models\Kota;
use App\Models\Tiket;
use App\Models\Category;
use App\Models\Provinsi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardTiketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tikets = Tiket::get();
        return view('pages.admin.dataTiket.index', compact('tikets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        $dataProKo = Provinsi::with('kota')->get();
        return view('pages.admin.dataTiket.create', compact('dataProKo', 'categories'));
    }

    public function get_kota($id)
    {
        $kota = Kota::where('provinsi_id', '=', $id)->get(['id', 'nama_kota']);
        return response()->json($kota);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_tiket' => 'required|string|max:255',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp|file|max:2048',
            'kota_id' => 'required|max:155',
            'category_id' => 'required|max:155',
            'provinsi_id' => 'required|max:155',
            'stok' => 'required|numeric|min:1',
            'harga' => 'required|numeric|integer|min:1',
            'deskripsi_tiket' => 'required'
        ]);

        $tiket = Tiket::all()->count();

        $init = $tiket + 1;
        $nol = '';
        if (strlen($init) < 3) {
            $nol = '000';
        } else {
            $nol = '';
        }

        $kodeTiket = 'T' . $nol . $init;

        $data = [
            'kode_tiket' => $kodeTiket,
            'nama_tiket' => $request->nama_tiket,
            'category_id' => $request->category_id,
            'kota_id' => $request->kota_id,
            'provinsi_id' => $request->provinsi_id,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'deskripsi_tiket' => $request->deskripsi_tiket
        ];

        if ($request->file('image')) {
            $data['image'] = $request->file('image')->store('sampul-tiket');
        }

        $data['excerpt'] = Str::limit(strip_tags($request->deskripsi_tiket), 50);

        $tiket = Tiket::create($data);

        if ($tiket) {
            return redirect()->route('data_tiket.index')->with('success', 'Tiket berhasil di tambahkan');
        } else {
            return redirect()->route('data_tiket.index')->with('error', 'Tiket gagal di buat');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tiket = Tiket::findOrFail($id);
        return view('pages.admin.dataTiket.detail', compact('tiket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $datas = [
            'tiket' => Tiket::findOrFail($id),
            'categories' => Category::select('id', 'nama_kategori')->get(),
            'provinsi' => Provinsi::select('id', 'nama_provinsi')->get()
        ];

        return view('pages.admin.dataTiket.edit', $datas);
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
        $this->validate($request, [
            'nama_tiket' => 'string|max:255|required',
            'stok' => 'required|numeric|min:1',
            'harga' => 'required|numeric|min:1',
            'image' => 'nullable|file|max:2048|mimes:jpg,jpeg,png,webp',
            'provinsi_id' => 'required',
            'category_id' => 'required',
            'kota_id' => 'required',
            'deskripsi_tiket' => 'required'
        ]);

        $data = [
            'nama_tiket' => $request->nama_tiket,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'provinsi_id' => $request->provinsi_id,
            'category_id' => $request->category_id,
            'kota_id' => $request->kota_id,
            'deskripsi_tiket' => $request->deskripsi_tiket
        ];

        if ($request->file('image')) {
            if ($request->sampulLama) {
                Storage::delete($request->sampulLama);
            } 
            $data['image'] = $request->file('image')->store('sampul-tiket');
        }

        $data['excerpt'] = Str::limit(strip_tags($request->deskripsi_tiket), 50);
        // dd($request->all());

        $tiket = Tiket::find($id)->update($data);

        if ($tiket) {
            return redirect()->route('data_tiket.index')->with('success', 'Tiket berhasil di ubah!');
        } else {
            return redirect()->route('data_tiket.index')->with('error', 'Tiket gagal di ubah!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tiket = Tiket::findOrFail($id);
        $tiket->delete();
        return back()->with('error', 'Tiket berhasil dihapus!');
    }
}
