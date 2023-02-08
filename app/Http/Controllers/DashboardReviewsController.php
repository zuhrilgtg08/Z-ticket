<?php

namespace App\Http\Controllers;

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
        $tikets = Tiket::with(['review'])->latest()->get();
        $tikets = $tikets->map(function ($tiket) {
            $reviews = Review::where('tiket_id', '=', $tiket->id)->get();

            if ($reviews->count() == 0) {
                $tiket->nilai_rating = 0;
            } else {
                $rating = $reviews->sum('nilai_rating') / $reviews->count();
                $tiket->nilai_rating = $rating;
            }

            return $tiket;
        });

        return view('pages.admin.dataReviews.index', [
            'tikets' => $tikets,
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
        $tikets = Tiket::find($id);
        return view('pages.admin.dataReviews.detail', ['tiket' => $tikets]);
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
