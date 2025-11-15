<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $orderCount = Order::count();
        $userCount = User::where('role', 'pembeli')->count();
        $productCount = Product::count();
        $categoryCount = Category::count();
        $orders = Order::where('status', 'pending')->latest()->get();

        return view('admin.dashboard', [
            'orderCount'   => $orderCount,
            'userCount'    => $userCount,
            'productCount' => $productCount,
            'categoryCount'=> $categoryCount,
            'orders'       => $orders,
        ]);
    }
}
