<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Kota;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Tiket;
use App\Models\Review;
use App\Models\Pesanan;
use App\Models\Category;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
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
            'pesanans' => Pesanan::all(),
            'hotel' => Hotel::all()
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
            return back()->with('success', 'The profile successfully updated!');
        } else {
            return back()->with('error', 'The profile error updated, please try again!');
        }
    }

    public function changePassword(Request $request, $id)
    {
        $user_password = User::findOrFail($id);

        $request->validate([
            'current_password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8',
            'confirm_password' => 'required|string|min:8'
        ]);

        if($user_password) {
            if(Hash::check($request->current_password, $user_password->password)) {
                if($request->new_password == $request->confirm_password) {
                    User::where('id', auth()->user()->id)->update([
                        'password' => Hash::make($request->new_password)
                    ]);

                    return back()->with('success', 'Password has been updated!');
                }
            }

            return back()->with('error', 'The password something wrong!');
        }
    }
}
