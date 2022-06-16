@extends('layouts.appUser')
@section('title','Tambah Gallery')


@section('content')
<div class="main-panel">
    <div class="content-wrapper">
    <form action="{{route('gallery.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-3 align-items-center mb-3">
            <div class="col-9">
                <label for="">Nama produk</label>
                {{-- <input type="text" class="form-control" name="product_name"> --}}
                <select name="product_id" class="form-control" >
                    <option value="" selected>-- Pilih Produk --</option>
                    @foreach ($items as $item)
                        <option value="{{$item->id}}">{{$item->product_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row g-3 align-items-center mb-3">
            <div class="col-9">
                <label for="formFile"  class="form-label">Image</label>
                <input class="form-control" name="image" type="file" id="formFile">
            </div>
          </div>
        <button class="btn btn-warning mt-3" type="submit">Submit</button>
    </form>
    </div>
@endsection
