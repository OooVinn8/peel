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
        
        $orders = Order::whereIn('status', ['Menunggu Konfirmasi', 'Sedang Diproses'])
        ->orderByRaw("
            CASE
                WHEN status = 'Menunggu Konfirmasi' THEN 1
                WHEN status = 'Sedang Diproses' THEN 2
            END
        ")
        ->orderBy('created_at', 'desc')
        ->get();


        return view('admin.dashboard', compact(
            'orderCount',
            'userCount',
            'productCount',
            'categoryCount',
            'orders'
        ));
    }
}
