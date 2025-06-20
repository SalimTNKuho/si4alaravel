@extends('layout.main')
@section('title', 'Edit Materi')

@section('content')
<div class="container">
    <h1>Edit Materi</h1>
    <form action="{{ route('materi.update', $materi->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="judul">Judul</label>
            <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul', $materi->judul) }}" placeholder="Masukkan judul materi" required>
            @error('judul')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="nama_materi">Nama Materi</label>
            <input type="text" name="nama_materi" id="nama_materi" class="form-control" value="{{ old('nama_materi', $materi->nama_materi) }}" placeholder="Masukkan nama materi" required>
            @error('nama_materi')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="konten">Konten</label>
            <textarea name="konten" id="konten" class="form-control" rows="5" placeholder="Masukkan konten materi" required>{{ old('konten', $materi->konten) }}</textarea>
            @error('konten')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('materi.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
