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
}
