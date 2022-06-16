@extends('layouts.appUser')
@section('title','Tambah Produk')


@section('content')
<div class="main-panel">
    <div class="content-wrapper">
    <form action="{{route('data-produk.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-3 align-items-center mb-3">
            <div class="col-9">
                <label for="">Nama produk</label>
                <input type="text" class="form-control" name="product_name">
            </div>
        </div>
        <div class="row g-3 align-items-center mb-3">
            <div class="col-auto">
                <label for="">Berat</label>
                <input type="integer" class="form-control" name="product_weight">
            </div>
            <div class="col-auto">
                <label for="">Harga</label>
                <input type="integer" class="form-control" name="price">
            </div>
            <div class="col-auto">
                <label for="">Stok</label>
                <input type="integer" class="form-control" name="stock">
            </div>
        </div>


        <div class="row g-3 align-items-center mb-3">
            <div class="col-9">
                <label for="">Deskripsi</label>
                {{-- <input type="text" class="form-control" name="description"> --}}
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Deskripsi . . ." id="floatingTextarea" name="description"></textarea>
                  </div>
            </div>
        </div>
        <button class="btn btn-warning mt-3" type="submit">Submit</button>
    </form>
    </div>
@endsection
