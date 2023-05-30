<?php

namespace App\Http\Controllers;
use App\Models\Kota;
use App\Models\Hotel;
use App\Models\Tiket;
use App\Models\Review;
use App\Models\Category;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $tikets = Tiket::latest()->get();

        $init = null;
        if (request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $init = ' category: ' . $category->nama_kategori;
        }

        if (request('kota')) {
            $kota = Kota::firstWhere('kota', request('kota'));
            $init = ' kota: ' . $kota->nama_kota;
        }

        if (request('provinsi')) {
            $provinsi = Provinsi::firstWhere('provinsi', request('provinsi'));
            $init = ' Provinsi: ' . $provinsi->nama_provinsi;
        }

        return view('pages.customers.index', [
            "tikets" => $tikets,
            "init" => $init,
            "data" => Tiket::latest()->filter(request(['cari', 'category', 'kota', 'provinsi']))->paginate(6)->withQueryString(),
        ]);
    }

    public function detail($id)
    {
        $hotel = Hotel::with('review')->where('tiket_id', $id)->latest()->get();
        $detail = Tiket::findOrFail($id);
        return view('pages.customers.homeData.tiketFrontend.detail', [
            'detail' => $detail,
            'hotel' => $hotel,
        ]);
    }

    public function detail_hotel($id)
    {
        $detail = Hotel::findOrFail($id);
        $reviewHotel = Review::where('hotel_id', $id)->where('user_id', Auth::user()->id)->get();

        $reviewData = Hotel::where('id', $id)->with('review')->latest()->get();
        $comments = Review::where('hotel_id', $id)->select('komentar')->get()->count();

        $sumRating = 0;
        foreach($reviewData as $data) {
            if($data->review->count() == 0) {
                $sumRating += $data->review->nilai_rating = 0;
            } else {
                $data->review->nilai_rating = $data->review->sum('nilai_rating') / $data->review->count();
                $sumRating += $data->review->nilai_rating;
            }
        }       

        return view('pages.customers.homeData.tiketFrontend.detailHotel', [
            'detail' => $detail,
            'review' => $reviewHotel,
            'sumRating' => $sumRating,
            'comments' => $comments
        ]);
    }

    public function reviewHotel(Request $request)
    {
        $reviews = Review::where('user_id', Auth::user()->id)
            ->where('hotel_id', $request->hotel_id)->first();

        if ($reviews !== null) {
            $reviews->update([
                'komentar' => $request->komentar,
                'nilai_rating' => $request->nilai_rating
            ]);

            return redirect()->back()->with('success', 'Rating has been updated!');
        } else {
            $reviews = Review::create([
                'user_id' => Auth::user()->id,
                'hotel_id' => $request->hotel_id,
                'nilai_rating' => $request->nilai_rating,
                'komentar' => $request->komentar,
            ]);

            return redirect()->back()->with('success', 'Rating has been added!');
        }
    }
}
