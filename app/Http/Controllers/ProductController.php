<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function tampil()
    {
        $product = Product::all();
        $category = Category::all();
        return view('product.index', compact('product', 'category'));
    }

    public function detail($id)
    {
        $products = Product::all();
        $categories = Category::all();
        $product = Product::findOrFail($id);
        return view('product.detail', compact('product', 'products', 'categories'));
    }

    public function search(Request $request)
    {
        $categories = Category::all();
        $keyword = $request->input('search');
        $product = Product::where('name', 'LIKE', "%$keyword%")
            ->orWhere('desc', 'LIKE', "%$keyword%")
            ->get();
        $message = $product->isEmpty() ? 'Maaf, produk tidak ditemukan.' : null;

        return view('product.show', compact('product', 'categories'));
    }

    public function create()
    {
        $category = Category::all();
        return view('product.create', compact('category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'categoryid' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required',
            'desc' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // sesuaikan dengan jenis gambar yang diizinkan
        ]);
        
        $product = new Product([
            'name' => $request->name,
            'categoryid' => $request->categoryid,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $request->image,
            'desc' => $request->desc,
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageName); // simpan di direktori storage
            $product->image = $imageName;
        }

        $product->save();

        return redirect()->route('product.index')->with('success', 'Product created successfully');
    }

    public function edit($id)
    {
        $product = Product::where('id', $id)->first();
        $category = Category::all();
        return view('product.edit', compact('product', 'category'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'categoryid' => 'required|string',
        'price' => 'required|numeric',
        'stock' => 'required',
        'desc' => 'required|string',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // sesuaikan dengan jenis gambar yang diizinkan
    ]);

    $product = Product::findOrFail($id);

    $product->name = $request->name;
    $product->categoryid = $request->categoryid;
    $product->price = $request->price;
    $product->stock = $request->stock;
    $product->desc = $request->desc;

    if ($request->hasFile('image')) {
        // Hapus gambar lama jika ada
        if ($product->image) {
            Storage::delete('public/images/' . $product->image);
        }

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('public/images', $imageName); // simpan di direktori storage
        $product->image = $imageName;
    }

    $product->save();

    return redirect()->route('product.index')->with('success', 'Product updated successfully');
}


    
    public function destroy($id)
    {
        product::where('id', $id)->delete();
        return redirect(route('product.index'))->with(['Success' => 'Barang berhasil dihapus']);
    }

    public function show()
    {
        $categories = Category::all();
        $product = Product::all();
        return view('product.show', compact('product', 'categories'));
    }

    public function productsCategory($id)
    {
        
        //$productall = $category->Product()->get();
        $product = Product::where('categoryid', $id)->get();
        //$category = Category::all();

        return view('product.category', compact('product'));
        
    }

}
