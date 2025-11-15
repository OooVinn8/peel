<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product; // atau Menu kalau kamu pakai model Menu
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Tampilkan semua item dalam cart user
     */
    public function index()
    {
        $cartItems = CartItem::where('user_id', Auth::id())->with('product')->get();
        $total = $cartItems->sum(fn($item) => $item->price * $item->quantity);

        return view('cart.index', compact('cartItems', 'total'));
    }

    /**
     * Tambahkan item ke cart
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id', // ganti 'products' ke 'menus' jika pakai tabel menus
            'quantity'   => 'required|integer|min:1',
            'note'       => 'nullable|string|max:255',
        ]);

        $userId = Auth::id();

        // Cek apakah item sudah ada di cart
        $cartItem = CartItem::where('user_id', $userId)
            ->where('product_id', $request->product_id)
            ->first();

        $product = Product::findOrFail($request->product_id);

        if ($cartItem) {
            // Jika sudah ada, tambahkan jumlahnya
            $cartItem->quantity += $request->quantity;
            $cartItem->note = $request->note;
            $cartItem->save();
        } else {
            // Jika belum ada, buat baru
            CartItem::create([
                'user_id'    => $userId,
                'product_id' => $request->product_id,
                'quantity'   => $request->quantity,
                'price'      => $product->price,
                'note'       => $request->note,
            ]);
        }

        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    /**
     * Update jumlah item dalam cart
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = CartItem::where('user_id', Auth::id())->findOrFail($id);
        $cartItem->update(['quantity' => $request->quantity]);

        return back();
    }

    /**
     * Hapus item tertentu dari cart
     */
    public function destroy($id)
    {
        $cartItem = CartItem::where('user_id', Auth::id())->findOrFail($id);
        $cartItem->delete();

        return back();
    }

    public function updateNote(Request $request, $id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->note = $request->note;
        $cartItem->save();

        return back()->with('success', 'Catatan berhasil diperbarui.');
    }
}
