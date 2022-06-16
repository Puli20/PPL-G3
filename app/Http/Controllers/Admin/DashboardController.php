<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;



class DashboardController extends Controller
{
    public function index(){

        return view('pages.admin.dashboard',[
            'total_transaction' => Transaction::all()->count(),
            'products' => Product::all()->count(),

        ]);
    }
    public function profil($id){
        // dd('test');
        $item = User::find($id);
        return view('pages.admin.profil',['item'=>$item]);
    }
    public function editProfil($id){
        // dd('test');
        $item = User::find($id);
        return view('pages.admin.edit-profil',['user'=>$item]);
    }
    public function editProfilSubmit(Request $request,$id){
        // dd($id);
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'no_telp' => '',
            'foto_profil' => 'image',
            'alamat' => '',
        ]);
        if($request['password'] != null || $request['password'] != ''){
            $validated['password'] = Hash::make($request['password']);
        }
        $user = User::find($id);
        $user->update($validated);
        return redirect()->route('profil-admin',$user->id);
    }
}
