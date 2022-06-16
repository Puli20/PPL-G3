@extends('layouts.app')

@section('title','Graha Asri')

@push('addon-style')
<style type="text/css">
    body{
        /* margin-top:20px; */
        color: #1a202c;
        text-align: left;
        background-color: #e2e8f0;
    }
    .main-body {
        padding: 15px;
    }
    .card {
        box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid rgba(0,0,0,.125);
        border-radius: .25rem;
    }

    .card-body {
        flex: 1 1 auto;
        min-height: 1px;
        padding: 1rem;
    }

    .gutters-sm {
        margin-right: -8px;
        margin-left: -8px;
    }

    .gutters-sm>.col, .gutters-sm>[class*=col-] {
        padding-right: 8px;
        padding-left: 8px;
    }
    .mb-3, .my-3 {
        margin-bottom: 1rem!important;
    }

    .bg-gray-300 {
        background-color: #e2e8f0;
    }
    .h-100 {
        height: 100%!important;
    }
    .shadow-none {
        box-shadow: none!important;
    }
    .upload{
  width: 100px;
  position: relative;
  margin: auto;
}

.upload img{
  border-radius: 50%;
  border: 6px solid #eaeaea;
}

.upload .round{
  position: absolute;
  bottom: 0;
  right: 0;
  background: #00B4FF;
  width: 32px;
  height: 32px;
  line-height: 33px;
  text-align: center;
  border-radius: 50%;
  overflow: hidden;
}

.upload .round input[type = "file"]{
  position: absolute;
  transform: scale(2);
  opacity: 0;
}

input[type=file]::-webkit-file-upload-button{
    cursor: pointer;
}
    </style>
@endpush

@section('content')
<main>
    <div class="container">
        <div class="main-body">

              <!-- Breadcrumb -->
              <nav aria-label="breadcrumb" class="main-breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a class="text-decoration-none" href="{{route('home')}}">Home</a></li>
                  {{-- <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li> --}}
                  <li class="breadcrumb-item active" aria-current="page">Profil</li>
                </ol>
              </nav>
              <!-- /Breadcrumb -->

              <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex flex-column align-items-center text-center">
                          @if ($item->foto_profil == null)
                          <img src="https://ui-avatars.com/api/?name={{$item->name}}" alt="Admin" class="rounded-circle" width="150">
                          @else
                          <img src="{{Storage::url($item->foto_profil)}}" alt="Admin" style="background-size: cover;object-fit: cover;object-position: center" height="150" class="rounded-circle" width="150">
                          @endif
                        {{-- <div class="upload">
                            <img src="{{url('frontend/assets/img/noprofil.jpg')}}" width = 150 alt="">
                            <div class="round">
                              <input type="file">
                              <i class = "fa fa-camera" style = "color: #fff;"></i>
                            </div>
                          </div> --}}
                        <div class="mt-3">
                          <h4>{{$item->name}}</h4>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
                <div class="col-md-8">
                  <div class="card mb-3">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Nama</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          {{$item->name}}
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Tanggal Lahir</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          {{$item->tgl_lahir != null ? $item->tgl_lahir : '-'}}
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Email</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{$item->email}}
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Telepon</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{$item->no_telp != null ? $item->no_telp : '-'}}
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Alamat</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{$item->alamat != null ? $item->alamat : '-'}}
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Password</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            ********
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-12">
                          <a class="btn btn-info " href="{{route('edit-profil',$item->id)}}">Ubah</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
        </div>
</main>
@endsection
