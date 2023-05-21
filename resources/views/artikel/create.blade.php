@extends('layout')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Artikel</h1>
        <a href="{{ route('artikel.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-lg-11">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Buat artikel baru</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('artikel.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user @error('judul') is-invalid @enderror"
                                id="judul" name="judul"
                                placeholder="Masukkan judul..." required>
                            @error('judul')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <textarea name="konten" id="konten" cols="30" rows="5" class="form-control @error('konten') is-invalid @enderror" placeholder="Masukkan konten disini..."></textarea>
                            @error('konten')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="reset" class="btn btn-danger">Reset</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
        
    </div>


</div>
@endsection