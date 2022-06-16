{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Produk</title>
</head>
<body>
    <form action="{{route('data-produk.update', $product->id)}}" method="POST">
        @method('PUT')
        @csrf
        <label for="">nama produk</label>
        <input type="text" name="product_name" value="{{$product->product_name}}">
        <label for="">berat</label>
        <input type="integer" name="product_weight" value="{{$product->product_weight}}">
        <label for="">harga</label>
        <input type="integer" name="price" value="{{$product->price}}">
        <label for="">description</label>
        <input type="text" name="description" value="{{$product->description}}">
        <button type="submit">Submit</button>
    </form>

</body>
</html> --}}
@extends('layouts.appUser')
@section('title','Tambah Produk')


@section('content')
<div class="main-panel">
    <div class="content-wrapper">
    <form action="{{route('data-produk.update', $product->id)}}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="row g-3 align-items-center mb-3">
            <div class="col-9">
                <label for="">Nama produk</label>
                <input type="text" class="form-control" name="product_name" value="{{$product->product_name}}">
            </div>
        </div>
        <div class="row g-3 align-items-center mb-3">
            <div class="col-auto">
                <label for="">Berat</label>
                <input type="integer" class="form-control" name="product_weight" value="{{$product->product_weight}}">
            </div>
            <div class="col-auto">
                <label for="">Harga</label>
                <input type="integer" class="form-control" name="price" value="{{$product->price}}">
            </div>
            <div class="col-auto">
                <label for="">Stok</label>
                <input type="integer" class="form-control" name="stock" value="{{$product->stock}}">
            </div>
        </div>


        <div class="row g-3 align-items-center mb-3">
            <div class="col-9">
                <label for="">Deskripsi</label>
                {{-- <input type="text" class="form-control" name="description"> --}}
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Deskripsi . . ." id="floatingTextarea" name="description">{{$product->description}}</textarea>
                  </div>
            </div>
        </div>
        <button class="btn btn-warning mt-3" type="submit">Submit</button>
    </form>
    </div>
@endsection
