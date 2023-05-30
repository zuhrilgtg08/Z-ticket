<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Review;
use App\Models\Tiket;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotels = Hotel::with(['review'])->latest()->get();
        $rows = $hotels->map(function ($query) {
            $reviews = Review::where('hotel_id', '=', $query->id)->get();

            if ($reviews->count() == 0) {
                $query->nilai_rating = 0;
            } else {
                $rating = $reviews->sum('nilai_rating') / $reviews->count();
                $query->nilai_rating = $rating;
            }

            return $query;
        });

        $data = $rows->filter(fn($q) => $q->nilai_rating >= 3);

        return view('pages.admin.dataReviews.index', [
            'data' => $data,
        ]);
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
        $detail = Hotel::findOrFail($id);
        $dataUsers = Review::where('user_id', '<>', '1')
                        ->where('hotel_id', $id)->get(['user_id', 'nilai_rating', 'komentar']);
        return view('pages.admin.dataReviews.detail', [
            'detail' => $detail,
            'dataUsers' => $dataUsers
        ]);
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
        $review = Review::find($id);
        $review->delete();
        return redirect()->route('data_reviews.index')->with('error', 'Review berhasil dihapus pada tiket ini!');
    }
}
