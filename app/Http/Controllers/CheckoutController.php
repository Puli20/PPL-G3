<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Transaction;
use Carbon\Carbon;
use App\Models\TransactionDetail;

class CheckoutController extends Controller
{
    public function addToCart(Request $request,$id){
        $validated = $request->validate([
            'order_quantity' => 'required|integer',
        ]);

        // ambil data produk
        $product = Product::find($id);
        $transactionCheckInitial = Transaction::where('users_id',Auth::user()->id)->where('transaction_status','IN_CART')->first();

        //validasi jika tidak ada transaksi yang sama dengan users_id dan dengan status IN_CART
        if(empty($transactionCheckInitial)){
            $kodeMax = Transaction::max('id');
            $urutan = (int)$kodeMax;
            $urutan++;
            $date =join("",explode("-",Carbon::now()->toDateString())) ;
            $invoiceNumber = $date.sprintf("%06s",$urutan);
            // dd($invoiceNumber);
            //masukkan ke tabel transaction
            $transaction = Transaction::create([
                'users_id' => Auth::user()->id,
                'invoice_number' => $invoiceNumber,
                'transaction_total' => 0,
                'transaction_date' => Carbon::now(),
                'total_weight' => 0,
                'transaction_status' => 'IN_CART'
            ]);
            $transactionCheck = Transaction::where('users_id',Auth::user()->id)->where('transaction_status','IN_CART')->first();
            $transactionDetailCheck = TransactionDetail::where('transactions_id',$transactionCheck->id)->where('products_id',$product->id)->first();
            if(empty($transactionDetailCheck)){
                $transactionDetail = TransactionDetail::create([
                    'transactions_id' => $transactionCheck->id,
                    'products_id' => $product->id,
                    'order_quantity' => $validated['order_quantity']
                ]);
                $transactionCheck->transaction_total += $product->price*$validated['order_quantity'];
                $transactionCheck->total_weight += $product->product_weight*$validated['order_quantity'];
                $transactionCheck->save();
            }
        }else{
            $transactionCheck = Transaction::where('users_id',Auth::user()->id)->where('transaction_status','IN_CART')->first();

            $transactionDetailCheck = TransactionDetail::where('transactions_id',$transactionCheck->id)->where('products_id',$product->id)->first();
            //validasi transaksi detail apakah barang yang di masukkan ke keranjang sudah ada atau belum, jika belum buat baru, jika ada tambahkan
            if(empty($transactionDetailCheck)){
                $transactionDetail = TransactionDetail::create([
                    'transactions_id' => $transactionCheck->id,
                    'products_id' => $product->id,
                    'order_quantity' => $validated['order_quantity']
                ]);
                $transactionCheck->transaction_total += $product->price*$validated['order_quantity'];
                $transactionCheck->total_weight += $product->product_weight*$validated['order_quantity'];
                $transactionCheck->save();
            }else{
                $transactionDetailCheck->order_quantity += $validated['order_quantity'];
                $transactionCheck->transaction_total += $product->price*$validated['order_quantity'];
                $transactionCheck->total_weight += $product->product_weight*$validated['order_quantity'];
                $transactionDetailCheck->save();
                $transactionCheck->save();
            }
        }
        return redirect()->route('detail',$id);
    }

    public function showCart(){
        $transactionCheck = Transaction::where('users_id',Auth::user()->id)->where('transaction_status','IN_CART')->first();
        // if(empty($transactionCheck)){
        //     return redirect()->route('cart');
        // }
        if(empty($transactionCheck)){
            return view('pages.cart',['items'=>[]]);
        }else{
            $transactionDetail = TransactionDetail::where('transactions_id',$transactionCheck->id)->get();
            // dd($transactionDetail);
            return view('pages.cart',[
                'items' => $transactionDetail
            ]);
        }
        // dd($transactionDetail);
    }
    public function remove(Request $request,$detail_id){
        $transactionDetail = TransactionDetail::find($detail_id);
        // dd($transactionDetail);
        $transaction = Transaction::find($transactionDetail->transactions_id);

        $transaction->transaction_total -= $transactionDetail->product->price*$transactionDetail->order_quantity;
        $transaction->total_weight -= $transactionDetail->product->product_weight*$transactionDetail->order_quantity;
        if($transaction->transaction_total == 0 && $transaction->transaction_status == 'IN_CART'){
            $transaction->delete();
        }else{
            $transaction->save();
        }
        $transactionDetail->delete();
        return redirect()->route('cart');
    }

    public function updateInCart(Request $request,$id){
        $validated = $request->validate([
            'order_quantity' => 'required|integer',
        ]);
        // dd($validated['order_quantity']);
        $detail_trans = TransactionDetail::find($id);
        //--------------------------------------------------------------------------
        $product = Product::find($detail_trans->product->id);
        $transactionCheck = Transaction::where('users_id',Auth::user()->id)->where('transaction_status','IN_CART')->first();

        $transactionDetailCheck = TransactionDetail::where('transactions_id',$transactionCheck->id)->where('products_id',$product->id)->first();
        // dd(  $transactionDetailCheck->order_quantity*$transactionDetailCheck->product->price);
        $transactionDetailCheck->transaction->transaction_total -= $transactionDetailCheck->order_quantity*$transactionDetailCheck->product->price;
        $transactionDetailCheck->transaction->transaction_total += $transactionDetailCheck->product->price*$validated['order_quantity'];
        $transactionDetailCheck->transaction->total_weight -= $detail_trans->product->product_weight*$transactionDetailCheck->order_quantity;
        $transactionDetailCheck->transaction->total_weight += $detail_trans->product->product_weight*$validated['order_quantity'];
        $transactionDetailCheck->order_quantity = $validated['order_quantity'];

        $transactionDetailCheck->save();
        $transactionDetailCheck->transaction->save();
        return redirect()->route('cart');
    }
    //mengubah status ke pending
    public function process($id){
        $transaction = Transaction::find($id);
        // dd($transaction->transaction_detail);
        if($transaction->transaction_status != 'PENDING'){
            foreach ($transaction->transaction_detail as $key) {
                if($key->product->stock < $key->order_quantity){
                    return redirect()->route('cart')->with('error','Jumlah stok yang dipesan melebihi stok');
                }
                $key->product->stock -= $key->order_quantity;
                $key->product->save();
            }
            $transaction->transaction_status = 'PENDING';
            $transaction->save();

            $transactionDetail = TransactionDetail::where('transactions_id',$transaction->id)->get();

            // dd($transactionDetail);
            return view('pages.checkout',[
                'items' => $transactionDetail
            ]);
        }else{
            $transactionDetail = TransactionDetail::where('transactions_id',$transaction->id)->get();

            return view('pages.checkout',[
                'items' => $transactionDetail
            ]);
        }
    }
    //proses bukti pembayaran
    public function processData(Request $request,$id){
        $validated = $request->validate([
            'proof_of_transaction' => 'required|image',
        ]);
        $validated['proof_of_transaction'] = $request->file('proof_of_transaction')->store('assets/gallery','public');
        $transaction = Transaction::find($id);
        $transaction->proof_of_transaction = $validated['proof_of_transaction'];
        $transaction->save();
        return redirect()->route('checkout-payment-process-confirm');
    }
    public function successConfirm(){
        return view('pages.success');
    }
}
