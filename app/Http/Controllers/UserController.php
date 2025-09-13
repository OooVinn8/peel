<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showRegisterForm()
    {
        return view('register'); 
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function showProfileForm()
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }

        $user = DB::table('users')->where('id', session('user_id'))->first();

        return view('profile', compact('user'));
    }

    public function register(Request $fill)
    {
        $username = $fill->username;
        $email = $fill->email;
        $phone = $fill->phone;
        $password = $fill->password;
        $confirmpassword = $fill->confirmpassword;

        if (empty($username) || empty($email) || empty($phone) || empty($password) || empty($confirmpassword)) {
            return back()->with('error', 'Semua inputan wajib diisi!');
        }   

        $cekEmail = DB::table('users')->where('email', $email)->first();
        if ($cekEmail) {
            return back()->with('error', 'Email sudah digunakan!');
        }

        $cekPhone = DB::table('users')->where('phone', $phone)->first();
        if ($cekPhone) {
            return back()->with('error', 'Nomor HP sudah digunakan!');
        }

        if (strlen($password) < 8) {
            return back()->with('error', 'Password harus minimal 8 karakter!');
        }

        if ($password !== $confirmpassword) {
            return back()->with('error', 'Password dan konfirmasi password tidak sama!');
        }

        DB::table('users')->insert([
            'username' => $username,
            'email' => $email,
            'phone' => $phone,
            'password' => Hash::make($password),
            'created_at' => now()
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }


    public function login(Request $fill)
    {
        $email = $fill->email;
        $password = $fill->password;

        if (empty($email) || empty($password)) {
            return back()->with('error', 'Email dan password wajib diisi!');
        }

        $cekUser = DB::table('users')->where('email', $email)->first();
        if (!$cekUser) {
            return back()->with('error', 'Email tidak ditemukan atau password salah!');
        }

        if (!Hash::check($password, $cekUser->password)) {
            return back()->with('error', 'Email tidak ditemukan atau password salah!');
        }

        // simpan session user
        session([
            'user_id' => $cekUser->id,
            'username' => $cekUser->username,
            'email' => $cekUser->email,
        ]);

        // set lifetime session jadi 1 jam
        config(['session.lifetime' => 60]);

        return redirect('/main');
    }

    public function logout(Request $request)
    {
        $request->session()->flush(); // hapus semua data session
        return redirect('/'); // balikin ke home
    }

    public function main()
    {
        if (!session()->has('user_id')) {
            return redirect('/main');
        }

        return view('main');
    }
}
