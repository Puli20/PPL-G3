@extends('layouts.appUser')
@section('title','Gallery')


@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <!-- isi kontene -->
<h1>Data Produk</h1>
<a href="{{route('gallery.create')}}" class="btn btn-warning">+ Tambah</a>
<!-- iki jarno ae yud-->
<!--<div class="row mt-4">
    <div class="col-md-3">
        <div class="card shadow">
            <img src="{{url('frontend/assets/img/produk1.png')}}" height="200" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title" style="margin: 0; margin-bottom:10px">Kopi Tubruk</h5>
              <p>Rp 13.000</p>
              <a href="#" class="btn btn-primary btn-sm">Go somewhere</a>
            </div>
          </div>
    </div>
</div>-->

<table class="table">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Nama Produk</th>
        <th>Image</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
        <tr>
        <td>{{ $item->id }}</td>
        <td>{{ $item->product->product_name }}</td>
          <td>
            <img src="{{ Storage::url($item->image) }}" alt="Image">
            </td>
          <td class="d-flex">
              <a href="{{route('gallery.edit', $item->id)}}" class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
              <form action="{{route('gallery.destroy', $item->id)}}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm btn-danger" type="submit" ><i class="fa-solid fa-trash"></i></button>
              </form>
          </td>
        </tr>
        @endforeach

    </tbody>
  </table>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->

@endsection
