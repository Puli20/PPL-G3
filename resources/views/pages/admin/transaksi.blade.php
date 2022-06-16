@extends('layouts.appUser')
@section('title','Transaksi')


@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <!-- isi kontene -->
<h1>Data Transaksi</h1>

<table class="table">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Nama Produk</th>
        <th scope="col">Pembeli</th>
        <th scope="col">Resi</th>
        <th scope="col">Total harga</th>
        <th scope="col">Status</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>

      <tr>
        <th>1</th>
        <td>Kopi tubruk</td>
        <td>Yudha</td>
        <td>-</td>
        <td>75.000</td>
        <td>PENDING</td>
        <td>
            <button class="btn btn-sm btn-primary">Terima</button>
        </td>
      </tr>
      <tr>
        <th>1</th>
        <td>Kopi tubruk</td>
        <td>Yudha</td>
        <td>-</td>
        <td>75.000</td>
        <td>SUCCESS</td>
        <td>
            <button class="btn btn-sm btn-primary" disabled>Diterima</button>
        </td>
      </tr>

    </tbody>
  </table>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->

@endsection
