<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function edit($id)
    {
        $dataUsers = User::findOrFail($id);

        if(Auth::user()->id == $id && Auth::user()->id != 1) {
            return view('pages.customers.editProfile.edit', ['dataUsers' => $dataUsers]);
        }
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'username' => 'string|required',
            'email' => 'email:dns|string|required',
            'phone' => 'numeric|required',
            'profile' => 'file|max:2048|required|mimes:jpg,png,jpeg'
        ]);

        $data = [
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
        ];

        if($request->file('profile')) {
            if($request->oldProfile) {
                Storage::delete($request->oldFile);
            }
            $data['profile'] = $request->file('profile')->store('profile-users');
        }

        $users = User::find($id);
        $users->update($data);

        if($users) {
            return redirect()->back()->with('success', 'Your Profile Update is Success!');
        } else {
            return redirect()->back()->with('error', 'Your Profile Update is Error!');
        }

    }
}
