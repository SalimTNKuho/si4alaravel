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
            <input type="text" name="title" id="title" class="form-control" value="{{ $materi->title }}" required>
        </div>
        <div class="form-group">
            <label for="content">Konten</label>
            <textarea name="content" id="content" class="form-control" rows="5" required>{{ $materi->content }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('materi.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
