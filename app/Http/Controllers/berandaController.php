<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class berandaController extends Controller
{
    public function admin(){
        $soldProductsCount = Transaction::where('status', 3)->count();
        $transactionOrders = Transaction::where('status', 1)->count();
        $shippedOrders = Transaction::where('status', 2)->count();
        $productCount = Product::all()->count();
        $userCount = User::all()->count();
        $categoryCount = Category::all()->count();
        return view('admin.dashboard', compact('soldProductsCount', 'transactionOrders', 'shippedOrders', 'productCount', 'userCount', 'categoryCount'));
    }
    
    public function profile()
    {
        $user = User::findOrFail(Auth::id());

        return view('profile', compact('user'));
    }

    public function updateprofile(Request $request, $id){
        request()->validate([
            'name'       => 'required|string|min:2|max:100',
            'email'      => 'required|email|unique:users,email, ' . $id . ',id',
            'no_telp'    => 'required'
        ]);
    
        $user = User::find($id);
    
        $user->name = $request->name;
        $user->email = $request->email;
        $user->no_telp = $request->no_telp;
    
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $imageName = time() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public/images', $imageName); // simpan di direktori storage
            $user->photo = $imageName;
        }
    
    
        $user->save();
    
        return back()->with('status', 'Profile updated!');
    }

    public function beranda(){
        $categories = Category::all();
        $product = Product::all();
        return view('beranda', compact('product', 'categories'));
    }

    public function showproduct($category){
        $selectedCategory = Category::where('slug', $category)->firstOrFail();
        $products = Product::where('category_id', $selectedCategory->id)->get();
    
        return view('category.show', [
            'selectedCategory' => $selectedCategory,
            'products' => $products,
        ]);
    }
}
