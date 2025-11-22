<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
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
            'email'    => 'required|string|email|unique:users,email',
            'phone'    => 'required|string|max:20',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'username' => $request->username,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
            'role'     => 'pembeli',
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil!');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirect berdasarkan role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('home'); // user biasa
            }
        }

        return back()->with('error', 'Email atau password salah!');
    }

    // Halaman utama user
    public function main()
    {
        $this->authorizeUser();
        return view('main');
    }

    // Halaman profil user
    public function showProfileForm()
    {
        $user = $this->authorizeUser();

        return view('profile', compact('user'));
    }

    // Halaman daftar pesanan user
    public function myOrders()
    {
        $user = Auth::user();
        $orders = $user->orders()
            ->whereIn('status', ['Menunggu Konfirmasi', 'Sedang Diproses'])
            ->latest()
            ->get();

        return view('orders', compact('orders'));
    }

    // Halaman detail pesanan user
    public function showOrder($id)
    {
        $user = $this->authorizeUser();

        $order = $user->orders()->where('id', $id)->firstOrFail();

        return view('order-detail', compact('order'));
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda berhasil logout.');
    }

    /**
     * Helper: pastikan user login & ambil datanya
     */
    private function authorizeUser()
    {
        $user = Auth::user();
        if (!$user) {
            redirect('/login')->send();
        }
        return $user;
    }
}
