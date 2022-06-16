<?php

namespace App\Http\Controllers\admin;

use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use App\Models\TransactionDetail;
use App\Models\Expedition;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Transaction::all();
        // dd($items->user);
        return view('pages.admin.transaction.index',[
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $data = Transaction::find($id);
        $data->transaction_status = 'PROCESS';
        $data->save();

        return redirect()->route('transaction.index');
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

    public function showFormExpedition($id){
        $item = Transaction::find($id);
        return view('pages.admin.transaction.resi',[
            'item' => $item
        ]);
    }
    public function storeExpedition(Request $request,$id){
        $transaction = Transaction::find($id);
        // dd($transaction);
        $validated = $request->validate([
            'expedition_name' => 'required|max:50|string',
            'no_resi' => 'required|string|max:70'
        ]);
        $validated['transaction_id'] = $id;
        Expedition::create($validated);
        $transaction->transaction_status = 'SENT';
        $transaction->save();

        return redirect()->route('transaction.index');
    }
    public function transactionDetail($id){
        $transaction = Transaction::find($id);
        return view('pages.admin.transaction.transactionDetail',[
            'items' => $transaction
        ]);
    }
     public function report(){
        DB::statement("SET SQL_MODE=''");
        // $report = DB::select('SELECT transaction_date, products.product_name, COUNT(transaction_details.order_quantity) as terjual, products.price, transaction_total FROM `transactions` INNER JOIN transaction_details on transactions.id=transaction_details.transactions_id LEFT JOIN products ON transaction_details.products_id=products.id WHERE transactions.transaction_date BETWEEN 2022-01 AND 2022-12
        // GROUP BY products.product_name'
        // );
        $report = DB::select('SELECT transaction_date, products.product_name, COUNT(transaction_details.order_quantity) as terjual, products.price, transaction_total, monthname(transaction_date) as nama_bulan FROM `transactions` INNER JOIN transaction_details on transactions.id=transaction_details.transactions_id LEFT JOIN products ON transaction_details.products_id=products.id where month(transaction_date) between 01 and 12
        GROUP BY products.product_name'
        );
        // dd($report);
        $no = 1;
        return view('pages.admin.report.report',['items' => $report, 'no' => $no]);
     }
     public function exportPdf(){
        DB::statement("SET SQL_MODE=''");
        // $report = DB::select('SELECT transaction_date, products.product_name, COUNT(transaction_details.order_quantity) as terjual, products.price, transaction_total FROM `transactions` INNER JOIN transaction_details on transactions.id=transaction_details.transactions_id LEFT JOIN products ON transaction_details.products_id=products.id WHERE transactions.transaction_date BETWEEN 2022-01 AND 2022-12
        // GROUP BY products.product_name'
        // );
        $bulan_now = Carbon::now()->isoFormat('MMMM');
        $bulan_number = Carbon::now()->isoFormat('MM');
        // $bulan_number = 7;
        $report = DB::select('SELECT transaction_date, products.product_name, COUNT(transaction_details.order_quantity) as terjual, products.price, transaction_total, monthname(transaction_date) as nama_bulan FROM `transactions` INNER JOIN transaction_details on transactions.id=transaction_details.transactions_id LEFT JOIN products ON transaction_details.products_id=products.id where month(transaction_date) like '.$bulan_number.'
        GROUP BY products.product_name'
        );
        // dd($report);
        $no = 1;
        // return view('pages.admin.report.report',['items' => $report, 'no' => $no]);
        $pdf = PDF::loadView('pages/pdf',['items' => $report, 'no' => $no, 'bulan' => $bulan_now]);

        return $pdf->download('Laporan Bulanan');
     }
}
