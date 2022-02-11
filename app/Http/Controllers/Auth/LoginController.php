<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only(['email', 'password']), $request->remember)) {
            return redirect('login')->with('status', 'wrong email or password!');
        }

        return redirect()->route('dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
