<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'categoriesCount' => Category::count(),
            'productsCount' => Product::count(),
            'ordersCount' => Order::count(),
            'userCount' => User::where('role', 'pembeli')->count(),
        ]);
    }

    public function categories()
    {
        $categories = Category::all();
        return view('admin.categories', compact('categories'));
    }

    public function products()
    {
        $products = Product::with('category')->get();
        return view('admin.products', compact('products'));
    }

    public function orders()
    {
        $orders = Order::with('user')->latest()->get();
        return view('admin.orders', compact('orders'));
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }
}
