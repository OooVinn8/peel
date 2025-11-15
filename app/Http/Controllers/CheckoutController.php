<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = \App\Models\CartItem::where('user_id', Auth::id())->with('product')->get();
        return view('checkout.index', compact('cartItems'));
    }


    public function process(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|string|max:30',
            'payment_method' => 'required|string|in:cod,transfer,ewallet',
        ]);

        $cartItems = \App\Models\CartItem::where('user_id', Auth::id())->with('product')->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Keranjangmu kosong.');
        }

        DB::beginTransaction();
        try {
            $total = $cartItems->sum(fn($i) => $i->price * $i->quantity);

            $order = Order::create([
                'user_id' => Auth::id(),
                'customer_name' => $request->name,
                'customer_address' => $request->address,
                'customer_phone' => $request->phone,
                'payment_method' => $request->payment_method,
                'status' => 'Menunggu Konfirmasi',
                'total_price' => $total,
                'notes' => $request->notes ?? null,
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id ?? null,
                    'product_name' => $item->product->name ?? $item->name ?? 'Produk',
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                    'subtotal' => $item->price * $item->quantity,
                ]);

                // Kurangi stok produk jika ada
                if (isset($item->product) && $item->product->stock !== null) {
                    $item->product->decrement('stock', $item->quantity);
                }
            }

            // Kosongkan keranjang
            \App\Models\CartItem::where('user_id', Auth::id())->delete();

            DB::commit();

            return redirect()->route('checkout.thankyou', $order->id)
                ->with('success', 'Order berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal membuat order: ' . $e->getMessage());
        }
    }

    public function thankyou($orderId)
    {
        $order = Order::with('items')->findOrFail($orderId);
        return view('checkout.thankyou', compact('order'));
    }
}
