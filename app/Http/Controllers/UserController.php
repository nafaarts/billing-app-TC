<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $title = "Users - Trans Continent";
        $data = User::where('id', '!=', auth()->user()->id)->paginate(6);
        return view('users.users', ['title' => $title, 'data' => $data]);
    }

    public function create()
    {
        $title = "Create User - Trans Continent";
        return view('users.users-create', ['title' => $title]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'level' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar')->getClientOriginalName();
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            $name = Str::slug($filename) . '-' . time() . '.' . $extension;

            $request->file('gambar')->move('img/users/', $name);
        } else {
            $name = "sample.png";
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'level' => $request->level,
            'password' => Hash::make($request->password),
            'image' => $name
        ]);

        return redirect('users')->with('status', 'User successfully added!');
    }

    public function edit(User $user)
    {
        $title = "Edit User - Trans Continent";
        return view('users.users-edit', ['title' => $title, 'data' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'level' => 'required',
            'password' => 'confirmed',
        ]);

        if ($request->hasFile('gambar')) {
            if ($user->image != "sample.png") {
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

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'level' => $request->level,
            'password' => ($request->password != null) ? Hash::make($request->password) : $user->password,
            'image' => $name
        ]);

        return redirect('users')->with('status', 'User successfully updated!');
    }

    public function destroy(User $user)
    {
        if ($user->image != "sample.png") {
            File::delete('img/users/' . $user->image);
        }
        $user->delete();
        return redirect('users')->with('status', 'User successfully deleted!');
    }
}
