<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        if (!Cache::has('daily_random_timestamp')) {
            Cache::put('daily_random_timestamp', now(), 86400);
        }

        $products = Cache::remember('daily_random_products', 86400, function () {
            return Product::with('category')->inRandomOrder()->take(4)->get();
        });

        // waktu expired untuk countdown
        $expiresAt = Cache::get('daily_random_timestamp')->copy()->addDay();

        $recommended = Product::where('is_recommendation', 1)->inRandomOrder()->take(3)->get();

        $randomProducts = Product::inRandomOrder()->take(9)->get();

        $categories = Category::orderBy('name', 'asc')->get();

        return view('main', compact(
            'recommended',
            'products',
            'randomProducts',
            'expiresAt',
            'categories'
        ));
    }
}
