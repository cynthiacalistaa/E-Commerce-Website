<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\berandaController;
use App\Http\Controllers\IndoregionController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [berandaController::class, 'beranda'])->name('beranda');

route::group(['middleware' => ['auth', 'checkrole:admin']], function(){
    //halaman admin
    Route::get('admin', [berandaController::class, 'admin'])->name('admin.dashboard');

    //product
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::get('/product', [ProductController::class, 'tampil'])->name('product.index');
    Route::get('/product/show', [ProductController::class, 'show'])->name('product.show');
    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

    //category
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    
    Route::get('/orders', [TransactionController::class, 'orders'])->name('orders');
    Route::put('/transactions/{id}/updateStatusToShipped', [TransactionController::class, 'updateStatusToShipped'])->name('transactions.updateStatusToShipped');
    Route::put('/transactions/{id}/history', [TransactionController::class, 'transactiondone'])->name('transaction.done');
    Route::get('/transactions/history', [TransactionController::class, 'history'])->name('history');
    Route::get('/cetaklaporan', [TransactionController::class, 'cetaklaporan'])->name('cetaklaporan');

});


route::group(['middleware' => ['auth', 'checkrole:user', 'verified']], function(){
    //halaman user
    Route::get('/profile', [berandaController::class, 'profile'])->name('profile');
    Route::patch('/profile/{id}', [berandaController::class, 'updateprofile'])->name('profile.update');
   
    //product
    Route::get('/product/show', [ProductController::class, 'show'])->name('product.show');
    Route::get('/product/search', [ProductController::class, 'search'])->name('products.search');
    Route::get('/product/{id}/detail', [ProductController::class, 'detail'])->name('product.detail');
    Route::get('/products/{id}', [ProductController::class, 'productsCategory'])->name('product.category');

    //cart
    Route::get('/cart', [CartController::class, 'keranjang'])->name('cart.index');
    Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');

    //transaction
    Route::get('/checkout', [TransactionController::class, 'create'])->name('checkout');
    Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction.index');
    Route::post('/transaction/create', [TransactionController::class, 'create'])->name('transaction.create');
    Route::get('/transaction/detail', [TransactionController::class, 'detail'])->name('transaction.detail');
    Route::post('/bayar', [TransactionController::class, 'bayar'])->name('transaction.bayar');
    Route::post('/transaction', [TransactionController::class, 'store'])->name('transaction.store');
    Route::put('/transaction/{id}/update', [TransactionController::class, 'update'])->name('transaction.update');

   //indoregion
   Route::post('/getdesa', [IndoregionController::class, 'getDesa'])->name('getdesa');
   Route::post('/getkota', [IndoregionController::class, 'getKota'])->name('getkota');
   Route::post('/getkecamatan', [IndoregionController::class, 'getKecamatan'])->name('getkecamatan');
   Route::post('/getkabupaten', [IndoregionController::class, 'getRegency'])->name('getkabupaten');
});


//route bawaan auth
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
