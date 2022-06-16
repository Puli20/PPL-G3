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
        <th scope="col">ID</th>
        <th scope="col">Tanggal Transaksi</th>
        <th scope="col">Berat</th>
        <th scope="col">Jumlah</th>
        <th scope="col">Bukti Pembayaran</th>
        <th scope="col">Status</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
        <tr>
          <th>{{ $item->id }}</th>
          <td>{{$item->transaction_date}}</td>
          <td>{{$item->total_weight}}</td>
          <td>{{$item->transaction_detail->sum('order_quantity')}}</td>
          <td >
              @if ($item->proof_of_transaction)
              <a href="{{Storage::url($item->proof_of_transaction)}}" data-lightbox="{{$item->id}}" data-title="Bukti Pembayaran {{$item->user->name}}">
                <img src="{{Storage::url($item->proof_of_transaction)}}" alt="image">
            </a>
            @else
                Belum upload
              @endif
        </td>
          <td>{{$item->transaction_status}}</td>
          <td class="d-flex">
              @if ($item->transaction_status == 'PROCESS' || $item->transaction_status == 'SUCCESS' || $item->transaction_status == 'SENT')
              <button disabled type="submit" class="btn btn-sm btn-primary"><i class="fa-solid fa-circle-check"></i> <span>Diterima</span></button>
              @else
              <form action="{{route('transaction.update',$item->id)}}" method="POST">
                  @csrf
                  @method('put')
                  <button type="submit" class="btn btn-sm btn-primary"><i class="fa-solid fa-check-to-slot"></i> <span>Terima</span></button>
              </form>
              @endif

              @if ($item->expedition == null && $item->transaction_status == 'PROCESS')
              <a href="{{route('Form-Expedition',$item->id)}}" class="btn btn-sm btn-primary"><i class="fa-solid fa-truck-fast"></i> <span>Resi</span></a>
              @else
              <button disabled class="btn btn-sm btn-info"><i class="fa-solid fa-truck-fast"></i> <span>Resi</span></button>
              @endif

              <a href="{{route('transaction-detail',$item->id)}}" class="btn btn-sm btn-success" ><i class="fa-solid fa-eye"></i></a>

          </td>
        </tr>
        @endforeach
    </tbody>
  </table>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->

@endsection
