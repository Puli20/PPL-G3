@extends('layouts.appUser')
@section('title','Ulasan')


@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <!-- isi kontene -->
<h1 class="mb-3">Ulasan</h1>
<table class="table table-sm">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Nama Customer</th>
        <th scope="col">Produk</th>
        <th scope="col">Ulasan</th>
        <th></th>
        <th scope="col">Bintang</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->user->name}}</td>
                <td>{{$item->product->product_name}}</td>
                <td colspan="2">
                    <input type="text" hidden id="comment" value="{{$item->comment}}">
                    {{substr($item->comment,0,10)}}
                    @if ($item->comment != null || $item->comment != '')
                    <button id="read-more" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Baca</button>
                    @endif
                </td>
                <td>{{$item->rate_value}}</td>
                <td class="d-flex">
                    <a href="{{route('review.edit',$item->id)}}" class="btn btn-primary btn-sm"><i class="fa-solid fa-reply"></i></a>
                    <form action="{{route('review.destroy',$item->id)}}" class="ms-2" method="POST">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Comment</h5>
          {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}

        </div>
        <div class="modal-body" style="word-wrap: break-word;" >
        <p id="text" style="word-wrap: break-word;"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
        </div>
      </div>
    </div>
  </div>

    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->

@endsection

@push('addon-script')
    <script>
         $(document).ready(function(){
        const buttonRead = document.querySelectorAll('#read-more')
        // console.log("halo")
        buttonRead.forEach(button => {
            button.onclick = (e)=>{
                const comment = $(e.target).siblings().first().val()
                // const detail_id = $(e.target).siblings().eq(1).html()
                // console.log(detail_id)
                $('.modal-body #text').html(comment)
                // $('#editForm').attr('action', `/checkout/cart/update/${detail_id}`);
                console.log(comment)
            }
        });
    })
    </script>
@endpush
