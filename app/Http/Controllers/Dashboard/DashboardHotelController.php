<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Tiket;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;
class DashboardHotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataHotel = Hotel::all();
        return view('pages.admin.dataHotel.index', ['dataHotel' => $dataHotel]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tikets = Tiket::select('id', 'nama_tiket')->get();
        return view('pages.admin.dataHotel.create', ['tikets' => $tikets]);
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
            'nama_hotel' => 'required|string|max:255',
            'slug' => 'unique:hotel|string|required',
            'tiket_id' => 'required|max:155',
            'image_hotel' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:2048',
            'harga_hotel' => 'required|numeric|integer|min:1',
            'deskripsi_hotel' => 'string|nullable'
        ]);

        $hotel = Hotel::all()->count();

        $init = $hotel + 1;
        $nol = '';
        if (strlen($init) < 4) {
            $nol = '0000';
        } else {
            $nol = '';
        }

        $kodeHotel = 'KM' . $nol . $init;

        $data = [
            'kode_hotel' => $kodeHotel,
            'nama_hotel' => $request->nama_hotel,
            'slug' => $request->input('slug'),
            'tiket_id' => $request->tiket_id,
            'harga_hotel' => $request->harga_hotel,
            'deskripsi_hotel' => $request->deskripsi_hotel,
        ];

        if($request->file('image_hotel')) {
            $data['image_hotel'] = $request->file('image_hotel')->store('gambar-Hotel');
        }

        $data['excerpt'] = Str::limit(strip_tags($request->deskripsi_hotel), 50);

        $fixData = Hotel::create($data);

        if($fixData) {
            return redirect()->route('data_hotel.index')->with('success', 'Kamar Berhasil Ditambahkan!');
        } else {
            return redirect()->route('data_hotel.index')->with('error', 'Maaf Kamar Gagal Ditambahkan!');
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
        $hotel = Hotel::findOrFail($id);
        return view('pages.admin.dataHotel.detail', ['hotel' => $hotel]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hotel = Hotel::findOrFail($id);
        $tikets = Tiket::select('id', 'nama_tiket')->get();
        return view('pages.admin.dataHotel.edit', ['hotel'=>$hotel, 'tikets' => $tikets]);
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
            'nama_hotel' => 'required|string|max:255',
            'slug' => 'unique:hotel|string|required',
            'tiket_id' => 'required|max:155',
            'image_hotel' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:2048',
            'harga_hotel' => 'required|numeric|integer|min:1',
            'deskripsi_hotel' => 'string|nullable'
        ]);

        $validateData = [
            'nama_hotel' => $request->nama_hotel,
            'slug' => $request->slug,
            'tiket_id' => $request->tiket_id,
            'harga_hotel' => $request->harga_hotel,
            'deskripsi_hotel' => $request->deskripsi_hotel
        ];

        if($request->file('image_hotel')) {
            if($request->gambarLama) {
                Storage::delete($request->gambarLama);
            }
            $validateData['image_hotel'] = $request->file('image_hotel')->store('gambar-hotel');
        }

        $validateData['excerpt'] = Str::limit(strip_tags($request->deskripsi_hotel), 50);

        $hotel = Hotel::find($id)->update($validateData);

        if($hotel) {
            return redirect()->route('data_hotel.index')->with('success', 'Data Kamar Berhasil Diubah!');
        } else {
            return redirect()->route('data_hotel.index')->with('error', 'Maaf Kamar Gagal Diubah!');
        }
    }

    public function slug(Request $request)
    {
        $slug = SlugService::createSlug(Hotel::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Hotel::findOrFail($id)->delete();
        return back()->with('error', 'Kamar Berhasil Dihapus!');
    }
}
