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
  margin-left: -12px
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
			<div class="row">
				<div class="col-lg-4">
					<div class="card">
						<div class="card-body">
                            <form action="{{route('edit-data-profil',$user->id)}}" method="POST" enctype="multipart/form-data">
							<div class=" d-flex flex-column align-items-center text-center">
                                <div class="upload">
                                      @if ($user->foto_profil == null)
                                        <img src="{{url('frontend/assets/img/noprofil.jpg')}}" width = 130 alt="">
                                        @else
                                        <img src="{{Storage::url($user->foto_profil)}}" style="background-size: cover;object-fit: cover;object-position: center;margin-left: -25px" height="150" width = 150 alt="">
                                        @endif
                                        <div class="round">
                                            <input class="form-control" name="foto_profil" type="file" id="formFile">
                                            <i class = "fa fa-camera" style = "color: #fff;"></i>
                                        </div>
                                    </div>
								<div class="mt-3">
									<h4>{{$user->name}}</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-8">
					<div class="card">
						<div class="card-body">
                                @csrf
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Nama</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="name" class="form-control" value="{{$user->name}}">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Tanggal lahir</h6>
								</div>
								<div class=" col-sm-9 text-secondary">
									<input type="date" name="tgl_lahir" class="form-control" value="{{$user->tgl_lahir}}">
                                    <div id="emailHelp" class="form-text">contoh : 2002-03-01 / tahun-bulan-tanggal</div>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Email</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="email" name="email" class="form-control" value="{{$user->email}}">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Nomor Telepon</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="number" name="no_telp" class="form-control" value="{{$user->no_telp}}">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Alamat</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="alamat" class="form-control" value="{{$user->alamat}}">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Password</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="password" name="password" class="form-control"  placeholder="Silahkan isi jika ingin mengubah password">
								</div>
							</div>
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									{{-- <input type="button" class="btn btn-primary px-4" value="Save Changes"> --}}
                                    <button class="btn btn-primary" type="submit">Ubah</button>
								</div>
							</div>
                        </form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
@endsection
