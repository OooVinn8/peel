<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\History;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');

        // Ambil semua pesanan, optional search by customer name + filter status
        $orders = Order::when($search, function ($query, $search) {
            $query->where('customer_name', 'like', "%{$search}%");
        })
            ->when($status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->orderByRaw("
            CASE
                WHEN status = 'Menunggu Konfirmasi' THEN 1
                WHEN status = 'Sedang Diproses' THEN 2
                WHEN status = 'Selesai' THEN 3
                WHEN status = 'Dibatalkan' THEN 4
                ELSE 5
            END
        ")
            ->orderBy('created_at', 'desc')
            ->get();

        // Statistik
        $newOrders = Order::whereDate('created_at', today())->count();
        $totalOrders = Order::count();

        // Statistik per status
        $statusCounts = Order::select('status')
            ->selectRaw('count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return view('admin.orders.index', compact('orders', 'newOrders', 'totalOrders', 'statusCounts'));
    }


    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.orders.order-detail', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|string'
        ]);

        $order = Order::findOrFail($id);

        $oldStatus = $order->status;          // status sebelum diubah
        $newStatus = $validated['status'];    // status baru dari admin

        // Update pesanan
        $order->update([
            'status' => $newStatus
        ]);

        // Masukkan ke history kalau status selesai / dibatalkan
        if (in_array(strtolower($newStatus), ['selesai', 'dibatalkan'])) {

            History::create([
                'user_id' => $order->user_id,
                'order_id' => $order->id,
                'status' => $newStatus,
                'notes' => $order->notes, // notes ambil dari orders table
            ]);
        }

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return back()->with('success', 'Pesanan berhasil dihapus.');
    }
}
