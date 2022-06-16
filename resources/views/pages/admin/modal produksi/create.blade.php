@extends('layouts.appUser')
@section('title','Tambah data modal produksi')


@section('content')
<div class="main-panel">
    <div class="content-wrapper">
    <form action="{{route('modal-produksi.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-3 align-items-center mb-3">
            <div class="col-9">
                <label for="">Nama produk</label>
                <select name="product_id" class="form-control" >
                    <option value="" selected>-- Pilih Produk --</option>
                    @foreach ($items as $item)
                        <option value="{{$item->id}}">{{$item->product_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row g-3 align-items-center mb-3">
            <div class="col-auto">
                <label for="">Berat(Kg)</label>
                <input type="integer" class="form-control" name="berat">
            </div>
            <div class="col-auto">
                <label for="">Harga</label>
                <input type="integer" class="form-control" name="harga">
            </div>
        </div>
        <button class="btn btn-warning mt-3" type="submit">Submit</button>
    </form>
    </div>
@endsection
