<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ModalProduction;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Carbon\Carbon;
use PDF;

class ProductionCapital extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = ModalProduction::all();
        return view('pages.admin.modal produksi.modal-produksi',['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Product::all();
        return view('pages.admin.modal produksi.create',['items'=>$items]);
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
            'product_id' => 'required|integer',
            'berat' => 'required|integer',
            'harga' => 'required|integer',
        ]);
        $validated['tanggal'] = date('Y-m-d');
        // dd($validated);
        ModalProduction::create($validated);

        return redirect()->route('modal-produksi.index');
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
        $items = ModalProduction::find($id);
        return view('pages.admin.modal produksi.edit',['items'=>$items]);
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
        $data = ModalProduction::find($id);
        $validated = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'berat' => 'required|integer',
            'harga' => 'required|integer',
        ]);
        $data->update($validated);
        return redirect()->route('modal-produksi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function exportPDFModal(){
        $bulan_number = Carbon::now()->isoFormat('MM');
        $bulan_now = Carbon::now()->isoFormat('MMMM');
       $items = DB::select('select * from modal_produksi inner join products on modal_produksi.product_id=products.id where month(tanggal) = ?', [$bulan_number]);
        // dd($items);
        $no = 1;
        $pdf = PDF::loadView('pages/admin/pdfModal',['items' => $items, 'no' => $no, 'bulan' => $bulan_now]);
        return $pdf->download('Modal Produksi');

    }
}
