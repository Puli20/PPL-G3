<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function index($id)
    {
        $products = Product::find($id);

        if ($products === 0) {
            return redirect()->to('/');
        } elseif (empty($products)) {
            return redirect()->to('/');
        } elseif (is_null($products)) {
            return redirect()->to('/');
        }
        // dd($products->gallery);
        return view('pages.detail', [
            'item' => $products
        ]);

    }
}
