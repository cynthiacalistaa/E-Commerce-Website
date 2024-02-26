<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function keranjang()
{
    $categories = Category::all();
    $keranjang = auth()->user()->keranjang;
    $keranjang = Cart::with('product')->where('usersid', Auth::id())->get();

    $total = $keranjang->sum(function ($item) {
        // Check if $item->product is not null and is an object
        if ($item->product && is_object($item->product)) {
            return $item->product->price * $item->qty;
        } else {
            // Handle the case where $item->product is null or not an object
            return 0;
        }
    });

    return view('cart', compact('keranjang', 'total', 'categories'));
}


    public function addToCart(Request $request, Product $product)
    {
        $userId = Auth::id();
        $cartItem = Cart::where('usersid', $userId)
                        ->where('productsid', $product->id)
                        ->first();
    
        if ($cartItem) {
            // Produk sudah ada di keranjang, tingkatkan qty
            $cartItem->update([
                'qty' => $cartItem->qty + $request->quantity,
            ]);
        } else {
            // Produk belum ada di keranjang, tambahkan entri baru
            Cart::create([
                'usersid' => $userId,
                'productsid' => $product->id,
                'qty' => $request->quantity,
            ]);
        }
        $cartCount = session('cart_count', 0);
        $cartCount++;
        session(['cart_count' => $cartCount]);

        return redirect()->back();
        
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:1',
        ]);

        $cartItem = Cart::findOrFail($id);
        $cartItem->update([
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully');
    }

    public function remove($id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Item removed from cart');
    }
}
