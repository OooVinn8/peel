<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $orders = Order::query()
            ->where('status', 'Menunggu Konfirmasi')
            ->when($search, function ($query, $search) {
                $query->where('customer_name', 'like', "%{$search}%");
            })
            ->latest()
            ->get();

        return view('admin.orders.index', [
            'orders' => $orders,
            'waitingCount' => Order::where('status', 'Menunggu Konfirmasi')->count(),
            'newOrders' => Order::whereDate('created_at', today())->count(),
        ]);
    }


    public function show($id)
    {
        return view('admin.orders.order-detail', [
            'order' => Order::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate(['status' => 'required']);
        Order::findOrFail($id)->update($validated);
        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Order::findOrFail($id)->delete();
        return back()->with('success', 'Pesanan berhasil dihapus.');
    }
}
