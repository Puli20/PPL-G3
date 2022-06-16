
@extends('layouts.appUser')
@section('title','Transaction Detail')


@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <!-- isi kontene -->
<h1>Detail Transaksi</h1>
<table class="table table-striped mt-4">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Nama Produk</th>
        <th scope="col">Jumlah</th>
        <th scope="col">Harga</th>
        <th scope="col">Ekspedisi</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($items->transaction_detail as $item)
        <tr>
          <td>{{$item->id}}</td>
          <td>{{$item->product->product_name}}</td>
          <td>{{$item->order_quantity}}</td>
          <td>{{$item->order_quantity*$item->product->price}}</td>
          <td>
              <table class="table table-sm">
                  <thead>
                      <tr>
                          <th>Ekspedisi</th>
                          <th>Resi</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                          <td>{{$item->transaction->expedition != null ? $item->transaction->expedition->expedition_name : '-'}}</td>
                          <td>{{$item->transaction->expedition != null ? $item->transaction->expedition->no_resi : '-'}}</td>
                      </tr>
                  </tbody>
              </table>
          </td>
        </tr>
        @endforeach
    </tbody>
  </table>

    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->

@endsection
