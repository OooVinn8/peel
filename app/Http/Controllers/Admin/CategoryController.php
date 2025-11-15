<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();

        if ($search = $request->query('search')) {
            $query->where('name', 'like', "%{$search}%");
        }

        $categories = $query->orderBy('created_at', 'desc')->get();

        $totalCategories = Category::count();
        $newCategories = Category::whereDate('created_at', Carbon::today())->count();

        return view('admin.categories.index', compact('categories', 'totalCategories', 'newCategories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $r)
    {
        $r->validate(['name' => 'required']);
        Category::create(['name' => $r->name]);
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        return view('admin.categories.edit', ['category' => Category::findOrFail($id)]);
    }

    public function update(Request $r, $id)
    {
        $r->validate(['name' => 'required']);
        Category::findOrFail($id)->update(['name' => $r->name]);
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // 🔥 Hapus semua produk yang memiliki kategori ini
        Product::where('category_id', $category->id)->delete();

        // Setelah itu baru hapus kategori-nya
        $category->delete();

        return back()->with('success', 'Kategori dan produk terkait berhasil dihapus.');
    }
}
