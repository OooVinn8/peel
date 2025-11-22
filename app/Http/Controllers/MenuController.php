<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class MenuController extends Controller
{
    /**
     * Tampilkan semua menu, bisa filter kategori & search
     */
    public function index(Request $request)
    {
        // Ambil semua kategori buat filter
        $categories = Category::all();

        // Query dasar
        $query = Product::with('category');

        // Filter kategori
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('name', $request->category);
            });
        }

        // Filter search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        // Ambil hasil
        $menus = $query->get();

        return view('menu.main', compact('menus', 'categories'));
    }

    /**
     * Detail menu
     */
    public function show($id)
    {
        $menu = Product::with('category')->findOrFail($id);

        // Ambil related menu (sama kategori)
        $relatedMenus = Product::where('category_id', $menu->category_id)
            ->where('id', '!=', $menu->id)->get();

        return view('menu.menu-detail', compact('menu', 'relatedMenus'));
    }

    /**
     * Tambahkan menu ke cart (session)
     */
    public function store(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        $product = Product::find($productId);
        if (!$product) {
            return back()->with('error', 'Produk tidak ditemukan');
        }

        if ($product->stock < $quantity) {
            return back()->with('error', 'Stok produk tidak cukup');
        }

        // Ambil cart dari session
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'id'       => $product->id,
                'name'     => $product->name,
                'price'    => $product->price,
                'quantity' => $quantity,
                'image'    => $product->image,
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }
}
