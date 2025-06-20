@extends('layout.main')
@section('title', 'Materi')

@section('content')
<div class="container">
    <h1>Edit Materi</h1>
    <form action="{{ route('materi.update', $materi->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Judul</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $materi->title) }}" placeholder="Masukkan judul materi" required>
            @error('title')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="content">Konten</label>
            <textarea name="content" id="content" class="form-control" rows="5" placeholder="Masukkan konten materi" required>{{ old('content', $materi->content) }}</textarea>
            @error('content')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('materi.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
