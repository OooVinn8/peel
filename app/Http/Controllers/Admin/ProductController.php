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
        $outOfStockProducts = Product::where('stock', 0)->get();

        return view('admin.products.index', [
            'products' => $products,
            'totalProducts' => Product::count(),
            'recommendedProducts' => $recommendedProducts,
            'outOfStockProducts' => $outOfStockProducts,
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

    $validated['is_recommendation'] = $request->boolean('is_recommendation', false);

    // generate folder baru sesuai kategori
    $newFolder = strtolower(str_replace(' ', '_', Category::find($validated['category_id'])->name));
    $oldFolder = strtolower(str_replace(' ', '_', $product->category->name));

    // kalau ganti kategori & file ada → pindahin folder
    if ($oldFolder !== $newFolder && $product->image) {
        $oldPath = public_path("image_menu/$oldFolder/{$product->image}");
        $newPathDir = public_path("image_menu/$newFolder");

        if (!file_exists($newPathDir)) {
            mkdir($newPathDir, 0777, true);
        }

        if (file_exists($oldPath)) {
            rename($oldPath, "$newPathDir/{$product->image}");
        }
    }

    // kalau upload gambar baru
    if ($request->hasFile('image')) {

        // hapus yang lama
        $existingPath = public_path("image_menu/$newFolder/{$product->image}");
        if (file_exists($existingPath) && $product->image) {
            unlink($existingPath);
        }

        // simpan baru
        $filename = strtolower(uniqid()."_".time().".".$request->image->extension());
        $request->image->move(public_path("image_menu/$newFolder"), $filename);

        $validated['image'] = $filename;
    }

    $product->update($validated);

    return redirect()->route('admin.products.index')
        ->with('success', 'Produk berhasil diperbarui.');
}

    //Hapus produk
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image && file_exists(public_path('image_menu/' . $product->image))) {
            unlink(public_path('image_menu/' . $product->image));
        }

        $product->delete();

        return back()->with('success', 'Produk berhasil dihapus.');
    }
}
