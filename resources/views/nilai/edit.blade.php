@extends('layout.main') {{-- Assuming AdminLTE 4 layout is named 'app' --}}
@section('title', 'Nilai')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Nilai</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('nilai.store') }}">Nilai</a></li>
                        <li class="breadcrumb-item active">Edit Nilai</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Edit Nilai</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('nilai.update', $nilai->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control" value="{{ $nilai->nama }}" required>
                        </div>
                        <div class="form-group">
                            <label for="nilai">Nilai</label>
                            <input type="number" name="nilai" id="nilai" class="form-control" value="{{ $nilai->nilai }}" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('nilai.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
