<?php

namespace App\Http\Controllers;
use App\Models\Hotel;
use App\Models\Tiket;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExploreController extends Controller
{
    public function index()
    {
        $datas = Hotel::with('review')->filter(request(['cari_hotel']))->paginate(3)->withQueryString();

        return view('pages.customers.explore.index', [
            'datas' => $datas,
        ]);
    }

    public function detail($id) {
        $detail = Hotel::findOrFail($id);
        $reviews = Hotel::where('id', $id)->with('review')->latest()->get();
        $comments = Review::where('hotel_id', $id)->select('komentar')->get()->count();

        $sumRating = 0;
        foreach ($reviews as $data) {
            if ($data->review->count() == 0) {
                $sumRating += $data->review->nilai_rating = 0;
            } else {
                $data->review->nilai_rating = $data->review->sum('nilai_rating') / $data->review->count();
                $sumRating += $data->review->nilai_rating;
            }
        }

        return view('pages.customers.explore.detail', [
            'detail' => $detail,
            'sumRating' => $sumRating,
            'comments' => $comments
        ]);
    }
} 
