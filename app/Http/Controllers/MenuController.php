<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Product::all();

        return view('menu.main', compact('menus'));
    }
}
