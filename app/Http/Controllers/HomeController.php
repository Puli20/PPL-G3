<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::limit(4)->get();

        if ($products === 0) {
            return redirect()->to('/');
        } elseif (empty($products)) {
            return redirect()->to('/');
        } elseif (is_null($products)) {
            return redirect()->to('/');
        }

        return view('pages.home', compact('products'));
    }
    public function profil(){
        $user = User::find(Auth::user()->id);
        // dd($user);
        return view('pages.profil',[
            'item' => $user
        ]);
    }
    public function editProfil($id){

        $user = User::find($id);

        return view('pages.edit-profil',[
            'user' => $user
        ]);
    }
    public function editDataProfil(Request $request,$id){
        // dd($id);
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'tgl_lahir' => '',
            'no_telp' => '',
            'foto_profil' => 'image',
            'alamat' => '',
        ]);
        if($request['foto_profil'] != null || $request['foto_profil'] != ""){
            // dd('hai');
            $validated['foto_profil'] = $request->file('foto_profil')->store('assets/gallery','public');
        }
        if($request['password'] != null || $request['password'] != ''){
            $validated['password'] = Hash::make($request['password']);
        }
        $user = User::find($id);
        $user->update($validated);
        return redirect()->route('profil');
    }
    public function orderHistory($id){
        $items = Transaction::where('users_id',$id)->where('transaction_status','NOT LIKE','IN_CART')->get();
        // dd($items);
        return view('pages.order-history',[
            'items' => $items
        ]);
    }
    public function orderHistoryDetail($id){
        // dd('halo'.$id);
        $transaction = Transaction::find($id);
        return view('pages.my-order-detail',[
            'items' => $transaction
        ]);
    }
    public function myOrderIsDone($id){
        $transaction = Transaction::find($id);
        $transaction->transaction_status = 'SUCCESS';
        $transaction->save();

        return redirect()->route('order-history',$transaction->users_id);
    }
    public function reviewProduct($id){
        // dd($id);
        $transactionDetail = TransactionDetail::find($id);
        // $transaction = Transaction::find($transactionDetail->);

        return view('pages.review',['transactionDetail' => $transactionDetail]);
    }
    public function listReviewProduct($id){
        $transaction = Transaction::find($id);
        $transactionDetail = TransactionDetail::where('transactions_id',$transaction->id)->where('review_status',0)->get();

        return view('pages.list-product-review',[
            'items' => $transactionDetail
        ]);
    }
    public function reviewProductSubmit(Request $request,$id){
        $transactionDetail = TransactionDetail::find($id);
        // dd($transactionDetail->transaction->id);
        $validated = $request->validate([
            'rate_value' => 'required|integer|max:5',
            'comment' => 'required|string',
        ]);
        $validated['product_id'] = $transactionDetail->products_id;
        $validated['user_id'] = $transactionDetail->transaction->users_id;
        Review::create($validated);
        $transactionDetail->review_status = 1;
        $transactionDetail->save();

        return redirect()->route('list-product-review',$transactionDetail->transaction->id);
    }

    public function allProduct(){
        $products = Product::all();

        if ($products === 0) {
            return redirect()->to('/');
        } elseif (empty($products)) {
            return redirect()->to('/');
        } elseif (is_null($products)) {
            return redirect()->to('/');
        }
    return view('pages.all-product', compact('products'));
    }
}
