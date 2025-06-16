@extends('layout.main')
@section('title', 'Nilai')

@section('content')
<div class="container">
    <h1>Edit Nilai</h1>
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
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('nilai.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
