@extends('layouts.appUser')
@section('title','Edit Modal Produksi')


@section('content')
<div class="main-panel">
    <div class="content-wrapper">
    <form action="{{route('modal-produksi.update',$items->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="row g-3 align-items-center mb-3">
            <div class="col-9">
                <label for="">Nama produk</label>
                {{-- <input type="text" class="form-control" name="product_name"> --}}
                <select name="product_id" class="form-control" >
                        <option value="{{$items->product_id}}" selected>{{$items->product->product_name}}</option>
                </select>
            </div>
        </div>
        <div class="row g-3 align-items-center mb-3">
            <div class="col-auto">
                <label for="">Berat(Kg)</label>
                <input type="integer" class="form-control" name="berat" value="{{$items->berat}}">
            </div>
            <div class="col-auto">
                <label for="">Harga</label>
                <input type="integer" class="form-control" name="harga" value="{{$items->harga}}">
            </div>
        </div>
        <button class="btn btn-warning mt-3" type="submit">Submit</button>
    </form>
    </div>
@endsection
