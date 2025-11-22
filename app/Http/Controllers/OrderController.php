<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderController extends Controller
{
    // List semua pesanan user
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
                       ->with('items.product')
                       ->orderBy('created_at', 'desc')
                       ->get();

        return view('orders.index', compact('orders'));
    }

    // Detail pesanan user
    public function show($id)
    {
        $order = Order::where('user_id', Auth::id())
                      ->with('items.product')
                      ->findOrFail($id);

        return view('orders.detail', compact('order'));
    }

    // Update status pesanan user (Selesaikan / Batalkan)
    public function updateStatus(Request $request, $id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);
        $newStatus = $request->input('status');

        $allowedStatuses = ['Selesai', 'Dibatalkan'];

        if (!in_array($newStatus, $allowedStatuses)) {
            return redirect()->back()->with('error', 'Status tidak valid.');
        }

        // Validasi status sebelum update
        if ($order->status == 'Selesai' || $order->status == 'Dibatalkan') {
            return redirect()->back()->with('error', 'Pesanan sudah selesai atau dibatalkan.');
        }

        if ($newStatus == 'Selesai' && $order->status != 'Sedang Diproses') {
            return redirect()->back()->with('error', 'Pesanan belum bisa diselesaikan.');
        }

        if ($newStatus == 'Dibatalkan' && $order->status != 'Menunggu Konfirmasi') {
            return redirect()->back()->with('error', 'Pesanan tidak bisa dibatalkan sekarang.');
        }

        $order->status = $newStatus;
        $order->save();

        return redirect()->back()->with('success', "Status pesanan berhasil diubah menjadi $newStatus.");
    }
}
