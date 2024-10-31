<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Gallery;

class DashboardProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['galleries', 'category'])
                            ->where('users_id', Auth::user()->id)
                            ->get();

        return view('pages.dashboardProducts', [
            'products' => $products
        ]);
    }

    public function detail(Request $request, $id)
    {
        $product = Product::with(['galleries', 'category', 'user'])
                            ->findOrFail($id);
        $categories = Category::all();
        
        return view('pages.dashboardDetail', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    public function uploadGallery (Request $request) {
        $data = $request->all();

        $data['photos'] = $request->file('photos')->store('assets/product', 'public');

        Gallery::create($data);

        return redirect()->route('dashboard-product-detail', $request->products_id);
    }

    public function deleteGallery(Request $request, $id) {
        $item = Gallery::findOrFail($id);
        $item->delete();

        return redirect()->route('dashboard-product-detail', $item->products_id);
    }

    public function update(Request $request, $id) {
        $data = $request->all();

        $item = Product::findOrFail($id);
        $data['slug'] = Str::slug($request->name);

        $item->update($data);

        return redirect()->route('dashboard-products');
    }

    public function create()
    {
        $categories = Category::all();

        return view('pages.dashboardCreate', [
            'categories' => $categories
        ]);
    }
    
    public function store(ProductRequest $request) {

        $data = $request->all();

        $data['slug'] = Str::slug($request->name);

        $product = Product::create($data);
        // $files = $request->file('photo');

        // if($request->hasFile('photo')){
        //     foreach ($files as $file) {
                $gallery = [
                    'products_id' => $product->id,
                    // 'photos' => $file->store('assets/product', 'public')
                    'photos' => $request->file('photo')->store('assets/product', 'public')
                ];
                Gallery::create($gallery);
        //     }
        // }
        return redirect()->route('dashboard-products');

    }
}
