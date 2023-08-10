<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('pages.auth.register');
    }

    public function process(Request $request)
    {
        $validateData = $request->validate([
            'username' => 'required|max:255|unique:users',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'newPassword' => 'required|min:8|max:255',
            'password' => 'required|same:newPassword|min:8'
        ]);

        $validateData['password'] = Hash::make($validateData['password']);

        $user = User::create($validateData);

        if ($user) {
            return redirect()->route('login')->with('success', 'Registrasi Berhasil, Harap login');
        } else {
            return redirect()->route('login')->with('error', 'Maaf, Registrasi gagal!, harap cek kembali');
        }
    }
}
