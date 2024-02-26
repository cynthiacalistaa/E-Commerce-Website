<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart; 
use App\Models\Product; 
use App\Models\Transaction;
use App\Models\Category;
use App\Models\Province;
use App\Models\TransactionDetail;
use App\Http\Controllers\DependantDropdownController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;

class TransactionController extends Controller
{
    public function index(){
        $categories = Category::all();
        $transactions = Transaction::all();
        return view('transaction.index', compact('transactions', 'categories'));
    }

    public function detail()
    {
        $transactions = TransactionDetail::with('product', 'transaction')->get();
        $categories = Category::all();
        return view('transaction.detail', compact('transactions', 'categories'));
    }
    
    public function bayar(Request $request){

        return redirect()->route('transaction.create');
    }

    public function create(Request $request){
        $categories = Category::all();
        $provinces = Province::all();
        $carts = Cart::with('product')->get();
        $product = DB::table('products')->whereIn('id', $request->product_id)->get();
      
        return view('transaction.create', ['carts' => $carts, 'product' => $product, 'qty' => $request->qty], compact('categories', 'provinces'));
    
    }

    public function store(Request $request)
    {
       
        $array = [];
        $tanggalTransaksi = Carbon::now();
        $id = DB::table('transaction')->insertGetId([
            'usersid' => Auth::user()->id,
            'alamat' => $request->alamat,
            'province_id' => $request->input('province_id'), // Fix this line
            'regency_id' => $request->input('regency_id'),
            'district_id' => $request->input('district_id'),
            'village_id' => $request->input('village_id'),
            'kodepos' => $request->kodepos,
            'transaction_date' => $tanggalTransaksi,
            'status' => 0,
            'created_at' => now()
        ]);
        
        
        foreach ($request->product_id as $key => $data) {
            $array[$key]['product_id'] = $data;
        }
        
        foreach ($request->qty as $key => $data) {
            $array[$key]['qty'] = $data;
        }

        foreach ($array as $key => $data) {
            DB::table('transactiondetail')->insert([
                'transactionid' => $id,
                'productsid' => $data['product_id'],
                'qty' => $data['qty']
            ]);
        }

        return redirect()->route('transaction.detail');
    }

        public function update(Request $request, $id)
        {

            $transactionDetail = TransactionDetail::find($id);
            
            if (!$transactionDetail) {
                return redirect()->back()->with('error', 'Transaction not found.');
            }
            
            $imagePath = $request->file('image')->store('bukti_bayar');
            
            // Update the transaction detail
            $transactionDetail->bukti_bayar = $imagePath;
            $transactionDetail->save();

            // Update the corresponding transaction status to "Sudah Dibayar"
            $transaction = Transaction::findOrFail($request->transaction_id);
            $transaction->status = 1; // Assuming 1 represents "Sudah Dibayar"
            $transaction->save();

            return redirect()->back()->with('success', 'Proof of payment updated successfully.');
        }

    public function updateStatusToShipped($id)
    {
        $transaction = Transaction::findOrFail($id);

        if (!$transaction) {
            return redirect()->back()->with('error', 'Transaction not found.');
        }

        $transaction->update(['status' => 2]);

        return redirect()->back()->with('success', 'Transaction status updated to Shipped successfully.');
    }

    public function transactiondone($id)
    {
        $transaction = transaction::findOrFail($id);

        if (!$transaction){
            return redirect()->back();
        }
        
        $transaction->update(['status' => 3]);

        return redirect()->route('history');
    }


    public function orders(){
        $transactions = Transaction::with('details.product', 'user')
        ->orderBy('created_at', 'desc')
        ->get();
        return view('admin.order', compact('transactions'));
    }
    
    public function history(){
        $transactions = Transaction::with('details.product', 'user')
        ->orderBy('created_at', 'desc')
        ->get();
        return view('admin.history', compact('transactions')); 
    }

    public function cetaklaporan()
    {
        $transactions = Transaction::with('details.product', 'user')
            ->orderBy('created_at', 'desc')
            ->get();

        $pdf = PDF::loadView('admin.cetaklaporan', ['transactions' => $transactions]);
        return $pdf->stream('Laporan-Transaction.pdf');
    }

}
