<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Tampilkan daftar produk
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Product::with('category');

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        $products = $query->latest()->get();
        $recommendedProducts = Product::where('is_recommendation', true)->get();

        return view('admin.products.index', [
            'products' => $products,
            'totalProducts' => Product::count(),
            'recommendedProducts' => $recommendedProducts,
        ]);
    }

    /**
     * Tampilkan detail produk
     */
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    /**
     * Tampilkan form tambah produk
     */
    public function create()
    {
        return view('admin.products.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Simpan produk baru
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'rating' => 'nullable|numeric|min:0|max:5',
            'is_recommendation' => 'nullable|boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        // Upload gambar jika ada
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('image_menu'), $imageName);
            $data['image'] = $imageName;
        }

        $data['is_recommendation'] = $request->boolean('is_recommendation', false);

        Product::create($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit produk
     */
    public function edit($id)
    {
        return view('admin.products.edit', [
            'product' => Product::findOrFail($id),
            'categories' => Category::all()
        ]);
    }

    /**
     * Update produk
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'rating' => 'nullable|numeric|min:0|max:5',
            'is_recommendation' => 'nullable|boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        // Upload gambar baru jika ada
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('image_menu'), $imageName);
            $validated['image'] = $imageName;
        }

        // Boolean konversi
        $validated['is_recommendation'] = $request->boolean('is_recommendation', false);

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Hapus produk
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Hapus file gambar jika ada
        if ($product->image && file_exists(public_path('image_menu/' . $product->image))) {
            unlink(public_path('image_menu/' . $product->image));
        }

        $product->delete();

        return back()->with('success', 'Produk berhasil dihapus.');
    }
}
