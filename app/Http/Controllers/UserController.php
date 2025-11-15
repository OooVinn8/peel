<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Halaman register
    public function showRegisterForm()
    {
        return view('register');
    }

    // Halaman login
    public function showLoginForm()
    {
        return view('login');
    }

    // Proses register
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email'    => 'required|string|email|unique:users',
            'phone'    => 'required|string|max:20',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil!');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'Login berhasil!');
        }

        return back()->with('error', 'Email atau password salah!');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah logout.');
    }

    // Halaman profil (hanya user login)
    public function showProfileForm()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        return view('profile', compact('user'));
    }

    // Halaman main (contoh: halaman utama)
    public function main()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        return view('main');
    }
}
