<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\History;
use App\Models\Order;

class ProfileController extends Controller
{
    // Menampilkan halaman profil beserta data pesanan & history
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user();

        // Ambil semua orders user
        $orders = Order::where('user_id', $user->id)
                       ->orderBy('created_at', 'desc')
                       ->get();

        // Ambil semua history user langsung dari tabel histories
        $histories = History::where('user_id', $user->id)
                            ->with('order') // biar bisa akses data order terkait
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('profile', compact('user', 'orders', 'histories'));
    }

    // Tampilkan detail history
    public function showHistoryOrder($id)
    {
        $history = History::where('id', $id)
                          ->where('user_id', auth()->id())
                          ->with('order')
                          ->firstOrFail();

        $order = $history->order;

        return view('history-order-show', compact('history', 'order'));
    }

    // Update status pesanan (Selesai/Dibatalkan)
    public function updateOrderStatus(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);

        if ($order->user_id != auth()->id()) {
            abort(403, 'Anda tidak berhak mengubah status pesanan ini.');
        }

        $request->validate([
            'status' => 'required|in:Selesai,Dibatalkan'
        ]);

        $newStatus = $request->status;
        $order->status = $newStatus;
        $order->save();

        // Masukkan ke history otomatis, notes dari orders
        History::create([
            'user_id' => $order->user_id,
            'order_id' => $order->id,
            'status' => $newStatus,
            'notes' => $order->notes ?? null,
        ]);

        return redirect()->back()->with('success', "Status pesanan berhasil diubah menjadi {$newStatus}!");
    }

    // Update foto profil
    public function update(Request $request)
    {
        $user = Auth::user();

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('uploads/profile_pictures');

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $file->move($path, $filename);

            if ($user->profile_picture && file_exists($path . '/' . $user->profile_picture)) {
                unlink($path . '/' . $user->profile_picture);
            }

            $user->update(['profile_picture' => $filename]);
        }

        return redirect()->back()->with('success', 'Foto profil berhasil diperbarui!');
    }

    // Update password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return back()->with('error', 'Password lama salah.');
        }

        auth()->user()->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', 'Password berhasil diubah!');
    }
}
