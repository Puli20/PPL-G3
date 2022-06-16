@extends('layouts.appUser')
@section('title','Pembeli')


@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <!-- isi kontene -->
<h1>Data Pembeli</h1>
<table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Nama</th>
        <th scope="col">Email</th>
        <th scope="col">Alamat</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        @if ($item->role == 0)
        <tr>
          <th>{{$item->id}}</th>
          <th>{{$item->name}}</th>
          <th>{{$item->email}}</th>
          <th>{{$item->alamat}}</th>
          <th></th>
        </tr>
        @endif
        @endforeach
    </tbody>
  </table>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->

@endsection
