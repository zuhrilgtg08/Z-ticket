<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.auth.login');
    }

    public function authenticate(Request $request)
    {
        $validateData = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => 'required|min:8',
        ]);

        if (Auth::attempt($validateData)) {
            $request->session()->regenerate();
            if(auth()->user()->role == 1) {
                return redirect()->intended('/dashboard');
            } else {
                return redirect()->intended('/home');
            }
        }

        return back()->with('error', 'Maaf login gagal, Coba lagi!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login')->with('success', 'Anda Berhasil Logout!');
    }
}
