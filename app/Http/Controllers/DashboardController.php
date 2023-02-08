<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use App\Models\User;
use App\Models\Tiket;
use App\Models\Review;
use App\Models\Pesanan;
use App\Models\Category;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'categories' => Category::all(),
            'tikets' => Tiket::all(),
            'users' => User::where('role','<>', 1)->get(),
            'reviews' => Review::all(),
            'provinsi' => Provinsi::all(),
            'kota' => Kota::all(),
            'pesanans' => Pesanan::all()
        ];

        $data1 = [
            $data['users']->count(),
            $data['reviews']->count(),
            $data['pesanans']->count(),
        ];

        $data2 = [
            $data['provinsi']->count(),
            $data['kota']->count(),
            $data['categories']->count(),
            $data['tikets']->count()
        ];

        return view('pages.admin.index', $data, compact('data1', 'data2'));
    }

    public function editProfile($id) 
    {
        $admin = User::findOrFail($id);
        return view('pages.admin.profile.edit', ['admin' => $admin]);
    }

    public function updateProfile(Request $request, $id)
    {
        $this->validate($request, [
            'username' => 'required|string|max:255',
            'phone' => 'required|numeric',
            'profile' => 'nullable|mimes:jpg,jpeg,png,webp|file|max:2048',
            'email' => 'required|email|string'
        ]);

        $data = [
            'username' => $request->username,
            'phone' => $request->phone,
            'email' => $request->email
        ];

        if($request->file('profile')){
            if($request->profileLama) {
                Storage::delete($request->profileLama);
            }

            $data['profile'] = $request->file('profile')->store('profile');
        }

        $admin = User::findOrFail($id);
        $admin->update($data);

        if($admin) {
            return back()->with('success', 'Profile berhasil diperbarui!');
        } else {
            return back()->with('error', 'Profile gagal diperbarui, coba lagi!');
        }
    }
}
