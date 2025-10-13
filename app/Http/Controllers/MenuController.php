<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Product::all();
        $categories = Category::all();

        return view('menu.main', compact('menus', 'categories'));
    }

public function show($id)
{
    $menu = Product::with('category')->findOrFail($id);
    $relatedMenus = Product::where('category_id', $menu->category_id)
        ->where('id', '!=', $menu->id)
        ->get();
    return view('menu.menu-detail', compact('menu', 'relatedMenus'));
}
}
