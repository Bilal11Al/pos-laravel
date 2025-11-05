<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::with('category')->orderBy('id', 'desc')->get();
        $title = 'Data Product';
        return view('products.index', compact('product', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'category_id' => $request->category_id,
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'product_description' => $request->product_description,
            'is_active' => $request->is_active,
        ];

        //Jika user?mengupload gambar
        if ($request->hasFile('product_photo')) {
            $path = $request->file('product_photo')->store('product', 'public');
            $data['product_photo'] = $path;
        }
        Product::create($data);
        Alert::success('Success', 'data Product successfully ');
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit Product';
        $edit = Product::find($id);
        $categories = Category::get();
        return view('products.edit', compact('title', 'categories', 'edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        $data = [
            'category_id' => $request->category_id,
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'product_description' => $request->product_description,
            'is_active' => $request->is_active,
        ];
        if ($request->hasFile('product_photo')) {
            if ($product->product_photo) {
                file::delete(public_path('storage/' . $product->product_photo));
            }
            $path = $request->File('product_photo')->store('product', 'public');
            $data['product_photo'] = $path;
        }
        $product->update($data);
        Alert::success('Success', 'data Product Update successfully ');
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $product->delete();
        File::delete(public_path('storage/' . $product->product_photo));
        Alert::success('Success', 'data Product successfully ');
        return redirect()->route('product.index');
    }
}
