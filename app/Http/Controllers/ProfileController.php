<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index()
    {
        $title = "Profile - Trans Continent";
        $profile = auth()->user();
        return view('profile.profile', ['title' => $title, 'profile' => $profile]);
    }

    public function update(Request $request)
    {
        $user = User::findOrFail(auth()->user()->id);

        Auth::logout();

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'confirmed',
            'gambar' => 'max:5048|mimes:jpg,png,jpeg,gif'
        ]);

        if ($request->hasFile('gambar')) {
            if ($user->image != 'sample.png') {
                File::delete('img/users/' . $user->image);
            }

            $file = $request->file('gambar')->getClientOriginalName();
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            $name = Str::slug($filename) . '-' . time() . '.' . $extension;

            $request->file('gambar')->move('img/users/', $name);
        } else {
            $name = $user->image;
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'image' => $name,
            'password' => ($request->password) ? Hash::make($request->password) : $user->password
        ];

        // dd($data);

        $user->update($data);

        return redirect('login');
    }
}
