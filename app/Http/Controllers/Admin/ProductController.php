<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data =  Product::all();
        return view('pages.admin.data-produk.data-produk',[
            'products' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.admin.data-produk.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|max:50',
            'product_weight' => 'required|integer',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            // 'image' => 'required|image',
            'description' => 'required|string'
        ]);
        // $validated['image'] = $request->file('image')->store('assets/gallery','public');
        // dd($validated);

        Product::create($validated);
        return redirect()->route('data-produk.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Product::find($id);
        return view('pages.admin.data-produk.edit',[
            'product' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $data = Product::find($id);
        $validated = $request->validate([
            'product_name' => 'required|max:50',
            'product_weight' => 'required|integer',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            // 'image' => 'required|image',
            'description' => 'required|string'
        ]);
        // $validated['image'] = $request->file('image')->store('assets/gallery','public');

        $data->update($validated);
        return redirect()->route('data-produk.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Product::find($id);
        $item->delete();
        return redirect()->route('data-produk.index');

    }
}
