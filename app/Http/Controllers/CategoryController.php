<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::with(['galleries'])->paginate(1);

        return view('pages.category', [
            'categories' => $categories,
            'products' => $products
        ]);
    }

    public function detail(Request $request, $slug)
    {
        $categories = Category::all();
        $products = Product::with(['galleries'])->where('categories_id', (Category::where('slug', $slug)->firstOrFail())->id)->paginate(16);

        return view('pages.category', [
            'categories' => $categories,
            'products' => $products
        ]);
    }
}
