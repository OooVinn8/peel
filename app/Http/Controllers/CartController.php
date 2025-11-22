<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product; // ganti sesuai model yang dipakai
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
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
            'note'       => 'nullable|string|max:255',
        ]);

        $userId = Auth::id();
        $product = Product::findOrFail($request->product_id);

        // Cek stok
        if ($request->quantity > $product->stock) {
            return back()->with('error', 'Jumlah melebihi stok yang tersedia!');
        }

        // Cek apakah item sudah ada di cart
        $cartItem = CartItem::where('user_id', $userId)
                            ->where('product_id', $request->product_id)
                            ->first();

        if ($cartItem) {
            if ($cartItem->quantity + $request->quantity > $product->stock) {
                return back()->with('error', 'Jumlah di keranjang melebihi stok yang tersedia!');
            }

            $cartItem->quantity += $request->quantity;
            $cartItem->note = $request->note;
            $cartItem->save();
        } else {
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
        $product = $cartItem->product;

        if ($request->quantity > $product->stock) {
            return response()->json(['error' => 'Jumlah melebihi stok yang tersedia!']);
        }

        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return response()->json(['success' => 'Jumlah di keranjang berhasil diperbarui!']);
    }

    /**
     * Hapus item tertentu dari cart
     */
    public function destroy($id)
    {
        $cartItem = CartItem::where('user_id', Auth::id())->findOrFail($id);
        $cartItem->delete();

        return back()->with('success', 'Produk berhasil dihapus dari keranjang!');
    }

    /**
     * Update catatan item di cart
     */
    public function updateNote(Request $request, $id)
    {
        $request->validate([
            'note' => 'nullable|string|max:255',
        ]);

        $cartItem = CartItem::findOrFail($id);
        $cartItem->note = $request->note;
        $cartItem->save();

        return back()->with('success', 'Catatan berhasil diperbarui.');
    }

    /**
     * Tambah item ke cart via session (opsional)
     */
    public function add(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->product_id;
        $product = Product::findOrFail($id);

        // cek stok session
        $currentQty = $cart[$id] ?? 0;
        if ($currentQty + 1 > $product->stock) {
            return back()->with('error', 'Jumlah melebihi stok yang tersedia!');
        }

        $cart[$id] = $currentQty + 1;
        session()->put('cart', $cart);

        return back()->with('success', 'Ditambahkan ke keranjang!');
    }
}
