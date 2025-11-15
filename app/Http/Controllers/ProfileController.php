<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    // Menampilkan halaman profil beserta data pesanan
    public function index()
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user();

        // Ambil pesanan user dari tabel orders (sesuaikan nama tabel/kolom)
        $orders = DB::table('orders')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Kirim data user & orders ke view
        return view('profile', compact('user', 'orders'));
    }

    // Update foto profil
    public function update(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user();

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = time() . '.' . $file->getClientOriginalExtension();

            $path = public_path('uploads/profile_pictures');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $file->move($path, $filename);

            // Hapus foto lama jika ada
            if ($user->profile_picture && file_exists($path . '/' . $user->profile_picture)) {
                unlink($path . '/' . $user->profile_picture);
            }

            // Update database
            DB::table('users')->where('id', $user->id)->update([
                'profile_picture' => $filename,
            ]);
        }

        return redirect()->back()->with('success', 'Foto profil berhasil diperbarui!');
    }
}
