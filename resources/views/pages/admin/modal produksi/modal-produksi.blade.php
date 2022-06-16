@extends('layouts.appUser')
@section('title','Modal Produksi')


@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <!-- isi kontene -->
<h1>Modal Produksi</h1>
<a href="{{route('modal-produksi.create')}}" class="btn btn-warning mt-2 mb-2">+ Tambah</a>
<a href="{{route('modal-export-to-pdf')}}" class="btn btn-warning ms-2">Export <i class="fa-solid fa-file-pdf"></i></a>
<table class="table">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Tanggal</th>
        <th scope="col">Nama Produk</th>
        <th scope="col">Berat(Kg)</th>
        <th scope="col">Harga(Rp)</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->tanggal}}</td>
                <td>{{$item->product->product_name}}</td>
                <td>{{$item->berat}}</td>
                <td>{{$item->harga}}</td>
                <td>
                    <a href="{{route('modal-produksi.edit',$item->id)}}" class="btn btn-primary btn-sm">Edit</a>
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->

@endsection
