<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

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

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'image' => 'required|image|mimes:png|max:2048',
        ]);

        $data = $request->only('name');

        if ($request->hasFile('image')) {
            $imageName = time() . '.png';
            $request->image->move(public_path('image_category'), $imageName);
            $data['image'] = $imageName;
        }

        Category::create($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit($id)
    {
        return view('admin.categories.edit', [
            'category' => Category::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required',
            'image' => 'nullable|image|mimes:png|max:2048',
        ]);

        $category = Category::findOrFail($id);

        $category->name = $request->name;

        if ($request->hasFile('image')) {

            // hapus gambar lama
            $oldPath = public_path('image_category/' . $category->image);
            if (file_exists($oldPath)) unlink($oldPath);

            // upload baru
            $imageName = time() . '.png';
            $request->image->move(public_path('image_category'), $imageName);
            $category->image = $imageName;
        }

        $category->save();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if ($category->image && file_exists(storage_path('app/public/image_category/' . $category->image))) {
            unlink(storage_path('app/public/image_category/' . $category->image));
        }

        Product::where('category_id', $category->id)->delete();
        $category->delete();

        return back()->with('success', 'Kategori dan produk terkait berhasil dihapus.');
    }
}
