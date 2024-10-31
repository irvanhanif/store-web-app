<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductGallery;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\ProductGalleryRequest;
use App\Models\Gallery;
use App\Models\Product;

class ProductGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request()->ajax()){
            $query = Gallery::with('product');
    
            return DataTables::of($query)
                ->addColumn('action', function($item) {
                return '
                    <div class="btn-group">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle mr-1 mb-1"
                            type="button" data-bs-toggle="dropdown"
                            > Aksi
                            </button>
                            <div class="dropdown-menu">
                                <form action="'. route('gallery.destroy', $item->id) .'" 
                                method="POST">
                                    '. method_field('delete') . csrf_field() .'
                                    <button type="submit" 
                                        class="dropdown-item text-danger">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                ';
            })->editColumn('photos', function($item) {
                return $item->photos ? '<img src="'. Storage::url($item->photos) .'" 
                                        style="max-height: 80px" />' : '';
            })->rawColumns(['action', 'photos'])->make();
        }

        return view('pages.admin.productgallery.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();

        return view('pages.admin.productgallery.create', [
            'products' => $products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductGalleryRequest $request)
    {
        $data = $request->all();

        $data['photos'] = $request->file('photos')->store('assets/product', 'public');
        Gallery::create($data);
        
        return redirect()->route('gallery.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductGalleryRequest $request, string $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Gallery::findOrFail($id);
        $item->delete();

        return redirect()->route('gallery.index');
    }
}
