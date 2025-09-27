<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
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

    public function register(StoreUserRequest $request)
    {
        User::create([
            'username' => $request->username,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        if (empty($email) || empty($password)) {
            return back()->with('error', 'Email dan password wajib diisi!');
        }

        $cekUser = DB::table('users')->where('email', $email)->first();
        if (!$cekUser || !Hash::check($password, $cekUser->password)) {
            return back()->with('error', 'Email tidak ditemukan atau password salah!');
        }

        session([
            'user_id'  => $cekUser->id,
            'username' => $cekUser->username,
            'email'    => $cekUser->email,
        ]);

        config(['session.lifetime' => 120]);

        return redirect('/main');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }

    public function main()
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }

        return view('main');
    }
}
