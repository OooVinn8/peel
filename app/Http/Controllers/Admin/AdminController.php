<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class AdminController extends Controller
{
    // Menampilkan daftar produk untuk dikelola
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.recommendations', compact('products'));
    }
}
