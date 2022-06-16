<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Gallery::all();
        // dd($items);
        return view('pages.admin.data-produk.galleries.index',[
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Product::all();
        return view('pages.admin.data-produk.galleries.create',[
            'items' => $items
        ]);
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
            'product_id' => 'required|integer|exists:products,id',
            'image' => 'required|image',
        ]);
        $validated['image'] = $request->file('image')->store('assets/gallery','public');

        Gallery::create($validated);
        return redirect()->route('gallery.create');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $gallery = Gallery::find($id);
        $items = Product::find($gallery->product_id);
        // dd($gallery);
        return view('pages.admin.data-produk.galleries.edit',[
            'items' => $items,
            'gallery' => $gallery
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Gallery::find($id);
        $validated = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'image' => 'required|image',
        ]);
        $validated['image'] = $request->file('image')->store('assets/gallery','public');
        $data->update($validated);
        return redirect()->route('gallery.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $item = Gallery::find($id);
        $link = $item->image;
        $file = explode("/",$link);
        // dd($link);
        // if(Storage::exists($file)){
        //     dd('filenya ada');
        // }
        // Storage::delete($file[2]);
        $item->delete();
        return redirect()->route('gallery.index');


    }
}
